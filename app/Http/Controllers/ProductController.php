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

class ProductController extends Controller
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
        $customer = \App\Product::with(['category_list','unit_list','sub_category_list'])->orderBy('id','DESC');
        
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $customer->where('name','LIKE','%'.$_GET['name'].'%');
          }           
        }

        if(isset($_GET['category_id']))
        {
          if($_GET['category_id']!='all' && $_GET['category_id']!='')
          {
           $customer->where('category_id',$_GET['category_id']);
          }           
        }
        if(isset($_GET['brand_id']))
        {
          if($_GET['brand_id']!='all' && $_GET['brand_id']!='')
          {
           $customer->where('brand_id',$_GET['brand_id']);
          }           
        }

        if(isset($_GET['shortby']))
        {
          if($_GET['shortby']!='all')
          {
            $customer->orderBy('total_credit',$_GET['shortby']);
          }
        }
        else
        {
            $customer->orderBy('id','DESC');
        }
        
        if(isset($_GET['status']))
        {
          if($_GET['status']!='' && $_GET['status']!='all'){
              if($_GET['status']=='verify' ){
               $customer->where('IsVerify',1);
              }
              if($_GET['status']=='unverify' ){
               $customer->where('IsVerify',0);
              }
              if($_GET['status']=='active' ){
               $customer->where('IsActive',1);
              }
              if($_GET['status']=='deactive' ){
               $customer->where('IsActive',0);
              }

          }           
        }
        
        
        $customers= $customer->paginate(20);
        $pagetitle='Product Management';
        $categories = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
        $sub_categories = \App\Category::where('parent_id','!=',0)->get();
        $units = \App\Unit::where(['IsActive'=>1])->get();
        $brands = \App\Brand::where(['IsActive'=>1])->get();
        return view('product.index',compact('customers','pagetitle','brands','categories'));
    }

    public function create()
    {
        $pagetitle='Product Create';
        $categories = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
        $units = \App\Unit::where(['IsActive'=>1])->get();
        $brands = \App\Brand::where(['IsActive'=>1])->get();
        $sub_categories = [];
        $sub_sub_categories = [];
        return view('product.create',compact('pagetitle','units','categories','brands','sub_categories','sub_sub_categories'));
    }


   public function edit($id)
    {
        $product = \App\Product::findOrFail($id); 
        $sub_categories = [];
        $sub_sub_categories = [];
        if($product->category_id)
        $sub_categories = \App\Category::where(['parent_id'=>$product->category_id])->get();

        if($product->sub_category_id)
        $sub_sub_categories = \App\Category::where(['parent_id'=>$product->sub_category_id])->get();       

        $pagetitle='Product Edit';
        $categories = \App\Category::where(['IsActive'=>1])->get();
        $units = \App\Unit::where(['IsActive'=>1])->get();
        $brands = \App\Brand::where(['IsActive'=>1])->get();
        return view('product.create',compact('product','pagetitle','units','categories','brands','sub_categories','sub_sub_categories')); 
    }

   public function store(Request $request)
    {
       //return $request;
        $this->validate($request, [
            'name'=>'required|max:120|unique:tbl_product',
            'category_id'=>'required',
        ]);

            
         $product = new \App\Product(); 
         $product->name     = $request->name;
         $product->category_id = $request->category_id;
         $product->sub_category_id = $request->sub_category;
         $product->sub_sub_category_id = $request->sub_sub_category;
         //$product->unit_id = $request->unit_id;   
         $product->brand_id = $request->brand_id;   
         //$product->price = $request->price;   
         //$product->internal_price = $request->internal_price;   
         $product->meta_data = $request->meta_data;   
         $product->meta_description = $request->meta_description;   
         $product->product_tags = $request->product_tags;   
         //$product->discount = $request->discount;   
         //$product->discount_type = $request->discount_type;   
         $product->description = $request->description;   
         $product->short_description = $request->short_description;   
        
        if($request->hasFile('file')) {
            $image = $request->file('file');
            if($image){
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/assets/img/product');
                $image->move($destinationPath, $input['imagename']);
                $img=$input['imagename'];
                $product->profile_pic = $img;
            }
        }


         $flag = $product->save();

        if($flag) {
            return redirect()->route('product.index')->with('message','Product Created successfully.');
        }else{
            return redirect()->route('product.index')->with('message','Action Failed Please try again.');
        }
    }

     public function update(Request $request, $id)
     {
            //return $request;
            $this->validate($request, [
                'name'=>'required|max:120|unique:tbl_product,name,'.$id,
                'category_id'=>'required',
            ]);

            $product = \App\Product::findOrFail($id); 
            $product->name = $request->name;
            $product->category_id = $request->category_id;
            $product->sub_category_id = $request->sub_category;
            $product->sub_sub_category_id = $request->sub_sub_category;
            //$product->unit_id = $request->unit_id;
            $product->brand_id = $request->brand_id;
            //$product->price = $request->price;   
            //$product->internal_price = $request->internal_price;   
            $product->meta_data = $request->meta_data;   
            $product->meta_description = $request->meta_description;   
            $product->product_tags = $request->product_tags;   
            //$product->discount = $request->discount;   
            //$product->discount_type = $request->discount_type;   
            $product->description = $request->description;   
            $product->short_description = $request->short_description;
        
            if($request->hasFile('file')) {
                $image = $request->file('file');
                if($image){
                    $path = public_path('/assets/img/product/');  
                    if($product->profile_pic)
                    {
                    unlink($path.$product->profile_pic);
                    }

                    $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/assets/img/product');
                    $image->move($destinationPath, $input['imagename']);
                    $img=$input['imagename'];
                    $product->profile_pic = $img;
                }
            }

            $flag = $product->save();
            if($flag) {
                return redirect()->route('product.index')->with('message','Product Update successfully.');
            }else{
                return redirect()->route('product.index')->with('message','Action Failed Please try again.');
            }
     }
   

       public function destroy($id)
    {
        $user = \App\Product::findOrFail($id);
        $delete = $user->delete();
        if(isset($delete)) {
        return redirect()->route('product.index')
            ->with('message',
             'Product successfully Deleted.');
        }else{
            return redirect()->route('product.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function customerStatus($id, $key)
    {
        $customer = \App\Product::findOrFail($id);
        if($key === 'active'){
            $customer->status = 1;
            $message = 'Product successfully Active';

        }
        if($key === 'deactive'){
            $customer->status = 0;
             $message = 'Product successfully Deactive';
        }
        $flag = $customer->save();
        if($flag){
            return redirect()->route('product.index')->with('message',$message);
        }else{
            return redirect()->route('product.index')->with('message','Operation failed please try again.');
        }
        
    }

    // public function changeProductStatus(Request $request)
    // {
    //     $id = $request->cat_id;
    //     $status = $request->status;
    //     $product = \App\Product::findOrFail($id);
    //     $product->IsActive = $status;
    //     if($status){
    //         $message = 'Product successfully Active';
    //     } else {
    //          $message = 'Product successfully Deactive';
    //     }
    //     $flag = $product->save();
    //     if($flag){
    //         echo json_encode(['status'=>true,'message'=>$message]);
    //     }else{
    //         echo json_encode(['status'=>false,'message'=>'Operation Failed']);
    //     }
    // }
    public function verifyProduct(Request $request)
    {
        $id = $request->product_id;
        $product = \App\Product::findOrFail($id);
        $product->IsVerify = 1;

        $inventory = \App\Inventory::where('product_id',$id)->update(['productVerify'=>1]);
        
        $message = 'Product successfully Verify';
        $flag = $product->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }
    public function changeProductStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $product = \App\Product::findOrFail($id);
        $product->IsActive = $status;
        if($status){
            $message = 'Product successfully Active';
        } else {
             $message = 'Product successfully Deactive';
        }
        $flag = $product->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }

    public function getSubCategory(Request $request)
    {
        $cid = $request->cid;
        $query = \App\Category::where(['parent_id'=>$cid,'IsActive'=>1]);
        $htm = '';    
        // $htm .= '<select class="form-control select2" name="product[]">'; 
        
        if ($query->count()) {
            $products = $query->get();
            $htm .= '<option value="" selected="" disabled="">Select Sub Category</option>';
            foreach ($products as $key => $value) {
                $htm .= "<option value=".$value->id.">".$value->name."</option>";
            }
            $response = ['status'=>true,'result'=>$htm];
        }else{
            $htm .= '<option value="" selected="" disabled="">No Records</option>';
            $response = ['status'=>false,'result'=>$htm];
        }
        // $htm .= '</select>'; 
        echo json_encode($response);
        // if($flag){
            
        // }else{
        //     echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        // }
    }





   
}
