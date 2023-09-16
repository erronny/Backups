<?php
namespace App\Http\Controllers;

use JWTAuth;
use App\User;
use App\Document;
use App\Share;
use App\DocumentDetail;
use App\Category;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    /**
     * @var bool
     */
    public $loginAfterSignUp = true;

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */


    public function test_new(Request $request){
    	echo "test_new";
        date_default_timezone_set("Asia/Kolkata");
    }

    public function notification($result)
    {
        $token = $result['token'];
        // echo "string ".$token;
        // die;
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        // $token='diWhHpEdy1k:APA91bHfaE_zy4FUJ_GGDmO3XuJNz5qshyMeyjbIvvdLKI-DkR5rzhS00k9Hwc49yKzJLUraUPbu9-H-XOv8hbT-q-omtzXa8-uAv8Ewej52zO1gH0maKoGP4FLCu9FwVlLSpwBDC_3T';
        
        $description = $result['description'];
        $title = $result['title'];
        $notification = [
            'body' => $description,
            'title' => $title,
            'sound' => true,
            'notificationDateStr'=>date('d M Y'),
            'description'=>$description,
            'status'=>true
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AAAAFdEafrE:APA91bHtzVinQCg2dCrEwX3uwtN8PaLsyruoofzJgWtKsljftxPomWTmLDU4MkhpPYlQvn568LRcCTFjn2qDlo6rzVSEciZzNlQmkqwEAUg5gO9-fkRKfrSaSbMlVKwM51MPlY6V_76X',
            'Content-Type: application/json'
        ];

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);
    }
    public function test(Request $request)
    {
        $token = JWTAuth::user()->device_token;
        // echo "string ".$token;
        // die;
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
        // $token='diWhHpEdy1k:APA91bHfaE_zy4FUJ_GGDmO3XuJNz5qshyMeyjbIvvdLKI-DkR5rzhS00k9Hwc49yKzJLUraUPbu9-H-XOv8hbT-q-omtzXa8-uAv8Ewej52zO1gH0maKoGP4FLCu9FwVlLSpwBDC_3T';
        
        $description = 'this is test';
        $title = 'this is title';
        $notification = [
            'body' => $description,
            'title' => $title,
            'sound' => true,
            'notificationDateStr'=>date('d M Y'),
            'description'=>$description,
            'status'=>true
        ];
        
        $extraNotificationData = ["message" => $notification,"moredata" =>'dd'];

        $fcmNotification = [
            //'registration_ids' => $tokenList, //multple token array
            'to'        => $token, //single token
            'notification' => $notification,
            'data' => $extraNotificationData
        ];

        $headers = [
            'Authorization: key=AAAAFdEafrE:APA91bHtzVinQCg2dCrEwX3uwtN8PaLsyruoofzJgWtKsljftxPomWTmLDU4MkhpPYlQvn568LRcCTFjn2qDlo6rzVSEciZzNlQmkqwEAUg5gO9-fkRKfrSaSbMlVKwM51MPlY6V_76X',
            'Content-Type: application/json'
        ];

        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$fcmUrl);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
        $result = curl_exec($ch);
        curl_close($ch);


        // print_r($result);
        $decoded = (json_decode($result));
        // // echo ->multicast_id;
        // print_r($decoded);
        // // echo $decoded->results[0]->message_id;
        // die;

        $body = [];
        if($decoded->success){
            $body =  [
                        "notificationId"        => $decoded->results[0]->message_id,
                        "notificationDateStr"   =>date('d M Y'),
                        "title"                 => $title,
                        "status"                => true,
                        "description"           => $description
                    ];
            $response = array('success' => true,
                'code' => 200,
                'IsData'=>true,
                'message' => 'Notification send',
                'body' => $body,
                );
        }else {
            $response = array('success' => false,
                'code' => 201,
                'IsData'=>false,
                'message' => 'Notification Failed',
                'body' => $body,
                // 'notification'=>$notification         
                );
        }
      
        return response()->json($response);
    }
    public function testsendOtp(Request $request){
        // $data = $request->all();
        
       
        $mobile = '9926331375';
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
          echo "cURL Error #:" . $err;
        } else {
            $arr = json_decode($response);
            // print_r($arr);
            // die;
           if($arr->type == "success"){
               $res = array('success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => "otp sent",
                    'data' => $arr,
                    );
            }else{
                $res = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => "opt failed",
                    'data' => $arr,
                    );
            }
            return response()->json($res);
        }
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
            return response()->json($res);
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
          echo "cURL Error #:" . $err;
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
            return response()->json($res);
        }
    } 
    
    public function documentDelete(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
           'document_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
           return response()->json($response);
        }


        $data = $request->all();
        $documents = explode(',',$data['document_id']);
        foreach($documents as $key=>$document){
            $product   = Document::findOrFail($document);
            //$product   = DocumentDetail::where('document_id',$document)->update('IsActive',0);
            $query = DocumentDetail::where('document_id',$document);
            if($query->count() > 0 ){
                $details = $query->get();
                foreach ($details as $key => $detail) {
                    Share::where('document_id',$detail->id)->update(['deleted_at'=>date('Y-m-d h:m:s')]);
                }
            }
            DocumentDetail::where('document_id',$document)->update(['deleted_at'=>date('Y-m-d h:m:s')]);
            $delete     = $product->delete();
        }
        if(isset($delete)) {
           $response = array('success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Document Deleted Successfully'
                    
                    );
        }else{
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
        }
        return response()->json($response);
    }


    public function addBookmark(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
           'document_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
           return response()->json($response);
        }


        $data = $request->all();
        $document = Document::findOrFail($data['document_id']); 
        $updatedata = $document->fill(array('bookMark'=>'1'))->save();
        if($updatedata) {
           $response = array('success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Document added Successfully'
                    
                    );
        }else{
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
        }
        return response()->json($response);
    }
    public function removeBookmark(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
           'document_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
           return response()->json($response);
        }


        $data = $request->all();
        $document = Document::findOrFail($data['document_id']); 
        $updatedata = $document->fill(array('bookMark'=>'0'))->save();
        if($updatedata) {
           $response = array('success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Document remove Successfully'
                    
                    );
        }else{
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
        }
        return response()->json($response);
    }
    
    
    public function documentImageDelete(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
           'document_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
           return response()->json($response);
        }


        $data = $request->all();
        
         $documents = explode(',',$data['document_id']);
        foreach($documents as $key=>$document){
            $product   = DocumentDetail::findOrFail($document);
            if(Share::where('document_id',$document)->count()){
                $shareFlag = Share::where('document_id',$document)->update(['deleted_at'=>date('Y-m-d h:m:s')]);
            }
            $delete     = $product->delete();
        }
        if(isset($delete)) {
           $response = array('success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Document Deleted Successfully'
                    
                    );
        }else{
            $response = array('success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Invalid Document',
                    'error'=>$validator->errors()
                    );
        }
        return response()->json($response);
    }

    public function rename(Request $request){

        $validator = Validator::make($request->all(), [
           'document_id' => 'required',
           'document_name' => 'required|min:2'
        ]);

        if ($validator->fails()) {
            $response = array('status'=>'failed','error'=>$validator->errors());
           return response()->json($response);
        }


        $data = $request->all();
        $document_id = $data['document_id'];
        $doc_name = $data['document_name'];
        $user_id = JWTAuth::user()->id;
        $document   = DocumentDetail::findOrFail($document_id);
        $document->doc_name = $doc_name;
        $flag = $document->save();
        // echo $user_id;die;
           
            
            if($flag) {
                $documents = Document::with(['image'])->where('createdby',$user_id)->orderBy('bookMark','DESC')->orderBy('id','DESC')->get()->toArray();
                return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document update successfully',
                    'results'=>$documents
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Action Failed Please try again',
                    'results'=>[]
                ]);
            }
    }
    public function savecategoty(Request $request){

        $validator = Validator::make($request->all(), [
           'name' => 'required|string',
        ]);

        if ($validator->fails()) {
            $response = array('status'=>'failed','error'=>$validator->errors());
           return response()->json($response);
        }


        $data = $request->all();
        $user_id = JWTAuth::user()->id;
           
            $data = $request->all();
            $image = "";
            if($request->file('file')){
            $document =  Document::create([          
              'name'                 => $data['title'],
              'short_des'            => $data['short_des'],
              'createdby'            => $user_id,         
             ]);
            $document_id = $document->id;

             
                $path = 'assets/img/documents/';        
                $destinationPath    = $path;
                $image_files         = $request->file('file');
                foreach($image_files as $k=>$image_file){
                    $IsDefault = 0;

                    if($k ==0){
                        $IsDefault = 1;
                    }
                    $image_name         = $image_file->getClientOriginalName();
                    $extention          = $image_file->getClientOriginalExtension();
                    $image = value(function() use ($image_file){
                    $filename = time().'.'. $image_file->getClientOriginalExtension();
                    return strtolower($filename);
                    });
                    $image_file->move($destinationPath, $image);

                    $product =  DocumentDetail::create([          
                        'document_id'            => $document_id ,
                        'url'                   => $image,
                        'IsDefault'             => $IsDefault,
                        'createdby'             => $user_id,         
                    ]);
                }
            }else{
                return response()->json([
                    'success' => false,
                    'IsData'=>false,
                    'message' => 'please select atleast one image',
                    'code' => 200,
                    'results' => [],
                ]);   
            }
           if(isset($product)) {
            $documents = Document::with(['image'])->where('createdby',$user_id)->get()->toArray();
                return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document Save successfully',
                    'results'=>$documents
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Action Failed Please try again',
                    'results'=>[]
                ]);
            }
    }

    public function category_list(Request $request){
        //$user_id = JWTAuth::user()->id;
        $documents = Category::where('IsActive',1)->orderBy('id','DESC')->get()->toArray();
        if(!empty($documents)){

            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => '',
                    'results' => $documents,
                ], 200); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 401,
                    'IsData'=>false,
                    'message' => 'no records',
                    'results' => [],
                ], 401); 

        } 
    }

    public function check_number(Request $request){

        $validator = Validator::make($request->all(), [
           'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|digits:10',
        ]);

        if ($validator->fails()) {
        //     $response = array('status'=>'true','code'=>201,'message'=>'failed to search mobile number','error'=>$validator->errors());
        //   return response()->json($response);
        return results($data);
       
        }

        $data = $request->all();
        $user_id = JWTAuth::user()->id;

       $query= User::where('mobile_no',$data['mobile'])->where('id','!=',$user_id);
       $user= $query->first();
       $count= $query->count();

        if($count){

            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Valid Mobile No.',
                    'results' => $user,
                ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 401,
                    'IsData'=>false,
                    // 'message' => $data['mobile'],
                     'message' => 'Invalid Mobile No.',
                    'results' => [],
                ]); 
        }

    }


    public function document_share(Request $request){

        $user_id = JWTAuth::user()->id;
        $query= Share::with(['user_name','image'])->where('createdby',$user_id)->orderBy('id','DESC');
        $document= $query->get();
        // $count= $query->count();

        if($document){

            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document share',
                    'public_path'=>URL('assets/img/documents'),
                    'results' => $document,
                ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 401,
                    'IsData'=>false,
                    'message' => 'Invalid Mobile',
                    'results' => [],
                ]); 
        }

    }


    public function document_received(Request $request){

        $user_id = JWTAuth::user()->id;
        $query= Share::with(['send_by','received','image'])->where('user_id',$user_id)->orderBy('id','DESC');
        $document= $query->get();
        // $count= $query->count();

        if($document){

            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document share',
                    'public_path'=>URL('assets/img/documents'),
                    'results' => $document,
                ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 401,
                    'IsData'=>false,
                    'message' => 'Invalid Mobile',
                    'results' => [],
                ]); 
        }

    }
    
    public function document_rename(Request $request){

        $validator = Validator::make($request->all(), [
           'document_id' => 'required',
           'name' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('status'=>'false','code'=>401,'message'=>'fill required field','error'=>$validator->errors());
           return response()->json($response);
        }

        $user_id = JWTAuth::user()->id;
        $data = $request->all();
        $document_id = $data['document_id'];

         $update =  Document::where('id',$data['document_id'])->update([          
              'name'       => $data['name']
             ]);

        if($update){

            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document rename successfully',
                    'results' => [],
                ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 401,
                    'IsData'=>false,
                    'message' => 'Rename operation failed',
                    'results' => [],
                ]); 
        }

    }

    public function share_number(Request $request){

        $validator = Validator::make($request->all(), [
           'user_id' => 'required',
           'document_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('status'=>'false','code'=>401,'message'=>'fill required field','error'=>$validator->errors());
           return response()->json($response);
        }
        $notification = array();
        $data = $request->all();
        $user_id = JWTAuth::user()->id;
        $user_name = JWTAuth::user()->name;
        $sender = User::where('id',$data['user_id'])->first();
        if($sender->device_token){
            $notification['token'] =$sender->device_token;
            $notification['title'] ='Document Send by '.$user_name;
            $notification['description'] ='Document';
            $this->notification($notification);
        }
        date_default_timezone_set("Asia/Kolkata");

        // $user_id = JWTAuth::user()->id;
        // $data = $request->all();
        $document_id = $data['document_id'];
        //echo $document_id;
        $documents = explode(',', $document_id);

        foreach ($documents as $key => $document) {
            
             $share =  Share::updateOrCreate([          
              'user_id'       => $data['user_id'],
              'document_id'   => $document,
              'createdby'     => $user_id, 
              'created_at' => date('Y-m-d H:i:s',time())         
             ],['IsActive'=>1]);
        }
        //print_r($data);
        //  die;

       

        $query= Share::where('createdby',$user_id);
        $document= $query->get();
        // $count= $query->count();

        if($share){

            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document share.',
                    'public_path'=>URL('assets/img/documents'),
                    'results' => $document,
                ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 401,
                    'IsData'=>false,
                    'message' => 'Invalid Mobiles',
                    'results' => [],
                ]); 
        }

    }
    public function documentList(){


        $user_id = JWTAuth::user()->id;
        $documents = Document::with(['image'])->where('createdby',$user_id)->orderBy('bookMark','DESC')->orderBy('id','DESC')->get()->toArray();
        if(!empty($documents)){

            return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => '',
                    'public_path'=>URL('assets/img/documents'),
                    'results' => $documents,
                ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'code' => 401,
                    'IsData'=>false,
                    'message' => 'no records',
                    'results' => [],
                ]); 

        }
    }

    public function savedocument(Request $request){
      
       $validator = Validator::make($request->all(), [
           'title' => 'required|string',
           'short_des' => 'required',
           //'category' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('status'=>'false','code'=>401,'message'=>'Server error','error'=>$validator->errors());
          return response()->json($response);
        }


        $data = $request->all();
        $user_id = JWTAuth::user()->id;
           
            $data = $request->all();
            $image = "";
            date_default_timezone_set("Asia/Kolkata");
            if($request->file('file')){
                $document =  Document::create([          
                  'name'                 => $data['title'],
                  'short_des'            => $data['short_des'],
                  'category_id'            => 0,
                  'createdby'            => $user_id, 
                  'created_at' => date('Y-m-d H:i:s',time()) 
                //   'created_at' => 'new Carbon()'       
                 ]);
                $document_id = $document->id;

             
                $path = 'assets/img/documents/';        
                $destinationPath    = $path;
                $image_files         = $request->file('file');
                foreach($image_files as $k=>$image_file){
                    $file_size = $image_file->getSize();
                    $IsDefault = 0;

                    if($k ==0){
                        $IsDefault = 1;
                    }
                    $image_name         = $image_file->getClientOriginalName();
                    $extention          = $image_file->getClientOriginalExtension();
                    $image = value(function() use ($image_file, $k){
                    $filename = $k.time().'.'. $image_file->getClientOriginalExtension();
                    return strtolower($filename);
                    });
                    $image_file->move($destinationPath, $image);

                    $product =  DocumentDetail::create([          
                        'document_id'            => $document_id ,
                        'url'                   => $image,
                        'IsDefault'             => $IsDefault,
                        'file_size'            => $file_size,
                        'createdby'             => $user_id, 
                        'created_at' => date('Y-m-d H:i:s',time())  
                        //   'created_at' => DateTime('Y-m-d H:i:s',time()) 
                        // 'created_at' => '>toDateTimeString()'
                    ]);
                }
            }else{
                return response()->json([
                    'success' => false,
                    'IsData'=>false,
                    'message' => 'please select atleast one image',
                    'code' => 200,
                    'results' => [],
                ]);   
            }
           if(isset($product)) {
            $documents = Document::with(['image'])->where('createdby',$user_id)->get()->toArray();
                return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document Save successfully.',
                    'public_path'=>URL('assets/img/documents'),
                    'results'=>$documents
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'public_path'=>URL('assets/img/documents'),
                    'message' => 'Action Failed Please try again',
                    'results'=>[]
                ]);
            }
    }


public function editdocument(Request $request){

        $validator = Validator::make($request->all(), [
           'document_id' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('status'=>'false','code'=>401,'message'=>'mobile required','error'=>$validator->errors());
           return response()->json($response);
        }


        $data = $request->all();
        $user_id = JWTAuth::user()->id;
        $document_id = $data['document_id'];
        
            $data = $request->all();
            $image = "";
            date_default_timezone_set("Asia/Kolkata");
            if($request->file('file')){
                $path = 'assets/img/documents/';        
                $destinationPath    = $path;
                $image_files         = $request->file('file');
                foreach($image_files as $k=>$image_file){
                    $file_size = $image_file->getSize();
                    $IsDefault = 0;
                     if($k ==0){
                        $IsDefault = 1;
                    }
                    $image_name         = $image_file->getClientOriginalName();
                    $extention          = $image_file->getClientOriginalExtension();
                    $image = value(function() use ($image_file,$k){
                    $filename = $k.time().'.'. $image_file->getClientOriginalExtension();
                    return strtolower($filename);
                    });
                    $image_file->move($destinationPath, $image);

                    $product =  DocumentDetail::create([          
                        'document_id'            => $document_id ,
                        'url'                   => $image,
                        'IsDefault'             => $IsDefault,
                        'file_size'            => $file_size,
                        'createdby'             => $user_id,  
                        'created_at' => date('Y-m-d H:i:s',time())        
                    ]);
                }
            }else{
                return response()->json([
                    'success' => false,
                    'IsData'=>false,
                    'message' => 'please select atleast one image',
                    'code' => 200,
                    'results' => [],
                ]);   
            }
           if(isset($product)) {
            $documents = Document::with(['image'])->where('createdby',$user_id)->get()->toArray();
                return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Document Save successfully',
                    'public_path'=>URL('assets/img/documents'),
                    'results'=>$documents
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'public_path'=>URL('assets/img/documents'),
                    'message' => 'Action Failed Please try again',
                    'results'=>[]
                ]);
            }
    }


public function profile(Request $request){
            $user_id = JWTAuth::user()->id;
            $data = $request->all();
            $image = "";
            $user = User::where('id',$user_id)->first()->toArray();
            $fileSize  =DocumentDetail::where('createdby',$user_id)->get()->sum("file_size");
           if(isset($user)) {
            //$documents = Document::with(['image'])->where('createdby',$user_id)->get()->toArray();
                return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>true,
                    'message' => 'Profile List',
                    'results'=>['user'=>$user,'size'=>$fileSize]
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Action Failed Please try again',
                    'results'=>[]
                ]);
            }
    }


public function forgot(Request $request){
    $validator = Validator::make($request->all(), [
           'mobile' => 'required',
           'password' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array('status'=>'false','code'=>401,'message'=>'mobile required','error'=>$validator->errors());
           return response()->json($response);
        }

            $data = $request->all();
            $mobile = $data['mobile'];
            $user = User::where('mobile_no',$mobile)->first();
           if(isset($user)) {
            $user = User::where('mobile_no',$mobile)->update(['password'=>bcrypt($request->password)]);
                return response()->json([
                    'success' => true,
                    'code' => 200,
                    'IsData'=>false,
                    'message' => 'Password Update',
                    'results'=>[]
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'code' => 201,
                    'IsData'=>false,
                    'message' => 'Action Failed Please try again',
                    'results'=>[]
                ]);
            }
    }

    public function login(Request $request)
    {
        $myfile = fopen("demo.txt", "w") or die("Unable to open file!");
        $txt = "John Doe\n";
        fwrite($myfile, json_encode($request->all()));
        fclose($myfile);
        $input = $request->only('email', 'password','device_token');

        $rules = [
            'email' => 'required',
            'password' => 'required',
            'device_token' => 'required',
        ];

        $validator = Validator::make($input, $rules);
        if($validator->fails()) {
            return response()->json([
                'success'=> false,
                'error'=> $validator->messages(), 
                'code' => 201,
                'message' => 'error',
                'IsData'=>false,
                'results'=>[]
            ]);
        }
        $user = User::where('email',$request->input('email'))->orWhere('mobile_no',$request->input('email'))->get()->toArray();
        if(!empty($user)){
            //$user = $query->first()
            $request->merge(['email' => $user[0]['email']]);
        }else{
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email/Mobile or Password',
                'token' => '',
                'code' => 201,
                'IsData'=>false,
                'results'=>[]
            ]);
        }
        $input = $request->only('email', 'password');
        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
                'token' => $token,
                'code' => 200,
                'IsData'=>false,
                'results'=>[]
            ]);
        }

        $user_id = JWTAuth::user()->id;
        $data = $request->all();
        $image = "";
        $user = User::where('id',$user_id)->first()->toArray();
        $userFlag = User::where('id',$user_id)->update(['device_token'=>$request->input('device_token')]);
        $fileSize  =DocumentDetail::where('createdby',$user_id)->get()->sum("file_size");

        return response()->json([
            'success' => true,
            'token' => $token,
            'code' => 200,
            'IsData'=>true,
            'message' => 'Login Successfully',
            'results'=>['user'=>$user,'size'=>$fileSize]
        ]);
    }

        /**
         * @param Request $request
         * @return \Illuminate\Http\JsonResponse
         * @throws \Illuminate\Validation\ValidationException
         */
        public function logout(Request $request)
        {
            $this->validate($request, [
                'token' => 'required'
            ]);

            try {
               JWTAuth::invalidate($request->token) ;

                return response()->json([
                    'success' => true,           
                    'message' => 'User logged out successfully',
                    'code' => 200,
                    'IsData'=>false,
                    'results'=>[]

                ]);
            } catch (JWTException $exception) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, the user cannot be logged out',
                    'code' => 401,
                    'IsData'=>false,
                    'results'=>[]
                ]);
            }
        }

        public function refresh(Request $request)
        {
    		try {
                $tokenFetch = JWTAuth::parseToken()->authenticate();
                if ($tokenFetch) {
                    $token = str_replace("Bearer ", "", $request->header('Authorization'));
                } else {
                    $token = '';
                    //echo "change";
                }
            } catch(\Tymon\JWTAuth\Exceptions\JWTException $e){//general JWT exception
                $token = '';
            }

    		if($token == ''){
    			try{
    				$token = JWTAuth::refresh($token);
    			}catch(TokenInvalidException $e){
    				//throw new AccessDeniedHttpException('The token is invalid');

    				return response()->json([
        				'success' => false,
        				'message' => 'Sorry, The token is invalid',
                        'code' => 401,
                        'IsData'=>false,
                        'results'=>[]
    				]);
    			}
    		}
            return response()->json([
    	        'success' => true,
    	        'token' => $token,
                'message' => 'token generate',
                'code' => 200,
                'IsData'=>false,
                'results'=>[]
    	    ]);
        }



         protected function respondWithToken($token)
        {
            return response()->json([
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60
            ]);
        }

        /**
         * @param RegistrationFormRequest $request
         * @return \Illuminate\Http\JsonResponse
         */
        public function register(Request $request)
        {

            $myfile = fopen("demo.txt", "a") or die("Unable to open file!");
            $txt = "John Doe\n";
            fwrite($myfile, json_encode($request->all()));
            fclose($myfile);
            $validator = Validator::make($request->all(), [
               'name' => 'required|string',
                'email' => 'required|email|unique:users',
                'mobile_no' => 'required|unique:users',
                'password' => 'required|string|min:3|max:10',
                'user_type' => 'required',
                // 'device_token' => 'required'
            ]);

            if ($validator->fails()) {
            	$response = array(
            	'success'=>false,
            	'code'=>201,
            	'message'=>'This mobile no is already registered.',
            	'results'=>[],
            	'error'=>$validator->errors()
            	);
               return response()->json($response);
            }

            //dd($validated);
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->user_type = $request->user_type;
            $user->mobile_no = $request->mobile_no;
            $user->address = $request->address?$request->address:'';
            $user->device_token = $request->device_token?$request->device_token:'';
            $user->occupation = isset($request->occupation)?$request->occupation:'';
            $user->registration_no = isset($request->registration_no)?$request->registration_no:'';
            $user->password = bcrypt($request->password);
            $user->save();

            // if ($this->loginAfterSignUp) {
            //     return $this->login($request);
            // }

            return response()->json([
                'success'   =>  true,
                'message' => 'user register',
                'code' => 200,
                'IsData'=>true,
                'results'=>$user
            ]);
        }
    }