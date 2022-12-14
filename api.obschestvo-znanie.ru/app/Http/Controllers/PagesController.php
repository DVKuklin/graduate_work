<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Theme;
use App\Models\Paragraph;
use App\Models\User;

class PagesController extends Controller
{
    function getSections() {
        return Section::orderBy('sort', 'asc')->get();
    }

    function getThemesAndSectionBySectionUrl(Request $r) {
        $section = Section::where('url',$r->section_url)->first();
        
        $themes = Theme::where('section',$section->id)->select('name','url','sort')->orderBy('sort', 'asc')->get();

        $data = [
            'section' => $section->name,
            'themes' => $themes
        ];

        return $data;
    }

    function getParagraphsBySectionAndThemeUrl(Request $r) {
        $res = User::where('custom_token',$r->token)
                    ->first();

        if ($res != null) {
            $section = Section::where('url',$r->section_url)->first();
        
            $theme = Theme::where('url',$r->theme_url)
                           ->where('section',$section->id)
                           ->select('id','name', 'sort')
                           ->first();
            
            $paragraphs = Paragraph::where('theme',$theme->id)
                            ->orderBy('sort', 'asc')
                            ->get();
    
            $data = [
                'status' => 'success',
                'section' => $section->name,
                'theme' => $theme->sort.". ".$theme->name,
                'paragraphs' => $paragraphs
            ];
            return $data;
        } else {
            return ['status'=>'notAuth'];
        }
    }

}
