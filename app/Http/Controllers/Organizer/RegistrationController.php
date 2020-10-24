<?php

namespace App\Http\Controllers\Organizer;


use App\Activity;
use App\Daypart;
use App\Daypart_activity;
use App\Participant;
use App\Registration;
use App\Staffparty;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class RegistrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


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
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function show(Daypart_activity $daypart_activity,Request $request)
    {
        $personeelsfeestid = $request->route('registration');
        $registratie= '%' . $request->input('registratie') . '%';
        $dayparts = Daypart::all();
        $activities = Activity::orderBy('name')->get();
        $edities = Staffparty::where('id', '=' , $personeelsfeestid)->get();

        $daypart_activities = Daypart_activity::with('daypart', 'activity')
            ->wherehas("daypart", function ($query) use($personeelsfeestid){$query->where('staffparty_id' ,'=' , $personeelsfeestid);})->get();
//        $daypart_activities = DB::table("daypart_activities")
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
//            ->join('activities', 'daypart_activities.activity_id' , '=' , 'activities.id')
//
//            ->orderBy('daypart_activities.id')
//            ->where('staffparty_id' , '=' , $personeelsfeestid)
//            ->select('*', 'daypart_activities.id as id')->distinct()->get();
        $participants = Participant::orderBy('first_name')->get();
        $registrations = Registration::with('participant' ,'daypart_activity.activity' ,'daypart_activity.daypart')
            ->wherehas("daypart_activity.daypart", function ($query) use($personeelsfeestid){$query->where('staffparty_id' ,'=' , $personeelsfeestid);})
            ->wherehas('participant',function ($query) use ($registratie) {
                $query->where('first_name', 'like', $registratie)->orwhere('last_name', 'like', $registratie)->orwhere('email', 'like', $registratie);

            })

            ->paginate(15);

        $registrations2 = Registration::with('participant' ,'daypart_activity.activity' ,'daypart_activity.daypart')
            ->wherehas("daypart_activity.daypart", function ($query) use($personeelsfeestid){$query->where('staffparty_id' ,'=' , $personeelsfeestid);})
            ->wherehas('participant',function ($query) use ($registratie) {
                $query->where('first_name', 'like', $registratie)->orwhere('last_name', 'like', $registratie)->orwhere('email', 'like', $registratie);

            })->get();



//
//
//

//        $registrations = DB::table("registrations")
//
//            ->join('participants', 'registrations.participant_id', '=' , 'participants.id')
//            ->join('daypart_activities', 'registrations.daypart_activity_id' , '=' , 'daypart_activities.id')
//            ->join('activities', 'daypart_activities.activity_id' , '=' , 'activities.id')
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
////
//            ->select("participants.first_name" ,'participants.last_name', 'participants.email' ,'activities.name' ,'registrations.id as id')->distinct()
//            ->where(function ($query) use ($registratie, $personeelsfeestid) {
//                $query->where('first_name', 'like', $registratie)
//                    ->where('staffparty_id', 'like', $personeelsfeestid);
//            })
//            ->orWhere(function ($query) use ($registratie, $personeelsfeestid) {
//                $query->where('last_name', 'like', $registratie)
//                    ->where('staffparty_id', 'like', $personeelsfeestid);
//            })
//            ->orWhere(function ($query) use ($registratie, $personeelsfeestid) {
//                $query->where('email', 'like', $registratie)
//                    ->where('staffparty_id', 'like', $personeelsfeestid);
//            })
////
//            ->orderBy('first_name')
//            ->paginate(15)
//            ->appends($request->input('registratie'));


        $count = Registration::with('daypart_activity.daypart')
            ->wherehas("daypart_activity.daypart", function ($query) use($personeelsfeestid){$query->where('staffparty_id' ,'=' , $personeelsfeestid);})

            ->count(DB::raw('DISTINCT participant_id'));

//        $count = DB::table('registrations')
//            ->join('daypart_activities', 'registrations.daypart_activity_id' , '=' , 'daypart_activities.id')
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
//            ->where('staffparty_id' , '=' , $personeelsfeestid)
//            ->count(DB::raw('DISTINCT participant_id'));

//        $countkort = DB::table('registrations')
//            ->join('daypart_activities', 'registrations.daypart_activity_id' , '=' , 'daypart_activities.id')
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
//            ->where('staffparty_id' , '=' , $personeelsfeestid)
//            ->where('dayparts.description', 'like','Korte activiteit')
//            ->count(DB::raw('DISTINCT participant_id'));
//        $countlang = DB::table('registrations')
//            ->join('daypart_activities', 'registrations.daypart_activity_id' , '=' , 'daypart_activities.id')
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
//            ->where('staffparty_id' , '=' , $personeelsfeestid)
//            ->where('dayparts.description', 'like','Lange activiteit')
//            ->count(DB::raw('DISTINCT participant_id'));
//        $countavond = DB::table('registrations')
//            ->join('daypart_activities', 'registrations.daypart_activity_id' , '=' , 'daypart_activities.id')
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
//            ->where('staffparty_id' , '=' , $personeelsfeestid)
//            ->where('dayparts.description', 'like','Avond activiteit')
//            ->count(DB::raw('DISTINCT participant_id'));


        $result = compact('registrations', 'participants', 'daypart_activities' ,'activities' ,'dayparts', "count", 'personeelsfeestid' ,'edities' ,'registrations2');
        Json::dump($result);
        return view('organizer.registraties.index', $result);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function edit(Registration $registration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registration $registration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registration  $registration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registration $registration)
    {



        $registration->delete();


        return response()->json([
            'type' => 'success',
            'text' => "De registratie is verwijderd"
        ]);
    }
}
