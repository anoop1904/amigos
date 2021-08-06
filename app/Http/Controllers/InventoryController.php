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

class InventoryController extends Controller
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
        $subcategorylist=array();
        $productlist=array();
        $customer = \App\Inventory::with(['store','product'])->orderBy('id','DESC');
        if(isset($_GET['store']))
        {
            if($_GET['store']!='all')
            {
              $customer->where('store_id',$_GET['store']);  
            }
            
        }
        if(isset($_GET['product']))
        {
            if($_GET['product']!='all')
            {
               $customer->where('product_id',$_GET['product']);
            }
        }
        if(isset($_GET['category']))
        {
            if($_GET['category']!='all')
            {
               $customer->where('category_id',$_GET['category']); 
                $subcategorylist = \App\Category::where(['parent_id'=>$_GET['category'],'IsActive'=>1])->get();
                 $productlist = \App\Product::where(['category_id'=>$_GET['category'],'IsActive'=>1])->get();
            }  
        }
        if(isset($_GET['subcategory']))
        {
            if($_GET['subcategory']!='all')
            {
              $customer->where('sub_category_id',$_GET['subcategory']); 
               $productlist = \App\Product::where(['sub_category_id'=>$_GET['subcategory'],'IsActive'=>1])->get();   
            }
        }
        $inventories= $customer->paginate(20);
        $pagetitle='Inventory Management';
        $categoties = \App\Category::where(['IsActive'=>1])->get();
        $stores = \App\Store::where(['IsActive'=>1])->get();
        // dd($student);
        return view('admin.inventory.index',compact('stores','pagetitle','categoties','inventories','subcategorylist','productlist'));
    }

    public function create()
    {
        $pagetitle='Inventory Create';
        $categoties = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
        $stores = \App\Store::where(['IsActive'=>1])->get();
        $unitlist = \App\Unit::where(['IsActive'=>1])->get();
        return view('admin.inventory.create',compact('stores','pagetitle','categoties','unitlist'));
    }


   public function edit($id)
    {
       
       $edit_data = \App\InventoryEntry::findOrFail($id); 
       $pagetitle='Inventory Edit';
       $stores = \App\Store::where(['IsActive'=>1])->get();
       $unitlist = \App\Unit::where(['IsActive'=>1])->get();
       $categoties = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
       $subcategorylist = \App\Category::where(['parent_id'=>$edit_data->category_id,'IsActive'=>1])->get();
       $products = \App\Product::where(['category_id'=>$edit_data->category_id,'sub_category_id'=>$edit_data->sub_category_id,'IsActive'=>1])->get();
     return view('admin.inventory.edit',compact('stores','edit_data','pagetitle','categoties','unitlist','products','subcategorylist')); 
    }

   public function store(Request $request)
    {}

   public function updateInventory(Request $request)
   {
        $inventory = \App\InventoryEntry::findOrFail($request->eid); 
        $qty=$inventory->qty;
        $inventory->qty             = $request->quantity;
        $inventory->weight          = $request->weight;
        $inventory->unit            = $request->unit;
        $inventory->sub_category_id = $request->subcategory;
        $inventory->category_id     = $request->category;
        $inventory->store_id        = $request->store;
        $inventory->product_id      = $request->product;
        $inventory->price           = $request->price;
        $inventory->internal_price  = $request->internalprice;
        $inventory->discount        =$request->discount;
        $inventory->discount_type   =$request->discount_type;
        $inventory->save();

               $stock= \App\Inventory::updateOrCreate([
                            'inventory_entry_id' =>$request->eid,
                            
                        ],[
                            'status'=>'available',
                            'added_by'      => 'admin',
                            'created_by'    => Auth::user()->id,
                        ]);
                $finalqty=($stock->stock-$qty)+$request->quantity;
                $stock->stock = $finalqty;
                $stock->weight = $request->weight;
                $stock->store_id = $request->store;
                $stock->product_id = $request->product;
                $stock->unit = $request->unit;
                $stock->sub_category_id = $request->subcategory;
                $stock->category_id = $request->category;
                $stock->price = $request->price;
                $stock->internal_price = $request->internalprice;
                $stock->discount =$request->discount;
                $stock->discount_type =$request->discount_type;
                $stock->save();

         return redirect()->route('inventory.index')->with('message','Inventory successfully updated.');
        
   }
   
    public function getStock(Request $request)
    {
        
         $products = \App\Inventory::with('unit')->where(['category_id'=>$request->category_id,'sub_category_id'=>$request->subcategory,'product_id'=>$request->product,'store_id'=>$request->store])->get();
         $stockList=array();
         foreach ($products as $key => $value) {
           array_push($stockList, $value);
         }
         echo json_encode(['status'=>true,'result'=>$stockList]);
    }
  public function getProductByCategory(Request $request)
    {
        $subcategory = $request->subcategory;
        $category = $request->category;
        $products = \App\Product::where(['category_id'=>$category,'sub_category_id'=>$subcategory,'IsActive'=>1])->get();
        $htm = '';    
        // $htm .= '<select class="form-control select2" name="product[]">'; 
        $htm .= '<option value="" selected="" disabled="">Select Product</option>';
        foreach ($products as $key => $value) {
            $htm .= "<option value=".$value->id.">".$value->name."</option>";
        }
        echo json_encode(['status'=>true,'result'=>$htm]);
     
    }
	
	public function getCatgoryByStore(Request $request){
		//getCategoryName($user['checkcategory'])
		$cat_id = \App\StoreCategoryMaping::where(['store_id'=>$request->store_id])->get();
        $cate_arry=array();
	     foreach($cat_id as $key=>$val)
	      {
	       $cate_arry[$key]=$val->category_id;
	      }
		$category = \App\Category::whereIn('id', $cate_arry)->get()->toArray();
         
		$htm = '';    
        $htm .= '<option value="" selected="" disabled="">Select Category</option>';
        foreach ($category as $key => $value) {
		$htm .= "<option value=".$value['id'].">".$value['name']."</option>";
        } 
		
        return json_encode(['status'=>true,'result'=>$htm]);
		
	}
	
    public function getSubcategory(Request $request)
    {
        $category_id = $request->category_id;
        $products = \App\Category::where(['parent_id'=>$category_id,'IsActive'=>1])->get();
        $htm = '';    
        $htm .= '<option value="" selected="" disabled="">Select Subcategory</option>';
        foreach ($products as $key => $value) {
            $htm .= "<option value=".$value->id.">".$value->name."</option>";
        }
        echo json_encode(['status'=>true,'result'=>$htm]);
      
    }

    public function saveInventory(Request $request)
    {
        $store = $request->store;
        $category = $request->category;
        $subcategory = $request->subcategory;
        $product = $request->product;
        $qty = $request->quantity;
        $weight = $request->weight;
        $unit = $request->unit;
        $quantity = $request->quantity;
        $price = $request->price;
        $internalprice = $request->internalprice;
        $discount = $request->discount;
        $discount_type = $request->discount_type;
        $stock_id = $request->stock_id;
       //dd($request->all());
        \DB::beginTransaction();
        try {
            foreach ($weight as $key => $value) {
                if($weight[$key]!='')
                {
                   echo $price[$key];
                   if($quantity[$key]!='')
                   {
                        $ids= \App\InventoryEntry::create([
                        'product_id'      =>$product,
                        'store_id'        =>$store,
                        'category_id'     =>$category,
                        'sub_category_id' =>$subcategory,
                        'qty'             =>$quantity[$key],
                        'weight'          =>$weight[$key],
                        'unit'            =>$unit[$key],
                        'price'           =>$price[$key],
                        'internal_price'  =>$internalprice[$key],
                        'discount'        =>$discount[$key],
                        'discount_type'   =>$discount_type[$key],
                        'status'          =>'add',
                        'added_by'        => 'admin',
                        'created_by'      => Auth::user()->id,
                      ]);
                        if($stock_id[$key]=='')
                        {
                            $Inventory= \App\Inventory::updateOrCreate([
                            'inventory_entry_id' =>$ids->id,
                                
                            ],[
                                'status'=>'available',
                                'added_by'      => 'admin',
                                'created_by'    => Auth::user()->id,
                            ]);

                            $Inventory->stock = $Inventory->stock +$quantity[$key];
                            $Inventory->weight = $weight[$key];
                            $Inventory->store_id = $store;
                            $Inventory->product_id = $product;
                            $Inventory->unit = $unit[$key];
                            $Inventory->sub_category_id = $subcategory;
                            $Inventory->category_id = $category;
                            $Inventory->price = $price[$key];
                            $Inventory->internal_price = $internalprice[$key];
                            $Inventory->discount =$discount[$key];
                            $Inventory->discount_type =$discount_type[$key];
                            $Inventory->save();    
                        }
                        else
                        {
                             $Inventory= \App\Inventory::findOrFail($stock_id[$key]);
                            $Inventory->stock = $Inventory->stock +$quantity[$key];
                            $Inventory->price = $price[$key];
                            $Inventory->internal_price = $internalprice[$key];
                            $Inventory->discount =$discount[$key];
                            $Inventory->discount_type =$discount_type[$key];
                            $Inventory->save();
                        }
                         
                   }
                   else
                   {
                        if($stock_id[$key])
                         {
                            $Inventory= \App\Inventory::findOrFail($stock_id[$key]);
                            $Inventory->price = $price[$key];
                            $Inventory->internal_price = $internalprice[$key];
                            $Inventory->discount =$discount[$key];
                            $Inventory->discount_type =$discount_type[$key];
                            $Inventory->save();
                        } 
                   }
                 
                
                
               }
               
            }
            
           \DB::commit();
            // all good
        } catch (\Exception $e) {
           \DB::rollback();
            // something went wrong
        }
       
     return redirect()->route('inventory.index')->with('message','Inventory successfully added.');
        

    }
    public function uploadProduct(Request $request){
       
      $filename='language_'.time();
      $image = $request->file('file');
      $input['imagename'] = $filename.'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/product_csv/');
      $image->move($destinationPath, $input['imagename']);
      $img=$input['imagename'];
      $destinationPath = $destinationPath.$img;
      $csv_file = $destinationPath;
      $store_id=$request->store_id;
      $flag = true;
       if (($handle = fopen($csv_file, "r")) !== FALSE) {
         \DB::beginTransaction();
        try {
             while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
               if($flag) { $flag = false; continue; }
                $num = count($data);
                $productname=$data[0];
                $category=$data[1];
                $subcategory=$data[2];
                $weight=explode(',',$data[3]);
                $unit=explode(',',$data[4]);
                $stock=explode(',',$data[5]);
                $price=explode(',',$data[6]);
                $internalprice=explode(',',$data[7]);
                $discount=explode(',',$data[8]);
                $discount_type=explode(',',$data[9]);
                $product = \App\Product::where('name',$productname)->value('id');
                  $category_id = \App\Category::where('name',$category)->value('id');
                  $sub_category_id = \App\Category::where('name',$subcategory)->value('id');
                  foreach ($weight as $key => $value) 
                  {
                     $unit_id = \App\Unit::where('name',$unit[$key])->value('id');
                       $ids= \App\InventoryEntry::create([
                        'product_id'      =>$product,
                        'store_id'        =>$store_id,
                        'category_id'     =>$category_id,
                        'sub_category_id' =>$sub_category_id,
                        'qty'             =>$stock[$key],
                        'weight'          =>$weight[$key],
                        'unit'            =>$unit_id,
                        'price'           =>$price[$key],
                        'internal_price'  =>$internalprice[$key],
                        'discount'        =>$discount[$key],
                        'discount_type'   =>$discount_type[$key],
                        'status'          =>'add',
                        'added_by'        => 'admin',
                        'created_by'      => Auth::user()->id,
                      ]);
                         $Inventory= \App\Inventory::updateOrCreate([
                            'inventory_entry_id' =>$ids->id,
                                
                            ],[
                                'status'=>'available',
                                'added_by'      => 'admin',
                                'created_by'    => Auth::user()->id,
                            ]);

                            $Inventory->stock = $Inventory->stock +$stock[$key];
                            $Inventory->weight = $weight[$key];
                            $Inventory->store_id = $store_id;
                            $Inventory->product_id = $product;
                            $Inventory->unit = $unit_id;
                            $Inventory->sub_category_id = $sub_category_id;
                            $Inventory->category_id = $category_id;
                            $Inventory->price = $price[$key];
                            $Inventory->internal_price = $internalprice[$key];
                            $Inventory->discount =$discount[$key];
                            $Inventory->discount_type =$discount_type[$key];
                            $Inventory->save();  
                        }

            }
         \DB::commit();
            // all good
        } catch (\Exception $e) {
           \DB::rollback();
            // something went wrong
        }
        fclose($handle);
        return redirect()->route('inventory.index')->with('message','Inventory successfully added.'); 
        }
  
    }

    public function changeStoreStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $store = \App\Store::findOrFail($id);
        $store->IsActive = $status;
        if($status){
            $message = 'Store successfully Active';
        } else {
             $message = 'Store successfully Deactive';
        }
        $flag = $store->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }


    public function file_format(Request $request){
     $header = array('name','category','subcategory','weight(comma seprated for multiple unit)','unit(comma seprated for multiple unit)','stock(comma seprated for multiple unit)','price(comma seprated for multiple unit)','internal price(comma seprated for multiple unit)','discount(comma seprated for multiple unit)','discount type(0=No Discount,1=Flat,2=Percentage)'); 
        $products = \App\Product::where(['IsActive' => '1','category_id' => $request->downloadcategory,'sub_category_id' =>$request->downloadsubcategory])->get();
        $filename = time() . ".csv";
        ob_clean();
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $fh = fopen('php://output', 'w');
        $heading = false;
        fputcsv($fh,$header);
        foreach ($products as $key => $value) {
          $categoryname=singledata('tbl_category','id',$value->category_id);
          $subcategoryname=singledata('tbl_category','id',$value->sub_category_id);
          $st=array();
          $st[]=$value->name;
          $st[]=$categoryname->name;
          $st[]=$subcategoryname->name;
          $st[]='';
          $st[]='';
          $st[]='';
          $st[]='';
          $st[]='';
          $st[]='';
          $st[]='';
          fputcsv($fh,array_values($st));
        }
        fclose($fh);
      
    }



   
}
