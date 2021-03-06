@extends('layouts.index')

@section('title')
    Role
@endsection

@section('content')
<style>
    .dataTables_empty {
        text-align: center;
    }
    .dataTables_filter {
        float: right;
    }
    .dataTables_filter input {
        margin-left: 0px !important;
    }
    .card {
        padding: 8px;
    }
    .pagination {
        float: right;
    }
</style>
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-left mb-0">Role</h2>
                    <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                            <li class="breadcrumb-item">User</li>
                            <li class="breadcrumb-item active">Role</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <button class="btn btn-info mb-2" id="button-add">Add</button>
        <!-- Basic table -->
        <section id="basic-datatable">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <table class="datatables-basic table">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal to add new record -->
            <div class="modal modal-slide-in fade" id="form-modal">
                <div class="modal-dialog sidebar-sm">
                    <form class="add-new-record modal-content pt-0" id="form-role">
                        <input type="hidden" name="hidden_id" id="hidden_id" />
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">??</button>
                        <div class="modal-header mb-1">
                            <h5 class="modal-title">New Record</h5>
                        </div>
                        <div class="modal-body flex-grow-1">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" class="form-control name_error" id="name" name="name" placeholder="Name" aria-label="Name" />
                                <div class="invalid-feedback" id="name_error"></div>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="description">Description</label>
                                <input type="text" class="form-control description_error" id="description" name="description" placeholder="Description" aria-label="Description" />
                                <div class="invalid-feedback" id="description_error"></div>
                            </div>
                            <button type="submit" class="btn btn-primary data-submit mr-1">Add</button>
                            <button type="button" class="btn btn-outline-secondary btn-cancel" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!--/ Basic table -->
    </div>
</div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            var _token = '{{ csrf_token() }}';
            
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': _token
                }
            });

            // datatable
            $('.datatables-basic').DataTable({
                processing: true,
                serverside: true,
                autoWidth: false,
                bLengthChange: true,
                pageLength: 10,
                ajax: {
                    url: "{{route('admin.role.index')}}",
                },
                columns: [
                    {data: "id", render: function (data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        },
                    },
                    {data: "name", name: "name", orderable: false},
                    {data: "description", name: "description", orderable: false},
                    {data: "action", name: "action", orderable: false},
                ],
                columnDefs: [
                    { width: "10%", "targets": [0] },
                    { width: "25%", "targets": [3] },
                    { className: "text-center", "targets": [3] },
                ]
            });
            
        })

        // display modal form
        $('#button-add').on('click', function () {
            $('#form-modal').modal('show');
        })

        //submit form
        $('#form-role').on('submit', function (e) {
            e.preventDefault();
            if ($('.data-submit').text() == 'Add') {
                $.ajax({
                    url: "{{ route('admin.role.store') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                        if (data.errors) {
                            console.log(data.errors);
                            $.each(data.errors, function (i,v) {
                                $('.' + i + '_error').addClass('is-invalid');
                                $('#' + i + '_error').html(v);
                            })
                        }
                        if (data.success) {
                            $('#form-modal').modal('hide');
                            $('#form-role')[0].reset();
                            bootbox.alert({
                                message: "Save data has been successfully",
                                callback: function () {
                                    location.reload();
                                }
                            });
                            $('.datatables-basic').DataTable().ajax.reload();
                        }
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.statusText);
                        bootbox.alert({
                              message: "Error Server, Please Contact Your Adminstrator",
                              callback: function () {
                                location.reload();
                              }
                        });
                        $('#form-modal').modal('hide');
                        $('#form-role')[0].reset();
                    }
                })
            }

            if ($('.data-submit').text() == 'Edit') {
                $.ajax({
                    url: "{{ route('admin.role.update') }}",
                    method: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {
                      if (data.errors) {
                          console.log(data.errors);
                          $.each(data.errors, function (i,v) {
                              $('.' + i + '_error').addClass('is-invalid');
                              $('#' + i + '_error').html(v);
                          })
                      }
                      if (data.success) {
                          $('#form-modal').modal('hide');
                          $('#form-role')[0].reset();
                          bootbox.alert({
                              message: "Update data has been successfully",
                              callback: function () {
                                location.reload();
                              }
                          });
                          $('.datatables-basic').DataTable().ajax.reload();
                      }
                    },
                    error: function(xhr, textStatus, error) {
                        console.log(xhr.statusText);
                        bootbox.alert({
                              message: "Error Server, Please Contact Your Adminstrator",
                              callback: function () {
                                location.reload(true);
                              }
                        });
                        $('#form-modal').modal('hide');
                        $('#form-role')[0].reset();
                    }
                })
            }
        })

        // display modal edit
        $(document).on('click', '#edit', function () {
            var id = $(this).attr('data-id');
            
            $.ajax({
                url: "{{ route('admin.role.edit') }}",
                method: "POST",
                data: {id:id},
                success: function (resp) {
                    console.log(resp);
                    $('#hidden_id').val(resp.data.id);
                    $('#name').val(resp.data.name);
                    $('#description').val(resp.data.description);
                    $('.modal-title').text('Edit Record');
                    $('.data-submit').text('Edit');
                    $('#form-modal').modal('show');
                }
            })
        })

        // delete data
        $(document).on('click', '#delete', function () {
            var id = $(this).attr('data-id');

            bootbox.confirm("Are you sure to delete this data ?", function(result) {
                if (result) {
                    $.ajax({
                        url: "{{ route('admin.role.destroy') }}",
                        method: "POST",
                        data: {id:id},
                        success: function (resp) {
                            bootbox.alert("Delete data has been successfully");
                            $('.datatables-basic').DataTable().ajax.reload();
                        },
                        error: function (resp) {
                            var res = resp.responseJSON;
                            bootbox.alert(res.message);
                        }
                    })
                }
            }); 
        })

        // reload page if dismiss modal
        $('.close, .btn-cancel').on('click', function () {
            location.reload();
        })
    </script>
@endsection