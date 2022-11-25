@extends('Admin.layouts.inc.app')
@section('title')
    الالبومات
@endsection
@section('css')
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">الالبومات</h5>

                    <div>
                        <button id="addBtn" class="btn btn-primary">اضافة البوم</button>
                    </div>

                </div>
                <div class="card-body">
                    <table id="table" class="table table-bordered dt-responsive nowrap table-striped align-middle"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الالبوم</th>
                            <th> تفاصيل الالبوم</th>
                            <th> تاريخ الانشاء</th>
                            <th>العمليات</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="Modal" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2><span id="operationType"></span> البوم </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer"
                         data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="form-load">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-3">
                            الفاء
                        </button>
                        <button form="form" type="submit" id="submit" class="btn btn-primary">
                            <span class="indicator-label">اتمام</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>




    <div class="modal fade" id="ModalDelete" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog modal-dialog-centered modal-lg mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content" id="modalContent">
                <!--begin::Modal header-->
                <div class="modal-header">
                    <!--begin::Modal title-->
                    <h2> خيارت نقل صور الالبوم </h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" style="cursor: pointer"
                         data-bs-dismiss="modal" aria-label="Close">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                 fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)"
                                      fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                      fill="black"/>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7" id="form-load-delete">

                </div>
                <!--end::Modal body-->
                <div class="modal-footer">
                    <div class="text-center">
                        <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-3">
                            الفاء
                        </button>
                        <button form="form-change" type="submit" id="submit-delete" class="btn btn-primary">
                            <span class="indicator-label">اتمام</span>
                        </button>
                    </div>
                </div>
            </div>

            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>

@endsection
@section('js')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'images', name: 'images'},
            {data: 'created_at', name: 'created_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ];
    </script>
    @include('Admin.layouts.inc.ajax',['url'=>'albums'])

    <script>
        $(document).on('click', '.deleteRow', function () {

            var id = $(this).data('id');
            swal.fire({
                title: "هل انت متأكد من الحذف؟",
                text: "لا يمكنك التراجع بعد ذلك؟",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "نعم",
                cancelButtonText: "الغاء",
                okButtonText: "نعم",
                closeOnConfirm: false
            }).then((result) => {
                if (!result.isConfirmed) {
                    return true;
                }


                var url = '{{ route("albums.destroy",":id") }}';
                url = url.replace(':id', id)
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    beforeSend: function () {
                        $('.loader-ajax').show()

                    },
                    success: function (data) {

                        window.setTimeout(function () {
                            $('.loader-ajax').hide()
                            if (data.code == 200) {
                                toastr.success(data.message)
                                $('#table').DataTable().ajax.reload(null, false);
                            } else if (data.code == 202) {
                                toastr.error(data.message)

                                $('#form-load-delete').html(loader)

                                $('#ModalDelete').modal('show')
                                setTimeout(function () {
                                    $('#form-load-delete').html(data['html'])
                                }, 1000)

                            } else {
                                toastr.error('there is an error')
                            }

                        }, 1000);
                    }, error: function (data) {

                        if (data.status === 500) {
                            toastr.error('there is an error')
                        }


                        if (data.status === 422) {
                            var errors = $.parseJSON(data.responseText);

                            $.each(errors, function (key, value) {
                                if ($.isPlainObject(value)) {
                                    $.each(value, function (key, value) {
                                        toastr.error(value)
                                    });

                                } else {

                                }
                            });
                        }
                    }

                });
            });
        });
    </script>

    <script>
        $(document).on('change', '.changeAlbum', function () {
            var deleted = $(this).val();
            var id = $(this).attr('data-id');


            if (deleted == 1) {

                var url = "{{route('admin.getAlbumSelect',':id')}}";
                url = url.replace(':id', id);
                $('#albumID').load(url);


            } else {
                $('#albumID').text('');
            }
        })
    </script>
    <script>

        $(document).on('submit',"#form-change",function (e) {
            e.preventDefault();

            var formData = new FormData(this);

            var url = $('#form-change').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function () {


                    $('#submit-delete').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">جاري العمل</span>').attr('disabled', true);
                    $('#form-load-delete').append(loader)
                    $('#form-change').hide()
                },
                complete: function () {
                },
                success: function (data) {

                    window.setTimeout(function () {
                        $('#submit-delete').html('ا تمام').attr('disabled', false);

// $('#product-model').modal('hide')
                        if (data.code == 200) {
                            toastr.success(data.message)
                            $('#ModalDelete').modal('hide')
                            $('#table').DataTable().ajax.reload(null, false);
                        }else {
                            $('#form-load-delete > .linear-background').hide(loader)
                            $('#form-change').show()
                            toastr.error(data.message)
                        }
                    }, 1000);



                },
                error: function (data) {
                    $('#form-load-delete > .linear-background').hide(loader)
                    $('#submit-delete').html('اتمام').attr('disabled', false);
                    $('#form-change').show()
                    if (data.status === 500) {
                        toastr.error('there is an error')
                    }

                    if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);

                        $.each(errors, function (key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    toastr.error(value)
                                });

                            } else {

                            }
                        });
                    }
                    if (data.status == 421){
                        toastr.error(data.message)
                    }

                },//end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>

@endsection
