<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use App\Roles;
use App\Icon;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::orderBy('urutan', 'asc')
                    ->get();

        return view('admin.admin_permission.menu.index', compact('menu'));
    }

    public function create()
    {
        $menu = Menu::where('id_parent', 0)
                    ->get();
        $roles = Roles::all();
        
        return view('admin.admin_permission.menu.create', compact('menu','roles'));
    }

    public function store()
    {
    	date_default_timezone_set("Asia/Jakarta");
        $id_parent = \Input::get('id_parent')?\Input::get('id_parent'):0;
        $nama = \Input::get('nama');
        $urutan = \Input::get('urutan');
        $alias = \Input::get('alias');
        $direktori = \Input::get('direktori');        
        $icon = \Input::get('icon');        
        $active = \Input::get('active')?\Input::get('active'):0;        
        $default_role = \Input::get('default_role');        

        $menu = new Menu;
        $menu->id_parent = $id_parent;
        $menu->nama = $nama;
        $menu->urutan = $urutan;
        $menu->alias = $alias;
        $menu->direktori = $direktori;
        $menu->icon = $icon;
        $menu->active = $active;
        $menu->default_role = $default_role;
        $query_Menu = $menu->save();

        if($query_Menu){
            return Redirect('admin/menu')->with(['msg'=>'Data berhasil ditambahkan','status'=>1]);
        }else{
            return Redirect('admin/menu')->with(['msg'=>'Terdapat Kesalahan','status'=>0]);
        }
    }

    public function edit($id)
    {   
        $select = Menu::where('id_parent', 0)
                    ->get();
        $menu = Menu::find($id);
        $roles = Roles::all();
        
        return view('admin.admin_permission.menu.edit', compact('menu', 'select','roles'));
    }

    public function update($id)
    {
    	date_default_timezone_set("Asia/Jakarta");
    	$data = \Input::all();
        $find = Menu::find($id);    

    	$menu['id_parent'] = $data['id_parent'];
    	$menu['nama'] = $data['nama'];
    	$menu['urutan'] = $data['urutan'];
    	$menu['alias'] = $data['alias'];
    	$menu['direktori'] = $data['direktori'];
    	$menu['icon'] = $data['icon'];
    	$menu['active'] = $data['active'];
    	$menu['default_role'] = $data['default_role'];
    	$update = Menu::where('id',$id)->update($menu);

    	return redirect('/admin/menu');
    }

    public function delete($id)
    {
        $delete = Menu::where('id',$id)->delete();

    	if($delete){
            return 1;
        }else{
            return 0;
        }

    }
}
