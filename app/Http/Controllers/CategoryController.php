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

class CategoryController extends Controller
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
        $category = \App\Category::with(['category_name'])->orderBy('id','DESC');
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $category->where('name','LIKE','%'.$_GET['name'].'%');
          }
        }
        if(isset($_GET['status']))
        {
          if($_GET['status']!='all')
          {
             $category->where('IsActive',$_GET['status']);
          }
        } 
        $categories= $category->paginate(10);

        // dd($categories);
        $pagetitle='Category List';
        // dd($student);
        return view('category.index',compact('categories','pagetitle'));
    }

    public function getName($id){
      $category = \App\Category::where(['id',$id])->first();
      if($category->parent_id){
        return ['status'=>true,'parent_id'=>$category->parent_id];
      }else{
        return ['status'=>false];
      }
    }
    public function create()
    {
        // $category = \App\Category::get(); 
        $pagetitle='Create Category'; 
        $categories = \App\Category::with(['category_name'])->get();
        // dd();
        $categories_array = [];
        foreach ($categories as $key => $value) {
          $category = $value;
          $parent_category = $value;
          $temp = [];
          do
          {
            $flag = false;
            if($category->parent_id){
              $parent_category = \App\Category::where(['id'=>$category->parent_id])->first();
              $flag = true;
            }
            $temp[] = $category->name;
            $category = $parent_category;
            // execute the statements;
          }while ($flag);
          // echo implode('/', array_reverse($temp));
          $categories_array[$key]['id'] = $category->id;
          $categories_array[$key]['data'] = $temp;
        }

        // dd($categories);
        return view('category.create',compact('categories_array','categories','pagetitle'));
    }

   public function edit($id)
    {
     $category = \App\Category::findOrFail($id);
     $categories = \App\Category::with(['category_name'])->get();
        // dd();
        $categories_array = [];
        foreach ($categories as $key => $value) {
          $category_data = $value;
          $parent_category = $value;
          $temp = [];
          $categories_array[$key]['id'] = $value->id;
          do
          {
            $flag = false;
            if($category_data->parent_id){
              $parent_category = \App\Category::where(['id'=>$category_data->parent_id])->first();
              $flag = true;
            }
            $temp[] = $category_data->name;
            $category_data = $parent_category;
            // execute the statements;
          }while ($flag);
          // echo implode('/', array_reverse($temp));
          
          $categories_array[$key]['data'] = $temp;
        } 
     $pagetitle='Edit Category'; 
     return view('category.create',compact('category','pagetitle','categories_array','categories')); 
    }

   public function store(Request $request)
    {
        //return $request;
        $this->validate($request, [
          'name'=>'required|max:120',
        ]);

        $image = $request->file('file');
        $bannerimage = $request->file('bannerimage');
        $img = '';
        if($image){
            $img = uniqid().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/category');
            $image->move($destinationPath, $img);
        }
        
		if($bannerimage){
                  $banner = uniqid().'.'.$bannerimage->getClientOriginalExtension();
                  $destinationPath = public_path('/assets/img/category');
                  $bannerimage->move($destinationPath, $banner);
          }

        $category = new \App\Category(); 
        $category->name = $request->name;
        $category->image = $img;
        $category->banner_image = $banner;
        $category->parent_id = $request->category_id;
        $category->created_by = Auth::user()->id;

        $flag = $category->save();
        if($flag){
            return redirect()->route('category.index')->with('message','Category Info successfully added.');
        }else{
            return redirect()->route('category.index')->with('message','Action Failed Please try again.');
        }
     
    }

 public function update(Request $request, $id)
    {
       //return $request;
        $this->validate($request, [
        'name'=>'required|max:120',
        ]);

        $category = \App\Category::findOrFail($id); 
        $image = $request->file('file');
        $bannerimage = $request->file('bannerimage');
        $path = public_path('/assets/img/category/');  
        if($image){
        
             if($category->image)
             {
               unlink($path.$category->image);
             }
             $img = uniqid().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/assets/img/category');
             $image->move($destinationPath, $img);

             $category->image=$img;
        }  
        if($bannerimage){
         
             if($category->banner_image)
             {
               unlink($path.$category->banner_image);
             }
             $banner = uniqid().'.'.$bannerimage->getClientOriginalExtension();
             $destinationPath = public_path('/assets/img/category');
             $bannerimage->move($destinationPath, $banner);

             $category->banner_image=$banner;
        }

    
        $category->name = $request->name;
        $category->parent_id = $request->category_id;

        $flag = $category->save();
        if($flag){
            return redirect()->route('category.index')->with('message','Category Info successfully added.');
        }else{
            return redirect()->route('category.index')->with('message','Action Failed Please try again.');
        }
    }
   

       public function destroy($id)
    {
        $user = \App\Category::findOrFail($id);
        $delete = $user->delete();
        // Log::create([
        //   'user_id' =>$id,
        //   'activity' =>"User Deleted",
        //   'createdBy' =>Auth::user()->id
        // ]);
        if(isset($delete)) {
        return redirect()->route('category.index')
            ->with('message',
             'Category successfully Deleted.');
        }else{
            return redirect()->route('category.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

     public function categoryStatus($id, $key)
    {
        $customer = \App\Category::findOrFail($id);
        if($key === 'active'){
            $customer->IsActive = 1;
            $message = 'Category successfully Active';

        }
        if($key === 'deactive'){
            $customer->IsActive = 0;
             $message = 'Category successfully Deactive';
        }
        $flag = $customer->save();
        if($flag){
            return redirect()->route('category.index')->with('message',$message);
        }else{
            return redirect()->route('category.index')->with('message','Operation failed please try again.');
        }
        
    }

    public function changeCategoryStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $customer = \App\Category::findOrFail($id);
        $customer->IsActive = $status;
        if($status){
            $message = 'Category successfully Active';
        } else {
             $message = 'Category successfully Deactive';
        }
        $flag = $customer->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }
 public function showOnhome(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $customer = \App\Category::findOrFail($id);
        $customer->IsHomePage = $status;
        if($status){
            $message = 'Category successfully Active';
        } else {
             $message = 'Category successfully Deactive';
        }
        $flag = $customer->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }

   public function changeOrder()
    {  
        $categories = \App\Category::with(['category_name'])->where('parent_id',0)->orderBy('category_order','ASC')->get();
        $pagetitle='Change Category Order';
        return view('category.changeorder',compact('categories','pagetitle'));
    }

    public function chnageCategoryOrder(Request $request)
    {
      foreach ($request->value as $key => $value) {
       $category = \App\Category::findOrFail($value);
       $category->category_order = $key;
       $category->save();

      }
    }
   
   
}
