<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Auth;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Mail;
use App\Mail\Verification;
use App\Websitesetting;
use Validator;
//use Illuminate\Support\Facades\Hash;

class BannerController extends Controller
{
    public function __construct() 
    {
        //$this->middleware(['auth','clearance']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        
        $start='';
        $customer = \App\Banner::orderBy('id','DESC');;
        
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $customer->where('name','LIKE','%'.$_GET['name'].'%');
          }           
        }
        
        $banners= $customer->get();
        $pagetitle='Banner Management';
        // dd($student);
        return view('banner.index',compact('banners','pagetitle'));
    }

    public function create()
    {
        $pagetitle='Banner Create';
        return view('banner.create',compact('pagetitle'));
    }


   public function edit($id)
    {
     $banner = \App\Banner::findOrFail($id); 
     $pagetitle='Banner Edit';
     return view('banner.create',compact('banner','pagetitle')); 
    }

   public function store(Request $request)
    {
       // return $request;
        $this->validate($request, [
            'title'=>'required|max:120',
        ]);

            // dd($request->all());
        $banner = new \App\Banner(); 
        $banner->title = $request->title;
        $banner->caption = $request->caption;
        $banner->secondCaption = $request->secondCaption;
        $banner->thirdCaption = $request->thirdCaption;
        
        if($request->hasFile('file')) {
        $image = $request->file('file');
        if($image){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/banner');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
            $banner->image = $img;
        }
        }


         $flag = $banner->save();

        if($flag) {
            return redirect()->route('banner.index')->with('message','Banner Created successfully.');
        }else{
            return redirect()->route('banner.index')->with('message','Action Failed Please try again.');
        }
    }

 public function update(Request $request, $id)
 {
        //return $request;
        $this->validate($request, [
            'title'=>'required|max:120',
        ]);

        $banner = \App\Banner::findOrFail($id); 
        $banner->title = $request->title;
        $banner->caption = $request->caption;
        $banner->secondCaption = $request->secondCaption;
        $banner->thirdCaption = $request->thirdCaption;


        if($request->hasFile('file')) {
            $image = $request->file('file');
            if($image){
                $path = public_path('/assets/img/banner/');  
                if($banner->image)
                {
                  unlink($path.$banner->image);
                }

                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/img/banner/');
                $image->move($destinationPath, $input['imagename']);
                $img=$input['imagename'];
                $banner->image = $img;
            }
        }

        $flag = $banner->save();
        if($flag) {
            return redirect()->route('banner.index')->with('message','Banner Update successfully.');
        }else{
            return redirect()->route('banner.index')->with('message','Action Failed Please try again.');
        }
    }
   

       public function destroy($id)
    {
        $banner = \App\Banner::findOrFail($id);
        $delete = $banner->delete();
        if(isset($delete)) {
        return redirect()->route('banner.index')
            ->with('message',
             'Store successfully Deleted.');
        }else{
            return redirect()->route('banner.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }


    public function changeBannerStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $banner = \App\Banner::findOrFail($id);
        $banner->IsActive = $status;
        if($status){
            $message = 'Banner successfully Active';
        } else {
             $message = 'Banner successfully Deactive';
        }
        $flag = $banner->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }




   
}
