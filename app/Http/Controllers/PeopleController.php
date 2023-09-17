<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\People;
use Illuminate\Support\Facades\Auth;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $peoples = People::all();

        return view('people.index', ['peoples' => $peoples]);
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
        $request->validate([
            'name' => 'required|unique:people|max:255'
        ]);

        $people = new People;
        $people->name = $request->name;
        $people->last_name = $request->last_name;
        $people->number_phone = $request->number_phone;
        $people->email = $request->email;
        $people->user_id = Auth::user()->id;
        $people->save();

        return  redirect()->route('peoples.index')->with('success','Nueva persona agregada!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $people = People::find($id);
        return view('people.show',['people' => $people]);
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
        $people = People::find($id);
        $people->name = $request->name;
        $people->last_name = $request->last_name;
        $people->number_phone = $request->number_phone;
        $people->email = $request->email;
        $people->save();

        return redirect()->route('peoples.index')->with('success','Datos actualizados!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $people = People::find($id);
        $people->delete();

        return redirect()->route('peoples.index')->with('success','Datos actualizados!');
    }
}
