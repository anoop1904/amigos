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

class UnitController extends Controller
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
        $category = \App\Unit::orderBy('id','DESC');
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
        $categories= $category->paginate(20);
        $pagetitle='Unit List';
        // dd($student);
        return view('unit.index',compact('categories','pagetitle'));
    }

    public function create()
    {
        $category = \App\Unit::get(); 
        $pagetitle='Create Unit'; 
        return view('unit.create',compact('category','pagetitle'));
    }

   public function edit($id)
    {
     $category = \App\Unit::findOrFail($id); 
     $pagetitle='Edit Unit'; 
     return view('unit.create',compact('category','pagetitle')); 
    }

   public function store(Request $request)
    {
        //return $request;
        $this->validate($request, [
        'name'=>'required|max:120',
        ]);

        $image = $request->file('file');
       
        $unit = new \App\Unit(); 
        $unit->name = $request->name;
        $unit->created_by = Auth::user()->id;

        $flag = $unit->save();
        if($flag){
            return redirect()->route('unit.index')->with('message','Unit Info successfully added.');
        }else{
            return redirect()->route('unit.index')->with('message','Action Failed Please try again.');
        }
     
    }

 public function update(Request $request, $id)
    {
       //return $request;
        $this->validate($request, [
        'name'=>'required|max:120',
        ]);

        $unit = \App\Unit::findOrFail($id); 
        $image = $request->file('file');

        
        $unit->name = $request->name;

        $flag = $unit->save();
        if($flag){
            return redirect()->route('unit.index')->with('message','Unit Info successfully added.');
        }else{
            return redirect()->route('unit.index')->with('message','Action Failed Please try again.');
        }
    }
   

       public function destroy($id)
    {
        $user = \App\Unit::findOrFail($id);
        $delete = $user->delete();
        // Log::create([
        //   'user_id' =>$id,
        //   'activity' =>"User Deleted",
        //   'createdBy' =>Auth::user()->id
        // ]);
        if(isset($delete)) {
        return redirect()->route('unit.index')
            ->with('message',
             'Unit successfully Deleted.');
        }else{
            return redirect()->route('unit.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

     public function unitStatus($id, $key)
    {
        $customer = \App\Unit::findOrFail($id);
        if($key === 'active'){
            $customer->IsActive = 1;
            $message = 'Unit successfully Active';

        }
        if($key === 'deactive'){
            $customer->IsActive = 0;
             $message = 'Unit successfully Deactive';
        }
        $flag = $customer->save();
        if($flag){
            return redirect()->route('unit.index')->with('message',$message);
        }else{
            return redirect()->route('unit.index')->with('message','Operation failed please try again.');
        }
        
    }

    public function changeUnitStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $unit = \App\Unit::findOrFail($id);
        $unit->IsActive = $status;
        if($status){
            $message = 'Unit successfully Active';
        } else {
             $message = 'Unit successfully Deactive';
        }
        $flag = $unit->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }

   
}
