@if(count($albums)>0)

    <select name="album_id" class="form-select" aria-label="Default select example">
        <option selected disabled>اختر الابوم الان</option>
        @foreach($albums as $album)
        <option value="{{$album->id}}">{{$album->title}}</option>
        @endforeach
    </select>

@else


<span>عفوا لايوجد البومات اخري</span>


@endif
