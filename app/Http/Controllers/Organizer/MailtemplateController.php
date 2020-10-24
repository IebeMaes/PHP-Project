<?php

namespace App\Http\Controllers\Organizer;

use App\Mailtemplate;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MailtemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mailtemplates = Mailtemplate::orderBy('id')
            ->get();
        $functies = collect(["", "", "(ontwikkelaar)","(tester)"]);

        $result = compact('mailtemplates','functies');

        Json::dump($result);

        //naar view met data

        return view('organizer.mailtemplates.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return redirect('organizer/mailtemplates');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:mailtemplates,name,',
            'mailcontent' => 'required|min:3,'
        ],[
            'name.required' => 'Vul een naam in.',
            'name.min' => 'De naam moet minstens :min karakters bevatten.',
            'name.unique' => 'Naam is al ingebruik.',
            'mailcontent.required' => 'Geef de inhoud in.',
            'mailcontent.min' => 'De inhoud moet minstens :min karakters bevatten.',
        ]);
        $mailtemplate = new Mailtemplate();
        $mailtemplate->name = $request->name;
        $mailtemplate->mailcontent = $request->mailcontent;
        $mailtemplate->save();
        return response()->json([
            'type' => 'success',
            'text' => "<b>$mailtemplate->name</b> is aangemaakt",
            'object' => $mailtemplate
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mailtemplate  $mailtemplate
     * @return \Illuminate\Http\Response
     */
    public function show(Mailtemplate $mailtemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mailtemplate  $mailtemplate
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return redirect('organizer/mailtemplates');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mailtemplate  $mailtemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mailtemplate $mailtemplate)
    {
        $this->validate($request,[
            'name' => 'required|min:3|unique:mailtemplates,name,' . $mailtemplate->id,
            'mailcontent' => 'required|min:3,' . $mailtemplate->id
        ],[
            'name.required' => 'Vul een naam in.',
            'name.min' => 'De naam moet minstens :min karakters bevatten.',
            'name.unique' => 'Naam is al ingebruik.',
            'mailcontent.required' => 'Geef de inhoud in.',
            'mailcontent.min' => 'De inhoud moet minstens :min karakters bevatten.',
        ]);

        $mailtemplate->name = $request->name;
        $mailtemplate->mailcontent = $request->mailcontent;
        $mailtemplate->save();
        return response()->json([
            'type' => 'success',
            'text' => "<b>$mailtemplate->name</b> is gewijzigd."
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mailtemplate  $mailtemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mailtemplate $mailtemplate)
    {
        $mailtemplate->delete();
        return response()->json([
            'type' => 'success',
            'text' => "<b>$mailtemplate->name</b> is verwijderd"
        ]);
    }
}
