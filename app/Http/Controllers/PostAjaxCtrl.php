<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Libraries\Croppic;

class PostAjaxCtrl extends Controller
{
    public function __construct()
    {
    }

    public function createPost(Request $request)
    {
        $photo = null;
        /**
         * Crear la foto y guardar en la base de datos
         *
         * @photo | array Contiene la foto en caso de que se guarde bien
         */
        if($request->hasFile('file_name')){
            $photo = (new Croppic())->create_photo($request);
        }

        try{
            Post::create([
                'user_id'   => \Auth::user()->id,
                'type' => $request->get('post-type'),
                'text' => $request->get('post-text'),
                'photo_id'  => $photo ? \Hashids::decode($photo['photo_id'])[0] : null
            ]);
            return [
                'satus' => 'succes',
                'message'   => 'Post create succes.',
                'photo' => $photo ? $photo : null
            ];
        } catch (QueryException $e){
            return [
                'status'    => 'error',
                'message'   => $e->getMessage()
            ];
        } catch (MassAssignmentException $e){
            return [
                'status'    => 'error',
                'message'   => $e->getMessage()
            ];
        }
    }

    public function validate(Request $request, array $rules, array $messages = [], array $customAttributes = [])
    {

    }
}
