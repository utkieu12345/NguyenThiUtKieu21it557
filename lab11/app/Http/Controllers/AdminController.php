<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Rules\Captcha;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public static function Authlogin(){ 
        $admin_login = Session::get('admin_id');
        // if($admin_login){ 
        //     return Redirect::to('/dashboard');
        // }else{ 
        //     return Redirect::to('/admin')->send();
        // }
        if(!isset($admin_login)){
            return Redirect::to('/admin')->send();
        }
    }
    public function index(){
        /* Login Tự Động Bằng Cookie */
        if(isset($_COOKIE['Admin_Email']) && isset($_COOKIE['Admin_Password'])){
            echo  $_COOKIE['Admin_Password'];
            $result = DB::table('tbl_admin')->where('admin_email',  $_COOKIE['Admin_Email'])->where('admin_password',  $_COOKIE['Admin_Password'])->first();
            if($result){
               Session::put('admin_id',$result->admin_id);
               Session::put('admin_name',$result->admin_name);
               return Redirect::to('/dashboard');
            }
            else{
                
                return view('admin.Login.admin_login');
            }
        }
       else{
        return view('admin.Login.admin_login');
        }
    }
    public function show_dashboard(){
        $this->Authlogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $data = $request->validate([
            'admin_email' => 'required', /* Nghiên cứu thêm validate của lava có thể truyền vào |string|min5|max15 để very */
            'admin_password' => 'required',
            'g-recaptcha-response' => new Captcha(), //dòng kiểm tra Captcha
        ]);
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);
       
        $result = DB::table('tbl_admin')->where('admin_email',  $admin_email)->where('admin_password',  $admin_password)->first();
        if($result){
           Session::put('admin_id',$result->admin_id);
           Session::put('admin_name',$result->admin_name);

           if($request->SaveLoginSession =="ON"){
            setcookie("Admin_Email",$result->admin_email, time() + (86400 * 30));
            setcookie("Admin_Password",($result->admin_password), time() + (86400 * 30));
           }
   
             return Redirect::to('/dashboard');
           
        }else{
            Session::put('mesage','TK or MK không đúng !');
            return Redirect::to('/admin');
        }
        
    }

    public function logout(){
        Session::put('admin_id',null);
        Session::put('admin_name',null);
        setcookie("Admin_Email",'', time()-99);
        setcookie("Admin_Password",'', time()-99);
        return Redirect::to('/admin');
    }

}
