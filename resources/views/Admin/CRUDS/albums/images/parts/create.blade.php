<!--begin::Form-->

<form id="form" enctype="multipart/form-data" method="POST" action="{{route('images.store')}}">
    @csrf
    <div class="row">

        <div class="form-group">
            <label for="image" class="form-control-label">الصورة</label>
            <input id="image" type="file" class="dropify" name="image" data-default-file="" accept="image/png, image/gif, image/jpeg,image/jpg"/>
            <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif, jpeg, jpg</span>
        </div>

        <div class="d-flex flex-column mb-7 fv-row col-sm-12">
            <!--begin::Label-->
            <label for="title"  class="d-flex align-items-center fs-6 fw-bold form-label mb-2">
                <span class="required mr-1">الاسم</span>
            </label>
            <!--end::Label-->
            <input id="title" required type="text" class="form-control form-control-solid" placeholder="الاسم " name="title" value=""/>
        </div>
        <input type="hidden" value="{{$id}}" name="album_id">


    </div>
</form>
<script>
    $('.dropify').dropify();

</script>
