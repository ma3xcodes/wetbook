<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserCtrl extends Controller
{
    public function __construct()
    {
    }

    public function popover(Request $request)
    {
        if ($request->ajax()){
            sleep(1);
            if ($request->userid){
                $decodeUserId = \Hashids::connection('user')->decode($request->userid);
                $dataUser = [];
                return [
                    'status'    => 'success',
                    'view'      => view('popovers.profilePreview',$dataUser)->render()
                ];
            }
        }
    }
}
