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

        //Верифицируем current_user
        $user_id = (int)$r->current_user;
        if (gettype($user_id)!="integer") {
            $currentUser = User::select('id')->orderBy('id', 'asc')->get();
            $user_id = $currentUser[0]->id; 
        } else {
            $currentUser = User::where('id',$user_id)->select('id')->first();
            if ($currentUser) {
                $user_id = $currentUser->id;
            } else {
                $currentUser = User::select('id')->orderBy('id', 'asc')->get();
                $user_id = $currentUser[0]->id; 
            }
        }

        //Верификация current_section
        $current_section = (int)$r->current_section;
        if (gettype($current_section)!="integer") {
            $currentSection = Section::select('id')->orderBy('id', 'asc')->get();
            $current_section = $currentSection[0]->id; 
        } else {
            $currentSection = Section::where('id',$current_section)->select('id')->first();
            if ($currentSection) {
                $current_section = $currentSection->id;
            } else {
                $currentSection = Section::select('id')->orderBy('id', 'asc')->get();
                $current_section = $currentSection[0]->id; 
            }
        }
        
        //Пользователи
        $users = User::select('id','name')->get();

        //Разделы
        $sections = Section::select('id','name')->get();

        //Темы с разрешениями по пользователю
        $res = User::where('id',$user_id)->select('allowed_themes')->first();
        $permitions = json_decode($res->allowed_themes);

        $themes = Theme::where('section',$current_section)->select('id','sort','name')->get();

        $themes_with_permissions = [];

        for ($i=0;$i<count($themes);$i++) {
            $permission=false;
            
            if ($permitions) {
                for ($j=0;$j<count($permitions);$j++) {
                    if ($permitions[$j]->id == $themes[$i]->id) {
                        $permission = $permitions[$j]->allowed;
                        break;
                    }
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
            'current_user'=>$user_id,
            'current_section'=>$current_section,
            'status'=>'success',
            'users'=>$users,
            'sections'=>$sections,
            'themes'=>$themes_with_permissions,
        ];
        return $data;
    }

    public function setPermition(Request $r) {
        if ($r->token != "sdfsdfsdfsdfsdf") {
            return [
                'status'=>'notfound',
                'message'=>'Something went wrong.'
            ];
        }

        $res = User::where('id',$r->current_user)->select('allowed_themes')->first();

        if (!$res) {
            return [
                'status'=>'error',
                'message'=>'Something went wrong.'
            ];
        }
        $permitions = json_decode($res->allowed_themes);
        $isDone = false;//Установили разрешение или нет
        
        if (gettype($permitions)=='array') {
            for ($i=0;$i<count($permitions);$i++) {
                if ($permitions[$i]->id == $r->theme_id) {
                    $permitions[$i]->allowed = $r->permition;
                    $isDone = true;
                    break;
                }
            }
    
            if (!$isDone) {
                array_push($permitions,[
                    "id"=>$r->theme_id,
                    "allowed"=>$r->permition
                ]);
            }            
        } else {
            $permitions = [
                [
                    "id"=>$r->theme_id,
                    "allowed"=>$r->permition
                ]
            ];
        }



        $jsonData = json_encode($permitions);

        $res = User::where('id',$r->current_user)->update(['allowed_themes'=>$jsonData]);

        if ($res) {
            $status = 'success';
            $message = 'That is ok';
        } else {
            $status = 'error';
            $message = 'Somethink went wrong';  
        }

        $data = [
            'status'=>$status,
            'message'=>$message
        ];

        return $data;
    }

    public function getDataForParagraphsEdit(Request $r) {
        if ($r->token != "sdfsdfsdfsdfsdf") {
            return [
                'status'=>'notfound',
                'message'=>'Something went wrong.'
            ];
        }

        // //Верифицируем current_user
        // $user_id = (int)$r->current_user;
        // if (gettype($user_id)!="integer") {
        //     $currentUser = User::select('id')->orderBy('id', 'asc')->get();
        //     $user_id = $currentUser[0]->id; 
        // } else {
        //     $currentUser = User::where('id',$user_id)->select('id')->first();
        //     if ($currentUser) {
        //         $user_id = $currentUser->id;
        //     } else {
        //         $currentUser = User::select('id')->orderBy('id', 'asc')->get();
        //         $user_id = $currentUser[0]->id; 
        //     }
        // }

        //Верификация current_section
        $current_section = (int)$r->current_section;
        if (gettype($current_section)!="integer") {
            $currentSection = Section::select('id')->orderBy('id', 'asc')->get();
            $current_section = $currentSection[0]->id; 
        } else {
            $currentSection = Section::where('id',$current_section)->select('id')->first();
            if ($currentSection) {
                $current_section = $currentSection->id;
            } else {
                $currentSection = Section::select('id')->orderBy('id', 'asc')->get();
                $current_section = $currentSection[0]->id; 
            }
        }

        //Верификация current_theme
        $current_theme = (int)$r->current_theme;

        if (gettype($current_theme)!="integer") {
            $currentTheme = Theme::select('id','sort')->where('section',$current_section)->orderBy('sort', 'asc')->get();            
            $current_theme = $currentTheme[0]->id; 
        } else {
            $currentTheme = Theme::where('id',$current_theme)->where('section',$current_section)->select('id')->first();
            if ($currentTheme) {
                $current_theme = $currentTheme->id;
            } else {
                $currentTheme = Theme::select('id','sort')->where('section',$current_section)->orderBy('sort', 'asc')->get();
                if (count($currentTheme)==0) {
                    $current_theme=null;
                } else {
                    $current_theme = $currentTheme[0]->id; 
                }
            }
        }
        
        //Достаем параграфы

        if ($current_theme == null) {
            $paragraphs = null;
        } else {
            $paragraphs = Paragraph::where('theme',$current_theme)->select('id','content','sort')->get();
            if (count($paragraphs)==0) $paragraphs = null;
        }

        // //Пользователи
        // $users = User::select('id','name')->get();

        // //Разделы
        // $sections = Section::select('id','name')->get();

        // //Темы с разрешениями по пользователю
        // $res = User::where('id',$user_id)->select('allowed_themes')->first();
        // $permitions = json_decode($res->allowed_themes);

        // $themes = Theme::where('section',$current_section)->select('id','sort','name')->get();

        // $themes_with_permissions = [];

        // for ($i=0;$i<count($themes);$i++) {
        //     $permission=false;
            
        //     if ($permitions) {
        //         for ($j=0;$j<count($permitions);$j++) {
        //             if ($permitions[$j]->id == $themes[$i]->id) {
        //                 $permission = $permitions[$j]->allowed;
        //                 break;
        //             }
        //         }
        //     }


        //     $themes_with_permissions[$i] = [
        //         'theme_id'=>$themes[$i]->id,
        //         'theme'=>$themes[$i]->name,
        //         'sort'=>$themes[$i]->sort,
        //         'permission'=>$permission
        //     ];
        // }

        //Результирующий набор данных
        $data = [
            // 'current_user'=>$user_id,
            'status'=>'success',
            'current_section'=>$current_section,
            'current_theme'=>$current_theme,
            'paragraphs' => $paragraphs
            // 'sections'=>$sections
        ];
        return $data;
    }


}
