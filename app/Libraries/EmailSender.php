<?php
/**
 * Created by PhpStorm.
 * User: ma3xc
 * Date: 16/10/2016
 * Time: 9:27
 */

namespace Pheaks\Http\Libraries;




class EmailSender
{
    public function __construct()
    {

    }

    public static function send_activate_accound($user)
    {
        /*
         * ns1.hostinger.mx
         * ns2.hostinger.mx
         * ns3.hostinger.mx
         * ns4.hostinger.mx
         * 187.244.45.21
         * */
        $request = null;
        $data['email']  = $user->email;
        $data['name'] = $user->first_name." ".$user->last_name;
        $data['subject']= 'Activate Accond';
        $data['key_id']   = encrypt($user->id);
        $data['hash']   = encrypt(uniqid());
        try {
            \Mail::send('email.basic', $data, function ($message) use ($data) {
                //remitente
                $message->from(env('CONTACT_MAIL'), env('CONTACT_NAME'));

                //asunto
                $message->subject($data['subject']);

                //receptor
                $message->to($data['email'], $data['name']);

            });
            $response['status'] = 'success';
        }catch (Exeption $e){
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
        return $response;
    }

    public static function test_message(){
        $request = null;
        $data['email']  = 'ma3xcodes@gmail.com';
        $data['name'] = "Manuel Lopez.";
        $data['subject']= 'Activate Accond';
        $data['key_id']   = encrypt(17);
        $data['hash']   = encrypt(uniqid());
        try {
            \Mail::send('email.basic', $data, function ($message) use ($data) {
                //remitente
                $message->from(env('CONTACT_MAIL'), env('CONTACT_NAME'));

                //asunto
                $message->subject($data['subject']);

                //receptor
                $message->to($data['email'], $data['name']);

            });
            $response['status'] = 'success';
        }catch (Exeption $e){
            $response['status'] = 'error';
            $response['message'] = $e->getMessage();
        }
        return $response;
    }
}