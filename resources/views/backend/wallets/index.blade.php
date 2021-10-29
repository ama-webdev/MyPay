@extends('backend.layouts.app')
@section('wallet-active', 'active')

@section('content')
    <div class="content-title">
        <div>
            <i class="far fa-wallet"></i><span>Wallets</span>
        </div>

    </div>
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="wallets_table" class="table table-bordered" style="width:100%">
                    <thead>
                        <tr class="bg-light">
                            <th>Account Number</th>
                            <th>Account Person</th>
                            <th>Amount (MMK)</th>
                            <th>Cteated At</th>
                            <th>Updated At</th>
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
            var table = $('#wallets_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "/admin/wallets/datatables/ssd",
                columns: [{
                        data: "account_number",
                        name: "account_number"
                    },
                    {
                        data: "account_person",
                        name: "account_person"
                    },
                    {
                        data: "amount",
                        name: "amount"
                    },
                    {
                        data: "created_at",
                        name: "created_at",
                    },{
                        data: "updated_at",
                        name: "updated_at",
                    },
                ],
                order:[
                    [4,'desc'],
                ]
            });

            $("#users_table").on('click', '.delete-btn', function(e) {
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
                            url: '/admin/users/' + id,
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
