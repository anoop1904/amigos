<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class EmailTemplateController extends Controller
{
    //
	
	  public function index()
    {  
         $start='';
        $email_template = \App\EmailTemplate::orderBy('id','DESC');
        
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
       
	   
        $email_template= $email_template->paginate(20);
        $pagetitle='Email Template';
	
        // dd($student);
        return view('email_template.index',compact('email_template','pagetitle')); 
    }
	
	
    public function create()
    {
		
        $pagetitle='Create Email Template';
        $stores = \App\Store::where('IsActive','1')->get();
        return view('email_template.create',compact('pagetitle','stores'));
    }
	
	 public function store(Request $request)
    {
		
		
		   $validator = Validator::make(
         array(
        'title' => $request->template_title,
        'body' => $request->editor1,
        'background_img' => $request->hasFile('file')
          ),
         array(
        'title' => 'required|unique:tbl_email_template',
        'body' => 'required',
        'background_img' => 'required'
            )
         );
		 
		 if ($validator->fails()) {
            return redirect('admin/emailtemplate/create')
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
	
        $email_temp = new \App\EmailTemplate(); 
        $email_temp->title = $request->template_title;
        $email_temp->subject = $request->subject;
        $email_temp->background_img = $img;
        $email_temp->body = $request->editor1;
	      $flag = $email_temp->save();
     
	   if($flag) {
            return redirect('admin/emailtemplate')->with('message','Template Created successfully.');
        }else{
            return redirect('admin/emailtemplate/create')->with('message','Action Failed Please try again.');
        }
	
    }
	 public function update(Request $request, $id)
    {
      //return $request;
        $this->validate($request, [
        'template_title'=>'required|max:120',
        'editor1'=>'required',
        ]);

        $emailtemplate = \App\EmailTemplate::findOrFail($id); 
        $image = $request->file('file');

        if($image){
          $path = public_path('/assets/img/email_temp_background/');  
             if($emailtemplate->image)
             {
               unlink($path.$emailtemplate->image);
             }
             $img = time().'.'.$image->getClientOriginalExtension();
             $destinationPath = public_path('/assets/img/email_temp_background');
             $image->move($destinationPath, $img);

             $emailtemplate->background_img=$img;
        }
        $emailtemplate->title = $request->template_title;
        $emailtemplate->subject = $request->subject;
        $emailtemplate->body = $request->editor1;

        $flag = $emailtemplate->save();
        if($flag){
            return redirect()->route('emailtemplate.index')->with('message','Email template successfully added.');
        }else{
            return redirect()->route('emailtemplate.index')->with('message','Action Failed Please try again.');
        }
    }
    
	  public function destroy($id)
    {
        $email_temp = \App\EmailTemplate::findOrFail($id);
        $delete = $email_temp->delete();
        if(isset($delete)) {
        return redirect('admin/emailtemplate')
            ->with('message',
             'Template successfully Deleted.');
        }else{
            return redirect('admin/emailtemplate')
            ->with('message',
             'Action Failed Please try again.');
        }
    }
	
	
	  public function edit($id)
    {

     $email_temp = \App\EmailTemplate::findOrFail($id); 

     $pagetitle='Email Template';
     return view('email_template.create',compact('email_temp','pagetitle')); 
    }
	
	
	  public function changeEmailTemplateStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $banner = \App\EmailTemplate::findOrFail($id);
        $banner->IsActive = $status;
        if($status){
            $message = 'Email Template successfully Active';
        } else {
             $message = 'Email Template successfully Deactive';
        }
        $flag = $banner->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }
	
	
	
	
}
