<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Websitesetting;
use App\Plan;
class WebsiteController extends Controller
{
    public function index()
    {  
        $webseting = Websitesetting::first();
        $pagetitle='Website Setting';
        return view('admin/websitesetting',compact('webseting','pagetitle'));
    }


    public function websettingupd(Request $request)
    {   
        $this->validate($request, [
            'near_by_distance'               => 'required',
            'shpping_charge' =>'max:4',
        ]);

        

        //return $request;
        $data  = $request->all();
        //return $data;
        $websitesetting = Websitesetting::findOrFail($data['id']);
        //$websitesetting->fill($data)->save();
        $websitesetting->website_name = $data['website_name'];
        $websitesetting->near_by_distance = $data['near_by_distance'];
        $websitesetting->email = $data['email'];
		$websitesetting->whatapps_no = $data['whatapps_no'];
		$websitesetting->sapport_no = $data['sapport_no'];
        $websitesetting->address = $data['address'];
        $websitesetting->mobile = $data['mobile'];
        $websitesetting->shpping_charge = $data['shpping_charge'];
        $websitesetting->save();
        if($websitesetting){
            return \Redirect::back()->with('message','Update Successfully');
        }else{
            return \Redirect::back()->with('message','Action Failed...');
        }
       
    }
	
	public function StaticPageEditor(Request $request){
		DD('DD');
	}


}
