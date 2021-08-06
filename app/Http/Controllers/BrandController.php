<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Kitchen;
use App\KitchenFood;
use App\Student;
use App\Referral;
use App\School;
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

class BrandController extends Controller
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
        $query = \App\Brand::with(['category_list'])->orderBy('id','DESC');
        
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $query->where('name','LIKE','%'.$_GET['name'].'%');
          }           
        }
        if(isset($_GET['shortby']))
        {
          if($_GET['shortby']!='all')
          {
            $query->orderBy('total_credit',$_GET['shortby']);
          }
        }
        else
        {
            $query->orderBy('id','DESC');
        }
        
        $brands= $query->paginate(20);
        $pagetitle='Brand Management';

        // dd($student);
        return view('admin.brand.index',compact('brands','pagetitle'));
    }

    public function create()
    {
        $pagetitle='Brand Create';
        $categories = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
        return view('admin.brand.create',compact('pagetitle','units','categories'));
    }


   public function edit($id)
    {
     $brand = \App\Brand::findOrFail($id); 
     $pagetitle='Brand Edit';
     $categories = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
     return view('admin.brand.create',compact('brand','pagetitle','categories')); 
    }

   public function store(Request $request)
    {
       //return $request;
        $this->validate($request, [
            'name'=>'required|max:120|unique:tbl_brand',
            'category_id'=>'required',
        ]);

            
         $brand = new \App\Brand(); 
         $brand->name = $request->name;
         $brand->category_id = $request->category_id;
   
         $flag = $brand->save();

        if($flag) {
            return redirect()->route('brand.index')->with('message','Brand Created successfully.');
        }else{
            return redirect()->route('brand.index')->with('message','Action Failed Please try again.');
        }
    }

 public function update(Request $request, $id)
 {
        //return $request;
        $this->validate($request, [
            'name'=>'required|max:120|unique:tbl_brand,name,'.$id,
            'category_id'=>'required',
        ]);

        $brand = \App\Brand::findOrFail($id); 
        $brand->name = $request->name;
        $brand->category_id = $request->category_id;
        $flag = $brand->save();
        if($flag) {
            return redirect()->route('brand.index')->with('message','Brand Update successfully.');
        }else{
            return redirect()->route('brand.index')->with('message','Action Failed Please try again.');
        }
    }
   

    public function destroy($id)
    {
        $user = \App\Brand::findOrFail($id);
        $delete = $user->delete();
        if(isset($delete)) {
        return redirect()->route('brand.index')
            ->with('message',
             'Brand successfully Deleted.');
        }else{
            return redirect()->route('brand.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function changeBrandStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $brand = \App\Brand::findOrFail($id);
        $brand->IsActive = $status;
        if($status){
            $message = 'Brand successfully Active';
        } else {
             $message = 'Brand successfully Deactive';
        }
        $flag = $brand->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }




   
}
