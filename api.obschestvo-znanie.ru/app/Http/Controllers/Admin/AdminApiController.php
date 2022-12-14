<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Theme;
use App\Models\Paragraph;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminApiController extends Controller
{
    public function getDataForUserExtended(Request $r) {
        if ($r->token != "sdfsdfsdfsdfsdf") {
            return [
                'status'=>'notfound',
                'message'=>'Something went wrong.'
            ];
        }

        //Верифицируем user_id
        if (gettype($r->user_id)!="integer") {
            $user_id = User::
        }

        //Пользователи
        $users = User::select('id','name')->get();

        //Разделы
        $sections = Section::select('id','name')->get();

        //Темы с разрешениями по пользователю
        $res = User::where('id',$r->user_id)->select('allowed_themes')->first();
        $permissions = json_decode($res->allowed_themes);

        $themes = Theme::where('section',$r->section_id)->select('id','sort','name')->get();

        $themes_with_permissions = [];

        for ($i=0;$i<count($themes);$i++) {
            $permission=false;
            
            for ($j=0;$j<count($permissions);$j++) {
                if ($permissions[$j]->id == $themes[$i]->id) {
                    $permission = $permissions[$j]->allowed;
                    break;
                }
            }

            $themes_with_permissions[$i] = [
                'theme_id'=>$themes[$i]->id,
                'theme'=>$themes[$i]->name,
                'sort'=>$themes[$i]->sort,
                'permission'=>$permission
            ];
        }

        //Результирующий набор данных
        $data = [
            'status'=>'success',
            'users'=>$users,
            'sections'=>$sections,
            'themes'=>$themes_with_permissions,
        ];
        return $data;
    }
}
