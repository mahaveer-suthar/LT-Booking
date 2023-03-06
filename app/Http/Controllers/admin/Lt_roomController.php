<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lt_rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Lt_roomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rooms=Lt_rooms::orderBy('id','desc')->get();
        return view('admin.lt_rooms.index',compact('rooms'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $validated = Validator::make(
            $request->all(),
            [
                'room_name' => ['required', 'string','unique:lt_rooms'],
            ]
        );
        //Check the validation
        if ($validated->fails()) {
            return redirect()->back()->with('error', 'your message,here');
        }
        $room=Lt_rooms::create(['room_name'=>$request->room_name]);
        if ($room) {
            return redirect()->back()->with('success','Room added successfully');
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
        $room=Lt_rooms::find($id);
        return view('admin.lt_rooms.edit',compact('room'));
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
        $validated = Validator::make(
            $request->all(),
            [
                'room_name' => ['required', 'string','unique:lt_rooms'],
            ]
        );
        //Check the validation
        if ($validated->fails()) {
            return redirect()->back()->with('error', 'ohh! room name is exist');
        }
        $room=Lt_rooms::find($id)->update(['room_name'=>$request->room_name]);
        if ($room) {
            return redirect()->back()->with('success','Room update successfully');
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
    public function changeStatus(Request $request){
        $room=Lt_rooms::find($request->id)->update(['status'=>$request->status]);
        return response()->json(['status'=>200]);
    }
}
