<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Language_master;
use Auth;
use App\Log;
use App\Courier;
use App\Category;
//use Mail;
//use App\Mail\Client as clientMail;
//use App\Websitesetting;

class CategoryController extends Controller

{
    public function __construct()
    {
        //$this->middleware(['auth', 'clearance']);
    }


    

    public function index()
    {
        $query = Category::orderBy('id','DESC');

        // if(isset($_GET['type'])){
        //     if($_GET['type'] !="all" ){
        //         $query->where('type',$_GET['type']);
        //     }
        // }
        $couriers = $query->get();
        //dd($languages);
        $page_title = "Category List";
        $categories = Category::where('IsActive',1)->get();
        return view('courier.index', compact('couriers','page_title','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $data['error']='';
         //dd($languages);
        $data['page_title'] = "Category";
        return view('courier.create',$data);
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
            'name'=>'required|max:100',
        ]);

        $data = $request->all();
        $image ="";

        if($request->file('file')){
            $path = 'assets/img/category/';        
            $image_file         = $request->file('file');
            $destinationPath    = $path;
            $image_name         = $image_file->getClientOriginalName();
            $extention          = $image_file->getClientOriginalExtension();
            $image = value(function() use ($image_file){
            $filename = time().'.'. $image_file->getClientOriginalExtension();
            return strtolower($filename);
            });
            $request->file('file')->move($destinationPath, $image);
        }

        $courier =  Category::create([          
          'name' => $data['name'],
          'logo' => $image,
          'createdby'=>Auth::user()->id
         ]);


       if(isset($courier)) {
        return redirect()->route('courier.index')
            ->with('message',
             'Courier successfully added.');
        }else{
            return redirect()->route('courier.index')
            ->with('message',
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
        $coriour = Courier::findOrFail($id);
        return view('courier.create', compact('coriour'));
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
            'name'=>'required|max:100',
        ]);

        $courier = Document::findOrFail($id);

        $path = 'assets/img/document/';        
        $oldLogoUrl=$courier->logo;
        if($request->file('file')){
            // file selected
            if($oldLogoUrl != ''){
                if(file_exists($path.$oldLogoUrl)){
                    if(unlink($path.$oldLogoUrl)){
                        //echo "success delete";
                    }
                }
            }
            $image_file =$request->file('file');
            $destinationPath    = $path;
            $image_name         = $image_file->getClientOriginalName();
            $extention          = $image_file->getClientOriginalExtension();
            $image = value(function() use ($image_file){
            $filename = time().'.'. $image_file->getClientOriginalExtension();
                return strtolower($filename);
            });
            $request->file('file')->move($destinationPath, $image);
            $courier->logo   = $image;
        }

        $courier->name = $request->input('name');
        $upate = $courier->save();

        if(isset($upate)) {
           
        return redirect()->route('courier.index')
            ->with('message',
             'Courier successfully Updated.');
        }else{
            return redirect()->route('courier.index')
            ->with('message',
             'Action Failed Please try again.');
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
        $courier   = Document::findOrFail($id);
        $delete     = $courier->delete();
        
        if(isset($delete)) {
            return redirect()->route('courier.index')
            ->with('message',
             'Language successfully Deleted.');
        }else{
            return redirect()->route('courier.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }
    
    
    public function updateCategory($id, $keyword){
        
        if($keyword == 'deactive'){
           
            $courier = Document::findOrFail($id); 
            $updatedata = $courier->fill(array('IsActive'=>'0'))->save();
            Log::create([
              'user_id' =>0,
              'activity' =>"courier Deactivated",
              'createdBy' =>Auth::user()->id,
            ]);
            return redirect('admin/courier')->with('message',
             'Deactive Successfully.');
            
        }
        
        if($keyword == 'active'){
            $courier = Document::findOrFail($id); 
            $updatedata = $courier->fill(array('IsActive'=>'1'))->save();
            return redirect('admin/courier')->with('message',
             'Active Successfully.');
            
        }
    }
}
