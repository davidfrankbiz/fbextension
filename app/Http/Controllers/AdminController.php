<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cookies;

class AdminController extends Controller
{
    $data = Cookies::get()->toArray();
echo "<pre>"; print_r($data); die();
    return view('home',compact('data'));
}
