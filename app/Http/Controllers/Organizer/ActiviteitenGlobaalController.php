<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 11/03/2020
 * Time: 11:22
 */

namespace App\Http\Controllers\Organizer;

use App\Activity;
use App\Daypart;
use App\Daypart_activity;
use App\Helpers\Json;
use App\Location;
use App\Staffparty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ActiviteitenGlobaalController extends Controller
{
    public function index(Request $request)
    {
        //$activities=Activity::orderBy('id');


        $activities = Activity::orderBY('id')
            ->paginate(5);
            //->get();

        $locations=Location::orderBy('id')
            ->get();

        //Iebe,Arno,Robin,Stef
        $functies = collect(["", "", "T","O"]);

        $result = compact('activities','functies','locations');
        //Json::dump($result);

        return view('organizer.activiteitenglobaal.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $activity=new Activity();
        $activity->name=$request->name;
        $activity->description=$request->description;
        $activity->sort=$request->sort;
        $activity->min_number=$request->minpersonen;
        $activity->max_number=$request->maxpersonen;
        $activity->location_id=$request->location;
        $activity->active=$request->actief;
        $activity->save();
        return redirect('/organizer/activiteitenglobaal');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,Activity $activity,$id)
    {
        $activity = Activity::find($id);
        $activity->name=$request->name;
        $activity->description=$request->description;
        $activity->sort=$request->sort;
        $activity->min_number=$request->minpersonen;
        $activity->max_number=$request->maxpersonen;
        $activity->location_id=$request->location;
        $activity->active=$request->actief;

        $activity->save();

        return redirect('/organizer/activiteitenglobaal');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */

    public function destroy(Activity $activity,$id)
    {
        $activity = Activity::find($id);
        $activity->delete();
        return redirect('/organizer/activiteitenglobaal');

    }
}