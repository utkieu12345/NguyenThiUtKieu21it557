<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Mail;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class MailController extends Controller
{
    public function send_mail(){
        $to_name = "Lê Khả Nhân - Test Mail Laravel";
        $to_email = "nhanlekha@gmail.com";//send to this email

        $data = array(
            "name"=>"Nhan Test Mail Từ Tài Khoản Khách Hàng",
            "body"=>"Noi Dung Mail"
        ); // send_mail of mail.blade.php
    
        Mail::send('pages.mail.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Tiêu Đề');//send this mail with subject
            $message->from($to_email,$to_name);//send from this mail
        });
        return redirect('/')->with('mesage',' ');
    }
}