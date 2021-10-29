<?php

namespace App\Http\Controllers\Backend;

use App\AdminUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminUser;
use App\Http\Requests\UpdateAdminUser;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\Datatables\Datatables;
use Jenssegers\Agent\Agent;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.admin_users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin_users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdminUser $request)
    {
        $admin_user = new AdminUser();
        $admin_user->name = $request->name;
        $admin_user->email = $request->email;
        $admin_user->phone = $request->phone;
        $admin_user->password = Hash::make($request->password);

        $admin_user->save();
        return redirect()->route('admin.admin-users.index')->with('created', 'Successfully Created');
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
        $admin_user = AdminUser::findOrFail($id);
        return view('backend.admin_users.edit', compact('admin_user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAdminUser $request, $id)
    {
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->name = $request->name;
        $admin_user->email = $request->email;
        $admin_user->phone = $request->phone;
        $admin_user->password = $request->password ? Hash::make($request->password) : $admin_user->password;

        $admin_user->update();
        return redirect()->route('admin.admin-users.index')->with('updated', 'Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin_user = AdminUser::findOrFail($id);
        $admin_user->delete();
        return "success";
    }

    public function ssd()
    {
        $data = AdminUser::query();
        return Datatables::of($data)
            ->addColumn('action', function ($each) {
                $edit = '<a href="' . route('admin.admin-users.edit', $each->id) . '" class="text-warning edit-btn mr-2"><i class="fas fa-edit"></i></a>';
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
