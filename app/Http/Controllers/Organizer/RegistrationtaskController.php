<?php

namespace App\Http\Controllers\Organizer;

use App\Participant;
use App\Registration;
use App\Registrationtask;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class RegistrationtaskController extends Controller
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
     * @param  \App\Registrationtask  $registrationtask
     * @return \Illuminate\Http\Response
     */
    public function show(Registrationtask $registrationtask, Request $request)
    {
        $personeelsfeestid = $request->route('registrationtask.id');
        $participants = Participant::with('registrationtask.task.activity.daypart_activity.daypart')
            ->wherehas("registrationtask.task.activity.daypart_activity.daypart", function ($query) use($personeelsfeestid){$query->where('staffparty_id' ,'=' , $personeelsfeestid)->where('kind', 'like', 'helper');})

            ->paginate(10);
//        $participants = DB::table("participants")
//            ->join('registrationtasks', 'registrationtasks.participant_id', '=' , 'participants.id')
//            ->join('tasks', 'tasks.id', '=' , 'registrationtasks.task_id')
//            ->join('activities', 'activities.id', '=' , 'tasks.activity_id')
//            ->join('daypart_activities', 'activities.id', '=' , 'daypart_activities.activity_id')
//            ->join('dayparts', 'dayparts.id', '=' , 'daypart_activities.daypart_id')
//            ->select('tasks.name as taaknaam', 'first_name', 'last_name','unumber','cellphone','email', 'registrationtasks.id as id')->distinct()
//            ->where('kind', 'like', 'helper')
//            ->where('staffparty_id', '=',$personeelsfeestid)
//            ->paginate(10);
        $result = compact('participants', 'personeelsfeestid');
        Json::dump($result);
        return view('organizer.registratiehelpers.index', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Registrationtask  $registrationtask
     * @return \Illuminate\Http\Response
     */
    public function edit(Registrationtask $registrationtask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Registrationtask  $registrationtask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Registrationtask $registrationtask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Registrationtask  $registrationtask
     * @return \Illuminate\Http\Response
     */
    public function destroy(Registrationtask $registrationtask)
    {



        $registrationtask->delete();

        return response()->json([
            'type' => 'success',
            'text' => "De registratie is verwijderd"
        ]);


    }
}
