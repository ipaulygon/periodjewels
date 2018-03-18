<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Response;
use Session;
use DB;
use Illuminate\Validation\Rule;
use App\Gem;
use App\Jewelry;
use App\Product;
use App\ProductCertificate;
use App\ProductPrice;
use App\ProductImage;
use App\Country;
use Illuminate\Support\Facades\Storage;

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
            ->orderBy('name')
            ->select('j.*')
            ->get();
        $gems = DB::table('gem as g')
            ->where('isActive',1)
            ->orderBy('name')
            ->select('g.*')
            ->get();
        $countries = Country::countries();
        return View('product.index',compact('products','gems','jewelries','countries'));
    }

    public function GetData($set){
        return Product::where('isActive',$set)->get();
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
        $rules = [
            'gem' => 'required',
            'jewelry' => 'required',
            'carat' => 'required',
            'color' => 'max:50',
            'clarity' => 'max:50',
            'cut' => 'max:50',
            'origin' => 'max:50',
            'description' => 'required',
            'price' => 'required',
            'certificate.*' => 'required',
            'image.*' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'gem' => 'Gem Stone',
            'jewelry' => 'Jewelry',
            'carat' => 'Carat',
            'color' => 'Color',
            'clarity' => 'Clarity',
            'cut' => 'Cut',
            'origin' => 'Origin',
            'description' => 'Description',
            'price' => 'Price',
            'certificates.*' => 'Certificate(s)',
            'images.*' => 'Image(s)'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            try{
                DB::beginTransaction();
                $product = Product::create([
                    'gemId' => trim($request->gem),
                    'jewelryId' => trim($request->jewelry),
                    'carat' => str_replace(',','',$request->carat),
                    'color' => trim($request->color),
                    'clarity' => trim($request->clarity),
                    'cut' => trim($request->cut),
                    'origin' => trim($request->origin),
                    'description' => trim($request->description),
                    'price' => str_replace(',','',$request->price)
                ]);
                ProductPrice::create([
                    'productId' => $product->id,
                    'price' => str_replace(',','',$request->price)                    
                ]);
                $certificates = $request->file('certificate');
                $images = $request->file('image');
                $s3 = Storage::disk('s3');
                if(!empty($certificates)){
                    foreach ($certificates as $key => $certificate) {
                        $date = date("Ymdhis".substr((string)microtime(), 1, 8));
                        $extension = $certificate->getClientOriginalExtension();
                        $certificateFile = "certificates/".$date.'.'.$extension;
                        // $certificate->move("certificates",$certificateFile);
                        $s3->put($certificateFile,file_get_contents($certificate),'certificates');
                        ProductCertificate::create([
                            'productId' => $product->id,
                            'certificate' => $certificateFile
                        ]);
                    }
                }
                if(!empty($images)){
                    foreach ($images as $key => $image) {
                        $date = date("Ymdhis".substr((string)microtime(), 1, 8));
                        $extension = $image->getClientOriginalExtension();
                        $imageFile = "images/".$date.'.'.$extension;
                        // $image->move("images",$imageFile);
                        $s3->put($imageFile,file_get_contents($image),'images');
                        ProductImage::create([
                            'productId' => $product->id,
                            'image' => $imageFile,
                            'isMain' => ($key == $request->main ? 1 : 0)
                        ]);
                    }
                }
                DB::commit();
                $request->session()->flash('success', 'Successfully added.');
                $products = $this->GetData(1);
                return view('product.active',compact('products'));
            }catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                $request->session()->flash('error', 'Please check your network connection');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return View('layouts.404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return View('layouts.404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'gem' => 'required',
            'jewelry' => 'required',
            'carat' => 'required',
            'color' => 'max:50',
            'clarity' => 'max:50',
            'cut' => 'max:50',
            'origin' => 'max:50',
            'description' => 'required',
            'price' => 'required',
            'certificate.*' => 'required',
            'image.*' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'gem' => 'Gem Stone',
            'jewelry' => 'Jewelry',
            'carat' => 'Carat',
            'color' => 'Color',
            'clarity' => 'Clarity',
            'cut' => 'Cut',
            'origin' => 'Origin',
            'description' => 'Description',
            'price' => 'Price',
            'certificates.*' => 'Certificate(s)',
            'images.*' => 'Image(s)'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            try{
                DB::beginTransaction();
                $product = Product::findOrFail($request->idUpdate);
                $product->update([
                    'gemId' => trim($request->gem),
                    'jewelryId' => trim($request->jewelry),
                    'carat' => str_replace(',','',$request->carat),
                    'color' => trim($request->color),
                    'clarity' => trim($request->clarity),
                    'cut' => trim($request->cut),
                    'origin' => trim($request->origin),
                    'description' => trim($request->description),
                    'price' => str_replace(',','',$request->price)
                ]);
                ProductPrice::create([
                    'productId' => $product->id,
                    'price' => str_replace(',','',$request->price)                    
                ]);
                $certificates = $request->file('certificate');
                $images = $request->file('image');
                $s3 = Storage::disk('s3');
                if(!empty($certificates)){
                    foreach($product->certificate as $certificate){
                        (file_exists($certificate->certificate) ? unlink($certificate->certificate) : '');
                    }
                    ProductCertificate::where('productId',$product->id)->delete();
                    foreach ($certificates as $key => $certificate) {
                        $date = date("Ymdhis".substr((string)microtime(), 1, 8));
                        $extension = $certificate->getClientOriginalExtension();
                        $certificateFile = "certificates/".$date.'.'.$extension;
                        // $certificate->move("certificates",$certificateFile);
                        $s3->put($certificateFile,file_get_contents($certificate),'certificates');
                        ProductCertificate::create([
                            'productId' => $product->id,
                            'certificate' => $certificateFile
                        ]);
                    }
                }
                if(!empty($images)){
                    foreach($product->image as $image){
                        (file_exists($image->image) ? unlink($image->image) : '');
                    }
                    ProductImage::where('productId',$product->id)->delete();                    
                    foreach ($images as $key => $image) {
                        $date = date("Ymdhis".substr((string)microtime(), 1, 8));
                        $extension = $image->getClientOriginalExtension();
                        $imageFile = "images/".$date.'.'.$extension;
                        // $image->move("images",$imageFile);
                        $s3->put($imageFile,file_get_contents($image),'images');
                        ProductImage::create([
                            'productId' => $product->id,
                            'image' => $imageFile,
                            'isMain' => ($key == $request->main ? 1 : 0)
                        ]);
                    }
                }else{
                    ProductImage::where('productId',$request->idUpdate)->update(['isMain'=>0]);
                    $images = ProductImage::where('productId',$request->idUpdate)->get();
                    $images[$request->main]->update(['isMain'=>1]);
                }
                DB::commit();
                $request->session()->flash('success', 'Successfully updated.');
                $products = $this->GetData(1);
                return view('product.active',compact('products'));
            }catch(\Illuminate\Database\QueryException $e){
                DB::rollBack();
                $errMess = $e->getMessage();
                $request->session()->flash('error', 'Please check your network connection');
            }
        }
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
