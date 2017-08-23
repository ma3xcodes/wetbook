<?php
/**
 * Created by PhpStorm.
 * User: ma3xc
 * Date: 27/12/2016
 * Time: 11:08
 */

if(!function_exists('sendPusherMessage')){
    function sendPusherMessage($user, $data=null)
    {
        if (!$data){
            return "Missing a second parameter. Type = string";
        }
        try {
            \Pheaks\User::find($user)->first();
            $pusher = makePusher();
            $pusher->trigger('private-' . $user->user_name,'event-message',[]);
        }catch (Exception $e){
            Illuminate\Support\Facades\Log::error($e->getMessage());
        }
    }
}

if(!function_exists('sendPusherNotify')){
    function sendPusherNotify($user, $data=null)
    {
        if (!$data){
            return "Missing a second parameter. Type = string";
        }
        try {
            \Pheaks\User::find($user)->first();
            $pusher = makePusher();
            $pusher->trigger('private-' . $user->user_name, 'event-notify', []);
        }catch (Exception $e){
            Illuminate\Support\Facades\Log::error($e->getMessage());
        }
    }
}

if(!function_exists('makePusher')){
    function makePusher()
    {
        $pusher = App::make('pusher');
        return $pusher;
    }
}