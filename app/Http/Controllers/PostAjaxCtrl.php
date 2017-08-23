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
    public function createPost(Request $request)
    {
        if($request->hasFile('file_name')){
            //Crear la foto y fuardar en la base de datos
            //Retorna el id
            (new Croppic())->create_photo($request);
        }

        try{
            Post::create([
                'type' => $request->get('post-type'),
                'text' => $request->get('post-text')
            ]);
            return [
                'satus' => 'succes',
                'message'   => 'Post create succes.'
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
