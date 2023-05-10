@extends('admin.layouts.main')
@section('title', 'User')

@section('stylesheet')

@endsection

@section('breadcumbs')
@include('admin.templates.breadcrumbs')
@endsection

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>{{$menu['breadcrumbs']->name}} Table</h5>
            </div>
            <div class="card-body">
                @php
                $current_path = \Request::route()->getName();
                getPagesAccess($current_path);
                @endphp
                <div class="card-datatable table-responsive">
                    <table id="contentTable" class="display table nowrap table-striped table-hover" style="width:100%">
                        <thead>
                            <tr class="table100-head">
                                <th width="3%" class="text-center">No</th>
                                <th>Nama Lengkap</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Group</th>
                                <th>Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>


</div>

@include('admin.contents.user._modal')

@endsection

@section('script')


<script type="text/javascript">
    var url = {
        detail: "{{route('dashboard_user_detail')}}",
        delete: "{{route('dashboard_user_delete')}}",
        submit: "{{route('dashboard_user_post')}}",
        table: "{{route('dashboard_user_table')}}"
    };
    var table;


    $(document).ready(function() {
        var CSRF_TOKEN = "{{@csrf_token()}}";
        const tglLahir = flatpickr("#tgl_lahir", {
            enableTime: false,
            dateFormat: "Y-m-d",
            required: true
        }); // flatpickr
        table = $('#contentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: url.table,
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    title: '#',
                    width: '2%'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: 'username',
                    name: 'username'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'group.name',
                    name: 'group',
                    defaultContent: '#'
                },
                {
                    data: 'status',
                    name: 'status',
                    render: function(data, type, row) {
                        if (data == 1) {
                            return 'Aktif';
                        } else if (data == 0) {
                            return 'Tidak Aktif';
                        } else {
                            return '';
                        }
                    }
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false,
                    className: 'text-center',
                    width: '15%'
                },
            ]
        });

        $(document).on('click', '.view', function(e) {
            let id = $(this).data('id');
            e.preventDefault();
            formDisable();
            modalShow('myModal', 'View Data');
            $.get(url.detail, {
                id: id
            }, function(result) {

                let response = result.data;
                $('#fullname').val(response.fullname)
                $('#username').val(response.username)
                $('#nik').val(response.nik)
                $('#email').val(response.email)
                $('#no_hp').val(response.no_hp)
                $('#alamat').val(response.alamat)
                $('#tempat_lahir').val(response.tempat_lahir)
                $('#tgl_lahir').val(response.tgl_lahir)
                $('#group').val(response.group.id).trigger('change')
                $('#unlat').val(response.unlat.id).trigger('change')
                $('#sabuk').val(response.sabuk.id).trigger('change')
                $('#kategori').val(response.kategori.id).trigger('change')
                $('#agama').val(response.agama.id).trigger('change')
                $('#status').val(response.status).trigger('change')


            });

        });

        $(document).on('click', '.update', function(e) {
            let id = $(this).data('id');
            e.preventDefault();
            formEnable();
            modalShow('myModal', 'Update Data');

            $.get(url.detail, {
                id: id
            }, function(result) {
                let response = result.data;
                $('#id').val(response.id)
                $('#fullname').val(response.fullname)
                $('#username').val(response.username)
                $('#nik').val(response.nik)
                $('#email').val(response.email)
                $('#no_hp').val(response.no_hp)
                $('#alamat').val(response.alamat)
                $('#tempat_lahir').val(response.tempat_lahir)
                $('#tgl_lahir').val(response.tgl_lahir)
                $('#group').val(response.group.id).trigger('change')
                $('#unlat').val(response.unlat.id).trigger('change')
                $('#sabuk').val(response.sabuk.id).trigger('change')
                $('#kategori').val(response.kategori.id).trigger('change')
                $('#agama').val(response.agama.id).trigger('change')
                $('#status').val(response.status).trigger('change')

            });

        });
        $(document).on('click', '.delete', function(e) {
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': CSRF_TOKEN
                }
            });
            Swal.fire({
                title: `Are you sure delete ${$(this).data('name')}?`,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                            url: url.delete,
                            method: 'GET',
                            data: {
                                id: $(this).data('id'),
                            },
                        })
                        .then((result) => {
                            swalStatus(result, "myModal")
                        }).then(() => {
                            tableReload(table)
                        });
                }
            });
        });

        $('#formModal').validate({ // initialize the plugin
            rules: {
                username: {
                    required: true,
                }

            },
            submitHandler: function(form) {
                let data = $('#formModal').serialize();

                $.post(url.submit, data, function(result) {
                    swalStatus(result, "myModal", '', table)
                });
            }
        });

    });
</script>

@endsection