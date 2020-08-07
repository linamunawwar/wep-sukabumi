<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $connection = 'mysql';
    protected $table = "permissions";
    public $timestamps = true;

    public function menu()
    {
        return $this->belongsTo('App\Menu','id_menu','id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User','id_user','id');
    }

    public static function getSelectPermission($selected='')
    {
        $html = '<select id="id_menu" name="id_menu" style="width:100%" required id="select" class="form-control col-md-7 col-xs-12 select">';
        $data = Menu::where('id_parent', 0)->orderBy('nama')->get();
		$html .= '<option value=""> --- </option>';
        
        foreach ($data as $row) {
            $s = $row->id==$selected?'selected="selected"':'';
            $html .= '<optgroup label="'.$row->nama.'">';
            $subMenu = Menu::where('id_parent', '=', $row->id)->where('active', '=', 1)->orderBy('nama')->get();
            if (count($subMenu) > 0) {
                foreach ($subMenu as $sub) {
                    $s = $sub->id==$selected?'selected="selected"':'';
                    $html .= '<option '.$s.' value="'.$sub->id.'">&nbsp;&nbsp;&nbsp;'.$sub->nama.'</option>';
                }
            }else {
                $html .= '<option '.$s.' value="'.$row->id.'">'.$row->nama.'</option>';
            }
        }

        $html .= '</select>';
		return $html;
    }
}
