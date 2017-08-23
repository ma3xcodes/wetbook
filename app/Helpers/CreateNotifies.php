<?php
/**
 * Created by PhpStorm.
 * User: ma3xc
 * Date: 01/11/2016
 * Time: 8:10
 */

use Pheaks\User,
    Pheaks\Profiles,
    McKay\Flash;

//Notificr que alguien commento su foto
function CommentPhotoNotify($to_user)
{
    $pusher = pusher();
    $user = User::find($to_user);
    $html = "<a href='".route('accound', encrypt(Auth::user()->id))."' class='white-text'><img src='" . asset(Auth::user()->profile->avatar->small) . "' class='responsive-img circle' width='25' style='display:inline-block;vertical-align: middle'>".Auth::user()->user_name."</a> <small>accept your contact request.</small>";
    $pusher->trigger('private-' . $user->user_name,'event-notify', [
        'text' => $html,
        'from' => encrypt(Auth::user()->id),
        'from_user_name'  => Auth::user()->user_name,
        'image_url' => asset(Auth::user()->profile->avatar->small),
        'str_to_time'=> strtotime(date('Y-m-d H:i:s'))
    ]);
}

//Notificar que alguien le gusta su foto

//Notificar que alguien comento su pubicacion

//Notificar que alguien le gusta su publicacion

//Notificar que alguien agrego a contactos

//Notificar que alguien acepto la solicitud de contacto

//Notificar que alguien envio un mensaje


function pusher()
{
    $pusher = new Pusher(env('PUSHER_KEY'), env('PUSHER_SECRET'), env('PUSHER_APP_ID'));
    return $pusher;
}