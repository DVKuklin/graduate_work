<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Theme;
use App\Models\Paragraph;
use App\Models\User;

class CustomAdminController extends Controller
{
    public function users() {
        return view('custom_admin.custom-admin');
    }

}
