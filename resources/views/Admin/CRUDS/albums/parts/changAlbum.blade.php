<form id="form-change" enctype="multipart/form-data" method="POST" action="{{route('admin.moveImagesFromAlbum',$album->id)}}">
    @csrf
    <div class="row">

        <div class="row g-3">
            <div class="d-flex align-items-center justify-content-between flex-wrap col-md-6 ">
                <div class="form-check">
                    <input class="form-check-input changeAlbum" data-id="{{$album->id}}"  type="radio" name="delete"
                           id="exampleRadios1" value="0">
                    <label class="form-check-label" for="exampleRadios1">
                       الحذف دون نقل الي البوم اخر
                    </label>
                </div>


                <div class="form-check">
                    <input class="form-check-input changeAlbum" data-id="{{$album->id}}" type="radio"  name="delete"
                           id="exampleRadios2" value="1">
                    <label class="form-check-label" for="exampleRadios2">
                        النقل الي البوم اخر
                    </label>
                </div>


            </div>
            <div class="col-md-6" id="albumID"></div>


        </div>
    </div>


</form>
