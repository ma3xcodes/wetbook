<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * En esta clase se mostrara todo lo relacionado con un usuario
 * 
 * Class UserCtrl
 * @package App\Http\Controllers
 */
class UserCtrl extends Controller
{
    /**
     * UserCtrl constructor.
     */
    public function __construct()
    {
    }

    /**
     * Muestra un popover(Bootstrap css) con una vista prebia del perfil de un uasuario
     *
     * @param Request $request
     * @return array
     */
    public function popover(Request $request)
    {
        if ($request->ajax()){
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
