<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Redirect;
use Response;
use Session;
use DB;
use Illuminate\Validation\Rule;
use App\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = DB::table('event as e')
            ->where('isActive',1)
            ->orderBy('name','desc')
            ->select('e.*')
            ->get();
        return View('event.index', compact('events'));
    }

    public function GetData($set){
        return DB::table('event as e')
            ->where('isActive',$set)
            ->orderBy('name','desc')
            ->select('e.*')
            ->get();
    }

    public function switch(Request $request){
        $events = $this->GetData($request->set);
        if($request->set == 1){
            return view('event.active',compact('events'));            
        }
        return view('event.inactive',compact('events'));
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
            'name' => 'required|unique:event|max:50',
            'date' => 'required',
            'address' => 'required',
            'description' => 'max:200',
            'valid' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'name' => 'Event',
            'Date' => 'Date',
            'Address' => 'Address',
            'description' => 'Description',
            'valid' => 'Valid Address'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            try{
                DB::beginTransaction();
                $dates = explode('-',trim($request->date)); // two dates MM/DD/YYYY-MM/DD/YYYY
                $startDate = explode('/',$dates[0]); // MM[0] DD[1] YYYY[2] 
                $finalStartDate = "$startDate[2]-$startDate[0]-$startDate[1]";
                $endDate = explode('/',$dates[1]); // MM[0] DD[1] YYYY[2] 
                $finalEndDate = "$endDate[2]-$endDate[0]-$endDate[1]";
                Event::create([
                    'name' => trim($request->name),
                    'startDate' => str_replace(' ','',$finalStartDate),
                    'endDate' => str_replace(' ','',$finalEndDate),
                    'address' => trim($request->address),
                    'description' => trim($request->description)
                ]);
                DB::commit();
                $request->session()->flash('success', 'Successfully added.');
                $events = $this->GetData(1);
                return view('event.active',compact('events'));
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
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => ['required','max:50',Rule::unique('event')->ignore(trim($request->idUpdate))],
            'date' => 'required',
            'address' => 'required',
            'description' => 'max:200',
            'valid' => 'required'
        ];
        $messages = [
            'unique' => ':attribute already exists.',
            'required' => 'The :attribute field is required.',
            'max' => 'The :attribute field must be no longer than :max characters.'
        ];
        $niceNames = [
            'name' => 'Event',
            'Date' => 'Date',
            'Address' => 'Address',
            'description' => 'Description',
            'valid' => 'Valid Address'
        ];
        $validator = Validator::make($request->all(),$rules,$messages);
        $validator->setAttributeNames($niceNames); 
        if ($validator->fails()) {
            return response()->json(['errors'=>$validator->errors()]);
        }
        else{
            try{
                DB::beginTransaction();
                $dates = explode('-',trim($request->date)); // two dates MM/DD/YYYY-MM/DD/YYYY
                $startDate = explode('/',$dates[0]); // MM[0] DD[1] YYYY[2] 
                $finalStartDate = "$startDate[2]-$startDate[0]-$startDate[1]";
                $endDate = explode('/',$dates[1]); // MM[0] DD[1] YYYY[2] 
                $finalEndDate = "$endDate[2]-$endDate[0]-$endDate[1]";
                $event = Event::findOrFail($request->idUpdate);
                $event->update([
                    'name' => trim($request->name),
                    'startDate' => str_replace(' ','',$finalStartDate),
                    'endDate' => str_replace(' ','',$finalEndDate),
                    'address' => trim($request->address),
                    'description' => trim($request->description)
                ]);
                DB::commit();
                $request->session()->flash('success', 'Successfully updated.');
                $events = $this->GetData(1);
                return view('event.active',compact('events'));
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
    public function destroy($id)
    {
        //
    }
}
