<?php

namespace App\Http\Controllers\Organizer;

use App\Daypart_activity;
use App\Registration;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class Registrationhulp extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Daypart_activity  $daypart_activity
     * @return \Illuminate\Http\Response
     */
    public function show(Daypart_activity $daypart_activity)
    {
        //geef alle registraties van een bepaalde daypert.
        $datas = Registration::with('daypart_activity', 'chosentransport.transportoption' ,'participant')
            ->wherehas("daypart_activity", function ($query) use($daypart_activity)  {$query->where('daypart_activity_id' ,'=' , $daypart_activity->id);})
            ->get();

        //tel alle registraties die met de bus komen bij een bepaalde daypart.
        $count = Registration::with('daypart_activity', 'chosentransport.transportoption' ,'participant')
            ->wherehas("chosentransport.transportoption", function ($query)  {$query->where('name' ,'=' , 'Bus');})
            ->wherehas("daypart_activity", function ($query) use($daypart_activity)  {$query->where('daypart_activity_id' ,'=' , $daypart_activity->id);})
            ->count();

//        $datas = DB::table("registrations")->join('daypart_activities', 'registrations.daypart_activity_id' , '=' , 'daypart_activities.id')
//            ->join('participants', 'registrations.participant_id', '=' , 'participants.id')
//            ->join('chosentransports', 'registrations.chosentransport_id' , '=' , 'chosentransports.id')
//            ->join('transportoptions', 'chosentransports.transportoption_id', "=" ,"transportoptions.id")
//        ->select("*")->distinct()->get();

        $result = compact('daypart_activity', 'datas' ,'count');
        Json::dump($result);
        return view('organizer.registraties.show', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Daypart_activity  $daypart_activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Daypart_activity $daypart_activity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Daypart_activity  $daypart_activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Daypart_activity $daypart_activity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Daypart_activity  $daypart_activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Daypart_activity $daypart_activity)
    {
        //
    }
}
