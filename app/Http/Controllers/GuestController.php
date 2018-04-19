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
        SELECT *
        FROM product AS p
        JOIN product_image AS pi
        WHERE p.id IN (
            SELECT TOP 2 id
            FROM product as p
            WHERE p.jewelry = p.jewelry
            ORDER BY ID DESC)
        ORDER BY p.id;
        '));
        // $products = Product::where('isActive',1)->get();
        return $products;
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
