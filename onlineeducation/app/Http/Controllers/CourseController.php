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
use App\Videourl;
use Validator;
//use Illuminate\Support\Facades\Hash;

class CourseController extends Controller
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
        $course = \App\Course::with(['category_list','sub_category_list'])->orderBy('id','DESC');
        
        if(isset($_GET['name']))
        {
          if($_GET['name']!='')
          {
           $course->where('name','LIKE','%'.$_GET['name'].'%');
          }           
        }

        if(isset($_GET['category_id']))
        {
          if($_GET['category_id']!='all' && $_GET['category_id']!='')
          {
           $course->where('category_id',$_GET['category_id']);
          }           
        }
        

        if(isset($_GET['shortby']))
        {
          if($_GET['shortby']!='all')
          {
            $course->orderBy('total_credit',$_GET['shortby']);
          }
        }
        else
        {
            $course->orderBy('id','DESC');
        }
        
        if(isset($_GET['status']))
        {
          if($_GET['status']!='' && $_GET['status']!='all'){
             
              if($_GET['status']=='active' ){
               $course->where('IsActive',1);
              }
              if($_GET['status']=='deactive' ){
               $course->where('IsActive',0);
              }

          }           
        }
        
        
        $courselist= $course->paginate(20);
        $pagetitle='Course Management';
        $categories = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
        $sub_categories = \App\Category::where('parent_id','!=',0)->get();
        return view('course.index',compact('courselist','pagetitle','categories'));
    }

    public function create()
    {
        $pagetitle='Course Create';
        $categories = \App\Category::where(['IsActive'=>1,'parent_id'=>0])->get();
        $sub_categories = [];
        return view('course.create',compact('pagetitle','categories','sub_categories'));
    }


   public function edit($id)
    {
        $course = \App\Course::with(['videourl'])->findOrFail($id); 
        if($course->IsSale==1)
        {
           return redirect()->route('course.index')->with('message','You can not edit this course because this course is already sale.');
        }
        $sub_categories = [];
        $sub_sub_categories = [];
        if($course->category_id)
        $sub_categories = \App\Category::where(['parent_id'=>$course->category_id])->get();

        if($course->sub_category_id)
        $sub_sub_categories = \App\Category::where(['parent_id'=>$course->sub_category_id])->get();       

        $pagetitle='Course Edit';
        $categories = \App\Category::where(['IsActive'=>1])->get();
        return view('course.create',compact('course','pagetitle','categories','sub_categories')); 
    }

   public function store(Request $request)
    {
      
        $this->validate($request, [
            'name'=>'required|max:120|unique:tbl_course',
            'plan_id'=>'required',
        ]);
   
         $course = new \App\Course(); 
         $course->name     = $request->name;
         // $course->category_id = $request->category_id;
         // $course->sub_category_id = $request->sub_category; 
         $course->price = $request->price;   
         $course->meta_data = $request->meta_data;   
         $course->meta_description = $request->meta_description;   
         $course->discount = $request->discount;   
         $course->price = $request->price;   
         $course->discount_type = $request->discount_type;   
         $course->description = $request->description;   
         $course->short_description = $request->short_description;   
         $course->plan_id = $request->plan_id;   
         $course->created_by = Auth::user()->id; 
         $destinationPath = public_path('/assets/img/course');
        if($request->hasFile('file')) {
            $image = $request->file('file');
            if($image){
                $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                $image->move($destinationPath, $input['imagename']);
                $img=$input['imagename'];
                $course->image = $img;
            }
        }
         $flag = $course->save();
        // dd($flag);
        
   if($files=$request->file('videoimg')){
        foreach($files as $file){
              $name=uniqid().'.'.$file->getClientOriginalExtension();
              $file->move($destinationPath,$name);
              $url = 'public/assets/img/course/'.$name;
              $images[]=asset($url);
        }
    }
   // print_r($images);
         $videolist=$request->video_link;  
          for ($i=0; $i <count($videolist) ; $i++) 
          { 
                    \App\Videourl::create([
                            'course_id' =>$course->id,
                            'video_url' =>$videolist[$i],
                            'image' =>$images[$i],
                      ]);

          }
        if($flag) {
            return redirect()->route('course.index')->with('message','Course Created successfully.');
        }else{
            return redirect()->route('course.index')->with('message','Action Failed Please try again.');
        }
    }

     public function update(Request $request, $id)
     {
            //return $request;
            $this->validate($request, [
                'name'=>'required|max:120|unique:tbl_course,name,'.$id,
                'plan_id'=>'required',
               
            ]);

             $course = \App\Course::findOrFail($id); 
             $course->name     = $request->name;
             // $course->category_id = $request->category_id;
             // $course->sub_category_id = $request->sub_category; 
             $course->price = $request->price;   
             $course->meta_data = $request->meta_data;   
             $course->meta_description = $request->meta_description;   
             $course->discount = $request->discount;   
             $course->price = $request->price;   
             $course->discount_type = $request->discount_type;   
             $course->description = $request->description;   
             $course->short_description = $request->short_description;   
             $course->plan_id = $request->plan_id;   
             //$course->video_url = $request->video_link; 
        
            if($request->hasFile('file')) {
                $image = $request->file('file');
                if($image){
                    $path = public_path('/assets/img/course/');  
                    if($course->image)
                    {
                    unlink($path.$course->image);
                    }

                    $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
                    $destinationPath = public_path('/assets/img/course');
                    $image->move($destinationPath, $input['imagename']);
                    $img=$input['imagename'];
                    $course->image = $img;
                }
            }

                $flag = $course->save();
                $video = Videourl::where('course_id',$id);
                $delete = $video->delete();  
                $destinationPath = public_path('/assets/img/course'); 
                $oldimg=$request->oldimg; 
                for ($i=0; $i <count($oldimg) ; $i++) 
                  {
                    $images[]=$oldimg[$i];
                 }
               if($files=$request->file('videoimg')){
                foreach($files as $key=>$file){
                     
                           $name=uniqid().'.'.$file->getClientOriginalExtension();
                           $file->move($destinationPath,$name);
                           $url = 'public/assets/img/course/'.$name;
                           $images[$key]=asset($url);
                    }
                }
           
                  
                 $videolist=$request->video_link;  
                  for ($i=0; $i <count($videolist) ; $i++) 
                  { 
                            \App\Videourl::create([
                                    'course_id' =>$id,
                                    'video_url' =>$videolist[$i],
                                    'image' =>$images[$i],
                              ]);

                  }

            if($flag) {
                return redirect()->route('course.index')->with('message','Course Update successfully.');
            }else{
                return redirect()->route('course.index')->with('message','Action Failed Please try again.');
            }
     }
   

   public function destroy($id)
    {
        $course = \App\Course::findOrFail($id);
        // $path = public_path('/assets/img/course/');  
        // if($course->image)
        // {
        // unlink($path.$course->image);
        // }
        $delete = $course->delete();
        if(isset($delete)) {
        return redirect()->route('course.index')
            ->with('message',
             'Course successfully Deleted.');
        }else{
            return redirect()->route('course.index')
            ->with('message',
             'Action Failed Please try again.');
        }
    }

    public function courseStatus($id, $key)
    {
        $course = \App\Course::findOrFail($id);
        if($key === 'active'){
            $course->status = 1;
            $message = 'Course successfully Active';

        }
        if($key === 'deactive'){
            $course->status = 0;
             $message = 'Course successfully Deactive';
        }
        $flag = $course->save();
        if($flag){
            return redirect()->route('course.index')->with('message',$message);
        }else{
            return redirect()->route('course.index')->with('message','Operation failed please try again.');
        }
        
    }

   
    public function changeCourseStatus(Request $request)
    {
        $id = $request->cat_id;
        $status = $request->status;
        $course = \App\Course::findOrFail($id);
        $course->IsActive = $status;
        if($status){
            $message = 'Course successfully Active';
        } else {
             $message = 'Course successfully Deactive';
        }
        $flag = $course->save();
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
