<?php

namespace App\Http\Controllers\Organizer;

use App\Location;
use App\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class ParticipantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $participants = Participant::orderby('id')
            ->where('kind', '=', 'participant' )
            ->paginate(8)
            ->appends(['search' => $request->input('search')]);

        //Iebe,Arno,Robin,Stef
        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);

        $result = compact('functies','participants');
        Json::dump($result);
        return view('organizer.participant.index', $result);
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
        $this->validate($request, [
            'voornaam' => 'required|min:3',
            'achternaam' => 'required|min:3',
            'telefoonnummer' => 'required|min:10|unique:participants,cellphone',
            'email' => 'required|min:3|email|unique:participants,email,',
            'unummer' => 'required|min:4|unique:participants,unumber'
        ],
            [
                'voornaam.required' => 'Gelieve een voornaam in te vullen.',
                'voornaam.min' => 'De voornaam moet minimaal 3 karakters lang zijn.',
                'achternaam.required' => 'Gelieve een achternaam in te vullen.',
                'achternaam.min' => 'De achternaam moet minimaal 3 karakters lang zijn.',
                'telefoonnummer.required' => 'Gelieve een telefoonnummer in te vullen.',
                'telefoonnummer.min' => 'Het telefoonnummer moet minimaal 10 karakters lang zijn.',
                'telefoonnummer.unique' => 'Dit telefoonnummer staat al in het systeem',
                'email.required' => 'Gelieve een email adres in te vullen.',
                'email.min' => 'Het email adres moet minimaal 3 karakters lang zijn.',
                'email.unique' => 'Dit email adres staat al in het systeem',
                'email.email' => 'Gelieve een e-mail adres op te geven',
                'unummer.required' => 'Gelieve een u-nummer in te vullen.',
                'unummer.min' => 'Het u-nummer moet minimaal 4 karakters lang zijn.',
                'unummer.unique' => 'Dit u-nummer staat al in het systeem',
            ]);

        $deelnemer = new Participant();
        $deelnemer->first_name = $request->voornaam;
        $deelnemer->last_name = $request->achternaam;
        $deelnemer->cellphone = $request->telefoonnummer;
        $deelnemer->email = $request->email;
        $deelnemer->unumber = $request->unummer;
        $deelnemer->kind = 'participant';
        $deelnemer->save();
        return response()->json([
            'type' => 'success',
            'text' => "De deelnemer is toegevoegd!"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Participant $participant)
    {
        $this->validate($request, [
            'editvoornaam' => 'required|min:3',
            'editachternaam' => 'required|min:3',
            'edittelefoonnummer' => 'required|min:10|unique:participants,cellphone,' . $participant->id,
            'editemail' => 'required|min:3|email|unique:participants,email,' . $participant->id,
            'editunummer' => 'required|min:4|unique:participants,unumber,' . $participant->id
        ],
            [
                'editvoornaam.required' => 'Gelieve een voornaam in te vullen.',
                'editvoornaam.min' => 'De voornaam moet minimaal 3 karakters lang zijn.',
                'editachternaam.required' => 'Gelieve een achternaam in te vullen.',
                'editachternaam.min' => 'De achternaam moet minimaal 3 karakters lang zijn.',
                'edittelefoonnummer.required' => 'Gelieve een telefoonnummer in te vullen.',
                'edittelefoonnummer.min' => 'Het telefoonnummer moet minimaal 10 karakters lang zijn.',
                'edittelefoonnummer.unique' => 'Dit telefoonnummer staat al in het systeem' ,
                'editemail.required' => 'Gelieve een email adres in te vullen.',
                'editemail.min' => 'Het email adres moet minimaal 3 karakters lang zijn.',
                'editemail.unique' => 'Dit email adres staat al in het systeem' ,
                'editemail.email' => 'Gelieve een e-mail adres op te geven',
                'editunummer.required' => 'Gelieve een u-nummer in te vullen.',
                'editunummer.min' => 'Het u-nummer moet minimaal 4 karakters lang zijn.',
                'editunummer.unique' => 'Dit u-nummer staat al in het systeem',
            ]);

        $participant->first_name = $request->editvoornaam;
        $participant->last_name = $request->editachternaam;
        $participant->cellphone = $request->edittelefoonnummer;
        $participant->email = $request->editemail;
        $participant->unumber = $request->editunummer;
        $participant->save();

        return response()->json([
            'type' => 'success',
            'text' => "De deelnemer is gewijzigd!"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Participant $participant)
    {
        $participant->delete();
        return response()->json([
            'type' => 'success',
            'text' => "De deelnemer is verwijderd!"
        ]);
    }
}
