<?php

namespace App\Http\Controllers;

use App\Language;
use App\Photo;
use Illuminate\Http\Request;

class GetAjaxCtrl extends Controller
{
    public function __construct()
    {
    }

    public function showLanguages(Request $request)
    {
        if($request->ajax()) {
            $languages = Language::all();
            return view('modals.change_language', ['languages'=>$languages]);
        }
    }

    public function showPhoto(Request $request)
    {
        if($request->ajax()) {
            $id = $request->id ? $request->id : null;
            try{
                $photo_id = \Hashids::decode($id);
                if($photo_id!=null) {
                    $photo = Photo::find($photo_id[0]);
                    return view('modals.show_photo', ['photo'=>$photo]);
                }else{
                    return [
                        'status'    => 'error',
                        'message'   => 'Undefined id'
                    ];
                }
            }catch(\Exception $e){
                return [
                    'status'    => 'error',
                    'message'   => $e->getMessage()
                ];
            }
        }
    }
}
