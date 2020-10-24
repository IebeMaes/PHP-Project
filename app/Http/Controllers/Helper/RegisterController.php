<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 20/04/2020
 * Time: 11:00
 */

namespace App\Http\Controllers\Helper;


use App\Chosentransport;
use App\Http\Controllers\Controller;
use App\Registrationtask;
use App\Task;
use Illuminate\Support\Facades\DB;
use Session;
use App\Transportoption;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use App\Participant;
use Illuminate\Mail\Transport\Transport;

class RegisterController extends Controller
{
    public function index()
    {
        $currentdate= date('Y-m-d');
        $tasks=Task::orderBy('id')
            ->paginate(5);

        $inschrijvingen = DB::table('registrationtasks')
            ->join('participants','registrationtasks.participant_id',"=","participants.id")
            ->join('tasks','tasks.id',"=",'registrationtasks.task_id')
            ->get();

        $transports=Transportoption::orderBy('id')
            ->get();

        //Iebe,Arno,Robin,Stef
        $functies = collect(["", "", "(Tester)","(Ontwikkelaar)"]);

        $result = compact('tasks','functies','transports','inschrijvingen');

        return view('helper.index', $result);
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
        $usermail=$request->mailconfirm;

        if (Participant::where('email', '=', $usermail)->where('kind',"=","helper")->exists()) {
            $userid = Participant::where('email', $usermail)->first()->id;
            $inschrijving=new Registrationtask();
            $inschrijving->task_id=$request->bevestigen;
            $inschrijving->participant_id=$userid;
            $activity_id=$request->activity_id;
            $transport=$request->transport;

            if(Chosentransport::where('activity_id', $activity_id)->where('transportoption_id',$transport)->exists()){
                $inschrijving->chosentransport_id=Chosentransport::where('activity_id', $activity_id)->where('transportoption_id',$transport)->first()->id;
            }else{
                $inschrijving->chosentransport_id=Chosentransport::where('transportoption_id',$transport)->first()->id;
            }

            $inschrijving->save();
            //Session()->flash('success', "U bent ingeschreven");
            Session::put('flash_message', 'U bent ingeschreven!');
            return redirect('/');

        }
        Session::put('error_message', 'Error, u heeft het verkeerde mailadres ingegeven, controleer uw gegevens en probeer opnieuw.');
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy()
    {



    }
}