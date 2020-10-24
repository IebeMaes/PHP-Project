<?php /** @noinspection ALL */

/** @noinspection Annotator */

namespace App\Http\Controllers\User;

use App\Activity;
use App\Chosentransport;
use App\Daypart_activity;
use App\Registration;
use App\Transportoption;
use Carbon\Carbon;
use App\Participant;
use App\Registrationtask;
use App\Staffparty;
use App\User;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;
use Session;

class InschrijvingController extends Controller
{
    public function index()
    {
        return view("user.inschrijven.index");
    }


    public function namiddag(Request $request)
    {
        $usermail = $request->emailinschrijving;

        if (Participant::where('email', '=', $usermail)->where('kind', "=", "participant")->exists()) {
            $user = Participant::where("email", '=', $usermail)->first();
            $userid = $user->id;
            session(['user' => $user]);
            session(['userid' => $userid]);


            //Datum van vandaag opvragen in gewenste formaat YYYY/MM/DD
            $today = Carbon::now()->toDateString();
            $staffparty = Staffparty::where("date", ">=", $today)->orderBy('date', 'asc')->first();
            //DIT LATER NOG TERUG UIT COMMENTAAR ZETTEN, TIJDELIJK VOOR TE TESTEN
            $staffpartyid = $staffparty->id;
            session(['staffparty_id' => $staffpartyid]);


//            $registrations = DB::table('registrations')
//                ->join('daypart_activities', 'registrations.daypart_activity_id', '=', 'daypart_activities.id')
//                ->join('dayparts', 'daypart_activities.daypart_id', '=', 'dayparts.id')
//                ->where('dayparts.staffparty_id', '=', $staffpartyid)
//                ->where('registrations.participant_id', '=', $userid)
//                ->select('*')
//                ->get();

            $registrations1 = Registration::with('daypart_activity.daypart')
                ->where('participant_id', '=', $userid)
                ->wherehas("daypart_activity.daypart", function ($query) use($staffpartyid){$query->where('staffparty_id' ,'=' , $staffpartyid);})
                ->get();

//            dd($registrations1);
            if (!$registrations1->isEmpty()) {
                Session::put('error_message', 'Error, u heeft zich al eens ingeschreven voor het komende personeelsfeest.');
                return redirect('/');
            }

            $vervoersmogelijkheden = Transportoption::all();


//            $activities = DB::table('activities')
//                ->join('daypart_activities', 'activities.id', '=', 'daypart_activities.activity_id')
//                ->join('dayparts', 'daypart_activities.daypart_id', '=', 'dayparts.id')
//                ->join('locations', 'activities.location_id', '=', 'locations.id')
//                ->select('activities.*', "daypart_activities.id as daypartactivityID", "daypart_activities.activity_id", "daypart_activities.daypart_id", "dayparts.*", 'locations.name as locationname', "locations.town", "locations.postalcode", "locations.street")
//                ->where('staffparty_id', '=', $staffpartyid)
//                ->get();

            $activities = Daypart_activity::with('daypart', 'activity.location')
                ->whereHas("daypart", function ($query) use($staffpartyid) {$query->where('staffparty_id', '=', $staffpartyid);})
                ->get();
//            dd($activities, $staffpartyid);
            $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);

            if ($activities->isEmpty()){
                $dit = false;
            }
            if ($activities->isNotEmpty()){
                $dit= true;
            }


            $result = compact( 'activities',  'vervoersmogelijkheden', 'staffpartyid', 'registrations1', 'functies', 'dit');
            Json::dump($result);
//            dd($result);
            return view('user.inschrijven.namiddag', $result);
        }
        Session::put('error_message', 'Error, u heeft het verkeerde mailadres ingegeven, controleer uw gegevens en probeer opnieuw.');
        return redirect('/');
    }

    public function savenamiddag(Request $request)
    {
        $userid = session('userid');
        $kortactivities = $request->input('kort');
        $langactivities = $request->input('lang');
        $vervoer = $request->input('vervoer');
        $result = compact('userid', 'kortactivities', 'langactivities', 'vervoer');


        if ($kortactivities != null) {
            foreach ((array)$kortactivities as $kortactivity) {
                $inschrijving = new Registration();
                $inschrijving->participant_id = $userid;
                $inschrijving->daypart_activity_id = $kortactivity;
                $inschrijving->chosentransport_id = $vervoer;
                $inschrijving->save();
            }
        }

        if ($langactivities != null) {
            foreach ((array)$langactivities as $langactivity) {
                $inschrijving = new Registration();
                $inschrijving->participant_id = $userid;
                $inschrijving->daypart_activity_id = $langactivity;
                $inschrijving->chosentransport_id = $vervoer;
                $inschrijving->save();

            }
        }
        return redirect('/inschrijving/avond');
    }

    public function saveavond(Request $request)
    {
        $userid = session('userid');
        $avondactivity = $request->input('avond');
        $opmerking = $request->input('opmerkingavond');
        $vervoer = $request->input('vervoer');



        if ($avondactivity != null) {
                $inschrijving = new Registration();
                $inschrijving->participant_id = $userid;
                $inschrijving->daypart_activity_id = $avondactivity;
                $inschrijving->note = $request->opmerkingavond;
                $inschrijving->chosentransport_id = $vervoer;
                $inschrijving->save();
        }

        return redirect('/inschrijving/bevestiging');
    }
    public function avond()
    {
        $userid = session('userid');
        $staffpartyid = session('staffparty_id');


        $activities = Daypart_activity::with('daypart', 'activity.location')
            ->whereHas("daypart", function ($query) use($staffpartyid) {$query->where('staffparty_id', '=', $staffpartyid);})
            ->get();

        $vervoersmogelijkheden = Transportoption::all();
        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);
        $result = compact( 'activities', 'staffpartyid', 'userid', 'vervoersmogelijkheden', 'functies');
        Json::dump($result);
//            dd($result);
        return view('user.inschrijven.avond', $result);
    }


    public function overzicht()
    {
        $staffpartyid = session('staffparty_id');
        $userid = session('userid');
        $user = session('user');
//        $registrations = DB::table('registrations')
//            ->join('daypart_activities', 'registrations.daypart_activity_id', '=', 'daypart_activities.id')
//            ->join('dayparts', 'daypart_activities.daypart_id', '=', 'dayparts.id')
//            ->join('activities', 'daypart_activities.activity_id', '=', 'activities.id')
//            ->join('locations', 'activities.location_id', '=', 'locations.id')
//            ->where('dayparts.staffparty_id', '=', $staffpartyid)
//            ->where('registrations.participant_id', '=', $userid)
//            ->select('*')
//            ->get();


        $registrations = Daypart_activity::with('daypart', 'registration', 'activity.location')
            ->whereHas("daypart", function ($query) use($staffpartyid) {$query->where('staffparty_id', '=', $staffpartyid);})
            ->whereHas("registration", function ($query) use($userid) {$query->where('participant_id', '=', $userid);})
            ->get();
//        dd($registrations);
        if ($registrations->isEmpty()){
            $dit = false;
        }
        if ($registrations->isNotEmpty()){
            $dit= true;
        }

        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);
        $result = compact('userid', 'registrations', 'user', 'functies', 'dit');
//        dd($result);
        return view('user.inschrijven.overzicht', $result);
    }
}
