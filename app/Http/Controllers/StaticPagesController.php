<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    //
	
	public function index(){
		 
     $start='';
        $static_page = \App\StaticPages::orderBy('id','DESC');
        //$email_template = DB::table('tbl_messages_template')->get();;

        if(isset($_GET['title']))
        {
          if($_GET['title']!='')
          {
           $static_page->where('title','LIKE','%'.$_GET['title'].'%');
          }           
        }
      
        
		 if(isset($_GET['IsActive']))
        { 
          if($_GET['IsActive']!='all')
          {
            $static_page->where('IsActive',$_GET['IsActive']);
          }
        }
       else
        {
            $static_page->orderBy('id','DESC');
        }
        
        $staticpage= $static_page->paginate(20);
	 
        $pagetitle='Static Page Editor';
      
	  
        return view('static_pages.index',compact('staticpage','pagetitle'));
	}
	
	public function create()
    {
		
        $pagetitle='Static Page Editor';
        $stores = \App\Store::where('IsActive','1')->get();
        return view('static_pages.create',compact('pagetitle','stores'));
    }
	
	public function show(Request $request){
		return $request;
	}
	
	 public function store(Request $request)
    { 
       
        $static_page = new \App\StaticPages(); 
        $static_page->title = serialize($request->template_title);
        $static_page->content = serialize($request->editor);
        $static_page->page_type = $request->page_type;
        $static_page->page_title = $request->page_title;
	      $flag = $static_page->save();
     
	   if($flag) {
            return redirect('admin/staticpages')->with('message','Page Created successfully.');
        }else{
            return redirect('admin/staticpages/create')->with('message','Action Failed Please try again.');
        }
	
    }
	
	   public function destroy($id)
    {
        $email_temp = \App\StaticPages::findOrFail($id);
        $delete = $email_temp->delete();
        if(isset($delete)) {
        return redirect('admin/staticpages')
            ->with('message',
             'Page successfully Deleted.');
        }else{
            return redirect('admin/staticpages')
            ->with('message',
             'Action Failed Please try again.');
        }
    }
	
	
	  public function edit($id)
    {

     $static_page = \App\StaticPages::findOrFail($id); 

     $pagetitle='Edit Static Page';
     return view('static_pages.create',compact('static_page','pagetitle')); 
    }
 public function update(Request $request, $id)
    {
      //return $request;
        $this->validate($request, [
        'template_title'=>'required|max:120',
        'editor'=>'required',
        ]);

        $messagetemplate = \App\StaticPages::findOrFail($id); 
        $messagetemplate->title = serialize($request->template_title);
        $messagetemplate->page_type = $request->page_type;
        $messagetemplate->page_title = $request->page_title;
        $messagetemplate->content = serialize($request->editor);
        $flag = $messagetemplate->save();
        if($flag){
            return redirect()->route('staticpages.index')->with('message','Static Pages  successfully added.');
        }else{
            return redirect()->route('staticpages.index')->with('message','Action Failed Please try again.');
        }
    }
   public function changeStaticPagesStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $banner = \App\StaticPages::findOrFail($id);
        $banner->IsActive = $status;
        if($status){
            $message = 'Static Pages Template successfully Active';
        } else {
             $message = 'Static Pages Template successfully Deactive';
        }
        $flag = $banner->save();
        if($flag){
            echo json_encode(['status'=>true,'message'=>$message]);
        }else{
            echo json_encode(['status'=>false,'message'=>'Operation Failed']);
        }
    }
	
}
