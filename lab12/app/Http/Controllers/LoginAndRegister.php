<?php

namespace App\Http\Controllers;

use App\Rules\Captcha;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Mail;
use Session;

session_start();

class LoginAndRegister extends Controller
{
    /* Đăng Nhập */
    public function login()
    {
        /* Login Tự Động Bằng Cookie */
        if (isset($_COOKIE['customer_name']) && isset($_COOKIE['customer_password'])) {
            $result = DB::table('tbl_customers')->where('customer_name', $_COOKIE['customer_name'])->where('customer_password', $_COOKIE['customer_password'])->first();
            if ($result) {
                session()->put('customer_id', $result->customer_id);
                session()->put('customer_name', $result->customer_name);
                return Redirect::to('/');
            } else {
                return view('pages.LoginAndRegister.login');
            }
        } else {
            return view('pages.LoginAndRegister.login');
        }
    }
    public function login_customer(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required', /* Nghiên cứu thêm validate của lava có thể truyền vào |string|min5|max15 để very */
            'customer_password' => 'required',
            'g-recaptcha-response' => new Captcha(), //dòng kiểm tra Captcha
        ]);
        $EmailorName = $data['customer_name'];
        $Password = $data['customer_password'];
        $result = DB::table('tbl_customers')->where('customer_name', $EmailorName)->orWhere('customer_email', $EmailorName)->where('customer_password', md5($Password))->first();
        if ($result) {
            session()->put('customer_id', $result->customer_id);
            session()->put('customer_name', $result->customer_name);

            if (isset($request->checkbox) && $request->checkbox == 'On') {
                setcookie("customer_name", $result->customer_name, time() + (86400 * 30));
                setcookie("customer_password", $result->customer_password, time() + (86400 * 30));
            }
            return redirect('/');
        } else {
            return redirect('login-checkout');
        }
    }
    /* Đăng Xuất */
    public function logout()
    {
        Session()->flush(); // Hủy toàn bộ session
        // Session::put('customer_id',Null);
        // Session::put('customer_name',Null);
        setcookie("customer_name", null, 0);
        setcookie("customer_password", null, 0);
        return redirect('/login-checkout');
    }

    /* Đăng Ký */
    public function register()
    {
        return view('pages.LoginAndRegister.register');
    }
    public function create_customer(Request $request)
    {
        if (isset($request->checkbox) && $request->checkbox == 'YES') {
            $data = $request->validate([
                'customer_name' => 'required', /* Nghiên cứu thêm validate của lava có thể truyền vào |string|min5|max15 để very */
                'customer_email' => 'required',
                'customer_password' => 'required',
                'customer_sdt' => 'required',
                'g-recaptcha-response' => new Captcha(), //dòng kiểm tra Captcha
            ]);
            array_pop($data); /* Xóa phần tử cuối cùng (g-recaptcha) trong mảng vì trong mảng có chứa g-recaptcha */
            $data['customer_password'] = md5($request->customer_password);

            session()->put('rg_customer_name', $data['customer_name']);
            session()->put('rg_customer_email', $data['customer_email']);
            session()->put('rg_customer_allinfo', $data);

            $this->RandomCode();
            return redirect('/MailToCustomer');

        } else {
            return redirect('/register');
        }
    }

    /* Khôi Phục Mật Khẩu */
    public function RandomCode()
    {
        $randomrg = rand(10000000, 99999999);
        $randomrc = rand(10000000, 99999999);
        $rg = session()->get('rg_customer_name');
        $rc = session()->get('rc_customer_name');

        if (isset($rg)) {
            session()->put('rg_code', $randomrg);
        };

        if (isset($rc)) {
            session()->put('rc_code', $randomrc);
        };
    }
    public function MailToCustomer()
    {
        $rc = session()->get('rc_customer_email');
        if (isset($rc)) {
            $name = session()->get('rc_customer_name');
            $mail_customer = session()->get('rc_customer_email');
            $code = session()->get('rc_code');
            $type = "Bạn đã yêu cầu khôi phục tài khoản của mình!";

            $to_name = "Lê Khả Nhân - Mail Laravel";
            $to_email = "$mail_customer";
        };
        $rg = session()->get('rg_customer_email');
        if (isset($rg)) {
            $name = session()->get('rg_customer_name');
            $mail_customer = session()->get('rg_customer_email');
            $code = session()->get('rg_code');
            $type = "Bạn đã yêu cầu đăng ký tài khoản!";

            $to_name = "Lê Khả Nhân - Mail Laravel";
            $to_email = "$mail_customer";
        };

        $data = array(
            "name" => "$name",
            "code" => "$code",
            "type" => "$type",
        ); // send_mail of mail.blade.php

        Mail::send('pages.LoginAndRegister.mailtocustomer', $data, function ($message) use ($to_name, $to_email) {
            $message->to($to_email)->subject("Xin Chào ! Lê Khả Nhân Đang Test Mail Chút Hihi"); //send this mail with subject
            $message->from($to_email, $to_name); //send from this mail
        });
        return view('pages.LoginAndRegister.verycodercpw');
    }
    public function recovery_pw()
    {
        return view('pages.LoginAndRegister.recoverypw');
    }
    public function find_account_recovery_pw(Request $request)
    {

        $result = DB::table('tbl_customers')->select('customer_id', 'customer_name', 'customer_email')->where('customer_name', $request->customer_name_mail)->orWhere('customer_email', $request->customer_name_mail)->first();
        if ($result) {
            session()->put('rc_customer_id', $result->customer_id);
            session()->put('rc_customer_name', $result->customer_name);
            session()->put('rc_customer_email', $result->customer_email);
            // session()->get('rc_customer_id');
            // session()->get('rc_customer_name');
            $this->RandomCode();
            return redirect('/MailToCustomer');
        } else {
            return redirect('/recovery-pw');
        }

    }
    public function verification_code(Request $request)
    {
        $rc = session()->get('rc_customer_email');
        $rg = session()->get('rg_customer_email');
        if(isset($rc)){
            $code = session()->get('rc_code');
        }else if(isset($rg)){
            $code = session()->get('rg_code');
        }
        echo $code;
        if (isset($request->verycoderc) && $request->verycoderc == $code) {
            return view('pages.LoginAndRegister.confirmpassword');
        } else if ((isset($request->verycoderg) && $request->verycoderg == $code)) {
            return redirect('/successful-create-account');
        } else {
            return view('pages.LoginAndRegister.verycodercpw');
        }
    }
    public function confirm_password(Request $request)
    {
        $rc_customer_id = session()->get('rc_customer_id');
        if (isset($request->password1) && isset($request->password2)) {
            if ($request->password1 == $request->password2) {
                $data = array();
                $data['customer_password'] = $request->password1;
                $result = DB::table('tbl_customers')->where('customer_id', $rc_customer_id)->update($data);
                Session()->flush(); // Hủy toàn bộ session
                //echo "<script language='javascript'>alert('Cập Nhật Mật Khẩu Thành Công');";
                return redirect('/login-checkout');
            } else {
                return view('pages.LoginAndRegister.confirmpassword');
            }
        }
        return view('pages.LoginAndRegister.confirmpassword');
    }

    public function successful_create_account()
    {
        $data = session()->get('rg_customer_allinfo');
        DB::table('tbl_customers')->insert($data);
        Session()->flush(); // Hủy toàn bộ session
        return redirect('/login-checkout');
    }

}
