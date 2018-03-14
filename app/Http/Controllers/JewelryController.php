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

class JewelryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jewelries = DB::table('jewelry as j')
            ->where('isActive',1)
            ->orderBy('name','desc')
            ->select('j.*')
            ->get();
        return View('jewelry.index', compact('jewelries'));
    }

    public function GetData($set){
        return DB::table('jewelry as j')
            ->where('isActive',$set)
            ->orderBy('name','desc')
            ->select('j.*')
            ->get();
    }

    public function switch(Request $request){
        $jewelries = $this->GetData($request->set);
        if($request->set == 1){
            return view('jewelry.active',compact('jewelries'));            
        }
        return view('jewelry.inactive',compact('jewelries'));
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
            'name' => 'required|unique:jewelry|max:50',
            'description' => 'max:100',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'name' => 'Jewelry',
            'description' => 'Description',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            try{
                DB::beginTransaction();
                Jewelry::create([
                    'name' => trim($request->name),
                    'description' => trim($request->description)
                ]);
                DB::commit();
                $request->session()->flash('success', 'Successfully added.');
                $jewelries = $this->GetData(1);
                return view('jewelry.active',compact('jewelries'));
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
            'name' => ['required','max:50',Rule::unique('jewelry')->ignore(trim($request->idUpdate))],
            'description' => 'max:100',
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'name' => 'Jewelry',
            'description' => 'Description',
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            try{
                DB::beginTransaction();
                $jewelry = Jewelry::findOrFail($request->idUpdate);
                $jewelry->update([
                    'name' => trim($request->name),
                    'description' => trim($request->description)
                ]);
                DB::commit();
                $request->session()->flash('success', 'Successfully updated.');
                $jewelries = $this->GetData(1);
                return view('jewelry.active',compact('jewelries'));
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
            $jewelry = Jewelry::findOrFail($request->id);
            $jewelry->update([
                'isActive' => 0
            ]);
            DB::commit();
            $request->session()->flash('success', 'Successfully deactivated.');
            $jewelries = $this->GetData(1);
            return view('jewelry.active',compact('jewelries'));
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $errMess = $e->getMessage();
            $request->session()->flash('error', 'Please check your network connection');
        }
    }

    public function reactivate(Request $request){
        try{
            DB::beginTransaction();
            $jewelry = Jewelry::findOrFail($request->id);
            $jewelry->update([
                'isActive' => 1
            ]);
            DB::commit();
            $request->session()->flash('success', 'Successfully reactivated.');
            $jewelries = $this->GetData(1);
            return view('jewelry.active',compact('jewelries'));
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollBack();
            $errMess = $e->getMessage();
            $request->session()->flash('error', 'Please check your network connection');
        }
    }
}
