<?php
namespace App\Http\Controllers;
// use JWTAuth;
use JWTAuthException;
use Tymon\JWTAuth\Facades\JWTAuth; 
use App\User;
use App\Student;
use App\Device_Detail;
use App\Subscription;
use App\SchoolVendorMapping;
use App\StoreCategoryMaping;
use App\KitchenFood;
use App\Notification;
use App\OrderDetail;
use App\Banner;
use App\Category;
use App\Address;
use App\Offer;
use App\Order;
use App\Store;
use App\School;
use App\Plan;
use App\StaticPages;
use App\Referral;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
include('send_notification.php');

class AuthController extends Controller
{
     public function __construct()
    {
        // $this->middleware('auth.jwt', ['except' => ['login','phoneNumberVerification']]);
    }
    private $api_key = 'APA91bEacXF96n2qYk8IhHbGT4ZUc12uOtBcT6jgorKrdionryG8W1D6q';
    
    public function checkAPIKey($key) 
    {
        if($this->api_key === $key){
          return true;
        }else{
            return false;
        }
    }

    public function saveAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_address'=>'required|max:120',
            'location'=>'required',
            'address_type'=>'required',
        ]);

        if ($validator->fails()) {
        return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        // return response()->json($request->location['latitude']);
         $userId = $this->getUserId();
         $address = new \App\Address(); 
         $address->user_id = $userId;
         
         if(isset($request->full_address)){
             $address->full_address = $request->full_address;
         }

         if(isset($request->home_block_flat)){
            $address->home_block_flat = $request->home_block_flat;
         }

         if(isset($request->landmark)){
            $address->landmark = $request->landmark;
         }


         if(isset($request->area)){
            $address->area = $request->area;
         }

         if(isset($request->city)){
            $address->city = $request->city;
         }

         if(isset($request->state)){
             $address->state = $request->state;
         }

          if(isset($request->country)){
             $address->country = $request->country;
         }
          if(isset($request->pincode)){
            $address->pincode = $request->pincode;
         }
          if(isset($request->address_type)){
             $address->address_type = $request->address_type;
         }
          if(isset($request->location)){
             $address->latitude = $request->location['latitude'];
            $address->longitude = $request->location['longitude'];
         }
         
         $address->save();
       
         // remove all default address
          Address::query()->update(['IsDefault' => 0]);

          //set default address
           $setdefault =Address::find($address->id);
           $setdefault->IsDefault=1;
           $flag=$setdefault->save();
           $addressList = \App\Address::where('user_id',$userId)->orderBy('IsDefault','DESC')->get();
           if($flag) {
            return response()->json($this->sResponse('Address save successfully',$addressList));
            // return redirect()->route('customer.index')->with('message','Customer Created successfully.');

        }else{
            return response()->json($this->fResponse('Action Failed Please try again',null));
            // return redirect()->route('customer.index')->with('message','Action Failed Please try again.');
        }
    }

    public function saveRatting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'=>'required|max:120',
            'ratting'=>'required',
        ]);

        if ($validator->fails()) {
        return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        // return response()->json($request->location['latitude']);
         $userId = $this->getUserId();
         $ratting = new \App\Ratting();
         $order = \App\Order::where('id', $request->order_id)->first();
         // $ratting->user_id = $userId;
         
         // if(isset($request->ratting)){
         //     $ratting->ratting = $request->ratting;
         // }
         // $ratting->store_id = $order->store_id;
         // $ratting->order_id = $request->order_id;
         
          $flag = \App\Ratting::updateOrCreate([
              'user_id'             =>$userId,
              'store_id'             =>$request->order_id,
              'order_id'             =>$order->store_id
            ],['ratting'      => $request->ratting]);

          // $flag = $ratting->save();
          \App\Order::where('id', $request->order_id)->update(['placedRatting'=>1]);
          // $rattingList = new \App\Ratting(); 
          $get_order_history= $this->get_order_history($userId);
        if($flag) {
            return response()->json($this->sResponse('Ratting save successfully',$get_order_history));
            // return redirect()->route('customer.index')->with('message','Customer Created successfully.');

        }else{
            return response()->json($this->fResponse('Action Failed Please try again',null));
            // return redirect()->route('customer.index')->with('message','Action Failed Please try again.');
        }
    }
    public function updateAddress(Request $request)
    {
        // return response()->json($request->all());
        $validator = Validator::make($request->all(), [
            'id'=>'required',
            'full_address'=>'required|max:120',
            'location'=>'required',
            'address_type'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }

        try{
         
            // return response()->json($request->location['latitude']);
            $userId = $this->getUserId();
                
             $address = \App\Address::findOrFail($request->id); 
             //$address->user_id = $userId;
             if(isset($request->full_address)){
                 $address->full_address = $request->full_address;
             }

             if(isset($request->home_block_flat)){
                $address->home_block_flat = $request->home_block_flat;
             }

             if(isset($request->landmark)){
                $address->landmark = $request->landmark;
             }


             if(isset($request->area)){
                $address->area = $request->area;
             }

             if(isset($request->city)){
                $address->city = $request->city;
             }

             if(isset($request->state)){
                 $address->state = $request->state;
             }

              if(isset($request->country)){
                 $address->country = $request->country;
             }
              if(isset($request->pincode)){
                $address->pincode = $request->pincode;
             }
              if(isset($request->address_type)){
                 $address->address_type = $request->address_type;
             }
             if(isset($request->location)){
                 $address->latitude = $request->location['latitude'];
                $address->longitude = $request->location['longitude'];
             }
             
           
             $flag = $address->save();
            $address = \App\Address::where('user_id',$userId)->orderBy('IsDefault','DESC')->get();
            if($flag) {
                return response()->json($this->sResponse('Address update successfully',$address));
            }else{
                return response()->json($this->fResponse('Action Failed Please try again',null));
            }

        } catch (ModelNotFoundException $ex) {  
           return response()->json($this->fResponse('Action Failed Please try again',null));
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        }
    }

    public function deleteAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'=>'required'
        ]);

        if ($validator->fails()) {
            return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        // return response()->json($request->location['latitude']);
        try{
            $userId = $this->getUserId();
            $address = \App\Address::findOrFail($request->id); 
            $flag = $address->delete();
            $address = \App\Address::where('user_id',$userId)->orderBy('IsDefault','DESC')->get();
            if($flag) {
              if(count($address)>0)
              {
                return response()->json($this->sResponse('Address delete successfully',$address));
              }else
              {
               return response()->json($this->sResponse('Address delete successfully',null)); 
              }
            }else{
                return response()->json($this->fResponse('Action Failed Please try again',null));
            }
        } catch (ModelNotFoundException $ex) {  
           return response()->json($this->fResponse('Action Failed Please try again',null));
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        } 
    }
    public function getAddress()
    {
            $userId = $this->getUserId();
            $address = \App\Address::where('user_id',$userId)->orderBy('IsDefault','DESC')->get();
            if(count($address)>0)
            {
              return response()->json($this->sResponse('Address List',$address));
            }else
            {
              return response()->json($this->sResponse('Address List',null));
            }
       
    }

    public function setDefaultAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'=>'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        // return response()->json($request->location['latitude']);
         try{
            $userId = $this->getUserId();
            
            \App\Address::where('user_id',$userId)->update(['IsDefault'=>0]); 
            $address = \App\Address::findOrFail($request->id);
            $address->IsDefault = 1;
            $flag = $address->save();
            $address = \App\Address::where('user_id',$userId)->orderBy('IsDefault','DESC')->get();
            if($flag) {
                return response()->json($this->sResponse('Address update successfully',$address));
            }else{
                return response()->json($this->fResponse('Action Failed Please try again',null));
            }
        } catch (ModelNotFoundException $ex) {  
           return response()->json($this->fResponse('Address not found',null));
          // return response()->json(['set_attributes'=>['order_placed'=>"FALSE" ,'message'=>"modal not found"]]); 
        } 
    }

    public function demo(){ 
      $item_type = 'store';
      $item_id = 2;
      $sub_category_id = 3;
      $store_id =6;
      $inventories  = \App\Inventory::with(['product','store','unit_detail'])->whereHas('product',function($query) use ($sub_category_id){
            // $query->where('start_order_time', '<', $time);
            $query->where('sub_category_id', $sub_category_id);
        })->where(['IsActive'=>1,'store_id'=>$store_id])->get()->groupBy(['store_id','product_id']);
      // dd($inventories);
      // if($item_type === 'product'){
      //       $inventories  = \App\Inventory::with(['product','store','unit_detail'])->where(['IsActive'=>1,'product_id'=>$item_id])->get()->groupBy(['store_id','product_id']);
      //   }

      //   if($item_type === 'store'){
      //        $inventories  = \App\Inventory::with(['product','store','unit_detail'])->where(['IsActive'=>1,'store_id'=>$item_id])->get()->groupBy(['store_id','product_id']);
      //   }

      //   if($item_type === 'category'){
      //       $ids = \App\Product::where(['IsActive'=>1,'category_id'=>$item_id])->get()->pluck('id');
      //       $inventories  = \App\Inventory::with(['product','store'])->whereIn('product_id',$ids)->get()->groupBy(['store_id','product_id']);
      //   }

      $product_list = [];
      $store = [];
      $ids = [];
      $i = 0;
      $j = 0;
        $product = [];
      foreach ($inventories as $key => $store) {
        foreach ($store as $key => $value) {
          $product_list['name'] = $value[0]->product->name;
          if($i === 0){
            $store = $value[0]->store->toArray();
            if($value[0]->store->image){
                $store['image'] = URL('public/assets/img/store/'.$value[0]->store->storelogo);
            }
          }
          if($value[0]->product->profile_pic){
              $product_list['item_image'] = URL('public/assets/img/product/'.$value[0]->product->profile_pic);
          }
          
          $attr = [];
          foreach ($value as $k => $productValue) {
            $discount = 0;
            $payable_amount = $productValue->price;
            if($productValue->discount_type == 1){ //flat
              $payable_amount = (int) ($productValue->price - $productValue->discount);
            }
            if($productValue->discount_type == 2){ //percentage
              $d_amount = (int)(($productValue->price * $productValue->discount)/100);
              $payable_amount =  (int)($productValue->price - $d_amount);
            }
            $price[] = ['amount'=>(int)$productValue->price,'payable_amount'=>$payable_amount];
            $unit[] = ['weight'=>$productValue->weight,'unit_name'=>$productValue->unit_detail->name];
            $ids[] = $productValue->id;
            $attr[] = ['id'=>$productValue->id,'weight'=>$productValue->weight.' '.$productValue->unit_detail->name,'amount'=>(int)$productValue->price,'payable_amount'=>$payable_amount,'discount'=>$productValue->discount, 'discount_type'=>$productValue->discount_type];
          }
          $product_list['attribute'] = $attr;
          $temp_product[$i] = $product_list;
          print_r($product_list);
          
          $i++;
        }
        // // add store
        // $i = 0;
        // $product[$j]['store'] = $store;
        // $product[$j]['store']['product_detail'] = $temp_product;
        // $j++;

      }
      // $product['store'] = $store;
      // $product['product_detail'] = $product_list;
      dd($product);


      $inventories  = \App\Inventory::with(['product','store','unit_detail'])->where(['IsActive'=>1,'store_id'=>1])->get()->groupBy('product_id');
      $product_list = [];
      $store = [];
      $i = 0;

      foreach ($inventories as $key => $value) {
        $product_list[$i]['name'] = $value[0]->product->name;
        if($i === 0){
          $store = $value[0]->store->toArray();
          if($value[0]->store->image){
              $store['image'] = URL('public/assets/img/store/'.$value[0]->store->storelogo);
          }
        }
        if($value[0]->product->profile_pic){
            $product_list[$i]['item_image'] = URL('public/assets/img/product/'.$value[0]->product->profile_pic);
        }
        
        $price = [];
        $unit = [];
        foreach ($value as $k => $productValue) {
          $discount = 0;
          $payable_amount = $productValue->price;
          if($productValue->discount_type == 1){ //flat
            $payable_amount = (int) ($productValue->price - $productValue->discount);
          }
          if($productValue->discount_type == 2){ //percentage
            $d_amount = (int)(($productValue->price * $productValue->discount)/100);
            $payable_amount =  (int)($productValue->price - $d_amount);
          }
          $price[] = ['amount'=>(int)$productValue->price,'payable_amount'=>$payable_amount];
          $unit[] = ['weight'=>$productValue->weight,'unit_name'=>$productValue->unit_detail->name];
        }
        $product_list[$i]['price'] = $price;
        $product_list[$i]['unit'] = $unit;
        // $product_list[$i]['discount'] = [];
        $i++;
      }
      $product['store'] = $store;
      $product['product_detail'] = $product_list;
      dd($product);
      dd($inventories);


        $store_id = 2;
        $sub_category_id = 'all';
        $store = \App\Store::findOrFail($store_id);
        $ids = \App\Inventory::where(['store_id'=>$store_id,'IsActive'=>1])->get()->pluck('product_id');

        // dd($ids);
        if($sub_category_id !== 'all')
        $condition['sub_category_id'] = $sub_category_id; 
        $condition['IsActive'] = 1; 
        $results = \App\Product::with(['sub_category_list'])->whereIn('id',$ids)->where($condition)->get();
        // dd($results);
         $products =[];
         $index = 0;
        foreach ($results as $key => $value) {
            // $products = \App\Inventory::where(['category_id'=>$value->category_id])->get()->toArray();
            $products[$index]['id']  = $value->sub_category_list->id;
            $products[$index]['name']  = $value->sub_category_list->name;
            $products[$index]['image']  = URL('public/assets/img/category/'.$value->sub_category_list->image);
            $index++;
        }
        $data['id'] = $store->id;
        $data['name'] = $store->name;
        $data['distance']  = 50;
        $data['ratting']  = $store->ratting;
        $data['city']  = $store->city;
        $data['image']  = URL('public/assets/img/store/'.$store->storelogo);
        $data['products'] = $products;
        dd($data);   
        // echo $this->distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";
        // echo (int)$this->distance(23.3027707, 77.4042243, 23.1842854, 77.41767469999999, "K") . " Kilometers<br>";
        // echo $this->distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";
    }

    public function distance($lat1, $lon1, $lat2, $lon2, $unit) {
        if (($lat1 == $lat2) && ($lon1 == $lon2)) {
            return 0;
        } else {
            $theta = $lon1 - $lon2;
            $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            $unit = strtoupper($unit);

            if ($unit == "K") {
            return ($miles * 1.609344);
            } else if ($unit == "N") {
            return ($miles * 0.8684);
            } else {
            return $miles;
            }
        }
    }

    public function createImage($img)
    {
        $image = $img;  // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'user-'.time().'.'.'png';
        \File::put('public/student/' . $imageName, base64_decode($image));
        return $imageName;
    }

    public function search(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'search' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'messageId'=>203,
            'message'=>'Invalid Parameter',
            'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             $response = array(
            'success'=>false,
            'messageId'=>400,
            'message'=>'Invalid Request',
            );
             return response()->json($response);
        }
          $web_setting = \App\Websitesetting::first();
          $products  = \App\Product::select('id','name','profile_pic')
                    ->where('name','LIKE','%'.$request->search.'%')
                    ->where(['IsActive'=>1])->get();

             foreach ($products as $key => $product)
             {
                $inventorylist = \App\Inventory::select('id','store_id')->where('product_id',$product->id)->groupBy('product_id')->get();
                foreach ($inventorylist as  $inventory) {
                  $productstores  =Store::select('latitude','longitude')->where('id',$inventory->store_id)->where(['IsActive'=>1])->get();
                  
                   foreach ($productstores as $store)
                   {
                      $distance = (int) $this->distance($store->latitude, $store->longitude, $request->latitude, $request->longitude, "K");
                      if($web_setting->near_by_distance >$distance)
                      {
                         $product->type = 'product';
                         $product->image =URL('public/assets/img/product/'.$product->profile_pic);
                         unset($product->profile_pic);
                         $results[] = $product;
                         
                      }
                   }
                  
                }  
            }
            
          //array_unique($results);
          $stores  =Store::select('id','name','ratting','latitude','longitude','storelogo')->where('name','LIKE','%'.$request->search.'%')->where(['IsActive'=>1])->get();
        foreach ($stores as $key => $store){
           $distance = (int) $this->distance($store->latitude, $store->longitude, $request->latitude, $request->longitude, "K");
            if($web_setting->near_by_distance >$distance){
               $store->type = 'store';
               $store->image =URL('public/assets/img/store/'.$store->storelogo);;
               $store->distance = $distance;
               $results[] = $store;
            }
           
        }
        $response = array(
            'success'=>true,
            'messageId'=>200,
            'message'=>'Category List',
            'data'=>$results,
            );
             return response()->json($response);
        // echo "string";
    }

    public function searchResult(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'item_id' => 'required',
            'item_type' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'device_id' => 'required',
            
        ]);
        // try {
        //     // attempt to verify the credentials and create a token for the user
        //     $token = JWTAuth::getToken();
        //     $apy = JWTAuth::getPayload($token)->toArray();
        //     $userId =  $apy['sub'];
        //     $isLogin = true;
        // } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
        //     $isLogin = false;
        //     // return response()->json(['token_expired'], 500);
        // } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
        //     $isLogin = false;
        //     // return response()->json(['token_invalid'], 500);
        // } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
        //     $isLogin = false;
        //     // return response()->json(['token_absent' => $e->getMessage()], 500);
        // }

        // $data['isLogin'] = $isLogin;
        // return response()->json($data);
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
            return response()->json($this->fResponse('Invalid api key.',[]));
        }
        $res=\App\Customer::where('device_id',$request->device_id)->get()->toArray();
       if(empty($res))
        {
          $results['store'] = "";
          return response()->json($this->sResponse('Item List',$results)); 
        }
        $userId = $res[0]['id'];
        $data = $request->all();
        // if($isLogin){
        //     $data['isLogin'] = $isLogin;  
           
        // }
         $this->saveSearchHistory(['item_id'=>$request->item_id,'item_type'=>$request->item_type,'user_id'=>$userId]); 
        $results = [];
        $inventories = [];
        $item_type = $request->item_type;
        $item_id = $request->item_id;
        if($item_type === 'product'){
            $inventories  = \App\Inventory::with(['product','store','unit_detail'])->where(['IsActive'=>1,'product_id'=>$item_id])->get()->groupBy(['store_id','product_id']);
        }

        if($item_type === 'store'){
             $inventories  = \App\Inventory::with(['product','store','unit_detail'])->where(['IsActive'=>1,'store_id'=>$item_id])->get()->groupBy(['store_id','product_id']);
        }

        if($item_type === 'category'){
            $ids = \App\Product::where(['IsActive'=>1,'category_id'=>$item_id])->get()->pluck('id');
            $inventories  = \App\Inventory::with(['product','store'])->whereIn('product_id',$ids)->get()->groupBy(['store_id','product_id']);
        }
        if($item_type === 'subcategory'){
            $ids = \App\Product::where(['IsActive'=>1,'sub_category_id'=>$item_id])->get()->pluck('id');
            $inventories  = \App\Inventory::with(['product','store'])->whereIn('product_id',$ids)->get()->groupBy(['store_id','product_id']);
        }

      $product_list = [];
      $store = [];
      $temp_product =array();
      $ids = [];
      $i = 0;
      $j = 0;
      $web_setting = \App\Websitesetting::first();
      foreach ($inventories as $key => $store) {
         $store1 =array();
         $temp_data =array();
        foreach ($store as $key => $value) {

           $distance = (int) $this->distance($value[0]->store->latitude, $value[0]->store->longitude, $request->latitude, $request->longitude, "K");
            if($web_setting->near_by_distance >$distance)
            {
            
              $product_list['name'] = $value[0]->product->name;
              $store1['name']= $value[0]->product->name;
               
              //array_push($temp_data, $value[0]->product->name);
               if($i === 0){
                $store = $value[0]->store->toArray();
                $temp_data['id']=$value[0]->store->id;
                $temp_data['name']=$value[0]->store->name;
                $temp_data['distance']=$distance;
                $temp_data['ratting']=$value[0]->store->ratting;
                $temp_data['city']=$value[0]->store->city;
                if($value[0]->store->storelogo){
                   $temp_data['storeLogo']= URL('public/assets/img/store/'.$value[0]->store->storelogo);
                }
              }
              if($value[0]->product->profile_pic){
                  $store1['item_image'] = URL('public/assets/img/product/'.$value[0]->product->profile_pic);
                  unset($value[0]->product->profile_pic);
              }
              $attr = [];
              foreach ($value as $k => $productValue) {
                $discount = 0;
                $payable_amount = $productValue->price;
                if($productValue->discount_type == 1){ //flat
                  $payable_amount = ($productValue->price - $productValue->discount);
                }
                if($productValue->discount_type == 2){ //percentage
                  $d_amount = (($productValue->price * $productValue->discount)/100);
                  $payable_amount =  ($productValue->price - $d_amount);
                }
                $price[] = ['amount'=>$productValue->price,'payable_amount'=>$payable_amount];
                $unit[] = ['weight'=>$productValue->weight,'unit_name'=>$productValue->unit_detail->name];
                $ids[] = $productValue->id;
                $selected = false;
                if($k === 0){
                  $selected = true;
                }
                $attr[] = ['id'=>$productValue->id,'weight'=>$productValue->weight.' '.$productValue->unit_detail->name,'amount'=>$productValue->price,'payable_amount'=>$payable_amount,'discount'=>$productValue->discount, 'discount_type'=>$productValue->discount_type,'selectedItems'=>0,'selected'=>$selected];
              }
               $store1['attribute']=$attr;
               $temp_data['productdetail']=array($store1);
             
              //$temp_product[$i][] = $product_list;
          
              $i++;
          // add store
          $i = 0;
          
          array_push($temp_product, $temp_data);
          //$results[$j]['store']['product_detail'] = $temp_product;
          $j++;
         }

        }
        
   
      }
      $results['store'] = $temp_product;
      return response()->json($this->sResponse('Item List',$results));
    }

    public function saveSearchHistory($request){
        $history  = \App\History::updateOrCreate([
            'user_id'=>$request['user_id'],
            'item_id'=>$request['item_id'],
            'item_type'=>$request['item_type']
        ],[]);
        if($history){
            return ['status'=>true];
        }else{
            return ['status'=>false];
        }
    }

    public function addToCart(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'product_id' => 'required',
            'qty' => 'required',
            'type' => 'required',
            'device_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->sResponse('Invalid Parameter',$validator->errors()));
        }
        $res=singledata('tbl_customer','device_id',$request->device_id);
        $userId = $res->id;
        $inventory = \App\Inventory::where('id',$request->product_id)->first();
        if(empty($inventory))
        {
         return response()->json($this->sResponse('No any product found.',$validator->errors())); 
        }
        $cart = \App\Cart::where('user_id',$userId)->first();
        if($cart){
            // cart exist
            $cartCount = \App\CartDetail::where(['cart_id'=>$cart->id,'status'=>1])->count();
            // check same store or not
            if($cartCount){
                if($inventory->store_id !== $cart->store_id){
                  $response = $this->getCartDetail($userId);
                   $cart = $response['data'];
                    return response()->json($this->sResponse('You added other store item. Please clear your cart',$cart,201));
                }
            }else{
                // update store
                \App\Cart::where('user_id',$userId)->update(['store_id'=>$inventory->store_id,'status'=>1]); 
            }
        }else{
            // cart created
            $cart = \App\Cart::create(['user_id' =>  $userId,'store_id'=>$inventory->store_id,'status'=>1]);
        }
        $cart = \App\Cart::where(['user_id' =>  $userId])->first();
        if($request->qty){
               $cart = \App\CartDetail::updateOrCreate([
                'cart_id' =>  $cart->id,
                'inventory_id' =>  $request->product_id,
                'product_id' =>  $inventory->product_id,
                'store_id' =>  $inventory->store_id,
                'status' =>  1
            ],['qty' =>  $request->qty]); 
        }else{
             
            $cart = \App\CartDetail::where([
                'cart_id' =>  $cart->id,
                'inventory_id' =>  $request->product_id,
                'product_id' =>  $inventory->product_id,
                'store_id' =>  $inventory->store_id,
                'status' =>  1
            ])->delete();    
        }
       
        $response = $this->getCartDetail($userId);
        $msg = "Item remove successfully";
        if($request->type == 'add'){
            $msg = "Item added successfully";
        }

        // print_r($response['status']);
        // dd();
        if(!$response['status']){
            return response()->json($this->sResponse($msg,null));
        }
         if(count($response['data']['cart_detail'])>0)
          {
              $cart = $response['data'];
              return response()->json($this->sResponse($msg,$cart));
          }
          else
          {
             $cartremove = \App\Cart::where(['user_id'=>$userId,'status'=>1])->first();
              $cartremove->delete();
             return response()->json($this->sResponse($msg,null));
          }

        // $cart = $response['data'];
        
        // return response()->json($this->sResponse($msg,$cart));

    }
    public function cartDetail(Request $request){
        //$userId = $this->getUserId();
       $validator = Validator::make($request->all(), [
            'api_key' => 'required', 
            'device_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Api Key.',[]));
        }
        $res=singledata('tbl_customer','device_id',$request->device_id);
        if(empty($res))
        {
          return response()->json($this->sResponse('Cart Empty',null)); 
        }
        $response = $this->getCartDetail($res->id);
        if(!$response['status']){
            return response()->json($this->sResponse('Cart Empty',null));
        }

        if(count($response['data']['cart_detail'])>0)
        {
            $cart = $response['data'];
            return response()->json($this->sResponse('Cart detail',$cart));
        }
        else
        {
           return response()->json($this->sResponse('Cart detail',null));
        }
        
        
    }
    public function getCartDetail($userId){
        $cart = \App\Cart::with(['cart_detail'=>function($query){
            $query->where('status', 1);
        },'cart_detail.product','cart_detail.inventory.unit_detail','store'])->where(['user_id' =>  $userId])->first();
        //return response()->json($this->sResponse('Cart detail',$cart));
        // return ['status'=>true,'data'=>$cart];
        if(!empty($cart['cart_detail'])){
            $totalAmount = 0;
            $totalPaybleAmount = 0;
            $itemCount = 0;
            $cartDetail = [];
            
            $cartDetail['id'] = $cart->id;
            $cartDetail['store_id'] = $cart->store_id;
            $cartDetail['store_detail'] = $cart->store;

            if(count($cart->cart_detail)>0)
            {  
              foreach ($cart->cart_detail as $key => $value) {
                $itemCount += $value->qty;
                $payble_price = $value->inventory->price;
                if($value->inventory->discount_type == 1){
                    // flat discount
                    $payble_price = ($value->qty * ($value->inventory->price -$value->inventory->discount));
                }
                if($value->inventory->discount_type == 2){
                    // per discount
                    $payble_price = ($value->qty * ($value->inventory->price - (($value->inventory->price*$value->inventory->discount)/100)));
                }

                $totalAmount += $value->qty*$value->inventory->price;
                $totalPaybleAmount += $payble_price;
                
                $cartDetail['cart_detail'][$key]['id'] = $value->id;
                $cartDetail['cart_detail'][$key]['qty'] = $value->qty;
                $cartDetail['cart_detail'][$key]['product_id'] = $value->product_id;
                $cartDetail['cart_detail'][$key]['inventory_id'] = $value->inventory_id;
                $cartDetail['cart_detail'][$key]['product_name'] = $value->product->name;
                $cartDetail['cart_detail'][$key]['unit'] = $value->inventory->weight.''.$value->inventory->unit_detail->name;
                if($value->product->profile_pic){

                    $cartDetail['cart_detail'][$key]['product_image'] = URL('public/assets/img/product/'.$value->product->profile_pic);
                }
                $cartDetail['cart_detail'][$key]['price'] = $value->inventory->price;
                $cartDetail['cart_detail'][$key]['total_price'] = $value->qty*$value->inventory->price;
                $cartDetail['cart_detail'][$key]['payble_price'] = $payble_price;
                $cartDetail['cart_detail'][$key]['discount'] = $value->inventory->discount;
                $cartDetail['cart_detail'][$key]['discount_type'] =$value->inventory->discount_type;
               }
             }
             else
             {
               $cartDetail['cart_detail']=array();
             }
            // $cart = \App\Product::user()->products->sum('price');;
             $discountamount=0;
             $coupon_id='';
             if($cart->status==1)
             {

               if($cart->coupon_id!='')
               {
                  $coupon_id=$cart->coupon_id;
                   $offers=Offer::where('coupon',$cart->coupon_id)->first();
                 if($offers['discount_amount']==1)
                  {
                    $finalamountpay=$totalPaybleAmount-$offers['discount_amount']; 
                    $discountamount=$offers['discount_amount']; 
                    $type='Rs';
                  }
                  else
                  {
                    $amt=$totalPaybleAmount*$offers['discount_amount']/100;
                    if($amt>$offers['max_amount'])
                    {
                       $finalamountpay=$totalPaybleAmount-$offers['max_amount']; 
                       $discountamount=$offers['max_amount'];
                    }
                    else{
                         $finalamountpay=$totalPaybleAmount-$amt; 
                         $discountamount=$amt;
                    }
                   
                    $type='%';
                  }

                   $offerdata['paybleAmount']=$totalPaybleAmount;
                   $offerdata['afterdiscount']=($totalPaybleAmount-$discountamount);
                   $offerdata['discountamount']=$discountamount;
                   $offerdata['coupon']=$coupon_id;
                   $offerdata['type']=$type;
               }
             }
            
               

            $web_setting = \App\Websitesetting::first();
            $cartDetail['shipping_charge'] = $web_setting->shpping_charge;
            $cartDetail['totalItem'] = $itemCount;
            $cartDetail['totalAmount'] = $totalAmount;
            $cartDetail['before_coupon'] =$totalPaybleAmount;
            $cartDetail['coupon_discount'] =$discountamount;
            $cartDetail['paybleAmount'] = ($totalPaybleAmount-$discountamount);
            if(empty($offerdata))
            {
              $cartDetail['couponData'] =null;
            }
            else
            {
              $cartDetail['couponData'] =$offerdata;
            }
            
            return ['status'=>true,'data'=>$cartDetail];
        }
        return ['status'=>false];
    }

    public function getOfferAmount($coupon)
    {

    }

    public function place_order(Request $request){
      // $validator = Validator::make($request->all(), [
      //       'delivery_type' => 'required', 
      //   ]);
      //   if ($validator->fails()) {
      //      return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
      //   }
        $userId = $this->getUserId();
        try{
            $response = $this->getCartDetail($userId);
            if(!$response['status']){
                 return response()->json($this->fResponse('Cart Empty',[]));
            }
            $cartDetail = $response['data'];
            $offer_amount =0;
            $offer_id= '';
            if($request->offer_id){
                $offer_id =$request->offer_id; 
            }
            // return response()->json($this->sResponse('Order placed Successfully',$cartDetail));
            $delivery_type=$request->delivery_type;
            $web_setting = \App\Websitesetting::first();
            $orderId='AMG'.getRandomNumber();
            $orderData = [
                'user_id'=>$userId,
                'store_id'=>$cartDetail['store_id'],
                'order_id'=>$orderId,
                'offer_id'=>$offer_id,
                'offer_amount'=>$offer_amount,
                'order_amount'=>$cartDetail['totalAmount'],
                'delivery_type'=>$delivery_type,
                'payable_amount'=>$cartDetail['paybleAmount']+$web_setting->shpping_charge,
                'order_detail'=>json_encode($cartDetail),
                'orderdatetime'=>date('Y-m-d H:i:s'),
            ];
            $order = \App\Order::create($orderData);

            $order_id = $order->id;
            $ordercount=0;
            foreach ($cartDetail['cart_detail'] as $key => $value) {
                $discount_amount = $value['price'] - $value['payble_price'];
                $tempData = [
                    'order_id'        =>$order_id,
                    'store_id'        =>$cartDetail['store_id'],
                    'product_id'      =>$value['product_id'],
                    'qty'             =>$value['qty'],
                    'amount'          =>$value['price'],
                    'discount_amount' =>$discount_amount,
                    'payable_amount'  =>$value['payble_price'],
                ];
                // $value['inventory_id'];
                $product = \App\Product::where('id',$value['product_id'])->first();
                if($product->category_id){
                  $category = \App\Category::where('id',$product->category_id)->first();
                  \App\Category::where('id',$product->category_id)->update(['sell_count'=>$category->sell_count+1]);
                }
                
                $inventory = \App\Inventory::where('id',$value['inventory_id'])->first();
                \App\Inventory::where('id',$value['inventory_id'])->update(['stock'=>($inventory->stock-$value['qty'])]);
                // $order = \App\OrderDetail::create($tempData);
                $order = \App\OrderDetail::create($tempData);
                $order_detail[] = $tempData;
                $ordercount++;
            }

            $store = \App\Store::where('id',$cartDetail['store_id'])->first();

            //get all delivery boy of this store
            
            $useraddress= \App\Address::select('latitude','longitude','full_address','pincode')->where(['user_id'=>$userId,'IsDefault'=>1])->first();
             $userList = \App\User::where(['CreatedBy'=>$store->user_id,'zipcode'=>$useraddress['pincode'],'user_type'=>37])->where('IsAvailable','!=',0)->get();
              if(count($userList)>0)
              {
                $availableUser=array();
                $busyUser=array();
                foreach ($userList as $key => $value) {
                  if($value->IsAvailable==1)
                  {
                    array_push($availableUser, $value->id);
                  }else
                  {
                    array_push($busyUser, $value->id);
                  }
                }
                if(count($availableUser)>0)
                {
                  \App\Order::where('order_id', $orderId)->update(['assign_to'=>$availableUser[0]]);
                   // send push notification

                  // get device token  
                   $device = Device_Detail::where('user_id',$availableUser[0])->first();
                    if(!empty($device))
                    {
                       $arrNotification["body"] ="Your have got new order with order id : ".$orderId;
                       $arrNotification["title"] = "New Order";
                       $arrNotification["sound"] = "default";
                       sendPushNotification($arrNotification,$device->device_token,'Android');
                       
                    }

                        $notificationdata['sent_to']=$availableUser[0];
                        $notificationdata['noti_type']="New Order";
                        $notificationdata['message']="Your have got new order with order id : ".$orderId;
                        $this->saveNotification($notificationdata);
                }
                else
                {
                  if(count($busyUser)>0)
                  {
                     \App\Order::where('order_id', $orderId)->update(['assign_to'=>$busyUser[0]]);
                  // send push notification

                 // get device token  
                  $device = Device_Detail::where('user_id',$busyUser[0])->first();
                  if(!empty($device))
                  {
                     $arrNotification["body"] ="Your have got new order with order id : ".$orderId;
                     $arrNotification["title"] = "New Order";
                     $arrNotification["sound"] = "default";
                     sendPushNotification($arrNotification,$device->device_token,'Android');
                        
                  } 

                        $notificationdata['sent_to']=$busyUser[0];
                        $notificationdata['noti_type']="New Order";
                        $notificationdata['message']="Your have got new order with order id : ".$orderId;
                        $this->saveNotification($notificationdata); 
                  }
                }
              }
              else
              {
                //get all delivery boy of amigos
                  $userList = \App\User::where(['CreatedBy'=>1,'zipcode'=>$useraddress['pincode'],'user_type'=>37])->where('IsAvailable','!=',0)->get();
                  $availableUser=array();
                  $busyUser=array();
                  
                  foreach ($userList as $key => $value) {
                    if($value->IsAvailable==1)
                    {
                      array_push($availableUser, $value->id);
                    }else
                    {
                      array_push($busyUser, $value->id);
                    }
                  }
                if(count($availableUser)>0)
                {
                  \App\Order::where('order_id', $orderId)->update(['assign_to'=>$availableUser[0]]);
                   // send push notification

                  // get device token  
                  $device = Device_Detail::where('user_id',$availableUser[0])->first();
                    if(!empty($device))
                    {
                       $arrNotification["body"] ="Your have got new order with order id : ".$orderId;
                       $arrNotification["title"] = "New Order";
                       $arrNotification["sound"] = "default";
                       sendPushNotification($arrNotification,$device->device_token,'Android');
                       
                    }

                        $notificationdata['sent_to']=$availableUser[0];
                        $notificationdata['noti_type']="New Order";
                        $notificationdata['message']="Your have got new order with order id : ".$orderId;
                        $this->saveNotification($notificationdata);
                }
                else
                {
                  if(count($busyUser)>0)
                  {
                     \App\Order::where('order_id', $orderId)->update(['assign_to'=>$busyUser[0]]);
                  // send push notification

                // get device token  
                  $device = Device_Detail::where('user_id',$busyUser[0])->first();
                  if(!empty($device))
                  {
                     $arrNotification["body"] ="Your have got new order with order id : ".$orderId;
                     $arrNotification["title"] = "New Order";
                     $arrNotification["sound"] = "default";
                     sendPushNotification($arrNotification,$device->device_token,'Android');
                       
                  } 

                        $notificationdata['sent_to']=$busyUser[0];
                        $notificationdata['noti_type']="New Order";
                        $notificationdata['message']="Your have got new order with order id : ".$orderId;
                        $this->saveNotification($notificationdata); 
                  }
                 
                }
              }
            $flag = \App\Cart::where('id',$cartDetail['id'])->update(['status'=>0,'coupon_id'=>'']);
            $flag = \App\Store::where('id',$cartDetail['store_id'])->update(['sell_count'=>($store->sell_count + 1)]);
           $flag =  \App\CartDetail::where('cart_id',$cartDetail['id'])->update(['status'=>2]);
           
            if($flag ){
              $startTime = date("Y-m-d H:i:s");
              $sub_date = date('h:i a',strtotime('+5 hour +30 minutes +1 seconds',strtotime($startTime)));

                $orderdata['id']=$order_id;
                $orderdata['orderid']=$orderId;
                $orderdata['orderstatus']="Pending";
                $orderdata['store']=$store->name;
                $orderdata['totalamount']=$cartDetail['paybleAmount']+$web_setting->shpping_charge;
                $orderdata['totalorder']=$ordercount;
                $orderdata['whatsapp']=$store->mobile_number;
                $orderdata['mobile']=$store->mobile_number;
                $orderdata['ordertime']=$sub_date;
                $orderdata['useraddress']=array('address'=>$useraddress['full_address'],'latitude'=>$useraddress['latitude'],'longitude'=>$useraddress['longitude']);
                $orderdata['storeaddress']=array('address'=>$store->address,'latitude'=>$store->latitude,'longitude'=>$store->longitude);
                // send push notification

                // get device token send notification to user   
                $device = Device_Detail::where('user_id',$userId)->first();
                if(!empty($device))
                {
                   $arrNotification["body"] ="Your order has been placed successfully! ".$orderId;
                   $arrNotification["title"] = "Order Placed (#".$orderId.")";
                   $arrNotification["sound"] = "default";
                   sendPushNotification($arrNotification,$device->device_token,'Android');
                        
                 }

                        $notificationdata['sent_to']=$userId;
                        $notificationdata['noti_type']="Order Placed (#".$orderId.")";
                        $notificationdata['message']="Your order has been placed successfully! ";
                        $this->saveNotification($notificationdata);

                // get device token send notification to vendor   
                 
              $vebdordevice = Device_Detail::where('user_id',$store->user_id)->first();
                if(!empty($vebdordevice))
                {
                   $arrNotification["body"] ="You have recive new order with order id : ".$orderId;
                   $arrNotification["title"] = "New Order";
                   $arrNotification["sound"] = "default";
                   sendPushNotification($arrNotification,$vebdordevice->device_token,'Android');
                        
                }
                // get vendor id

                        $notificationdata['sent_to']=$store->user_id;
                        $notificationdata['noti_type']="New Order";
                        $notificationdata['message']="You have recive new order with order id : ".$orderId;
                        $this->saveNotification($notificationdata);
               

              return response()->json($this->sResponse('Order placed Successfully',$orderdata));
            }else{
              return response()->json($this->fResponse('Order could not placed',[]));  
            }
            
        }catch (ModelNotFoundException $ex) {  
          $response = array(
                    'success'=>false,
                    'messageId'=>203,
                    'message'=>'Item not found! please try again',
                ); 
        } 
        return response()->json($response);
    }

    public function fResponse($message,$payload=[])
    {
        $data=[];
        $data['messageId']=203;
        $data['success']=false;
        $data['message']=$message;
        $data['data']=$payload;
        return $data;
    }
    public function sResponse($message,$payload=[],$messageId=200)
    {
        $data=[];
        $data['messageId']=$messageId;
        $data['success']=true;
        $data['message']=$message;
        $data['data']=$payload;
        return $data;
    }
    public function removeCartItem(Request $request){

       $validator = Validator::make($request->all(), [
            'api_key' => 'required', 
            'device_id' => 'required',
            'cart_detail_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Api Key.',[]));
        }
        $res=singledata('tbl_customer','device_id',$request->device_id);
        $userId = $res->id;
        try{
            $cart = \App\CartDetail::where('id',$request->cart_detail_id)->first();
            $flag = $cart->delete();
            if($flag){
                $response = $this->getCartDetail($userId);
                if(!$response['status']){
                  \App\Cart::where(['user_id'=>$userId,'status'=>1])->update(['coupon_id'=>'']);
                    return response()->json($this->sResponse('Cart Empty',null));
                }
                 if(count($response['data']['cart_detail'])>0)
                  {
                      $cart = $response['data'];
                      return response()->json($this->sResponse('Item remove successfully',$cart));
                  }
                  else
                  {
                    $cartremove = \App\Cart::where(['user_id'=>$userId,'status'=>1])->first();
                    $cartremove->delete();
                     return response()->json($this->sResponse('Cart detail',null));
                  }
                // $cart = $response['data'];
                // return response()->json($this->sResponse('Item remove successfully',$cart));
            }else{
                return response()->json($this->fResponse('Unabled to delete! please try again',[]));
            }
        }catch (ModelNotFoundException $ex) {   
          return response()->json($this->fResponse('Item not found! please try again',[]));
        } 
    }
    public function getSearchHistory(){
        $userId = $this->getUserId();
        $histories  = \App\History::with(['product','store','category'])->whereHas('store',function($query){
            $query->whereNull('deleted_at');
            $query->where('IsAvailable',1);
            })->where('user_id',$userId)->orderBy('id','DESC')->limit(10)->get();
        $results= [];
        foreach ($histories as $key => $value) {
            $trmpArr = [];
            $trmpArr['id'] = $value->id;
            $trmpArr['item_id'] = $value->item_id;
            $trmpArr['item_type'] = $value->item_type;
           
            if($value->item_type === 'store'){
                $trmpArr['name'] = $value->store->name;
                $trmpArr['image'] = URL('public/assets/img/store/'.$value->store->storelogo);  
            }
             if($value->item_type === 'category'){
                $trmpArr['name'] = $value->category->name;
                if($value->category->image){
                    $trmpArr['image'] = URL('public/assets/img/category/'.$value->category->image);
                }
            }
            if($value->item_type === 'product'){
                $trmpArr['name'] = $value->product->name;
                if($value->product->profile_pic){
                $trmpArr['image'] = URL('public/assets/img/product/'.$value->product->profile_pic);
                }
            }
            $results[] = $trmpArr;
        }
        return response()->json($this->sResponse('History List',$results));
    }

    public function searchHistory(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
          return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Request',[]));
        }
        $categories  = \App\Category::select('id','name','image')->where(['IsActive'=>1,'parent_id'=>0])->get();
        foreach ($categories as $key => $category){
            $category->image = URL('public/assets/img/category/'.$category->image);
            $results[] = $category;
        }
        return response()->json($this->sResponse('Category List',$results));
    }

    public function getCategoryAroundYou(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) {
          return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Request',[]));
        }
        $categories  = \App\Category::select('id','name','image')->where(['IsActive'=>1])->where('parent_id','!=',0)->get();
        foreach ($categories as $key => $category){
            $category->image = URL('public/assets/img/category/'.$category->image);
            $category->type = 'subcategory';
            $results[] = $category;
        }
        return response()->json($this->sResponse('Category List',$results));
        // echo "string";
    }
    public function getStoreAroundYou(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
            return response()->json($this->fResponse('Invalid Request',[]));
        }
        $web_setting = \App\Websitesetting::first();
        $stores  = \App\Store::select('id','name','image','storelogo','latitude','longitude')->where(['IsActive'=>1])->where('IsAvailable',1)->whereNull('deleted_at')->get();
        $results = [];
        foreach ($stores as $key => $store){
            $distance = (int) $this->distance($store->latitude, $store->longitude, $request->latitude, $request->longitude, "K");
            if($web_setting->near_by_distance >$distance){
                $store->image = URL('public/assets/img/store/'.$store->storelogo);
                unset($store->storelogo);
                $store->type  = 'store';
                $store->distance  = $distance;
                $results[] = $store;
            }
        }
        return response()->json($this->sResponse('Store List',$results));
        // echo "string";
    }

    public function getOffer(Request $request){
      // ->where('last_order_time', '>', $time)
        $validator = Validator::make($request->all(), [
             'api_key' => 'required',
             'latitude' => 'required',
             'longitude' => 'required'
        ]);
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key',[]));
        }
          $web_setting = \App\Websitesetting::first();
          $offerlist=array();
          $todayDate=date('Y-m-d');
          $offerList=Offer::select('id','coupon','coupon_type','coupon_type','discount_type','discount_amount','description','min_amount','max_amount','store_ids','description','image')->whereDate('to_date', '>=', $todayDate)->get();

         foreach ($offerList as $key => $offer) {
            if($offer->discount_type==1)
            {
              $offer->discount_type='Rs';
            }else{
              $offer->discount_type='%';
             }
            $offer->image=URL('public/assets/img/offer/'.$offer->image);
            $store_array=array();
          if($offer->coupon_type==1)
          {
             
             $storeIds=explode(',', $offer->store_ids);

             foreach ($storeIds as $key => $value) {
              //$store_id = $value;
              $store = \App\Store::select('id','name','storelogo','longitude','latitude','city','ratting')->where('id',$value)->where('IsAvailable',1)->whereNull('deleted_at')->first();
              if(!empty($store))
              {
                $distance = (int) $this->distance($store->latitude, $store->longitude, $request->latitude, $request->longitude, "K");
                if($web_setting->near_by_distance >$distance)
                {
                  $store->storelogo = URL('public/assets/img/store/'.$store->storelogo);
                  $store->distance= $distance;
                  array_push($store_array, $store);  
                }
                
              }
              
              }
               unset($offer['store_ids']);
              
          }
        
           if($offer->coupon_type==1)
            {
              $offer->coupon_type='Store';
            }else
            {
              $offer->coupon_type='Offer'; 
            }
          $offer->storelist=$store_array;
          array_push($offerlist, $offer);  
        }
        $results['offerlist']=$offerlist;
       return response()->json($this->sResponse('Offer List',$offerlist));
       
    }

    public function getCategories(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',

        ]);
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Request',[]));
        }
        $categories  = \App\Category::select('id','name','image','banner_image')->where(['IsActive'=>1,'parent_id'=>0])->get();
        foreach ($categories as $key => $category){
            $category->image = URL('public/assets/img/category/'.$category->image);
            if($category->banner_image){
              $category->banner_image = URL('public/assets/img/category/'.$category->banner_image);
            }
            $results[] = $category;
        }
        return response()->json($this->sResponse('Category List',$results));
    }

    public function getSubCategories(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Request',[]));
        }
        $categories  = \App\Category::select('id','name','image')->where(['IsActive'=>1,'parent_id'=>$request->category_id])->get();
        foreach ($categories as $key => $category){
            $category->image = URL('public/assets/img/category/'.$category->image);
            $results[] = $category;
        }
        return response()->json($this->sResponse('Sub Category List',$results));
        // echo "string";
    }

    public function getStoreByCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'category_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Request',[]));
        }
        $web_setting = \App\Websitesetting::first();
        $category_id = $request->category_id;
        $category = \App\Category::findOrFail($category_id);
        $results = \App\Inventory::with(['product','store'])->whereHas('product',function($query) use ($category_id){
            $query->where('category_id', '=', $category_id);
        })->whereHas('store',function($query){
            $query->whereNull('deleted_at');
            $query->where('IsAvailable',1);
            })->where(['IsActive'=>1])->groupBy('store_id')->get();
         $stores =array();
         $i=0;
        foreach ($results as $key => $value) {
            // $value->image = URL('public/assets/img/store/'.$value->store->image);

           $distance = (int) $this->distance($value->store->latitude, $value->store->longitude, $request->latitude, $request->longitude, "K");
                 if($web_setting->near_by_distance >$distance)
                 {
                    $stores[$i]['id']  = $value->store->id;
                    $stores[$i]['name']  = $value->store->name;
                    $stores[$i]['distance']  = $distance;
                    $stores[$i]['ratting']  = $value->store->ratting;
                    $stores[$i]['city']  = $value->store->city;
                    $stores[$i]['image']  = URL('public/assets/img/store/'.$value->store->storelogo);
                   $i++; 
                 }
                    
        }

        $data['id'] = $category_id;
        $data['name'] = $category->name;
        if($category->banner_image){
            $data['banner_image'] = URL('public/assets/img/category/'.$category->banner_image);
        }
        $data['stores'] =$stores;
        return response()->json($this->sResponse('Store List',$data));
        // echo "string";
    }


    public function getCategoryByStore(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'store_id' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Request',[]));
        }

        $store_id = $request->store_id;
         $store = \App\Store::where('id',$store_id)->first();
        if(empty($store))
        {
         return response()->json($this->fResponse('Invalid Store Id',[])); 
        }
        $ids = \App\Inventory::where(['store_id'=>$store_id,'IsActive'=>1])->get()->pluck('product_id');

        $results = \App\Product::with(['sub_category_list','unit_list'])->whereIn('id',$ids)->groupBy('sub_category_id')->get();
        // dd($results);
         $categories =[];
         $index = 0;
          $web_setting = \App\Websitesetting::first();
        foreach ($results as $key => $value) {
            // $products = \App\Inventory::where(['category_id'=>$value->category_id])->get()->toArray();
            $categories[$index]['id']  = $value->sub_category_list->id;
            $categories[$index]['name']  = $value->sub_category_list->name;
            $categories[$index]['image']  = URL('public/assets/img/category/'.$value->sub_category_list->image);
            $index++;
        }
        $distance = (int) $this->distance($store->latitude, $store->longitude, $request->latitude, $request->longitude, "K");
        if($web_setting->near_by_distance >$distance)
          {
                  $data['id'] = $store->id;
                  $data['name'] = $store->name;
                  $data['distance']  = $distance;
                  $data['ratting']  = $store->ratting;
                  $data['city']  = $store->city;
                  $data['image']  = URL('public/assets/img/store/'.$store->storelogo);
                  $data['categories'] = $categories;
          } 
        return response()->json($this->sResponse('Store List',$data));
        // echo "string";
    }

    public function getSubcategoryByCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'store_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Request',[]));
        }

        $store_id = $request->store_id;
        $store = \App\Store::where('id',$store_id)->first();
        if(empty($store))
        {
         return response()->json($this->fResponse('Invalid Store Id',[])); 
        }
        $ids = \App\Inventory::where(['store_id'=>$store_id,'IsActive'=>1])->get()->pluck('product_id');

        $results = \App\Product::with(['sub_category_list','unit_list'])->whereIn('id',$ids)->where('sub_category_id',$request->category_id)->groupBy('sub_category_id')->get();
        return response()->json($results);
         $categories =[];
         $index = 0;

        foreach ($results as $key => $value) {
            // $products = \App\Inventory::where(['category_id'=>$value->category_id])->get()->toArray();
            if($value->sub_category_list){
              $categories[$index]['id']  = $value->sub_category_list->id;
              $categories[$index]['name']  = $value->sub_category_list->name;
              $categories[$index]['image']  = URL('public/assets/img/category/'.$value->sub_category_list->image);
              $index++;
            }
        }
        $distance = (int) $this->distance($store->latitude, $store->longitude, $request->latitude, $request->longitude, "K");
        $data['id'] = $store->id;
        $data['name'] = $store->name;
        $data['distance']  = $distance;
        $data['ratting']  = $store->ratting;
        $data['city']  = $store->city;
        $data['image']  = URL('public/assets/img/store/'.$store->storelogo);
        $data['sub_categories'] = $categories;
        return response()->json($this->sResponse('Store List',$data));
        // echo "string";
    }
    
    public function getProductByCategory(Request $request){
        $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'store_id' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Request',[]));
        }

        $store_id = $request->store_id;
        $sub_category_id = $request->category_id;
        // $store = \App\Store::findOrFail($store_id);

        $ids = \App\Inventory::where(['store_id'=>$store_id,'IsActive'=>1])->get()->pluck('product_id');

        $inventories  = \App\Inventory::with(['product','store','unit_detail'])->whereHas('product',function($query) use ($sub_category_id){
            // $query->where('start_order_time', '<', $time);
          if($sub_category_id!='all')
          {
            $query->where('sub_category_id', $sub_category_id);
          }
        })->whereHas('store',function($query){
            
          $query->whereNull('deleted_at');
          $query->where('IsAvailable',1);
         
        })->where(['IsActive'=>1,'store_id'=>$store_id])->get()->groupBy(['product_id']);

      $product_list = [];
      $temp_product = [];
      $store = [];
      $ids = [];
      $i = 0;
      $j = 0;

      // foreach ($inventories as $key => $store) {
        foreach ($inventories as $key => $value) {
          $product_list['name'] = $value[0]->product->name;
          if($i === 0){
            $store = $value[0]->store->toArray();
            if($value[0]->store->storelogo){
                $store['image'] = URL('public/assets/img/store/'.$value[0]->store->storelogo);
            }
          }
          if($value[0]->product->profile_pic){
              $product_list['item_image'] = URL('public/assets/img/product/'.$value[0]->product->profile_pic);
          }
          
          $attr = [];
          foreach ($value as $k => $productValue) {
            $discount = 0;
            $payable_amount = $productValue->price;
            if($productValue->discount_type == 1){ //flat
              $payable_amount = ($productValue->price - $productValue->discount);
            }
            if($productValue->discount_type == 2){ //percentage
              $d_amount = (($productValue->price * $productValue->discount)/100);
              $payable_amount =  ($productValue->price - $d_amount);
            }
            $price[] = ['amount'=>$productValue->price,'payable_amount'=>$payable_amount];
            $unit[] = ['weight'=>$productValue->weight,'unit_name'=>$productValue->unit_detail->name];
            $ids[] = $productValue->id;

            $selected = false;
            if($k === 0){
              $selected = true;
            }

            $attr[] = ['id'=>$productValue->id,'weight'=>$productValue->weight.' '.$productValue->unit_detail->name,'amount'=>$productValue->price,'payable_amount'=>$payable_amount,'discount'=>$productValue->discount, 'discount_type'=>$productValue->discount_type,'selectedItems'=>0,'selected'=>$selected];
          }
          $product_list['attribute'] = $attr;
          $temp_product[$i] = $product_list;
          
          $i++;
        }
        // add store
        $i = 0;
        $results['store'] = $store;
        $results['product_detail'] = $temp_product;
        $j++;

        return response()->json($this->sResponse('Store List',$results));
        // echo "string";
    }

    public function logout(Request $request)
        {      
            try {
               JWTAuth::invalidate(JWTAuth::getToken());
                return response()->json([
                    'status' => "success",           
                    'message' => 'User logged out successfully',
                    'messageId' => 200,
              
                ]);
            } catch (JWTException $exception) {
                return response()->json([
                    'status' => "failure",
                    'message' => 'Sorry, the user cannot be logged out',
                    'messageId' => 203,
                ]);
            }
    }

    public function getUserId(){
        try {
            // attempt to verify the credentials and create a token for the user
            $token = JWTAuth::getToken();
            $apy = JWTAuth::getPayload($token)->toArray();
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], 500);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent' => $e->getMessage()], 500);
        }
        // $token  = JWTAuth::getToken();
        // $apy    = JWTAuth::getPayload($token)->toArray();
        // return $apy;
        return $apy['sub'];
    }

    public function update_profile(Request $request){
        $userId = $this->getUserId();
        $customer = \App\Customer::findOrFail($userId);
        $customer->name = $customer->name;
        $web_setting = \App\Websitesetting::first();
        $comman = new CommanController();
        $payment = new PaymentController();
        if($request->name){
            $customer->name = $request->name;
        }
        if($request->profile_pic){
            $file_name = $this->createImage($request->profile_pic);
            $customer->profile_pic = $file_name;
        } 
        if($request->email){
            $customer->email = $request->email;
        }
         
        if($request->last_name){
            $customer->last_name  = $request->last_name;
        }
        $customer->user_reg_status   = 'OLD';         
        $schools = $customer->save();

        if($request->device_type && $request->device_token)
         {
            $device = Device_Detail::where('user_id',$customer->id)->first();

            if($device)
            {
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            } else {
                $device = new Device_Detail();
                $device->user_id = $customer->id;
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            }
         }

        $customer = \App\Customer::leftjoin('device_detail','device_detail.user_id','=','tbl_customer.id')
                      ->select('tbl_customer.*','device_detail.device_type', 'device_detail.device_token')
                      ->where('tbl_customer.id',$userId)->first();
               
        if($schools){
            return response()->json([
                "status"=> true,
                "messageId"=> 200,
                "message"=> "User Profile Update Successfully",
                "data"=>$customer,
            ]); 
        }else{

            return response()->json([
                    'success' => false,
                    'messageId' => 203,
                    'data' => $customer,
                    'message' => 'Something went wrong. Please try again later',
                ]); 

        } 
    }

    public function testNotifacation(){
        // ios
        $otp = rand(1000,9999);
        $result['token'] = 'dhWLCgOXSraeYICauSML_N:APA91bEacXF96n2qYk8IhHbGT4ZUc12uOtBcT6jgorKrdionryG8W1D6qbawsEZMR07lklzsuSNl-EaJwuqW6ZabLREyQaO21RKi92qALK3eQABj_GrNCtsyYZw91vNmIRU7-Qs0nprY';
        $result['type'] = 'android';
        $message = 'Order Place successfully';
        $notification_type = 'message';
        $fcm = $this->notificationSend($result,$message);
        return $fcm;
    }

    public function sendOtp($mobile='919926331375'){
        $mobile = '91'.$mobile;
        $curl = curl_init();
        $auth_key = config('constants.auth_key');
        $template_id = config('constants.template_id');
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
          return ['status'=>fasle];
        } else {
            $arr = json_decode($response);
            if($arr->type == "success"){
               return ['status'=>true,'data'=>$arr];
            }else{
                return ['status'=>fasle];
            }
            // return response()->json($res);
        }
    } 

    public function verifyOtp($mobile ,$otp){
        // $data = $request->all();
        $mobile = '91'.$mobile;
        $curl = curl_init();
        $auth_key = config('constants.auth_key');
        $template_id = config('constants.template_id');
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
          // echo "cURL Error #:" . $err;
          return ['status'=>false];
        } else {
            $arr = json_decode($response);
            // print_r($arr->type);
            // die;
            if($arr->type == 'success'){
                return ['status'=>true];
               // $res = array('success' => true,
               //      'code' => 200,
               //      'IsData'=>false,
               //      'message' => $arr->message,
               //      );
            }else{
                return ['status'=>false];
                // $res = array('success' => false,
                //     'code' => 201,
                //     'IsData'=>false,
                //     'message' => $arr->message,
                //     );
            }
            return response()->json($res);
        }
    } 
    
    public function validateNumber($number){
        $number = str_replace(' ', '', $number);
        $ext = substr($number, 0, 1);
        $country_code = substr($number, 0, 3);
        $number = str_replace('+', '', $number);
        // $n = config('constants.NUMBER_LENGTH');
        // echo substr($number, 0, 1);
        $number_length = 8;
        $code = 45;
        if($ext == '+'){
            //
            if($country_code == '+91'){
                // echo "india";
                $number_length = 10;
                $code = 91;
            }else if($country_code == '+45'){
                // echo "denmark";
                $number_length = 8;
                $code = 45;
            }else{
                return ['status'=>false];
            }
        } else if(strlen($number) >= 10){
            $number_length = 10;
            $code = 91;
            if(substr($number, 0, 2) == 45){
                $number_length = 8;
                $code = 45;
            }
            // echo 'india';
           
        }else{
            // echo "denmark";
            $number_length = 8;
            $code = 45;
        }
        // echo strlen($number);
        // $start = strlen($number) - $number_length; 
        // $mobile_number = substr($number, $start);
        // echo ' : '.$start;
        // echo ' : '.$mobile_number;
        // return ['status'=>true,'number'=>$mobile_number,'country_code'=>$code];
        // die;
        if(strlen($number) >= 8){
            $start = strlen($number) - $number_length; 
            $mobile_number = substr($number, $start);
            return ['status'=>true,'number'=>$mobile_number,'country_code'=>$code];
        }else{
            return ['status'=>false];
        }
    }
    public function phoneNumberVerification(Request $request){
        
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'device_id' => 'required',
        ]);
         if ($validator->fails()) {
            $response = array(
            'success'=>false,
            'messageId'=>203,
            'message'=>'Invalid Parameter',
            'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        // $api = new ApiController;
        $comman = new CommanController;
        $number =$request->phone_number;
        $device_id =$request->device_id;
        $res = $comman->validateNumber($number);
        if(!$res['status']){
            $response = array(
                'status'=>false,
                'messageId'=>203,
                'message'=>'Invalid Phone Number',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        // return response()->json($res);
        $phone_number = $res['number'];
        $country_code = $res['country_code'];
        $messageFlag = $this->sendOtp($phone_number);
        // return response()->json($messageFlag);
        if($messageFlag['status']){
            //$flag = \App\Customer::where('mobile_number',$phone_number)->get()->count();
             $flag = \App\Customer::where('device_id',$device_id)->get()->count();
            if ($flag>0)
             {

               \App\Customer::where('device_id',$device_id)->update(['otp_count'=>1,'mobile_number'=>$phone_number]);
             }
            else
            {
              $flag = \App\Customer::where('mobile_number',$phone_number)->get()->count();
              if($flag>0)
              {
                 \App\Customer::where('mobile_number',$phone_number)->update(['otp_count'=>1,'device_id'=>$device_id]);
              }
              else
              {
                 $flag =\App\Customer::create([
                        'device_id'=>$device_id,
                        'mobile_number'=>$phone_number,
                        'otp_count'=>1,
                         'user_reg_status'=>"NEW"
                      ]);
              }
             

              // $flag =\App\Customer::where('mobile',$phone_number)->update(['otp_count'=>1]);
               // $flag = $this->signup(['mobile'=>$phone_number,'country_code'=>$country_code]);
                if(!$flag){
                    $response = [
                        'status'=>false,
                        'messageId'=>203,
                        'message'=>'Something went wrong. Please try again later',
                    ];
                    return response()->json($response);
                }
            }

            $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'We have sent an OTP to '.$request->phone_number,
                'data'=>[
                    'phone_number'=>$request->phone_number,
                ]
            ];
        }else{
            $response = [
                'status'=>false,
                'messageId'=>203,
                'message'=>'Something went wrong. Please try again later',
            ];
        }
        return response()->json($response);
    }


    public function otpVerification(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'otp' => 'required',
        ]);
        // $api = new ApiController;
        $comman = new CommanController;
        $number =$request->phone_number;
        $res = $comman->validateNumber($number);
        if(!$res['status']){
            $response = array(
                'status'=>false,
                'messageid'=>203,
                'message'=>'Phone Number Required',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }

        $phone_number = $res['number'];
        $country_code = $res['country_code'];
        $ress = $this->verifyOtp($phone_number,$request->otp);
        if($ress['status']){
             $user = \App\Customer::where(['mobile_number'=>$phone_number])->first();
             if($user->IsActive==0)
             {
                $response = array(
                  'status'=>false,
                  'messageid'=>203,
                  'message'=>'Your account is deactive.Please contact to site admin.',
                  'error'=>$validator->errors()
              );
              return response()->json($response);
             }
             $customClaims = ['sid' => $user->id, 'baz' => 'bob','exp' => date('Y-m-d', strtotime('+12 month', strtotime(date('Y-m-d'))))];
            $token = JWTAuth::fromUser($user, $customClaims);
            $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Your phone number verified successfully.',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user
                ]
            ];
            return response()->json($response);
            return response()->json($user);
        }else{
                    $response = array(
                    'status'=>false,
                    'message'=>'Operation failed please try again',
                    'messageId'=>203
                );
                return response()->json($response);
        }  
    }

    public function signup($user)
    {
        $user =\App\Customer::create([
            'mobile_number'=>$user['mobile'],
            // 'otp'=>$user['otp'],
            'otp_count'=>1,
            'country_code'=>$user['country_code'],
            'user_reg_status'=>"NEW"
          ]);
        if($user){
            return ['status'=>true,'data'=>$user];
        }else{
            return ['status'=>false,'data'=>[]];
        }
    }

    public function registration(Request $request)
    {
        // if(!$this->checkAPIKey($request->api_key))
        // {
        //      $response = array(
        //     'success'=>false,
        //     'code'=>400,
        //     'message'=>'Invalid Request',
        //     'results'=>[],
        //     // 'error'=>$validator->errors()
        //     );
        //      return response()->json($response);
        // }


        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'mobile_number' => 'required|unique:student',
        ]);

        if ($validator->fails()) {
            $response = array(
            'success'=>"false",
            'code'=>203,
            'message'=>'This mobile no  already registered',
            'results'=>[],
            'error'=>$validator->errors()
            );
           return response()->json($response);
        }


        $rcode = str_replace(" ","-",$request->name).'-'.rand(10,100);
        
        $student = new Student();
        $student->referral_code = $rcode;
        $student->name = $request->name;
        $student->email = $request->email;
        $student->mobile_number = $request->mobile_number;
        $student->save();

        return response()->json([
            'success'   =>  true,
            'message' => 'user register',
            'code' => 200,
            'IsData'=>true,
            'results'=>$student
        ]);
    }
    public function saveNotification($data)
    {
      $notification = Notification::create($data);   
    }
    public function notification(Request $request)
    {
        $userId = $this->getUserId();
        $notification = Notification::where('sent_to',$userId)
                        // ->join('student','student.id','=','notification.sent_by')
                        ->where('is_read',0)
                        ->select('notification.id','notification.message','notification.created_at','notification.status')->orderBy('id','DESC')
                        ->get();

         return response()->json([
            'success'   =>  true,
            'messageId'   =>  200,
            'message' => 'Notification List',
            'data'=>$notification,
            // 'user'=>$student
        ]);
    }

 // get home data
    public function getHomeData(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'latitude' => 'required',
            'longitude' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key.',[]));
        }

        $temp_data=array();

        // get banner data
        $banners=array();
        $bannerList=Banner::select('id','title','caption','secondCaption','thirdCaption','image')->where('IsActive',1)->get();
        foreach ($bannerList as $key => $banner) {
         $banner['image']= URL('public/assets/img/banner/'.$banner->image);
         array_push($banners, $banner);
        }
         $temp_data['bannerlist']=$banners;
         $web_setting = \App\Websitesetting::first();

         // get popular category data
         $categories=array();
         $subcategories=array();
         $categoryList=Category::select('id','name','banner_image','category_order','IsHomePage','image')->where(['parent_id'=>0,'IsActive'=>1,'IsHomePage'=>1])->orderBy('sell_count','DESC')->get();
         
        foreach ($categoryList as $key => $category) {

            $category_id=$category->id;
            $results = \App\Inventory::with(['product','store'])->whereHas('product',function($query) use ($category_id){
            $query->where('category_id', '=', $category_id);
            })->whereHas('store',function($query){
            $query->whereNull('deleted_at');
            $query->where('IsAvailable',1);
            })->where(['IsActive'=>1])->groupBy('store_id')->get();
            $temp_store=array();
            $stores =array();
            $i=0;
            foreach ($results as $key => $value) {
               $distance = (int) $this->distance($value->store->latitude, $value->store->longitude, $request->latitude, $request->longitude, "K");
                if($web_setting->near_by_distance >$distance)
                {
                   $stores[$i]['id']= $value->store->id;
                   $stores[$i]['name']= $value->store->name;
                   $stores[$i]['city']= $value->store->city;
                   $stores[$i]['distance']= $distance;
                   $stores[$i]['ratting']= $value->store->ratting;
                   $stores[$i]['storelogo']= URL('public/assets/img/store/'.$value->store->storelogo);
                   array_push($temp_store,$stores);
                   $i++;
                }
               
             }

         $category['image']= URL('public/assets/img/category/'.$category->image);
         $category['banner_image']= URL('public/assets/img/category/'.$category->banner_image);
          $category['storelist']=$stores;
         array_push($categories, $category);
        }
        $temp_data['categorylist']=$categories;
// get subcategory list
        foreach ($categoryList as $key => $category)
        {
          $subcategoryList=Category::select('id','name','banner_image','category_order','IsHomePage','image')->where(['parent_id'=>$category->id,'IsActive'=>1])->get();
          foreach ($subcategoryList as $key => $subcategory) 
          {
             $subcategory['image']= URL('public/assets/img/category/'.$subcategory->image);
             $subcategory['banner_image']= URL('public/assets/img/category/'.$subcategory->banner_image);
             array_push($subcategories, $subcategory);
          }
        }
        $temp_data['subcategorylist']=$subcategories;
        // get offer 
        $offers=array();
        $todayDate=date('Y-m-d');
        $offerList=Offer::select('id','coupon_type','coupon','discount_type','discount_amount','description','store_ids','image')->whereDate('to_date', '>=', $todayDate)->get();
        foreach ($offerList as $key => $offer) {
           $store_array=array();
           $storeIds=explode(',', $offer->store_ids);
           foreach ($storeIds as $key => $value) {
              //$store_id = $value;
              $store = \App\Store::select('id','name','storelogo','longitude','latitude','city')->where('id',$value)->where('IsAvailable',1)->whereNull('deleted_at')->first();
              if(!empty($store))
              {
                $store->storelogo = URL('public/assets/img/store/'.$store->storelogo);
                array_push($store_array, $store); 
              }
              
          }
            if($offer->discount_type==1)
            {
              $offer->discount_type='Rs';
            }else{
              $offer->discount_type='%';
             }
           if($offer->coupon_type==1)
            {
              $offer->coupon_type='Store';
            }else{
              $offer->coupon_type='Offer';
             }
           $offer->image=URL('public/assets/img/offer/'.$offer->image);
           unset($offer['store_ids']);
           $offer['storeList']=$store_array;
           array_push($offers, $offer);
        }
        $temp_data['offerlist']=$offers;

        // get all store 
         $results = \App\Store::select('id','name','storelogo','longitude','latitude','city','ratting')->where('IsAvailable',1)->whereNull('deleted_at')->get();
         $allstores =[];
         foreach ($results as $key => $value) {
            // $value->image = URL('public/assets/img/store/'.$value->store->image);
              $distance = (int) $this->distance($value->latitude, $value->longitude, $request->latitude, $request->longitude, "K");
              if($web_setting->near_by_distance >$distance)
              {
                 $value->storelogo = URL('public/assets/img/store/'.$value->storelogo);
                 $value->distance  = $distance;
                 array_push($allstores, $value) ;
              }
              
        }
        $temp_data['storelist']=$allstores;
        return response()->json([
            'success'   =>  true,
            'messageId'   =>  200,
            'message' => 'Home Page Data',
            'data'=>$temp_data
        ]);
    }

public function getStoreList(Request $request)
{
       $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'start' => 'required',
            'pagelength' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key.',[]));
        }
        $web_setting = \App\Websitesetting::first();
         $results = \App\Store::select('id','name','storelogo','longitude','latitude','city','ratting')->where('IsAvailable',1)->whereNull('deleted_at')->offset($request->start)->limit($request->pagelength)->get();
         $allstores =[];
         foreach ($results as $key => $value) {
            // $value->image = URL('public/assets/img/store/'.$value->store->image);
              $distance = (int) $this->distance($value->latitude, $value->longitude, $request->latitude, $request->longitude, "K");
              if($web_setting->near_by_distance >$distance)
              {
                 $value->storelogo = URL('public/assets/img/store/'.$value->storelogo);
                 $value->distance  = $distance;
                 array_push($allstores, $value) ;
              }
              
        }
        $temp_data['storelist']=$allstores;
        return response()->json([
            'success'   =>  true,
            'messageId'   =>  200,
            'message' => 'Home Page Data',
            'data'=>$temp_data
        ]);
}


// get page list
   public function getPage(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'api_key' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key.',[]));
        }

        $temp_data=array();
        $pages=array();
        $pageList=StaticPages::select('id','title','content','page_title')->where('IsActive',1)->get();
        foreach ($pageList as $key => $page) {
          $title=unserialize($page->title);
          $description=unserialize($page->content);
          $pagedetail=array();
          $pagedata=array();
          for ($i=0; $i < count($title); $i++) { 
             $pagedata[$i]['id']=$i+1;
             $pagedata[$i]['title']=$title[$i];
             $pagedata[$i]['description']=$description[$i];
          }
          $pagedetail['pagetitle']=$page->page_title;
          $pagedetail['pagedata']=$pagedata;
         array_push($pages, $pagedetail);
        }
        
        $temp_data['pagelist']=$pages;
        return response()->json([
            'success'   =>  true,
            'messageId'   =>  200,
            'message' => 'Page List',
            'data'=>$temp_data
        ]);
    }
// get order history
    public function getOrderHistory(Request $request)
    {
      $userId = $this->getUserId();
      $get_order_history= $this->get_order_history($userId);
      return response()->json([
            'success'   =>  true,
            'messageId'   =>  200,
            'message' => 'Order History',
            'data'=>$get_order_history
        ]);
    }

    public function get_order_history($userId)
    {
      
       //$userId = $this->getUserId();
        $orderlist=Order::where('user_id',$userId)->orderBy('id','DESC')->get();
        $temp_data=array();
        $useraddress= \App\Address::select('latitude','longitude','full_address')->where(['user_id'=>$userId,'IsDefault'=>1])->first();
        $recentOrder=array();
        $pastOrder=array();
       foreach ($orderlist as $key => $value) 
       {
          $orders=array();
          $items=array();
          $orders['id']=$value->id;
          $orders['order_id']=$value->order_id;
          $orders['ratting']=$value->placedRatting;
          unset($value->placedRatting);
          $detail=json_decode($value->order_detail);
          $orders['store']=$detail->store_detail->name;
          $orders['storeaddress']=array('address'=>$detail->store_detail->address,'latitude'=>$detail->store_detail->latitude,'longitude'=>$detail->store_detail->longitude);
          $orders['useraddress']=array('address'=>$useraddress['full_address'],'latitude'=>$useraddress['latitude'],'longitude'=>$useraddress['longitude']);
            $orders['status']=getOrderStatus($value->status);
            $sub_date = date(DATE_ISO8601,strtotime('+5 hour +30 minutes +1 seconds',strtotime($value->created_at)));

          $orders['date']=$sub_date;
          $orders['storelogo']=URL('public/assets/img/store/'.$detail->store_detail->storelogo);
           $orders['whatsapp']=$detail->store_detail->mobile_number;
           $orders['mobile']=$detail->store_detail->mobile_number;
          foreach ($detail->cart_detail as $keycart => $cartvalue) {
                $items[$keycart]['name']=$cartvalue->product_name;
                $items[$keycart]['qty']=$cartvalue->qty;
                $items[$keycart]['unit']=$cartvalue->unit;
                $items[$keycart]['product_image']=$cartvalue->product_image;
                $items[$keycart]['price']=$cartvalue->price;
                $items[$keycart]['total_price']=$cartvalue->total_price;
                $items[$keycart]['payble_price']=$cartvalue->payble_price;
                $items[$keycart]['discount']=$cartvalue->discount;
                if($cartvalue->discount_type==1){
                    $items[$keycart]['discount_type']='Flat';
                }else
                {
                  $items[$keycart]['discount_type']='%';
                }
                
          }

          $web_setting = \App\Websitesetting::first();
          $orders['shipping_charge'] = $web_setting->shpping_charge;
          $orders['items']=$items;
          $orders['couponData']=$detail->couponData;
          $orders['totalAmount']=$value->order_amount;
          $orders['paybleAmount']=$value->payable_amount;
          if($value->status==1 || $value->status==2 || $value->status==3)
          {
            array_push($recentOrder, $orders);
          }
          else
          {
            array_push($pastOrder, $orders); 
          }
          
          
       }
     $temp_data['activeorder']=$recentOrder;
     $temp_data['pastorder']=$pastOrder;
     return $temp_data;
       
    }

    // apply applyCoupon

    public function applyCoupon(Request $request)
    {
       $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'device_id' => 'required',
            'coupon' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
           return response()->json($this->fResponse('Invalid Api Key.',[]));
        }   
        $coupon_id=$request->coupon;
        $todayDate=date('Y-m-d');
        $offers=Offer::where('coupon',$coupon_id)->first();
        if(empty($offers))
        {
          return response()->json($this->fResponse('Invalid Coupon',[]));
        }
        
        if($todayDate<=$offers['to_date'])
        {
             $res=singledata('tbl_customer','device_id',$request->device_id);
             $cart = \App\Cart::where(['user_id' =>$res->id])->first();
             $CartDetail=$this->getCartDetail($res->id);
             $totalAmount=$CartDetail['data']['totalAmount'];
             $paybleAmount=$CartDetail['data']['paybleAmount'];
             $cart_detail=\App\CartDetail::where(['cart_id'=>$cart->id])->get();
             $offerstatus=0;
             if($offers['coupon_type']==1)
             {
                $store_ids=explode(',',$offers['store_ids']);
                foreach ($cart_detail as $key => $value) {
                  if(in_array($value->store_id, $store_ids))
                  {
                    $offerstatus=1;
                    break;
                  }
                   
                }

                if($offerstatus==0)
                {
                  return response()->json($this->fResponse('Coupon not applicable.',[]));
                }

             }
             $min_amount=$offers['min_amount'];
             $max_amount=$offers['max_amount'];
             $discountamount=0;
             $finalamountpay=0;
             $type=0;
             if(intval($paybleAmount)>=$min_amount)
             {
                if($offers['discount_amount']==1)
                {
                  $finalamountpay=$paybleAmount-$offers['discount_amount']; 
                  $discountamount=$offers['discount_amount']; 
                  $type='Rs';
                }
                else
                {
                  $amt=$paybleAmount*$offers['discount_amount']/100;
                  if($amt>$max_amount)
                  {
                   $finalamountpay=$paybleAmount-$max_amount; 
                    $discountamount=$max_amount;
                 }else{
                  $finalamountpay=$paybleAmount-$amt; 
                   $discountamount=$amt;
                 }
                   
                 
                  $type='%';
                } 
                $offerdata['paybleAmount']=$paybleAmount;
                $offerdata['afterdiscount']=$finalamountpay;
                $offerdata['discountamount']=$discountamount;
                $offerdata['coupon']=$request->coupon;
                $offerdata['type']=$type;
                $cart->coupon_id = $request->coupon;
                $cart->save();
                $offerdata['discount']=$offers['discount_amount'];
                $response = $this->getCartDetail($res->id);
                  return response()->json([
                      'success'   =>  true,
                      'messageId'   =>  200,
                      'message' => 'Coupon Details',
                      'data'=>$response['data']
                  ]);
             }
             else
             {
              return response()->json($this->fResponse('Total payable amount should be equal or greater than '.$min_amount,[]));
             }
            
           
        }
        else
        {
          return response()->json($this->fResponse('Coupon has been expired.',[]));
        }
    }

public function updateStatus(Request $request)
{
           $userId = $this->getUserId();
           $validator = Validator::make($request->all(), [
            'orderid' => 'required','status' => 'required']);
          if($validator->fails())
          {
             return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
          }

          $orders =Order::find($request->orderid);
          if(empty($orders))
          {
            return response()->json($this->fResponse('Invalid order id.',[]));
          }

          $delivery =$orders->assign_to;
          $delivery_type =$orders->delivery_type;
          $userId=$orders->user_id;
          $userinfo = User::where(['id'=>$delivery])->first();
          $orders->status = $request->status;
          $flag=$orders->save();
          if($flag) 
           {
                // send push notification
                // get device token 
            if($delivery_type=='store')
            {
                if($request->status==2)
                  {
                    $title="Order Preparing";
                    $msg="Your order is being prepared!.";
                  }else if($request->status==3)
                  {
                    $title="Order PickedUp";
                    $msg=$userinfo['name']." has picked up your order.";
                  }
                  else if($request->status==4)
                  {
                    $title="Order Canceled";
                    $msg="Your order has been canceled";
                  }
                  else if($request->status==5)
                  {
                    $title="Order Delivered";
                    $msg="Your order has been delivered successfully!.";
                  }
                  else if($request->status==6)
                  {
                     $title="Order Delayed";
                     $msg="Your order has been delayed.";
                  }

            }
            else
            {
                 if($request->status==2)
                  {
                    $title="Order Ready";
                    $msg="Your order is ready to pick-up!.";
                  }else if($request->status==3)
                  {
                    $title="Order PickedUp";
                    $msg=$userinfo['name']." has picked up your order.";
                  }
                  else if($request->status==4)
                  {
                    $title="Order Canceled";
                    $msg="Your order has been canceled";
                  }
                  else if($request->status==5)
                  {
                    $title="Order Delivered";
                    $msg="Your order has been delivered successfully!.";
                  }
            }
                  $action=getOrderStatus($request->status);
                
                $device = Device_Detail::where('user_id',$userId)->first();
                if(!empty($device))
                {
                  $action=getOrderStatus($request->status); 
                  $arrNotification["body"] =$msg;
                  $arrNotification["title"] = $title;
                  $arrNotification["sound"] = "default";
                  sendPushNotification($arrNotification,$device->device_token,'Android');
                 
                }
                  $notificationdata['sent_to']=$userId;
                  $notificationdata['noti_type']=$action;
                  $notificationdata['message']=$msg;
                  $this->saveNotification($notificationdata);
               return response()->json($this->sResponse('Order update successfully',[]));
           }
             else
             {
                return response()->json($this->fResponse('Action Failed Please try again',null));
             }
       
          
}

public function saveDeviceId(Request $request)
{
     $validator = Validator::make($request->all(), [
            'api_key' => 'required', 
            'device_id' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Api Key.',[]));
        }
         $flag = \App\Customer::where('device_id',$request->device_id)->get()->count();
         if($flag)
         {
            return response()->json([
                      'success'   =>  true,
                      'messageId'   =>  200,
                      
                  ]); 
         }
        $user =\App\Customer::create([
            'device_id'=>$request->device_id,
             'user_reg_status'=>"NEW"
          ]);
        if($user)
        {
          return response()->json([
                      'success'   =>  true,
                      'messageId'   =>  200,
                      
                  ]);
        }
        else
        {
          return response()->json([
                      'success'   =>  false,
                      'messageId'   =>  203,
                      
                  ]);
        }
}


// vendor related api


public function storeLogin(Request $request)
{
       $validator = Validator::make($request->all(), [
            'email' => 'required', 
            'password' => 'required', 
        ]);  
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Api Key.',[]));
        } 

       $pos=strpos( $request->email,'@');
       if($pos)
       {
         $user = User::where(['email'=>$request->email,'user_type'=>'20'])->whereNull('deleted_at')->where('IsActive',1)->first();
       }
       else
       {
           $user = User::where(['Phone'=>$request->email,'user_type'=>'20'])->whereNull('deleted_at')->where('IsActive',1)->first();
       }
       if(empty($user))
       {
         return response()->json($this->fResponse('Email or password is wrong.',[]));
       }
       if ((Hash::check($request->password,$user->password)) == false)
        {
               return response()->json($this->fResponse('Email or password is wrong.',[]));
        }
        if($request->device_type && $request->device_token)
         {
            $device = Device_Detail::where('user_id',$user->id)->first();

            if($device)
            {
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            } else {
                $device = new Device_Detail();
                $device->user_id = $user->id;
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            }
         }

            $web_setting = \App\Websitesetting::first();
            $store = \App\Store::select('id','name','mobile_number','city','ratting','address','latitude','longitude','plan_id','storelogo','pan_card','store_registration','aadhar_front','aadhar_back','image','aadhar_number','pan_number','registration_number','isDocumentApprove','payment_status','IsAvailable')->where('user_id',$user->id)->first();
            
            
            $store->storelogo=URL('public/assets/img/store/'.$store->storelogo);
            $store->image=URL('public/assets/img/store/'.$store->image);
            $store->pan_card=URL('public/assets/img/store/'.$store->pan_card);
            $store->store_registration=URL('public/assets/img/store/'.$store->store_registration);
            $store->aadhar_front=URL('public/assets/img/store/'.$store->aadhar_front);
            $store->aadhar_back=URL('public/assets/img/store/'.$store->aadhar_back);
            $store->sapport_no=$web_setting->sapport_no;
            $store->payment_status=$store->payment_status;
            $PlanDetail=array();
            if($store->plan_id!='' && $store->plan_id!='0')
            {
              $paymentlink = \App\Subscription::where(['plan_id'=>$store->plan_id,'store_id'=>$user->id])->first();
              $plan=array();
             $plandetail=json_decode(getPlanDetail($store->plan_id));
             $plan['id']=$plandetail->id;
             $plan['interval']=$plandetail->interval;
             $plan['period']=$plandetail->period;
             $plan['name']=$plandetail->item->name;
             $plan['amount']=$plandetail->item->amount/100;
             $plan['currency']=$plandetail->item->currency;
             $plan['payment_link']=$paymentlink->payment_link;
             $plan['subscription_id']=$paymentlink->subscription_id;
             $store->plandetail=$plan;
            }else
            {
              $store->plandetail=null; 
            }
           
            $userClaims = ['sid' => $user->id, 'baz' => 'bob','exp' => date('Y-m-d', strtotime('+12 month', strtotime(date('Y-m-d'))))];
             $token = JWTAuth::fromUser($user, $userClaims);
             $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Login successfully.',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user,
                    'store_details'=>$store
                ]
            ];
            return response()->json($response);

        
}



public function getPlan(Request $request)
 { 
       $userId = $this->getUserId();

    $planList=getPlan();
    $temdata=array();
    if($planList->items)
    {
         foreach ($planList->items as $key => $value) 
         {
           $temdata[$key]['id']=$value->id;
           $temdata[$key]['period']=$value->period;
           $temdata[$key]['interval']=$value->interval;
           $temdata[$key]['name']=$value->item->name;
           $temdata[$key]['amount']=$value->item->amount/100;
           $temdata[$key]['description']=$value->item->description;
           $temdata[$key]['currency']=$value->item->currency;
        }
    }
   return response()->json([
                      'success'   =>  true,
                      'messageId'   =>  200,
                      'message' => 'Plan List',
                      'data'=>$temdata
                  ]);
}

public function subscribePlan(Request $request)
{
        $userId = $this->getUserId();
        $checksubscription = \App\Subscription::where('store_id',$userId)->get()->toArray();
        if(empty($checksubscription))
        {

            $result=json_decode(subscriptions($request->plan_id));
           if (property_exists($result,"error"))
            {
              if($result->error)
              {
                return response()->json($this->fResponse('Invalid Plan Id ',[]));
              }
            }
            
            $plandetail=json_decode(getPlanDetail($request->plan_id));
            if (property_exists($plandetail,"error"))
            {
              if($plandetail->error)
              {
                return response()->json($this->fResponse('Invalid Plan Id ',[]));
              }
            }
           
            $amount=$plandetail->item->amount/100;
            if($plandetail->period=='yearly')
            {
              $expiry_date = date('Y-m-d H:i:s', strtotime("+12 months",$result->created_at));
            }
            else
            {
              $expiry_date = date('Y-m-d H:i:s', strtotime("+1 months",$result->created_at));
            }
          $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
          $subscription_id=$result->id;
          $paymentlink=$result->short_url;
               $subscriptionData = [
                'subscription_id'=>$result->id,
                'plan_id'=>$plandetail->id,
                'plan_type'=>$plandetail->period,
                'plan_name'=>$plandetail->item->name,
                'store_id'=>$userId,
                'expiry_date'=>$expiry_date,
                'payment_link'=>$result->short_url,
                'price'=>$amount,
                'payment_amount'=>$amount,
                'payment_date'=>date('Y-m-d H:i:s',$result->created_at),
               
            ];
            $subscription = \App\Subscription::create($subscriptionData);
            if($subscription)
              {
                \App\Store::where('user_id',$userId)->update(['plan_id'=>$plandetail->id]);
                $plan=array();
                $plan['id']=$plandetail->id;
                $plan['interval']=$plandetail->interval;
                $plan['period']=$plandetail->period;
                $plan['name']=$plandetail->item->name;
                $plan['amount']=$plandetail->item->amount/100;
                $plan['currency']=$plandetail->item->currency;
                $plan['payment_link']=$paymentlink;
                $plan['subscription_id']=$subscription_id;
                return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message' => 'Plan has been successfully subscribed.',
                            "plane_detail"=>$plan
                            
                        ]);
              }
              else
              {
                return response()->json([
                            'success'   =>  false,
                            'messageId'   =>  203,
                            'message' => 'Try again later.',
                        ]);
              }
        }
        else
        {

            return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  203,
                            'message' => 'You have already subscribe plan.',
                        ]);
        }
        
}

public function cancelSubscribePlan(Request $request)
{
     $userId = $this->getUserId();
     $validator = Validator::make($request->all(), [
            'subscription_id' => 'required', 
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        
        $result=json_decode(cancelSubscriptions($request->subscription_id));
          return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message' => $result,
                            
                        ]);
}

public function changePassword(Request $request)
{
   $userId = $this->getUserId();
   $validator = Validator::make($request->all(), [
            'oldpassword' => 'required', 
            'newpassword' => 'required', 
        ]);
     if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
   $user= User::where('id', $userId)->first();
   if ((Hash::check($request->oldpassword,$user->password)) == false)
   {
     return response()->json($this->fResponse('Old password not match.',[]));
   }
   $res=User::where('id', $userId)->update(['password' => Hash::make($request->newpassword)]);
   if($res)
   {
          return response()->json([
                              'success'   =>  true,
                              'messageId'   =>  200,
                              'message' => "Password has been change successfully.",
                              
                          ]);
   }
   else
   {
      return response()->json($this->fResponse('Please try again.',[]));
   }
}

public function getstoreDashboard(Request $request)
{
   $userId = $this->getUserId();
   $temp_data=array();
   $todaytotal=0;
   $todayitems=0; 
   $weektotal=0;
   $weekitems=0;
   $monthtotal=0;
   $monthitems=0;
   $total=0;
   $items=0;
   $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
  // today calculation
  $todayOrder=Order::where(['store_id'=>$storeId->id,'status'=>5])->whereDate('created_at','=',date('Y-m-d'))->orderBy('id','DESC')->get();
  foreach ($todayOrder as $key => $value) {
   $detail=json_decode($value->order_detail);
   $todaytotal+=$value->payable_amount;
   $todayitems+=count($detail->cart_detail);
  }
$temp_data['today']=array('totalamount'=>$todaytotal,'itemtotal'=>$todayitems);

// current week calculation
 $from_date = date('Y-m-d', strtotime('monday this week'));
 $to_date = date('Y-m-d', strtotime('sunday this week'));
 $to_date = date('Y-m-d', strtotime($to_date . ' +1 day'));
$weekOrder=Order::where(['store_id'=>$storeId->id,'status'=>5])->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','DESC')->get();
foreach ($weekOrder as $key => $value) {
   $detail=json_decode($value->order_detail);
   $weektotal+=$value->payable_amount;
   $weekitems+=count($detail->cart_detail);
  }
$temp_data['week']=array('totalamount'=>$weektotal,'itemtotal'=>$weekitems);

// current month calculation
$c_year = date("Y");
$c_month = date("m");
$dates=array();
$no_day = cal_days_in_month(CAL_GREGORIAN, $c_month, $c_year);           
for($i=1; $i<=$no_day; $i++){ 
     $dates[] .= $c_year.'-'.$c_month.'-'.$i;
}

 $from_date = reset($dates);
 $to_date = end($dates);
 $monthOrder=Order::where(['store_id'=>$storeId->id,'status'=>5])->whereBetween('created_at', [$from_date, $to_date])->orderBy('id','DESC')->get();
foreach ($monthOrder as $key => $value) {
   $detail=json_decode($value->order_detail);
   $monthtotal+=$value->payable_amount;
   $monthitems+=count($detail->cart_detail);
  }
$temp_data['month']=array('totalamount'=>$monthtotal,'itemtotal'=>$monthitems);

 $Orders=Order::where(['store_id'=>$storeId->id,'status'=>5])->orderBy('id','DESC')->get();
foreach ($Orders as $key => $value) {
   $detail=json_decode($value->order_detail);
   $total+=$value->payable_amount;
   $items+=count($detail->cart_detail);
  }
$temp_data['total']=array('totalamount'=>$monthtotal,'itemtotal'=>$monthitems);


return response()->json([ 'success'   =>  true,'messageId'   =>  200,'data'=> $temp_data]);
}

public function uploadDocument(Request $request)
{

    $userId = $this->getUserId();
    $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
     $pan='';
    $aadhar='';
    $profile='';
    $storeregistration='';
    $store = \App\Store::findOrFail($storeId->id);
    // print_r($store);
    // dd();
       $destinationPath = public_path('/assets/img/store');
       if($request->hasFile('pancard')) {
        $pancard = $request->file('pancard');

        if($pancard){
           
          if($store->pan_card!='')
          {
            unlink($destinationPath.'/'.$store->pan_card);
          }
            $input['imagename'] = uniqid().'.'.$pancard->getClientOriginalExtension();
            $fname='pancard'.$pancard->getClientOriginalName();
            $myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
             fwrite($myfile, $fname);
             fclose($myfile);
            $pancard->move($destinationPath, $input['imagename']);
            $store->pan_card = $input['imagename'];
        }
        }

         if($request->hasFile('aadharcard_front')) {
        $aadharcard_front = $request->file('aadharcard_front');
        if($aadharcard_front){
           if($store->aadhar_front!='')
            {
              unlink($destinationPath.'/'.$store->aadhar_front);
            }
            $input['imagename'] = uniqid().'.'.$aadharcard_front->getClientOriginalExtension();
             $fname='aadharcard_front'.$aadharcard_front->getClientOriginalName();
            $myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
             fwrite($myfile, $fname);
             fclose($myfile);
            $aadharcard_front->move($destinationPath, $input['imagename']);
            $store->aadhar_front = $input['imagename'];
        }
        }

        if($request->hasFile('aadharcard_back')) {
        $aadharcard_back = $request->file('aadharcard_back');
        if($aadharcard_back){
           if($store->aadhar_back!='')
            {
              unlink($destinationPath.'/'.$store->aadhar_back);
            }
            $input['imagename'] = uniqid().'.'.$aadharcard_back->getClientOriginalExtension();
              $fname='aadharcard_back'.$aadharcard_back->getClientOriginalName();
            $myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
             fwrite($myfile, $fname);
             fclose($myfile);
            $aadharcard_back->move($destinationPath, $input['imagename']);
            $store->aadhar_back = $input['imagename'];
        }
        }


         if($request->hasFile('store_registration')) {
        $store_registration = $request->file('store_registration');
        if($store_registration){
          if($store->store_registration!='')
            {
              unlink($destinationPath.'/'.$store->store_registration);
            }
            $input['imagename'] = uniqid().'.'.$store_registration->getClientOriginalExtension();
             $fname='store_registration'.$store_registration->getClientOriginalName();
            $myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
             fwrite($myfile, $fname);
             fclose($myfile);
            $store_registration->move($destinationPath, $input['imagename']);
            $store->store_registration= $input['imagename'];
        }
        }

         if($request->hasFile('profile_pic')) {
        $profile_pic = $request->file('profile_pic');
       
        if($profile_pic){
          if($store->image!='')
            {
              unlink($destinationPath.'/'.$store->image);
            }
             if($store->storelogo!='')
            {
              unlink($destinationPath.'/'.$store->storelogo);
            }
            $input['imagename'] = uniqid().'.'.$profile_pic->getClientOriginalExtension();
             $fname='profile_pic'.$profile_pic->getClientOriginalName();
             $myfile = fopen("newfile.txt", "a+") or die("Unable to open file!");
             fwrite($myfile, $fname);
             fclose($myfile);
            $profile_pic->move($destinationPath, $input['imagename']);
            $store->image = $input['imagename'];
            $store->storelogo = $input['imagename'];
        }
        }
        if($request->aadhar_number!='')
        {
          $store->aadhar_number =$request->aadhar_number;
        }
        if($request->registration_number!='')
        {
          $store->registration_number =$request->registration_number;
        }
        if($request->pan_number!='')
        {
          $store->pan_number =$request->pan_number;
        }
         $store->save();
         return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message' => "Document has been uploaded successfully.",
                            
                        ]);

}
public function getStoreOrderHistory(Request $request)
{
      $userId = $this->getUserId();
      $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
       $validator = Validator::make($request->all(), [
            'start' => 'required',
            'pagelength' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
       
        if($request->status=='all')
        {
          $orderlist=Order::where('store_id',$storeId->id)->orderBy('id','DESC')->offset($request->start)->limit($request->pagelength)->get();
        }else
        {
          $orderlist=Order::where(['store_id'=>$storeId->id,'status'=>$request->status])->orderBy('id','DESC')->offset($request->start)->limit($request->pagelength)->get(); 
        }
       
        $temp_data=array();
        $order_list=array();
      $web_setting = \App\Websitesetting::first();
       foreach ($orderlist as $key => $value) 
       {
          $orders=array();
          $items=array();
          $orders['id']=$value->id;
          $orders['order_id']=$value->order_id;
          $orders['delivery_type']=$value->delivery_type;
          $orders['ratting']=$value->placedRatting;
          unset($value->placedRatting);
          $detail=json_decode($value->order_detail);
          if($value->assign_to!="0" && $value->assign_to!="")
          {
            $username = \App\User::where('id',$value->assign_to)->first();
            $assign_to=$username->name;
            $delivery_boy_number=$username->Phone;
          }
          else
          {
            $assign_to="Not Assign Yet.";  
            $delivery_boy_number=null;
          }
          

           $useraddress= \App\Address::select('latitude','longitude','full_address')->where(['user_id'=>$value->user_id,'IsDefault'=>1])->first();
          $orders['store']=$detail->store_detail->name;
          $orders['storeaddress']=array('address'=>$detail->store_detail->address,'latitude'=>$detail->store_detail->latitude,'longitude'=>$detail->store_detail->longitude);
          $orders['useraddress']=array('address'=>$useraddress['full_address'],'latitude'=>$useraddress['latitude'],'longitude'=>$useraddress['longitude']);
            $orders['status']=getOrderStatus($value->status);
            $sub_date = date(DATE_ISO8601,strtotime('+5 hour +30 minutes +1 seconds',strtotime($value->created_at)));

          $orders['date']=$sub_date;
          $orders['assign_to']=$assign_to;
          $orders['delivery_boy_number']=$delivery_boy_number;
          $orders['amigos_number']=$web_setting->sapport_no;
          $orders['storelogo']=URL('public/assets/img/store/'.$detail->store_detail->storelogo);
          foreach ($detail->cart_detail as $keycart => $cartvalue) {
                $items[$keycart]['name']=$cartvalue->product_name;
                $items[$keycart]['qty']=$cartvalue->qty;
                $items[$keycart]['unit']=$cartvalue->unit;
                $items[$keycart]['product_image']=$cartvalue->product_image;
                $items[$keycart]['price']=$cartvalue->price;
                $items[$keycart]['total_price']=$cartvalue->total_price;
                $items[$keycart]['payble_price']=$cartvalue->payble_price;
                $items[$keycart]['discount']=$cartvalue->discount;
                if($cartvalue->discount_type==1){
                    $items[$keycart]['discount_type']='Flat';
                }else
                {
                  $items[$keycart]['discount_type']='%';
                }
                
          }
          $orders['items']=$items;
          $orders['totalAmount']=$value->order_amount;
          $orders['paybleAmount']=$value->payable_amount;
          array_push($order_list, $orders);
          
          
       }
     $temp_data['orderlist']=$order_list;
     if(!empty($order_list))
     {
              return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'data' => $temp_data,
                            
                        ]);  
    
     }
     else
     {
              return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'data' => null,
                        ]);  
    
     }
      
}


public function getStoreCategory()
{
   $userId = $this->getUserId();
   $storeId=\App\Store::where('user_id',$userId)->first();
   $categoryList=StoreCategoryMaping::where('store_id',$storeId->id)->get();
   $tempData=array();
   $i=0;
      foreach ($categoryList as $key => $category)
      {
        $subcategory_array=array();
        $subcategories=\App\Category::select('id','name')->where(['IsActive'=>1,'parent_id'=>$category->category_id])->get();
        foreach ($subcategories as $subkey => $value) {
          $tempData[$i]['id']=$value->id;
          $tempData[$i]['name']=$value->name;
          $i++;
        }

      }
         return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Subcategory List",
                            'data' => $tempData,
                            
                        ]);  
}

public function getProduct(Request $request)
{
       $validator = Validator::make($request->all(), [
           'subcategory' => 'required',
            'start' => 'required',
            'pagelength' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        

         $userId = $this->getUserId();
         $storeId=\App\Store::where('user_id',$userId)->first();
         $categoryList=StoreCategoryMaping::where('store_id',$storeId->id)->get();
         $temp_data=array();
         $i=0;
            foreach ($categoryList as $key => $category)
            {
              if($request->subcategory=='all')
              {
                  $productlist = \App\Product::select('name','id','category_id','sub_category_id','profile_pic')->where(['IsActive'=>1,'category_id'=>$category->category_id])->offset($request->start)->limit($request->pagelength)->get();
              }
              else
              {
                $productlist = \App\Product::select('name','id','category_id','sub_category_id','profile_pic')->where(['IsActive'=>1,'sub_category_id'=>$request->subcategory,'category_id'=>$category->category_id])->offset($request->start)->limit($request->pagelength)->get(); 
              }
                foreach ($productlist as $key => $value)
                {
                 $value->image= URL('public/assets/img/product/'.$value->profile_pic);
                 unset($value->profile_pic);
                 array_push($temp_data, $value);
               }

            }
        // if($request->subcategory=='all')
        // {
        //    $productlist = \App\Product::select('name','id','category_id','sub_category_id','profile_pic')->where(['IsActive'=>1])->offset($request->start)->limit($request->pagelength)->get();
        // }
        // else
        // {
        //   $productlist = \App\Product::select('name','id','category_id','sub_category_id','profile_pic')->where(['IsActive'=>1,'sub_category_id'=>$request->subcategory])->offset($request->start)->limit($request->pagelength)->get(); 
        // }
       
      
        return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Product List",
                            'data' => $temp_data,
                            
                        ]);
}
public function storeProfile(Request $request)
{
  $userId = $this->getUserId();

  $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
  $store = \App\Store::select('id','name','mobile_number','city','ratting','address','latitude','longitude','plan_id','storelogo','pan_card','store_registration','aadhar_front','aadhar_back','image','aadhar_number','pan_number','registration_number','isDocumentApprove','payment_status','IsAvailable')->where('user_id',$userId)->first();
         
         $user = User::where('id', $userId)->first();   
            
            $store->storelogo=URL('public/assets/img/store/'.$store->storelogo);
            $store->image=URL('public/assets/img/store/'.$store->image);
            $store->pan_card=URL('public/assets/img/store/'.$store->pan_card);
            $store->store_registration=URL('public/assets/img/store/'.$store->store_registration);
            $store->aadhar_front=URL('public/assets/img/store/'.$store->aadhar_front);
            $store->aadhar_back=URL('public/assets/img/store/'.$store->aadhar_back);

           
            $PlanDetail=array();
            if($store->plan_id!='' && $store->plan_id!='0')
            {
               $paymentlink = \App\Subscription::where(['plan_id'=>$store->plan_id,'store_id'=>$userId])->first();
              $plan=array();
             $plandetail=json_decode(getPlanDetail($store->plan_id));
             $plan['id']=$plandetail->id;
             $plan['interval']=$plandetail->interval;
             $plan['period']=$plandetail->period;
             $plan['name']=$plandetail->item->name;
             $plan['amount']=$plandetail->item->amount/100;
             $plan['currency']=$plandetail->item->currency;
             $plan['payment_link']=$paymentlink->payment_link;
             $plan['subscription_id']=$paymentlink->subscription_id;
              $store->plandetail=$plan;
            }else
            {
              $store->plandetail=null; 
            }
           
           $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'User Profile.',
                'data'=>[
                   'user'=>$user,
                    'store_details'=>$store
                ]
            ];
            return response()->json($response);
}
public function getUnit(Request $request)
{
  $validator = Validator::make($request->all(), [
            'api_key' => 'required', 
           
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Api Key.',[]));
        }
         $unitlist = \App\Unit::select('name','id')->where(['IsActive'=>1])->get();
         return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Unit List",
                            'data' => $unitlist,
                            
                        ]);
}

public function addStock(Request $request)
{
     $userId = $this->getUserId(); 
     $storename = \App\Store::select('name','id')->where('user_id',$userId)->first();
     $store = $storename->id;
     $product=$request->productid;
     $category=$request->category;
     $subcategory=$request->subcategory;
     $weight=$request->weight;
     $unit=$request->unit;
     $quantity=$request->quantity;
     $price=$request->price;
     $internalprice=$request->internalprice;
     $discount=$request->discount;
     $discount_type=$request->discounttype;
     \DB::beginTransaction();
        try {
          
             $ids= \App\InventoryEntry::create([
            'product_id'      =>$product,
            'store_id'        =>$store,
            'category_id'     =>$category,
            'sub_category_id' =>$subcategory,
            'qty'             =>$quantity,
            'weight'          =>$weight,
            'unit'            =>$unit,
            'price'           =>$price,
            'internal_price'  =>$price,
            'discount'        =>$discount,
            'discount_type'   =>$discount_type,
            'status'          =>'add',
            'added_by'        => $storename->name,
            'created_by'      => $userId,
          ]);
             $Inventory= \App\Inventory::updateOrCreate([
                'inventory_entry_id' =>$ids->id,
                    
                ],[
                    'status'=>'available',
                    'added_by'      => $storename->name,
                    'created_by'    => $userId,
                ]);

                $Inventory->stock = $Inventory->stock +$quantity;
                $Inventory->weight = $weight;
                $Inventory->store_id = $store;
                $Inventory->product_id = $product;
                $Inventory->unit = $unit;
                $Inventory->sub_category_id = $subcategory;
                $Inventory->category_id = $category;
                $Inventory->price = $price;
                $Inventory->internal_price = $price;
                $Inventory->discount =$discount;
                $Inventory->discount_type =$discount_type;
                $Inventory->save();    
             \DB::commit();
            // all good
        } catch (\Exception $e) {
           \DB::rollback();
            // something went wrong
        }
      return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Inventory updated successfully.",
                            'data' => [],
                            
                        ]);  
}

public function updateInventoryStatus(Request $request)
{
   $validator = Validator::make($request->all(), [
             'inventoryid' => 'required|numeric',
             'status' => 'required|numeric|max:1',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
     $userId = $this->getUserId();
     $storeId = \App\Store::select('id')->where('user_id',$userId)->first(); 
      $Inventory= \App\Inventory::where(['store_id'=>$storeId->id,'id'=>$request->inventoryid])->first();
      if(!empty($Inventory))
      {
         $Inventory->Isavailable=$request->status;
         $Inventory->save(); 
      }
      else
      {
        return response()->json($this->fResponse('Invalid inventory id.',
        [])); 
      }
       
       return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Inventory successfully updated.",
                            'data' => [],
                            
                        ]);  

}
public function updateStock(Request $request)
{
   $validator = Validator::make($request->all(), [
             'inventoryid' => 'required|numeric',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
     $userId = $this->getUserId(); 
     $Inventory= \App\Inventory::where(['id'=>$request->inventoryid])->first();
      if(!empty($Inventory))
      {
         $Inventory->weight=$request->weight;
         $Inventory->unit=$request->unit;
         $Inventory->price=$request->price;
         $Inventory->discount=$request->discount;
         $Inventory->discount_type=$request->discounttype;
         $Inventory->stock=$request->quantity;
         $Inventory->save(); 
      }
      else
      {
        return response()->json($this->fResponse('Invalid inventory id.',
        [])); 
      }
      return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Inventory successfully updated.",
                            'data' => [],
                            
                        ]);  
}
public function getInventoryList(Request $request)
{
      $validator = Validator::make($request->all(), [
             'subcategory' => 'required',
             'start' => 'required',
             'pagelength' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
     $userId = $this->getUserId(); 
     $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
     if($request->subcategory!='all')
     {
       $inventoryList= \App\Inventory::with(['product','unit_detail'])->where('store_id',$storeId->id)->where('sub_category_id',$request->subcategory)->offset($request->start)->limit($request->pagelength)->get();
     }
     else
     {
       $inventoryList= \App\Inventory::with(['product','unit_detail'])->where('store_id',$storeId->id)->offset($request->start)->limit($request->pagelength)->get();
     }
    
     $productList=array();
    // print_r($inventoryList);
     if(!empty($inventoryList))
     {
      foreach ($inventoryList as $key => $inventory)
      {
        
        $productList[$key]['id']=$inventory->id;
        $productList[$key]['name']=$inventory->product->name;
        $productList[$key]['stock']=$inventory->stock;
        $productList[$key]['weight']=$inventory->weight.$inventory->unit_detail->name;
        $productList[$key]['actualweight']=$inventory->weight;
        $productList[$key]['price']=$inventory->price;
        $productList[$key]['unit']=$inventory->unit_detail->name;
        $productList[$key]['Isavailable']=$inventory->Isavailable;
        $productList[$key]['discountamount']=$inventory->discount;
        if($inventory->discount_type==2)
         {
            $productList[$key]['discount_type']='Percentage';
          }
          elseif($inventory->discount_type==1)
          {
            $productList[$key]['discount_type']='Flat';
          }
          else{
            $productList[$key]['discount_type']='No Discount';
          }
          $productList[$key]['item_image'] = URL('public/assets/img/product/'.$inventory->product->profile_pic);
       
      }
     }
     if(!empty($productList))
     {
       return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Inventory list.",
                            'data' =>$productList,
                            
                        ]);  
     }
     else
     {
      return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Inventory not added yet.",
                            'data' =>null,
                            
                        ]); 
     }
}


public function addDeliveryBoy(Request $request)
{
      $validator = Validator::make($request->all(), [
            'name'=>'required|max:120',
            'zipcode'=>'required|max:6',
            'email'=>'required|email',
            'phone'=>'required|max:15',
            'password'=>'required|min:6|max:30',
            'address'=>'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }

      $countemail=User::where('email',$request->email)->count(); 
      if($countemail>0)
      {
         return response()->json($this->fResponse('This email id already registered.',[]));
      }
      $countphone=User::where('Phone',$request->phone)->count(); 
    if($countphone>0)
      {
         return response()->json($this->fResponse('This mobile number already registered.',[]));
      }
     $userId = $this->getUserId();
     $usertype = $roles = 37; 
      
        $user = User::create([
              'user_type' =>$usertype,
              'name' =>$request->name,
              'email' =>$request->email,
              'Phone' =>$request->phone,
              'password' => $request->password,
              'IsVerify' => '1',
              'IsAvailable' => '1',
              'zipcode' =>$request->zipcode,
              'address' =>$request->address,
              'CreatedBy' =>$userId
        ]);
        $code = 'u'.date('Y').$user->id;
        User::where('id',$user->id)->update(['user_code'=>$code,'zipcode' =>$request->zipcode,'address' =>$request->address]);
        
        if (isset($roles)) {
            $role_r = Role::where('id', '=', $roles)->firstOrFail();            
            $user->assignRole($role_r);
        }  

        $userlist=User::select('id','name','email','Phone','address','zipcode','IsAvailable')->where('CreatedBy',$userId)->orderBy('updated_at','DESC')->offset(0)->limit(5)->get();
        return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Delivery Boy successfully created.",
                            'data' =>$userlist,
                            
                        ]); 
}


public function getDeliveryBoy(Request $request)
{
       $validator = Validator::make($request->all(), [
            'start' => 'required',
             'pagelength' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
         $userId = $this->getUserId();
         $userlist = User::select('id','name','email','Phone','address','zipcode','IsAvailable')->where('CreatedBy',$userId)->offset($request->start)->limit($request->pagelength)->get();
        
       if(count($userlist)>0)
       {
           return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Delivery Boy List.",
                            'data' =>$userlist,
                            
                        ]); 
       }
       else
       {
           return response()->json([
                            'success'   =>  true,
                            'messageId'   =>  200,
                            'message'   =>  "Delivery Boy not added yet.",
                            'data' =>null,
                            
                        ]); 
       }
       
}

public function updateDeliveryBoy(Request $request)
{
     $validator = Validator::make($request->all(), [
            'id'=>'required|numeric',
            'name'=>'required|max:120',
            'zipcode'=>'required|max:6',
            'email'=>'required|email',
            'phone'=>'required|max:10',
            'address'=>'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
      $userId = $this->getUserId(); 
      $user=\App\User::select('id','name','email','phone','zipcode','address')->where('id', $request->id)->first();
      $user->name=$request->name;
      $user->email=$request->email;
      $user->Phone=$request->phone;
      $user->zipcode=$request->zipcode;
      $user->address=$request->address;
      $user->save();
       $userlist=User::select('id','name','email','Phone','address','zipcode','IsAvailable')->where('CreatedBy',$userId)->orderBy('updated_at','DESC')->offset(0)->limit(5)->get();
       $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Delivery boy successfully updated.',
                'data'=>$userlist
            ];
            return response()->json($response);
}

public function deleteDeliveryBoy(Request $request)
{
  $validator = Validator::make($request->all(), [
            'id'=>'required|numeric', 
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
         $userId = $this->getUserId();  
         $user = User::findOrFail($request->id);
         $delete = $user->delete();
         $userlist=User::select('id','name','email','Phone','address','zipcode','IsAvailable')->where('CreatedBy',$userId)->orderBy('updated_at','DESC')->offset(0)->limit(5)->get();
        $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Delivery boy successfully deleted.',
                'data'=>$userlist
            ];
            return response()->json($response);
}

public function assignOrder(Request $request)
{ 
         $validator = Validator::make($request->all(), [
            'userid' => 'required|numeric', 
            'orderid' => 'required', 
        ]);  
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }  
        $orderids=$request->orderid;
        $flag= DB::table('tbl_order')->whereIn('id',$orderids)->update(array('assign_to' => $request->userid));

          $notificationdata['sent_to']=$request->userid;
          $notificationdata['noti_type']="Order Assign";
          $notificationdata['message']="Order has been successfully assign.";
          $this->saveNotification($notificationdata);

         $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Order has been successfully assign to selected user.',
                'data'=>null
            ];
            return response()->json($response);
}
// Delivery Boy
public function deliveryBoyLogin(Request $request)
{
       $validator = Validator::make($request->all(), [
            'email' => 'required', 
            'password' => 'required', 
        ]);  
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
          return response()->json($this->fResponse('Invalid Api Key.',[]));
        } 

       $pos=strpos( $request->email,'@');
       if($pos)
       {
         $user = User::where(['email'=>$request->email,'user_type'=>37])->whereNull('deleted_at')->where('IsActive',1)->first();
       }
       else
       {
           $user = User::where(['Phone'=>$request->email,'user_type'=>37])->whereNull('deleted_at')->where('IsActive',1)->first();
       }
        if(empty($user))
       {
         return response()->json($this->fResponse('Email or password is wrong.',[]));
       }
       if ((Hash::check($request->password,$user->password)) == false)
        {
               return response()->json($this->fResponse('Email or password is wrong.',[]));
        }
         if($request->device_type && $request->device_token)
         {
            $device = Device_Detail::where('user_id',$user->id)->first();
            if($device)
            {
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            } else {
                $device = new Device_Detail();
                $device->user_id = $user->id;
                $device->device_type = $request->device_type;
                $device->device_token = $request->device_token;
                $device->save();
            }
         }

             \App\User::where('id', $user->id)->update(['IsAvailable'=>1]);
              $web_setting = \App\Websitesetting::first();
              $user->sapport_no=$web_setting->sapport_no;
              $temp_data=array();
              $userClaims = ['sid' => $user->id, 'baz' => 'bob','exp' => date('Y-m-d', strtotime('+12 month', strtotime(date('Y-m-d'))))];
             $token = JWTAuth::fromUser($user, $userClaims);
             $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Login successfully.',
                'data'=>[
                    'token'=>$token,
                    'user'=>$user,
                ]
            ];
            return response()->json($response);
        
}
public function getDeliveryBoyOrder(Request $request)
{

       $userId = $this->getUserId(); 
        $validator = Validator::make($request->all(), [
             'status' => 'required',
             'start' => 'required',
             'pagelength' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
         if($request->status=='all')
        {
          $orderlist=\App\Order::where('assign_to',$userId)->offset($request->start)->limit($request->pagelength)->get();
        }else
        {
          $orderlist=Order::where(['assign_to'=>$userId,'status'=>$request->status])->orderBy('id','DESC')->offset($request->start)->limit($request->pagelength)->get(); 
        }


        $temp_data=array();
        $order_list=array();
        $web_setting = \App\Websitesetting::first();
       foreach ($orderlist as $key => $value) 
       {
          $orders=array();
          $items=array();
          $orders['id']=$value->id;
          $orders['order_id']=$value->order_id;
          $orders['ratting']=$value->placedRatting;
          unset($value->placedRatting);
          $detail=json_decode($value->order_detail);
        
           $usermobile= \App\Customer::select('mobile_number')->where(['id'=>$value->user_id])->first();
           $useraddress= \App\Address::select('latitude','longitude','full_address')->where(['user_id'=>$value->user_id,'IsDefault'=>1])->first();
          $orders['store']=$detail->store_detail->name;
          $orders['storeaddress']=array('address'=>$detail->store_detail->address,'latitude'=>$detail->store_detail->latitude,'longitude'=>$detail->store_detail->longitude);
          $orders['useraddress']=array('address'=>$useraddress['full_address'],'latitude'=>$useraddress['latitude'],'longitude'=>$useraddress['longitude']);
            $orders['status']=getOrderStatus($value->status);
            $sub_date = date(DATE_ISO8601,strtotime('+5 hour +30 minutes +1 seconds',strtotime($value->created_at)));

          $orders['date']=$sub_date;
          $orders['store_number']=$detail->store_detail->mobile_number;
          $orders['customer_number']=$usermobile['mobile_number'];
          $orders['amigos_number']=$web_setting->sapport_no;
          $orders['storelogo']=URL('public/assets/img/store/'.$detail->store_detail->storelogo);
          foreach ($detail->cart_detail as $keycart => $cartvalue) {
                $items[$keycart]['name']=$cartvalue->product_name;
                $items[$keycart]['qty']=$cartvalue->qty;
                $items[$keycart]['unit']=$cartvalue->unit;
                $items[$keycart]['product_image']=$cartvalue->product_image;
                $items[$keycart]['price']=$cartvalue->price;
                $items[$keycart]['total_price']=$cartvalue->total_price;
                $items[$keycart]['payble_price']=$cartvalue->payble_price;
                $items[$keycart]['discount']=$cartvalue->discount;
                if($cartvalue->discount_type==1){
                    $items[$keycart]['discount_type']='Flat';
                }else
                {
                  $items[$keycart]['discount_type']='%';
                }
                
          }
          $orders['items']=$items;
          $orders['totalAmount']=$value->order_amount;
          $orders['paybleAmount']=$value->payable_amount;
          array_push($order_list, $orders);
          
          
       }

            $temp_data['orderlist']=$order_list;
           if(!empty($order_list))
           {
                  return response()->json([
                                  'success'   =>  true,
                                  'messageId'   =>  200,
                                  'data' => $temp_data,
                                  
                              ]);  
          
           }
           else
           {
                  return response()->json([
                                  'success'   =>  true,
                                  'messageId'   =>  200,
                                  'data' => null,
                                  
                              ]);  
          
           }
 
}
public function updateAvailableStatus(Request $request)
{
   $validator = Validator::make($request->all(), [
            'status' => 'required|numeric|max:2', 
           
        ]);  
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
           $userId = $this->getUserId(); 
           \App\User::where('id', $userId)->update(['IsAvailable'=>$request->status]);
            $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Status successfully updated.',
                'data'=>null
            ];
            return response()->json($response);
}

  public function makepayment()
    {
        $data=$_REQUEST;
        $store = \App\Store::where('id',$_REQUEST['store_id'])->first();
        return view('payment',compact('data','store'));
    }
    public function paymentDone(Request $request)
    {
      //active cancelled created
       $validator = Validator::make($request->all(), [
            'subscription_id' => 'required',  
        ]);  
        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
      $userId = $this->getUserId(); 
      $res= json_decode(getSubscriptions($request->subscription_id));
       if (property_exists($res,"error"))
            {
              if($res->error)
              {
               
                return response()->json($this->fResponse($res->error->description,[]));
              }
            }
    if($res->status=='created')
    {
          $response = [
                'status'=>true,
                'messageId'=>203,
                'message'=>'Payment not done yet.',
                'data'=>null
            ];  
    }
    if($res->status=='cancelled')
    {
           $response = [
                'status'=>true,
                'messageId'=>203,
                'message'=>'Subscription plan  cancelled.',
                'data'=>null
            ];  
    }
    if($res->status=='active')
    {
           $plandetail=json_decode(getPlanDetail($res->plan_id));
            if (property_exists($plandetail,"error"))
            {
              if($plandetail->error)
              {
                return response()->json($this->fResponse('Invalid Plan Id ',[]));
              }
            }
         $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
        \App\Store::where('id',$storeId->id)->update(['payment_status'=>1]);
                $plan=array();
                $plan['id']=$plandetail->id;
                $plan['interval']=$plandetail->interval;
                $plan['period']=$plandetail->period;
                $plan['name']=$plandetail->item->name;
                $plan['amount']=$plandetail->item->amount/100;
                $plan['currency']=$plandetail->item->currency;
               
               $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Payment done.',
                'data'=>$plan
               ];  
    }
     return response()->json($response);
    }


public function getBanner(Request $request)
{

       $validator = Validator::make($request->all(), [
            'api_key' => 'required'
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key.',[]));
        }
       $temp_data=array();

        // get banner data
        $banners=array();
        $bannerList=Banner::select('id','title','caption','secondCaption','thirdCaption','image')->where('IsActive',1)->get();
        foreach ($bannerList as $key => $banner) {
         $banner['image']= URL('public/assets/img/banner/'.$banner->image);
         array_push($banners, $banner);
        }
         $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Banner List.',
                'data'=>$banners
            ];
            return response()->json($response);
}


 public function sendOtpforgotpassword(Request $request)
 {
       $validator = Validator::make($request->all(), [
            'api_key' => 'required',
            'mobile' => 'required',
        ]);

        if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        if(!$this->checkAPIKey($request->api_key))
        {
             return response()->json($this->fResponse('Invalid Api Key.',[]));
        }
    
        // $api = new ApiController;
        $comman = new CommanController;
        $number =$request->mobile;
        $res = $comman->validateNumber($number);
        if(!$res['status']){
            $response = array(
                'status'=>false,
                'messageId'=>203,
                'message'=>'Invalid Phone Number',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        $validatemobile = \App\User::where('Phone',$number)->first();
        //print_r( $validatemobile);
       
        if(empty($validatemobile))
        {
           $response = array(
                'status'=>false,
                'messageId'=>203,
                'message'=>'This mobile number not registered with us.',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }

        $messageFlag = $this->sendOtp($number);
        if($messageFlag['status']){
           $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'We have send an OTP to '.$request->mobile,
                'data'=>[
                    'phone_number'=>$request->mobile,
                ]
            ];
         }else{
                    $response = [
                        'status'=>false,
                        'messageId'=>203,
                        'message'=>'Something went wrong. Please try again later',
                    ];
                }
        return response()->json($response);

     }

  public function verifyMobileOtp(Request $request)
  {
    $validator = Validator::make($request->all(), [
            'phone_number' => 'required',
            'otp' => 'required',
        ]);
        // $api = new ApiController;
        $comman = new CommanController;
        $number =$request->phone_number;
        $res = $comman->validateNumber($number);
        if(!$res['status']){
            $response = array(
                'status'=>false,
                'messageid'=>203,
                'message'=>'Phone Number Required',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }

        $phone_number = $res['number'];
        $country_code = $res['country_code'];
        
        $ress = $this->verifyOtp($phone_number,$request->otp);
        if($ress['status']){
          
            $response = [
                'status'=>true,
                'messageId'=>200,
                'message'=>'Your phone number verified successfully.',
                'data'=>null
            ];
            return response()->json($response);
            return response()->json($user);
        }else{
                $response = array(
                    'status'=>false,
                    'message'=>'Operation failed please try again',
                    'messageId'=>203
                );
                return response()->json($response);
        }  
  }
public function updatePassword(Request $request)
{
     $validator = Validator::make($request->all(), [
            'mobile' => 'required', 
            'password' => 'required', 
        ]);
       if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
        $user = \App\User::where('Phone',$request->mobile)->first();
       if(empty($user))
        {
           $response = array(
                'status'=>false,
                'messageId'=>203,
                'message'=>'This mobile number not registered with us.',
                'error'=>$validator->errors()
            );
           return response()->json($response);
        }
        $res=User::where('id', $user->id)->update(['password' => Hash::make($request->password)]);
         if($res)
         {
             return response()->json([
              'success'   =>  true,
              'messageId'   =>  200,
              'message' => "Password has been change successfully.",
               ]);
         }
         else
         {
            return response()->json($this->fResponse('Please try again.',[]));
         }
}

public function saveCurrentLatLong(Request $request)
{
      $validator = Validator::make($request->all(), [
            'order_id' => 'required', 
            'latitude' => 'required', 
            'longitude' => 'required', 
          ]);
       if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
       $userId = $this->getUserId(); 
       \App\CurrentLocation::create([
                            'order_id' =>$request->order_id,
                            'delivery_boy' =>$userId,
                            'latitude' =>$request->latitude,
                            'longitude' =>$request->longitude,
                      ]);
       return response()->json([
              'success'   =>  true,
              'messageId'   =>  200,
              'message' => "Location update successfully.",
               ]);
    
}
public function getCurrentLatLong(Request $request)
{
      $validator = Validator::make($request->all(), [
            'order_id' => 'required', 
          ]);
       if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
       $userId = $this->getUserId(); 
       $result= \App\CurrentLocation::select('latitude','longitude')->where(['order_id'=>$request->order_id])->first();
        \App\CurrentLocation::where(['order_id'=>$request->order_id])->delete();
       return response()->json([
              'success'   =>  true,
              'messageId'   =>  200,
              'message' => "Location list.",
              'data'=>$result
               ]);
    
}


public function updatePaymentStatus(Request $request)
{
           $userId = $this->getUserId();
           $validator = Validator::make($request->all(), [
            'orderid' => 'required','status' => 'required']);
          if ($validator->fails())
          {
             return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
          }
          $orders =Order::find($request->orderid);
          if(empty($orders))
          {
            return response()->json($this->fResponse('Invalid order id.',[]));
          }
         $userdetail=\App\Store::where('id',$orders->store_id)->first();
         $orderId=$orders->order_id;
         $orders->payment_status = $request->status;
         $flag=$orders->save();
          if($flag) 
           {
             $device = Device_Detail::where('user_id',$userdetail->user_id)->first();
            if(!empty($device))
                {
                   $arrNotification["body"] ="Payment  successfully recived with order id : ".$orderId;
                   $arrNotification["title"] = "Payment Recive";
                   $arrNotification["sound"] = "default";
                   sendPushNotification($arrNotification,$device->device_token,'Android');
                        
                 }

                        $notificationdata['sent_to']=$userdetail->user_id;
                        $notificationdata['noti_type']="Payment Recive";
                        $notificationdata['message']="Payment  successfully recived with order id : ".$orderId;
                        $this->saveNotification($notificationdata);
              return response()->json($this->sResponse('Order update successfully',[]));
           }
             else
             {
                return response()->json($this->fResponse('Action Failed Please try again',null));
             }
}

public function getRecentOrder(Request $request)
{
    $userId = $this->getUserId();
    $storeId = \App\Store::select('id')->where('user_id',$userId)->first();
  // today calculation
   $todayOrder=Order::where(['store_id'=>$storeId->id,'status'=>1])->whereDate('created_at','=',date('Y-m-d'))->orderBy('id','DESC')->get();
     return response()->json([
              'success'   =>  true,
              'messageId'   =>  200,
              'message' => "Location list.",
              'data'=>count($todayOrder)
               ]);
}
public function storeStatusUpdate(Request $request)
{
       $validator = Validator::make($request->all(), [
            'status' => 'required', 
          ]);
       if ($validator->fails()) {
           return response()->json($this->fResponse('Invalid Parameter',$validator->errors()));
        }
    $status=$request->status;
    $userId = $this->getUserId();
    $res=\App\Store::where('user_id',$userId)->update(['IsAvailable'=>$status]);
    if($res)
    {
       return response()->json($this->sResponse('Status update successfully',[]));
    }
     else
     {
        return response()->json($this->fResponse('Action Failed Please try again',null));
     }
}
}