<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\User;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        return view('home');
    }

    public function about()
    {
        
       return view('about');
    }

    public function contact()
    {
        
       return view('contact');
    }

    public function signUp()
    {
        
       return view('sign-up');
    }

    

    public function checkEmail(Request $request){
        $validator = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'mobile_no' => 'required|unique:users',
            ]);
            $error = array('email'=>false,'mobile'=>false);
            if ($validator->fails()) {
                $errors = $validator->errors()->toArray();
                foreach ($errors as $key => $value) {
                    if($key =='email'){
                        $error['email'] = true;
                    }
                    if($key =='mobile_no'){
                        $error['mobile'] = true;
                    }
                }

                $response = array(
                    'success'=>false,
                    'code'=>201,
                    'message'=>'This mobile no  already registered',
                    'results'=>[],
                    'error'=>$error
                );
               
            }else{
                 $response = array(
                    'success'=>true,
                    'code'=>200,
                    'message'=>'This mobile no  already registered',
                    'results'=>[],
                    'error'=>$error
                );   
            }
            echo json_encode($response);
    }
    public function userRegister(Request $request){
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile_no = $request->mobile;
        $user->user_type = 1;
        $user->address = '';
        $user->password = bcrypt($request->password);
        $userFlag = $user->save();

            if ($userFlag) {
               $response = array(
                    'success'=>true,
                    'code'=>200,
                    'message'=>'user register',
                    'results'=>[],
                    //'error'=>$error
                );
            }else{
                  
                $response = array(
                    'success'=>false,
                    'code'=>201,
                    'message'=>'Try again! Operation failed',
                    'results'=>[],
                    //'error'=>$error
                );
                 
            }
            echo json_encode($response);
    }
    public function verifyOtp(Request $request){
        $data = $request->all();
        
        $curl = curl_init();
        $auth_key = "319797Ak7HzxTsW15e6c86faP1";
        $template_id = '5e6c88d7d6fc0546bb56c85d';
        $mobile = $data['mobile'];
        $otp = $data['otp'];
        $url = "https://api.msg91.com/api/v5/otp/verify?mobile=".$mobile."&otp=".$otp."&authkey=".$auth_key;
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
            $arr = json_decode($response);
            // print_r($arr->type);
            // die;
            if($arr->type == 'success'){
               $res = array('success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => $arr->message,
                    );
            }else{
                $res = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => $arr->message,
                    );
            }
            echo json_encode($res);
        }
    } 
      
    public function sendOtp(Request $request){
        $data = $request->all();
        
        $mobile = $data['mobile'];
        $curl = curl_init();
        $auth_key = "319797Ak7HzxTsW15e6c86faP1";
        $template_id = '5e6c88d7d6fc0546bb56c85d';
        $extra_param = '';
        $url = "https://api.msg91.com/api/v5/otp?authkey=".$auth_key."&template_id=".$template_id."&extra_param=".$extra_param."&mobile=".$mobile."&";
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_SSL_VERIFYHOST => 0,
          CURLOPT_SSL_VERIFYPEER => 0,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/json"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          // echo "cURL Error #:" . $err;
        } else {
            $arr = json_decode($response);
            // print_r($arr);
            // die;
           if($arr->type == "success"){
               $res = array('success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => "otp sent",
                    );
            }else{
                $res = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => "opt failed",
                    );
            }
            echo json_encode($res);
        }
    }
    public function services()
    {
        
       return view('services');
    }

    public function terms()
    {
        
        
        return view('term');
    }

    public function policy()
    {
        
       
        return view('policy');
    }

    public function faq()
    {
        
       
        return view('faq');
    }

    
    
    public function pricing()
    {
        
       
        return view('pricing');
        
    }
    
    public function returnpolicy()
    {
        
        
        return view('returnpolicy');
    }


    public function dashboard()
    {
        
        
        return view('dashboard');
    }
    
    public function metatag()
    {
        
        return view('test');
    }
}
