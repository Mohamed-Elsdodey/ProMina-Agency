<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\Upload_Files;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AlbumImageController extends Controller
{
    use Upload_Files;

    public function index(Request $request, $id)
    {

        $album=Album::findOrFail($id);
        if ($request->ajax()) {
            $rows = AlbumImage::query()->where('album_id', $id)->latest();
            return Datatables::of($rows)
                ->addColumn('action', function ($row) {


                    return '
                            <button   class="editBtn btn rounded-pill btn-primary waves-effect waves-light"
                                    data-id="' . $row->id . '"
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-edit"></i>
                                </span>
                            </span>
                            </button>
                            <button   class="btn rounded-pill btn-danger waves-effect waves-light delete"
                                    data-id="' . $row->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-trash-alt"></i>
                                </span>
                            </span>
                            </button>
                       ';


                })
                ->editColumn('image', function ($admin) {
                    return ' <img height="60px" src="' . get_file($admin->image) . '" class=" w-60 rounded"
                             onclick="window.open(this.src)">';
                })
                ->editColumn('created_at', function ($row) {
                    return date('Y/m/d', strtotime($row->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }

        return view('Admin.CRUDS.albums.images.index',compact('album'));
    }


    public function create(Request $request)
    {
        return view('Admin.CRUDS.albums.images.parts.create',['id'=>$request->id]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:30',
            'image' => 'required|mimes:jpeg,jpg,png,gif',
            'album_id'=>'required|exists:albums,id',
        ],
            [
                'title.required' => 'اسم الالبوم مطلوب',
                'title.unique' => 'الالبوم موجود مسبقا',
                'title.min' => 'الحد الادني لاسم الصورة 3 حرف',
                'title.max' => 'الحد الاقصي لاسم الصورة 30  حرف',
                'image.required' => 'الصورة مطلوبة',
                'image.mimes' => 'صيغة الصورة لابد ان تكون jpeg,jpg,png,gif',
                'album_id.required'=>'اسم الالبوم مطلوب',
                'album_id.exists'=>'هذا الالبوم غير مدرج لدينا',

            ]
        );

        $data["image"] = $this->uploadFiles('albums', $request->file('image'), null);

        AlbumImage::create($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }


    public function edit($id)
    {
        $image = AlbumImage::findOrFail($id);
        return view('Admin.CRUDS.albums.images.parts.edit', compact('image'));

    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:30',
            'image' => 'nullable|mimes:jpeg,jpg,png,gif',
        ],
            [
                'title.required' => 'اسم الالبوم مطلوب',
                'title.unique' => 'الالبوم موجود مسبقا',
                'title.min' => 'الحد الادني لاسم الصورة 3 حرف',
                'title.max' => 'الحد الاقصي لاسم الصورة 30  حرف',
                'image.mimes' => 'صيغة الصورة لابد ان تكون jpeg,jpg,png,gif',
            ]
        );

        $row = AlbumImage::findOrFail($id);
        if ($request->has('image')) {
            $data["image"] = $this->uploadFiles('albums', $request->file('image'), null);

        }

        $row->update($data);

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy($id )
    {

        $row=AlbumImage::findOrFail($id);

        $row->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun


}
