<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Response;
use Session;
use DB;
use Illuminate\Validation\Rule;
use App\Utility;
use App\Jewelry;
use App\Event;

class GuestController extends Controller
{
    private $util;

    public function GuestController()
    {
        $util = Utility::get()->first();
    } 

    public function index(){
        return View('welcome',compact('util'));
    }

    public function events(){
        $events = DB::table('event as e')
            ->where('isActive',1)
            ->orderBy('name','desc')
            ->select('e.*')
            ->get();
        return View('events',compact('util','events'));
    }

    public function about(){
        return View('about',compact('util'));
    }
}
