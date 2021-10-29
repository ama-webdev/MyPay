<?php

namespace App\Http\Controllers\Frontend;

// use Illuminate\Http\Request;

use App\Helpers\UUIDGenerate;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePhone;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdatePassword;
use App\Http\Requests\TransferFormValidate;
use App\Http\Requests\TransferCompleteFormValidate;
use App\Transaction;
use Symfony\Component\CssSelector\Node\FunctionNode;
use LaravelQRCode\Facades\QRCode;

class PageController extends Controller
{
    public function home()
    {
        return view('frontend.index');
    }
    public function menu()
    {
        return view('frontend.menu');
    }
    public function changePassword()
    {
        return view('frontend.change-password');
    }
    public function updatePassword(UpdatePassword $request)
    {
        $old_password = $request->old_password;
        $new_password = $request->new_password;

        $user = Auth::guard('web')->user();

        if (Hash::check($old_password, $user->password)) {
            $user->password = Hash::make($new_password);
            $user->update();
            return redirect()->route('menu')->with('updated', 'Successfully Update');
        }
        return back()->withErrors(['old_password' => 'Old Password is not correct.'])->withInput();
    }
    public function changePhone()
    {
        return view('frontend.change-phone');
    }
    public function updatePhone(UpdatePhone $request)
    {
        $password = $request->password;
        $user = Auth::guard('web')->user();

        if (Hash::check($password, $user->password)) {
            $user->phone = $request->phone;
            $user->update();
            return redirect()->route('menu')->with('updated', 'Successfully Update');
        }
        return back()->withErrors(['password' => 'Password is not correct.'])->withInput();
    }

    public function transfer()
    {
        $user = Auth::guard('web')->user();
        return view('frontend.transfer', compact('user'));
    }

    public function transferConfirm(TransferFormValidate $request)
    {
        $to_phone = $request->to_phone;
        $old_hash = $request->hash_value;
        $new_hash = hash_hmac('sha256', $to_phone, 'mypay123!@#');

        $is_to_phone = User::where('phone', $to_phone)->first();
        if (!$is_to_phone) {
            return back()->withErrors(['to_phone' => 'This number is not register in our system'])->withInput();
        }

        if ($to_phone == Auth::user()->phone) {
            return back()->withErrors(['to_phone' => 'you cannot transfer yourself.'])->withInput();
        }

        if ($new_hash != $old_hash) {
            return back()->with('fail', 'The given data is invalid');
        }

        $user = $is_to_phone;
        return view('frontend.transfer-confirm', compact('user', 'to_phone'));
    }

    public function transferComplete(TransferCompleteFormValidate $request)
    {
        $to_phone = $request->to_phone;
        $amount = $request->amount;
        $note = $request->note;

        $is_to_phone = User::where('phone', $to_phone)->first();
        if (!$is_to_phone) {
            return back()->withErrors(['to_phone' => 'This number is not register in our system'])->withInput();
        }

        if ($to_phone == Auth::user()->phone) {
            return back()->withErrors(['to_phone' => 'you cannot transfer yourself.'])->withInput();
        }


        $from_account = Auth::user();
        $to_account = User::where('phone', $to_phone)->first();

        if (!$from_account->wallet || !$to_account->wallet) {
            return back()->withErrors(['fail' => 'Something went wrong.'])->withInput();
        }

        if ($from_account->wallet->amount < $amount) {
            return back()->with('fail', 'You have not insufficient money.');
        }

        if ($amount <= 0) {
            return back()->with('fail', 'Amount must be greater than 0');
        }

        DB::beginTransaction();
        try {
            $from_account_wallet = $from_account->wallet;
            $from_account_wallet->decrement('amount', $amount);
            $from_account_wallet->update();

            $to_account_wallet = $to_account->wallet;
            $to_account_wallet->increment('amount', $amount);
            $to_account_wallet->update();

            $ref_no = UUIDGenerate::ref_no();

            $from_account_transaction = new Transaction();
            $from_account_transaction->ref_no = $ref_no;
            $from_account_transaction->trx_id = UUIDGenerate::trx_id();
            $from_account_transaction->user_id = $from_account->id;
            $from_account_transaction->type = 2;
            $from_account_transaction->amount = $amount;
            $from_account_transaction->source_id = $to_account->id;
            $from_account_transaction->note = $note;
            $from_account_transaction->save();

            $to_account_transaction = new Transaction();
            $to_account_transaction->ref_no = $ref_no;
            $to_account_transaction->trx_id = UUIDGenerate::trx_id();
            $to_account_transaction->user_id = $to_account->id;
            $to_account_transaction->type = 1;
            $to_account_transaction->amount = $amount;
            $to_account_transaction->source_id = $from_account->id;
            $to_account_transaction->note = $note;
            $to_account_transaction->save();


            DB::commit();
            return redirect()->route('transactionDetail', $from_account_transaction->trx_id)->with('success', 'Successfully transfered');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['fail' => $e->getMessage()])->withInput();
        }
    }

    public function checkPassword(Request $request)
    {
        if (Hash::check($request->password, Auth::user()->password)) {
            return response()->json([
                'status' => 'success',
                'message' => 'The Password is correct'
            ]);
        }
        return response()->json([
            'status' => 'fail',
            'message' => 'The Password is incorrect'
        ]);
    }

    public function transaction(Request $request)
    {
        $user = Auth::user();

        $transactions = Transaction::with('user', 'source')->where('user_id', $user->id)->orderBy('created_at', 'DESC');

        if ($request->type) {
            $transactions = $transactions->where('type', $request->type);
        }

        if ($request->date) {
            $transactions = $transactions->whereDate('created_at', $request->date);
        }

        $transactions = $transactions->paginate(5);
        return view('frontend.transaction', compact('transactions'));
    }

    public function transactionDetail(Request $request, $id)
    {
        $transaction = Transaction::with('user', 'source')->where('user_id', Auth::user()->id)->where('trx_id', $id)->first();
        return view('frontend.transaction-detail', compact('transaction'));
    }

    public function hashPhone(Request $request)
    {
        $to_phone = $request->to_phone;
        $hash_value = hash_hmac('sha256', $to_phone, 'mypay123!@#');

        return response()->json([
            'status' => 'success',
            'data' => $hash_value
        ]);
    }

    public function myQR()
    {
        return view('frontend.myqr');
    }

    public function myScan()
    {
        return view('frontend.myscan');
    }

    public function commingSoon()
    {
        return view('frontend.comming-soon');
    }
}
