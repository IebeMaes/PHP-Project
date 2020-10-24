<?php

namespace App\Http\Controllers\Organizer;


use App\Participant;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;



class HelperController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $participants = Participant::orderBy('first_name')
            ->where('kind', 'like', 'helper')
            ->paginate(10);
        $result = compact('participants');
        Json::dump($result);
        return view('organizer.helpers.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $participant = new Participant();
        $result = compact('participant');
        return view('organizer.helpers.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Participant $participant)
    {
        $this->validate($request,[
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'cellphone' => 'min:3',
            'email' => 'required|min:3|email|unique:participants,email,' . $participant->id,

        ],
            [
                'first_name.min' => 'De voornaam moet minimaal 3 karakters lang zijn',
                'last_name.min' => 'De achternaam moet minimaal 3 karakters lang zijn',
                'cellphone.min' => 'De telefoon nummmer moet minimaal 3 karakters lang zijn',
                'email.min' => 'De e-mail moet minimaal 3 karakters lang zijn',
                'first_name.required' => 'De voornaam moet ingevuld zijn',
                'last_name.required' => 'De achternaam moet ingevuld zijn',
                'email.required' => 'De e-mail moet ingevuld zijn',
                'email.unique' => 'De e-mail moet uniek zijn',
                'email.email' => 'De e-mail moet geldig zijn'
            ]);

        $participant = new Participant();
        $participant->first_name = $request->first_name;
        $participant->last_name = $request->last_name;
        $participant->cellphone = $request->cellphone;
        $participant->email = $request->email;
        $participant->unumber = $request->unumber;
        $participant->kind = 'helper';
        $participant->save();

        session()->flash('success', "De helper <b>$participant->first_name</b> is toegevoegd");
        return redirect('organizer/helpers');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function show(Participant $participant)
    {

        return redirect('organizer/helpers');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Participant  $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {

        $result = compact('participant');
        Json::dump($result);
        return view('organizer.helpers.edit', $result);
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
        $this->validate($request,[
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'cellphone' => 'min:3',
            'email' => 'required|min:3|email|unique:participants,email,' . $participant->id,
        ],
            [
                'first_name.min' => 'De voornaam moet minimaal 3 karakters lang zijn',
                'last_name.min' => 'De achternaam moet minimaal 3 karakters lang zijn',
                'cellphone.min' => 'De telefoon nummmer moet minimaal 3 karakters lang zijn',
                'email.min' => 'De e-mail moet minimaal 3 karakters lang zijn',
                'first_name.required' => 'De voornaam moet ingevuld zijn',
                'last_name.required' => 'De achternaam moet ingevuld zijn',
                'email.required' => 'De e-mail moet ingevuld zijn',
                'email.unique' => 'De e-mail moet uniek zijn',
                'email.email' => 'De e-mail moet geldig zijn'
            ]);
        $participant->first_name = $request->first_name;
        $participant->last_name = $request->last_name;
        $participant->cellphone = $request->cellphone;
        $participant->email = $request->email;
        $participant->unumber = $request->unumber;
        $participant->save();

        session()->flash('success', 'De helper is bijgewerkt');
        return redirect('organizer/helpers');

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

        session()->flash('success', "De helper <b>$participant->first_name</b> is verwijderd");
        return redirect('organizer/helpers');

    }
}
