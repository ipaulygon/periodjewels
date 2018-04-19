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
use App\Product;
use App\Event;

class GuestController extends Controller
{
    private $util;

    public function GuestController()
    {
        $util = Utility::firstOrFail();
    }

    public function index(){
        $products = DB::select(DB::raw('
        SELECT p.*, pi.image, j.*
        FROM product as p
        JOIN product_image as pi ON pi.productId = p.id
        JOIN jewelry as j ON j.id = p.jewelryId
        LEFT OUTER JOIN product as pd ON (p.jewelryId = pd.jewelryId AND p.id < pd.id)
        GROUP BY p.id
        HAVING COUNT(*) < 2
        ORDER BY j.name
        '));
        return View('welcome',compact('util','products'));
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
