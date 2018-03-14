<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Response;
use Session;
use DB;
use Illuminate\Validation\Rule;
use App\Jewelry;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('isActive',1)->get();
        $jewelries = DB::table('jewelry as j')
            ->where('isActive',1)
            ->orderBy('name','desc')
            ->select('j.*')
            ->get();
        return View('product.index',compact('products','jewelries'));
    }

    public function GetData($set){
        return Product::where('isActive',$set)->orderBy('name')->get();
    }

    public function switch(Request $request){
        $products = $this->GetData($request->set);
        if($request->set == 1){
            return view('product.active',compact('products'));            
        }
        return view('product.inactive',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('layouts.404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            DB::beginTransaction();
            $product = Product::findOrFail($request->id);
            $product->update([
                'isActive' => 0
            ]);
            DB::commit();
            $request->session()->flash('success', 'Successfully deactivated.');
            $products = $this->GetData(1);
            return view('product.active',compact('products'));
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $errMess = $e->getMessage();
            $request->session()->flash('error', 'Please check your network connection');
        }
    }

    public function reactivate(Request $request){
        try{
            DB::beginTransaction();
            $product = Product::findOrFail($request->id);
            $product->update([
                'isActive' => 1
            ]);
            DB::commit();
            $request->session()->flash('success', 'Successfully reactivated.');
            $products = $this->GetData(1);
            return view('product.active',compact('products'));
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $errMess = $e->getMessage();
            $request->session()->flash('error', 'Please check your network connection');
        }
    }
}
