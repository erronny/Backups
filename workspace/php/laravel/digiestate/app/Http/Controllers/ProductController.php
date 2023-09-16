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
use App\User;
use Illuminate\Support\Facades\Config;
//use Mail;
//use App\Mail\Client as clientMail;
//use App\Websitesetting;

class ProductController extends Controller
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
        $query = Document::with(['defaultImage'=> function($query){
            $query->where('IsDefault', 1);
        }])->orderBy('id','DESC');

        if(Auth::user()->user_type !=0){
          $query->where('createdby',Auth::user()->id);
        }
        $products = $query->get();
        $page_title ="Document List";
       //dd($products);
        $page_title ="Document List";
        $page ="Document";

        $categories = Category::where('IsActive',1)->get();
        //dd($products);
        return view('product.index', compact('products','page_title','page','categories'));
    }


    public function updateDetail($id)
    {
        $query = Product::with(['image'=> function($qs){
            $qs->orderBy('IsDefault', 'DESC');
        },'defaultImage'=> function($query){
            $query->where('IsDefault', 1);
        }])->orderBy('id','DESC');
         $query->where('id',$id);
        if(isset($_GET['type'])){
            if($_GET['type'] !="all" ){
                $query->where('type',$_GET['type']);
            }
        }
        $product = $query->first();
        $page_title ="University List";
        //dd($products);
        $page_title ="Product Detail";
        $page ="Product";

        //dd($product);
        return view('product.detail', compact('product','page_title','page'));
    }

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
           'short_des' => 'required',
           'category' => 'required',
            ]);

            $data = $request->all();
            $image = "";
            if($request->file('file')){
                $document =  Document::create([          
                  'name'                 => $data['title'],
                  'short_des'            => $data['short_des'],
                  'category_id'            => $data['category'],
                  'createdby'            => Auth::user()->id,       
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
                        'createdby'             => Auth::user()->id,         
                    ]);
                }
            }else{
                return redirect()->route('product.index')
                ->with('error',
                 'Action Failed Please try again.');   
            }

           if(isset($product)) {
            return redirect()->route('product.index')
                ->with('message',
                 'Product successfully added.');
            }else{
                return redirect()->route('product.index')
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
                    $image = value(function() use ($image_file){
                    $filename = time().'.'. $image_file->getClientOriginalExtension();
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
        
        $product->category_id     = $request->input('category');
        $product->name            = $request->input('title');
        $product->short_des       = $request->input('short_des');
        $upate = $product->save();


        if(isset($upate)) {
            return redirect()->route('product.index')->with('message','Product successfully Updated.');
        }else{
            return redirect()->route('product.index')->with('message','Action Failed Please try again.');
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
        $product   = Product::findOrFail($id);
        $delete     = $product->delete();
        if(isset($delete)) {
           return redirect()->route('product.index')->with('message','Product successfully Deleted.');
        }else{
            return redirect()->route('product.index')->with('message','Action Failed Please try again.');
        }
    }
    
    
    public function updateProduct($id, $keyword){
        if($keyword == 'deactive'){
            $product = Document::findOrFail($id); 
            $updatedata = $product->fill(array('IsActive'=>'0'))->save();
            return redirect('admin/product')->with('message','Deactive Successfully.');
            
        }
        if($keyword == 'active'){
            $product = Document::findOrFail($id); 
            $updatedata = $product->fill(array('IsActive'=>'1'))->save();
            return redirect('admin/product')->with('message','Active Successfully.');
            
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

      
        $query = Document::with(['defaultImage'=> function($query){
            $query->where('IsDefault', 1);
        }])->orderBy('id','DESC');

        if(isset($_GET['type'])){
            if($_GET['type'] !="all" ){
                $query->where('type',$_GET['type']);
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
          $str = "admin/product/".$value->id."/edit";
          $action .= '<a href="'.URL($str).'" class="btn btn-info pull-left" style="margin-right: 3px;" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>';

        if($value->IsActive){
            $action .='<a href="'.URL('admin/updateProduct/'.$value->id.'/deactive').'" class="btn btn-danger pull-left" style="margin-right: 3px;" onclick="return confirm(\'Are You Sure To Dctivated?\')" title="Click to Deactive"><i class="fa fa-ban"></i></a>';
            $status = '<span class="text text-success fa fa-check"></span>';
        }else{ 
            $action .='<a href="'.URL('admin/updateProduct/'.$value->id.'/active').'" class="btn btn-success pull-left" style="margin-right: 3px;" onclick="return confirm(\'Are You Sure To Activated?\')" title="Click to Active"><i class="fa fa-check"></i></a>';
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
