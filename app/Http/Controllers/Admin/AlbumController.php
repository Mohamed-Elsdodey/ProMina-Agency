<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\AlbumImage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class AlbumController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $rows = Album::query()->latest();
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
                            <button   class="btn rounded-pill btn-danger waves-effect waves-light deleteRow"
                                    data-id="' . $row->id . '">
                            <span class="svg-icon svg-icon-3">
                                <span class="svg-icon svg-icon-3">
                                    <i class="las la-trash-alt"></i>
                                </span>
                            </span>
                            </button>
                       ';


                })
                ->addColumn('images', function ($row) {
                    $url = route('admin.getImagesForAlbum', $row->id);
                    return "<a class='btn btn-info' href='$url'>عرض صور الالبوم</a>";

                })
                ->editColumn('created_at', function ($row) {
                    return date('Y/m/d', strtotime($row->created_at));
                })
                ->escapeColumns([])
                ->make(true);


        }
        return view('Admin.CRUDS.albums.index');
    }


    public function create()
    {
        return view('Admin.CRUDS.albums.parts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:30|unique:albums,title',

        ],
            [
                'title.required' => 'اسم الالبوم مطلوب',
                'title.unique' => 'الالبوم موجود مسبقا',
                'title.min' => 'الحد الادني لاسم الالبوم 3 حروف',
                'title.max' => 'الحد الاقصي لاسم الالبوم 30  حرف',

            ]
        );

        Album::create($data);


        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }


    public function edit(Album $album)
    {
        return view('Admin.CRUDS.albums.parts.edit', compact('album'));

    }

    public function update(Request $request, Album $album)
    {
        $data = $request->validate([
            'title' => 'required|min:3|max:30|unique:albums,title,' . $album->id,

        ],
            [
                'title.required' => 'اسم الالبوم مطلوب',
                'title.unique' => 'الالبوم موجود مسبقا',
                'title.min' => 'الحد الادني لاسم الالبوم 3 حروف',
                'title.max' => 'الحد الاقصي لاسم الالبوم 30  حرف',
            ]
        );

        $album->update($data);

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!',
            ]);
    }


    public function destroy(Album $album)
    {

        if (count($album->images) > 0) {
    $html=view('Admin.CRUDS.albums.parts.changAlbum',compact('album'))->render();
            return response()->json(
                [
                    'code' => 202,
                    'message' => 'لايمكن الحذف مباشرة',
                    'html'=>$html,
                ]);
        }

        $album->delete();

        return response()->json(
            [
                'code' => 200,
                'message' => 'تمت العملية بنجاح!'
            ]);
    }//end fun

    public function getAlbumSelect($id){
        $albums=Album::where('id','!=',$id)->get();
        return view('Admin.CRUDS.albums.parts.albumSelect',compact('albums'));
    }

    public function moveImagesFromAlbum(Request $request,$id ){

        $data = $request->validate([
            'delete' => 'required|in:0,1',
        ],
            [
                'delete.required' => 'يرجي اختيار نقل الصور ام لا',
                'title.in' => 'يرجي التاكد من اختيارك لنقل الصور',
            ]
        );

        $album=Album::findOrFail($id);

        if ($request->delete==0){
           $album->delete() ;
            return response()->json(
                [
                    'code' => 200,
                    'message' => 'تم حذف الالبوم بنجاح'
                ]);
        }
        else{
            $data = $request->validate([
                'album_id'=>'required|exists:albums,id',
            ],
                [
                    'album_id.required' => 'يرجي اختيارالالبوم الاخر لنقل الصور الية',
                    'album_id.exists' => 'هذا الالبوم ليس مدرج لدينا',
                ]
            );

            $images=AlbumImage::where('album_id',$album->id)->get();

            foreach ($images as $image){
                $image->update([
                    'album_id'=>$request->album_id,
                ]);
            }

            $album->delete();


            $toAlbum=Album::findOrFail($request->album_id);

            return response()->json(
                [
                    'code' => 200,
                    'message' => 'تم حذف الالبوم بنجاح ونقل الصور الي الالبوم '.$toAlbum->title,
                ]);

        }


    }


}
