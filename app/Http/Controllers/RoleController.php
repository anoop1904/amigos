<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Session;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{  

    public function __construct() 
    {
       // $this->middleware(['auth', 'isAdmin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(Auth::user()->user_type ==config('constants.SUPER_ADMIN')){

            $roles = Role::all();

        }else{
            $roles = Role::orwhere(['CreatedBy'=>Auth::user()->id,'CreatedBy'=>config('constants.SUPER_ADMIN')])->where('userid','!=','2')->get();
        }
        $parentPermissions = Permission::where('parent_id','0')->orderBy('permission_order')->get()->toArray();
        foreach ($parentPermissions as $key => $value) {
            $result[$key]['parent'] = $value;
            $result[$key]['child'] = Permission::where('parent_id',$value['id'])->orderBy('permission_order')->get()->toArray();
        }

        return view('roles.index')->with('roles', $roles)->with('result', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();

        return view('roles.create', ['permissions'=>$permissions]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            //'name'=>'required|unique:roles|max:30',
            'name'=>'required|max:30',
            'permissions' =>'required',
            ]
        );

        $name = $request['name'];
        $role = new Role();
        $role->name = $name;
        $role->userType = 1;
        $role->createdby = Auth::user()->id;
        $role->userid = Auth::user()->id;

        $permissions = $request['permissions'];

        $role->save();

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail();
            $role = Role::where('name', '=', $name)->first();
            $role->givePermissionTo($p);
        }

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role'. $role->name.' added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect('roles');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $role = Role::findOrFail($id);
        //$permissions = Permission::all();
        //$parentPermissions = Permission::where('parent_id','!=','0')->orderBy('permission_order')->get();
        //$childPermissions = Permission::where('parent_id','0')->orderBy('permission_order')->get();

        $parentPermissions = Permission::where('parent_id','0')->orderBy('permission_order')->get()->toArray();
        foreach ($parentPermissions as $key => $value) {
            $result[$key]['parent'] = $value;
            $result[$key]['child'] = Permission::where('parent_id',$value['id'])->orderBy('permission_order')->get()->toArray();
        }
        $roles = Role::all();
         //dd($id);

        return view('roles.index', compact('role','roles','result'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd('1');
        $role = Role::findOrFail($id);
        $this->validate($request, [
            //'name'=>'required|max:30|unique:roles,name,'.$id,
            'name'=>'required|max:30',
            'permissions' =>'required',
        ]);

        $input = $request->except(['permissions']);
        $permissions = $request['permissions'];
        // $parentPermissions = Permission::where('parent_id','!=','0')->orderBy('permission_order')->get();
        // $childPermissions = Permission::where('parent_id','0')->orderBy('permission_order')->get();
        $role->fill($input)->save();
        $p_all = Permission::all();

        foreach ($p_all as $p) {
            $role->revokePermissionTo($p);
        }

        foreach ($permissions as $permission) {
            $p = Permission::where('id', '=', $permission)->firstOrFail(); //Get corresponding form permission in db
            $role->givePermissionTo($p);  
        }

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role'. $role->name.' updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')
            ->with('flash_message',
             'Role deleted!');
    }
}
