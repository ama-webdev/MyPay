@extends('backend.layouts.app')
@section('user-active', 'active')
@section('admin-user-active', 'active')

@section('content')
    <div class="content-title">
        <div>
            <i class="far fa-user"></i><span>Admin Users</span>
        </div>
        <a href="{{ route('admin.admin-users.create') }}" class="btn btn-primary btn-sm mt-2"><i
                class="far fa-plus"></i>Create Admin User</a>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="admin_users_table" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-light">
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Ip</th>
                            <th>User Agent</th>
                            <th>Cteated At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            var table = $('#admin_users_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/admin-users/datatables/ssd",
                columns: [{
                        data: "name",
                        name: "name"
                    },
                    {
                        data: "email",
                        name: "email"
                    },
                    {
                        data: "phone",
                        name: "phone"
                    },
                    {
                        data: "ip",
                        name: "ip",
                        searchable:false,
                        sortable:false,
                    },
                    {
                        data: "user_agent",
                        name: "user_agent",
                        sortable:false,
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                    },{
                        data: "updated_at",
                        name: "updated_at",
                    },
                    {
                        data: "action",
                        name: "action",
                        searchable:false,
                        sortable:false,
                    },
                ],
                order:[
                    [6,'desc'],
                ]
            });

            $("#admin_users_table").on('click', '.delete-btn', function(e) {
                e.preventDefault();
                var id = $(this).data('id');


                Swal.fire({
                    title: 'Are you sure you want to delete ?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/admin/admin-users/' + id,
                            type: 'DELETE',
                            success: function() {
                                table.ajax.reload();
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection
