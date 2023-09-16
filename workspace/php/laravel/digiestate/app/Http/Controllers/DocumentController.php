<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Language_master;
use Auth;
use App\University;
use App\Product;
use App\Document;
use App\Category;
use App\Stock;
use App\ProductDetail;
use App\DocumentDetail;
use App\OrderDetail;
use App\Order;
use App\Share;
use App\User;
use Illuminate\Support\Facades\Config;
//use Mail;
//use App\Mail\Client as clientMail;
//use App\Websitesetting;

class DocumentController extends Controller
{
    public function __construct()
    {
        //$this->middleware(['auth', 'clearance']);
      //self::setUser();
    }

    public function setUser(){
      
    }

    public function index()
    {
        $query = Document::with(['image','defaultImage'=> function($query){
            $query->where('IsDefault', 1);
        }])->orderBy('id','DESC');

        if(Auth::user()->user_type !=0){
          $query->where('createdby',Auth::user()->id);
        }
        
        
        if(isset($_REQUEST['title'])){
              if($_REQUEST['title'] !="all" && $_REQUEST['title'] !="" ){
                  //$query->where('title',$_REQUEST['title']);
                  $query->where('name', 'LIKE', '%' . $_REQUEST['title'] . '%');;
              }
        }

        
        if(isset($_REQUEST['status'])){
            if($_REQUEST['status'] !="all" && $_REQUEST['status'] !="" ){
                $query->where('IsActive',$_REQUEST['status']);
            }
        }

        $documents = $query->get();
        $page_title ="Document List";
       //dd($documents);
        $page_title ="Document List";
        $page ="Document";

        $categories = Category::where('IsActive',1)->get();
        // ->where('IsActive',1)
        $users = User::where('id','!=',Auth::user()->id)->get();
        // dd($users);
        return view('product.index', compact('documents','page_title','page','categories','users'));
    }
    public function shareDocument()
    {
        $query = Share::with(['image','send_by','received'])->orderBy('id','DESC');
        $query->where('createdby',Auth::user()->id);
        $documents = $query->get();
        $page_title ="Share Document List";
        // foreach ($documents as $key => $value) {
        //   echo "Id ".$key.'<br/>';
        //   if($value->image){
        //     echo "image exist";
        //   }else{
        //       echo "image not exist";
        //   }
        //   echo "<br/>";
        // }
        // die;
       // dd($documents);
        $page_title ="Share Document List";
        $page ="Document";
        $type ="share";

        $categories = Category::where('IsActive',1)->get();
        $users = User::where('id','!=',Auth::user()->id)->get();

        return view('product.list_data', compact('documents','page_title','page','categories','users','type'));
    }
    public function recievedDocument()
    {
       $query = Share::with(['image','send_by','received'])->orderBy('id','DESC');
        $query->where('user_id',Auth::user()->id);
        $documents = $query->get();
        $page_title ="Share Document List";
        // foreach ($documents as $key => $value) {
        //   echo "Id ".$key.'<br/>';
        // }
        // die;
        // dd($documents);
        $page_title ="Share Document List";
        $page ="Document";
        $type ="received";

        $categories = Category::where('IsActive',1)->get();
        $users = User::where('id','!=',Auth::user()->id)->get();
        return view('product.list_data', compact('documents','page_title','page','categories','users','type'));
    }


    // public function updateDetail($id)
    // {
    //     $query = Product::with(['image'=> function($qs){
    //         $qs->orderBy('IsDefault', 'DESC');
    //     },'defaultImage'=> function($query){
    //         $query->where('IsDefault', 1);
    //     }])->orderBy('id','DESC');
    //      $query->where('id',$id);
    //     if(isset($_GET['type'])){
    //         if($_GET['type'] !="all" ){
    //             $query->where('type',$_GET['type']);
    //         }
    //     }
    //     $product = $query->first();
    //     $page_title ="University List";
    //     //dd($products);
    //     $page_title ="Product Detail";
    //     $page ="Product";

    //     //dd($product);
    //     return view('product.detail', compact('product','page_title','page'));
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['error']='';
         $page_title ="Create Product";
         $page ="Product";
         $categories = Category::where('IsActive',1)->get();
        return view('product.create',compact('data','page_title','page','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      

        $this->validate($request, [
            'title' => 'required|string',
           //'short_des' => 'required',
           //'category' => 'required',
            ]);

            $data = $request->all();
            $image = "";
            if($request->file('file')){
                $document =  Document::create([          
                  'name'                 => $data['title'],
                  'short_des'            => " ",
                  'category_id'            => 0,
                  'createdby'            => Auth::user()->id,       
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
                        'createdby'             => Auth::user()->id,         
                    ]);
                }
            }else{
                return redirect()->route('document.index')
                ->with('error',
                 'Action Failed Please try again.');   
            }

           if(isset($product)) {
            return redirect()->route('document.index')
                ->with('message',
                 'Category successfully added.');
            }else{
                return redirect()->route('document.index')
                ->with('error',
                 'Action Failed Please try again.');
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Document::with('image')->findOrFail($id);


        $page_title ="Edit Document";
        $categories = Category::where('IsActive',1)->get();

        // dd($product);
        return view('product.create', compact('product','page_title','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'=>'required',
            ]);
        $product = Document::findOrFail($id);
        //dd($request->file('file'));
        $image = "";
            if($request->file('file') !=null){
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
                    $image = value(function() use ($image_file,$k){
                    $filename = $k.time().'.'. $image_file->getClientOriginalExtension();
                    return strtolower($filename);
                    });
                    $image_file->move($destinationPath, $image);

                    $pro =  DocumentDetail::create([          
                        'document_id'            => $id,
                        'url'                   => $image,
                        'IsDefault'             => 0,
                        'createdby'             => Auth::user()->id,         
                    ]);
                }
            }
        
        $doc_title       = $request->input('doc_title');
        $dids       = $request->input('dids');
        foreach ($dids as $k => $value) {
          $detail = DocumentDetail::findOrFail($value);
          $detail->doc_name = $doc_title[$k];
          $upate = $detail->save();
        }
        // dd($doc_title);
        //$product->category_id     = $request->input('category');
        $product->name            = $request->input('title');
        $upate = $product->save();
        

        if(isset($upate)) {
            return redirect()->route('document.index')->with('message','Category successfully Updated.');
        }else{
            return redirect()->route('document.index')->with('message','Action Failed Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product   = Document::findOrFail($id);
        $query = DocumentDetail::where('document_id',$id);
        if($query->count() > 0 ){
          $details = $query->get();
          foreach ($details as $key => $detail) {
            Share::where('document_id',$detail->id)->update(['deleted_at'=>date('Y-m-d H:i:s',time())]);
          }
        }
        DocumentDetail::where('document_id',$id)->update(['deleted_at'=>date('Y-m-d H:i:s',time())]);
        // $share   = Share::where('document_id',$id)->update('IsActive','0');
        $delete     = $product->delete();
        if(isset($delete)) {
           return redirect()->route('document.index')->with('message','Document successfully Deleted.');
        }else{
            return redirect()->route('document.index')->with('message','Action Failed Please try again.');
        }
    }
    public function loadItem(){
      $query = Document::with(['user_name','image','defaultImage'=> function($query){
            $query->where('IsDefault', 1);
        }])->orderBy('bookMark','DESC')->orderBy('id','DESC');

        if(Auth::user()->user_type !=0){
          $query->where('createdby',Auth::user()->id);
        }
        
        
        if(isset($_REQUEST['title'])){
              if($_REQUEST['title'] !="all" && $_REQUEST['title'] !="" ){
                  //$query->where('title',$_REQUEST['title']);
                  $query->where('name', 'LIKE', '%' . $_REQUEST['title'] . '%');;
              }
        }

        
        if(isset($_REQUEST['status'])){
            if($_REQUEST['status'] !="all" && $_REQUEST['status'] !="" ){
                $query->where('IsActive',$_REQUEST['status']);
            }
        }

        $documents = $query->get();
        $page_title ="Document List";
       //dd($documents);
        $page_title ="Document List";
        $page ="Document";

        $categories = Category::where('IsActive',1)->get();
        // ->where('IsActive',1)
        $users = User::where('id','!=',Auth::user()->id)->get();
        // dd($users);
        return view('product.list', compact('documents','page_title','page','categories','users'));

    }
    public function deleteAllItem(Request $request)
    {
    	$data = $request->all();
    	$ids = $data['ids'];
    	foreach ($ids as $key => $value) {
			$product   = DocumentDetail::findOrFail($value);
      if(Share::where('document_id',$value)->count()){
        $shareFlag = Share::where('document_id',$value)->update(['deleted_at'=>date('Y-m-d H:i:s',time())]);
      }
			$delete     = $product->delete();
    	}
    	if(isset($delete)) {
           $response = array('status'=>'success','message'=>'Document Deleted');
        }else{
            $response = array('status'=>'failed','message'=>'Operation Failed');
        }
    	echo json_encode($response);
    	die;
    }

    public function shareAllItem(Request $request)
    {
      $documentCount = 0;
      $documentAlreadyShare = 0;
      $documentAlreadyShareFlag = false;
      $msg = '';
      $data = $request->all();
      $documents = $data['ids'];
      $shareDataUserIds = $data['shareDataUserId'];
      // echo json_encode($data);
      // die;
      foreach ($documents as $key => $document) {
      foreach ($shareDataUserIds as $key => $shareDataUserId) {
            $count =Share::where([ 'user_id'=> $shareDataUserId,'document_id'=>$document])->count();
            if($count == 0){
               $documentCount++;
               $share =  Share::updateOrCreate([          
                'user_id'       => $shareDataUserId,
                'document_id'   => $document,
                'createdby'     => Auth::user()->id,         
               ],['IsActive'=>1]);
             }else{
              $documentAlreadyShare++;
              $documentAlreadyShareFlag = true;
             }
        }
      }
      if($documentAlreadyShareFlag){
        if($documentCount >0){
          $msg .= $documentCount.' Document Share <br/>';
        }
        $msg .= 'Count : '.$documentAlreadyShare.' : This document aleady share';
        $response = array('status'=>'success','message'=>$msg);
      }else{
        if(isset($share)) {
           $response = array('status'=>'success','message'=>'Document Shared');
        }else{
            $response = array('status'=>'failed','message'=>'Operation Failed');
        }  
      }
      
      echo json_encode($response);
      die;
    }
    
    
    public function updateDocument($id, $keyword){
        if($keyword == 'deactive'){
            $product = Document::findOrFail($id); 
            $updatedata = $product->fill(array('IsActive'=>'0'))->save();
            return redirect('admin/document')->with('message','Deactive Successfully.');
            
        }
        if($keyword == 'active'){
            $product = Document::findOrFail($id); 
            $updatedata = $product->fill(array('IsActive'=>'1'))->save();
            return redirect('admin/document')->with('message','Active Successfully.');
            
        }

        if($keyword == 'add-bookmark'){
            $product = Document::findOrFail($id); 
            $updatedata = $product->fill(array('bookMark'=>'1'))->save();
            return redirect('admin/document')->with('message','Active Successfully.');
            
        }
        if($keyword == 'remove-bookmark'){
            $product = Document::findOrFail($id); 
            $updatedata = $product->fill(array('bookMark'=>'0'))->save();
            return redirect('admin/document')->with('message','Active Successfully.');
            
        }
    }

    public function getImages($id){
        //echo "string".$id;
        $images = DocumentDetail::where('document_id',$id)->get()->toArray();
        
        $html = "";
        $html = '<div class="form-group-inner">
        <div class="row">';
        foreach ($images as $key => $image) {
            $url = asset('assets/img/documents/'.$image['url']);
            $html .= '<div class="col-sm-3">';
            if($image['IsDefault']){
                $html .= '<input type="radio" class="preImage" name="image" value="'.$image['id'].'" checked/>';
            }else{
                $html .= '<input type="radio" class="preImage" name="image" value="'.$image['id'].'" />';
            }
            $html .= '<img class="img-circle" src="'.$url.'" alt="product image" />';
            $html .= '</div>';
        }

        $html .= '</div></div>';

        $response = array('status'=>'success','results'=>$images,'html'=>$html);
        echo json_encode($response);
        
    }


    public function updateImages(Request $request)
    {
        $data = $request->all(); 
       // print_r($data);
        $image = DocumentDetail::findOrFail($data['id']); 
        DocumentDetail::where('document_id',$image->product_id)->update(['IsDefault'=>0]);
        $update= DocumentDetail::where('id',$data['id'])->update(['IsDefault'=>1]);
        // $image->IsDefault = 1;
        // $update= $image->save();
        if($update){
             $response = array('status'=>'success');
        }else{
             $response = array('status'=>'failed','message'=>"Operation failed");
        }
         echo json_encode($response);
    }

    

    public function getProduct(){
        $draw = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];
        $searchArray = $_REQUEST['search'];

      
        $query = Document::with(['category','defaultImage'=> function($query){
            $query->where('IsDefault', 1);
        }])->orderBy('id','DESC');

        if(isset($_GET['type'])){
            if($_GET['type'] !="all" ){
                $query->where('type',$_GET['type']);
            }
        }

        if(isset($_REQUEST['title'])){
              if($_REQUEST['title'] !="all" && $_REQUEST['title'] !="" ){
                  //$query->where('title',$_REQUEST['title']);
                  $query->where('name', 'LIKE', '%' . $_REQUEST['title'] . '%');;
              }
        }

        if(isset($_REQUEST['category'])){
            if($_REQUEST['category'] !="all" && $_REQUEST['category'] !="" ){
                $query->where('category_id',$_REQUEST['category']);
            }
        }

        if(isset($_REQUEST['status'])){
            if($_REQUEST['status'] !="all" && $_REQUEST['status'] !="" ){
                $query->where('IsActive',$_REQUEST['status']);
            }
        }

        if(Auth::user()->user_type !=0){
          $query->where('createdby',Auth::user()->id);
        }
        $products = $query->get();



        $totalCount=Document::count();
        $scheduleData = array();
        foreach ($products as $key => $value) {
          $action = "";
          $status = "";
          if($value->IsActive){

          }else{

          }
          
         
          
          $action .='<a class="btn btn-info pull-left imagePopup" style="margin-right: 3px;" pid="'.$value->id.'"  title="Photo Gallery"><i class="fa fa-picture-o"></i></a> ';
          $str = "admin/document/".$value->id."/edit";
          $action .= '<a href="'.URL('admin/document/'.$value->id.'/edit').'" class="btn btn-info pull-left" style="margin-right: 3px;" data-toggle="tooltip" title="Document Edit"><i class="fa fa-edit"></i></a>';

        if($value->IsActive){
            $action .='<a href="'.URL('admin/updateDocument/'.$value->id.'/deactive').'" class="btn btn-danger pull-left" style="margin-right: 3px;" onclick="return confirm(\'Are You Sure To Dctivated?\')" title="Click to Deactive"><i class="fa fa-ban"></i></a>';
            $status = '<span class="text text-success fa fa-check"></span>';
        }else{ 
            $action .='<a href="'.URL('admin/updateDocument/'.$value->id.'/active').'" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm(\'Are You Sure To Activated?\')" title="Click to Active"><i class="fa fa-check"></i></a>';
            $status = '<span class="text text-danger fa fa-remove"></span>';
         }                                            

            $image = "assets/gallery.png";
            if($value->defaultImage->url){
                $image = "assets/img/documents/".$value->defaultImage->url;
            }
            $imageUrl = '<img class="img-thumbnail" src="'.asset($image).'" alt="product image" />';
            $name = '<a href="'.URL('admin/updateDetail/'.$value->id).'">'.$value->name.'</a>';
            $result=array(
                  'image'       =>$imageUrl,
                  'category'    =>$value->category->name,
                  'name'        =>$name,
                  'des'        =>$value->short_des,
                  'status'      =>$status,
                  'action'      =>$action
            );
            $scheduleData[] =$result;
        }

        $data=array(
          "draw"            => $draw,
          "recordsTotal"    => $totalCount,
          "recordsFiltered" => $totalCount,
          "data"            =>$scheduleData
        );

        echo json_encode($data);
  }

    

    
}
