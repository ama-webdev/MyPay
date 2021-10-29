<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\UUIDGenerate;
use App\User;
use App\Wallet;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use Yajra\Datatables\Datatables;
use App\Http\Requests\UpdateUser;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            Wallet::firstOrCreate(
                [
                    'user_id' =>  $user->id,
                ],
                [
                    'account_number' => UUIDGenerate::accountNumber(),
                    'amount' => 5000000,
                ]
            );

            DB::commit();

            return redirect()->route('admin.users.index')->with('created', 'Successfully Created');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['fail' => 'something wrong'])->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('backend.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password ? Hash::make($request->password) : $user->password;

            $user->update();
            Wallet::firstOrCreate(
                [
                    'user_id' =>  $user->id,
                ],
                [
                    'account_number' => UUIDGenerate::accountNumber(),
                    'amount' => 5000000,
                ]
            );
            DB::commit();
            return redirect()->route('admin.users.index')->with('updated', 'Successfully Updated');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['fail' => 'something wrong'])->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return "success";
    }

    public function ssd()
    {
        $data = User::query();
        return Datatables::of($data)
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.users.edit', $each->id) . '" class="text-warning edit-btn mr-2"><i class="fas fa-edit"></i></a>';
                $delete = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fas fa-trash"></i></a>';
                return $edit . $delete;
            })
            ->editColumn('user_agent', function ($each) {
                if ($each->user_agent) {
                    $agent = new Agent();
                    $device = $agent->device();
                    $platform = $agent->platform();
                    $browser = $agent->browser();
                    $table = '<table class="table table-bordered">
                <tr><td>Device</td><td>' . $device . '</td></tr>
                <tr><td>Platform</td><td>' . $platform . '</td></tr>
                <tr><td>Browser</td><td>' . $browser . '</td></tr>
                </table>';
                    return $table;
                }
                return '-';
            })
            ->editColumn('created_at', function ($each) {
                return Carbon::parse($each->created_at)->format('Y-m-d H:i:s');
            })
            ->editColumn('updated_at', function ($each) {
                return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
            })
            ->rawColumns(['user_agent', 'action'])
            ->make(true);
    }
}
