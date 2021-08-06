<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Store;

class MessagesController extends Controller
{
    //
	
	public function index(){
		 
     $start='';
        $email_template = \App\Messages::orderBy('id','DESC');
        //$email_template = DB::table('tbl_messages_template')->get();;

        if(isset($_GET['title']))
        {
          if($_GET['title']!='')
          {
           $email_template->where('title','LIKE','%'.$_GET['title'].'%');
          }           
        }
      
        
		 if(isset($_GET['IsActive']))
        {
          if($_GET['IsActive']!='all')
          {
            $email_template->where('IsActive',$_GET['IsActive']);
          }
        }
       else
        {
            $email_template->orderBy('id','DESC');
        }
        
        $messages= $email_template->paginate(20);
	
        $pagetitle='Sms Template';
      
	  
        return view('message.index',compact('messages','pagetitle'));
	}
	
	  public function create()
    {
		
        $pagetitle='Create Sms Template';
        $stores = \App\Store::where('IsActive','1')->get();
        return view('message.create',compact('pagetitle','stores'));
    }
	
	public function show(Request $request){
		return $request;
	}
	   public function changeMessageTemplateStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $banner = \App\Messages::findOrFail($id);
        $banner->IsActive = $status;
        if($status){
            $message = 'Messages Template successfully Active';
        } else {
             $message = 'Messages Template successfully Deactive';
        }
        $flag = $banner->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }
	 public function store(Request $request)
    {
		
		//return $request;
		$validator = Validator::make(
         array(
        'title' => $request->template_title,
        'message' => $request->editor1
          ),
         array(
        'title' => 'required|unique:tbl_email_template',
        'message' => 'required',
            )
         );
		 
		 if ($validator->fails()) {
            return redirect('admin/messages/create')
           ->withErrors($validator)
           ->withInput();
           }
		 
		
		$img = "";
		  if($request->hasFile('file')) {
        $image = $request->file('file');
        if($image){
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/assets/img/email_temp_background');
            $image->move($destinationPath, $input['imagename']);
            $img=$input['imagename'];
        }
        }
	
        $email_temp = new \App\Messages(); 
        $email_temp->title = $request->template_title;
        $email_temp->background_img = $img;
        $email_temp->body = $request->editor1;
	    $flag = $email_temp->save();
     
	   if($flag) {
            return redirect('admin/messages')->with('message','Template Created successfully.');
        }else{
            return redirect('admin/messages/create')->with('message','Action Failed Please try again.');
        }
	
    }
	
	   public function destroy($id)
    {
        $email_temp = \App\Messages::findOrFail($id);
        $delete = $email_temp->delete();
        if(isset($delete)) {
        return redirect('admin/messages')
            ->with('message',
             'Template successfully Deleted.');
        }else{
            return redirect('admin/messages')
            ->with('message',
             'Action Failed Please try again.');
        }
    }
	
	 public function update(Request $request, $id)
    {
      //return $request;
        $this->validate($request, [
        'template_title'=>'required|max:120',
        'editor1'=>'required',
        ]);

        $messagetemplate = \App\Messages::findOrFail($id); 
        $messagetemplate->title = $request->template_title;
        $messagetemplate->body = $request->editor1;

        $flag = $messagetemplate->save();
        if($flag){
            return redirect()->route('messages.index')->with('message','Message template successfully added.');
        }else{
            return redirect()->route('messages.index')->with('message','Action Failed Please try again.');
        }
    }
	  public function edit($id)
    {

     $message_temp = \App\Messages::findOrFail($id); 

     $pagetitle='Message Template';
     return view('message.create',compact('message_temp','pagetitle')); 
    }
	
	public function bulkSms(){
	  $pagetitle='Bulk SMS';
	  $sms_template = \App\Messages::where(['IsActive'=>1])->get();
      $customer = \App\Customer::where(['IsActive'=>1])->get();
      $store = \App\Store::where(['IsActive'=>1])->get();
     return view('message.bulksms',compact('pagetitle','customer','sms_template','store')); 
	}
  public function sendbulksms(Request $request)
  {
    $sms_template = \App\Messages::where(['IsActive'=>1,'id'=>$request->smstemplate])->first();
    if($request->select_type==1)
    {
      foreach ($request->stores as $key => $store)
       {
         $message=str_replace('{first_name}',$store->name, $sms_template->body);
         $message=str_replace('{email}',$store->email, $sms_template->body);
         $message=str_replace('{mobile}',$store->mobile_number, $sms_template->body);
            sendSms($store->mobile_number,str_replace(' ','%20',$message));
       } 
    }
    else
    {
      foreach ($request->customers as $key => $customer)
      {
        $user =\App\Customer::where(['IsActive'=>1,'id'=>$customer])->first();
        $message=str_replace('{first_name}',$user->name, $sms_template->body);
        $message=str_replace('{last_name}',$user->last_name, $message);
        $message=str_replace('{email}',$user->email, $message);
        $message=str_replace('{mobile}',$user->mobile_number, $message);
        $message = str_replace(' ', '-', $message);
        $message= preg_replace('/[^A-Za-z0-9\-]/', '',$message);
        
        sendSms($user->mobile_number,str_replace('-','%20',$message));
      } 
    }
   
      return redirect(URL('/admin/bulksms'))->with('message','Message send successfully to selected users.');
  }
	public function getSmsTemplate(request $request){
		 $sms_template = \App\Messages::where(['id'=>$request->id])->get();
		return json_encode(['status'=>true,'temp_details'=>$sms_template]);
	}
	
 public function pushNotifications()
 {
    $pagetitle='Send Push Notifications';
    $sms_template = \App\Messages::where(['IsActive'=>1])->get();
    $customer = \App\Customer::where(['IsActive'=>1])->get();
    $store = \App\Store::where(['IsActive'=>1])->get();
     return view('message.pushnotifications',compact('pagetitle','customer','sms_template','store'));
 }
		
	
}
