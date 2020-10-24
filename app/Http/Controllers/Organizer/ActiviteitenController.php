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
use App\Staffparty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;


class ActiviteitenController extends Controller
{
    public function index(Request $request)
    {
        //$activities=Activity::orderBy('id');

        //id opvragen uit URL om juiste activiteiten te tonen
        $personeelsfeestid=$request->route('feestid');


        //sql query

        $activities = DB::table('dayparts')
        ->LeftJoin('daypart_activities', 'daypart_activities.daypart_id', '=', 'dayparts.id')
        ->LeftJoin('activities','daypart_activities.activity_id','=','activities.id')
        ->LeftJoin('locations','activities.location_id','=','locations.id')
//        ->RightJoin('staffparties', 'dayparts.staffparty_id', '=', 'staffparties.id')
        ->select('dayparts.id as daypartid','dayparts.*','activities.description as activitydescription','activities.name as activityname','activities.*','locations.*','daypart_activities.id as linkid')
        ->where('dayparts.staffparty_id','=',$personeelsfeestid)
        ->orderBy('dayparts.start_hour')
            ->paginate(5);
            //->get();

        //voor de dropdown
        $activiteiten=Activity::orderBy('id')
        ->get();


        $description="Korte activiteit";

        //Iebe,Arno,Robin,Stef
        $functies = collect(["", "", "T","O"]);

        $result = compact('activities','functies','personeelsfeestid','activiteiten','description');
        //Json::dump($result);

        return view('organizer.activiteiten.index', $result);
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
//        $daypart=new Daypart();
//        $daypart->start_hour=$request->begin;
//        $daypart->end_hour=$request->eind;
//        $daypart->description=$request->sort;
//
//        $daypart->staffparty_id=$request->toevoegen;
//        $daypart->save();

        $daypart_activity=new Daypart_activity();
        $daypart_activity->activity_id=$request->activity;

        $daypart_activity->daypart_id=$request->toevoegen;
        $daypart_activity->save();

        return redirect()->back();
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
     * @param  \App\Daypart_activity  $daypart_activity
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request,$linkid,Daypart_activity $daypart_activity)
    {
        $daypart_activity = Daypart_activity::find($linkid);
        $daypart_activity->activity_id=$request->activityedit;
        //$daypart->activity_id=$request->activityedit;
        $daypart_activity->save();


        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Daypart  $daypart
     * @return \Illuminate\Http\Response
     */

    public function destroy(Daypart $daypart,$daypartid)
    {

        $daypart = Daypart::find($daypartid);
        $daypart->delete();
        return redirect()->back();
        //'/Organizer/activiteiten/1'

    }
}