<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use App\Menu;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PermissionController extends Controller
{
    public function index()
    {
        $permission = Permission::get();
        return view('admin.admin_permission.permission.index', compact('permission'));
    }

    public function create()
    {
        $labelMenu = Menu::where('id_parent', 0)
                    ->get();
        $subMenu = Menu::get();
        $pegawai = User::get();
        
        return view('admin.admin_permission.permission.create', compact('labelMenu', 'subMenu', 'pegawai'));
    }

    public function store()
    {
        date_default_timezone_set("Asia/Jakarta");
        $id_menu = \Input::get('id_menu');
        $id_user = \Input::get('id_user');         
        
        $menu = Menu::where('id', $id_menu)->first();
        if($menu->id_parent != 0){
            //cek parent udah ada blm di table permission
            $cek = Permission::where('id_menu',$menu->id_parent)->where('id_user',$id_user)->first();
            //kalau belum ada create parent di permission dulu
            if(count($cek)==0){
                $permissionParent= new Permission;
                $permissionParent->id_menu = $id_menu;
                $permissionParent->id_user = $id_user;
                $query_permissionParent= $permissionParent->save();
            }
        }

        $permission = new Permission;
        $permission->id_menu = $id_menu;
        $permission->id_user = $id_user;
        $query_permission = $permission->save();

        if($query_permission){
            return Redirect('admin/permission')->with(['msg'=>'Data berhasil ditambahkan','status'=>1]);
        }else{
            return Redirect('admin/permission')->with(['msg'=>'Terdapat Kesalahan','status'=>0]);
        }
    }

    public function edit($id)
    {   
        // $labelMenu = Menu::where('id_parent', 0)
        //             ->get();
        // $subMenu = Menu::get();
        $pegawai = User::get();
        $permission = Permission::where('id', $id)->first();
        $menu = Permission::getSelectPermission($permission->id_menu);      

        // dd($permission);
        
        return view('admin.admin_permission.permission.edit', compact('menu', 'pegawai', 'permission'));
    }

    public function update($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
    	$data = \Input::all();
        $find = Permission::find($id);    

    	$permission['id_menu'] = $data['id_menu'];
    	$permission['id_user'] = $data['id_user'];
    	$update = Permission::where('id',$id)->update($permission);

    	return redirect('/admin/permission');
    }

    public function delete($id)
    {
        $delete = Permission::where('id',$id)->delete();

    	if($delete){
            return 1;
        }else{
            return 0;
        }

    }
}
