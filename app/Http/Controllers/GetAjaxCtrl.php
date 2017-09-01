<?php

namespace App\Http\Controllers;

use App\Language;
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
}
