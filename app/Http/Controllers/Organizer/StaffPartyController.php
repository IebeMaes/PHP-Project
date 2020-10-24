<?php

namespace App\Http\Controllers\Organizer;

use App\Activity;
use App\Daypart;
use App\Daypart_activity;
use App\Location;
use App\Staffparty;
use DB;
use i;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class StaffPartyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $locations = Location::with('staffparty')->get();
        $staffparties = Staffparty::with('location')
            ->get();
        //Iebe,Arno,Robin,Stef
        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);
        $result = compact('staffparties', 'locations', 'functies');
        Json::dump($result);
        return view('organizer.personeelsfeest.index', $result);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staffparty = new Staffparty();
        $locations = Location::all();
        $dayparts = Daypart::all();
        $staffparties = Staffparty::get();
        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);
        $result = compact('locations', 'dayparts', 'staffparty', 'staffparties', 'functies');
        Json::dump($result);
        return view('organizer.personeelsfeest.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nameParty' => 'required|min:3',
            'date' => 'required|after:today|unique:staffparties,date,',
            'location' => 'required'
        ],
            [
                'nameParty.required' => 'Gelieve een naam in te vullen voor het feest.',
                'nameParty.min' => 'De naam moet minstens 3 karakters lang zijn.',
                'date.required' => 'Gelieve een datum te kiezen voor het feest.',
                'date.after' => 'De datum kan niet gelegen zijn in het verleden.',
                'date.unique' => 'Op deze datum is er al een feest gepland',
                'location.required' => 'Gelieve een locatie te kiezen voor het feest.',
            ]);

        $staffparty = new Staffparty();
        $staffparty->name = $request->nameParty;
        $staffparty->date = $request->date;
        $staffparty->location_id = $request->location;
        $staffparty->save();

        $lastRecord = Staffparty::latest()->first()->id;


        $dayparts = $request->input('daypart');


        foreach ((array) $dayparts as $daypart) {
            $record = Daypart::findOrFail($daypart);
            $record->staffparty_id = $lastRecord;
            $record->save();
        }
        return redirect('/organizer/staffparties');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Staffparty $staffparty
     * @return \Illuminate\Http\Response
     */
    public function show(Staffparty $staffparty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Staffparty $staffparty
     * @return \Illuminate\Http\Response
     */
    public function edit(Staffparty $staffparty)
    {

        $locations = Location::all();
        $dayparts = Daypart::all();
        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);
        $result = compact('staffparty', 'locations', 'dayparts', 'functies');
        Json::dump($result);
        return view('organizer.personeelsfeest.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Staffparty $staffparty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staffparty $staffparty)
    {
        $this->validate($request, [
            'nameParty' => 'required|min:3',
            'date' => 'required|after:today|unique:staffparties,date,' . $staffparty->id,
            'location' => 'required'
        ],
            [
                'nameParty.required' => 'Gelieve een naam in te vullen voor het feest.',
                'nameParty.min' => 'De naam moet minstens 3 karakters lang zijn.',
                'date.required' => 'Gelieve een datum te kiezen voor het feest.',
                'date.after' => 'De datum kan niet gelegen zijn in het verleden.',
                'date.unique' => 'Op deze datum is er al een feest gepland',
                'location.required' => 'Gelieve een locatie te kiezen voor het feest.',
            ]);

        $staffparty->name = $request->nameParty;
        $staffparty->date = $request->date;
        $staffparty->location_id = $request->location;
        $staffparty->save();

        $dayparts = $request->input('daypart');


        foreach ((array) $dayparts as $daypart) {
            $record = Daypart::findOrFail($daypart);
            $record->staffparty_id = $staffparty->id;
            $record->save();

        }

        return redirect('/organizer/staffparties');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Staffparty $staffparty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staffparty $staffparty)
    {
        $staffparty->delete();
        return redirect('/organizer/staffparties');
    }


    public function addDaypartS(Request $request)
    {
        $this->validate($request, [
            'start_hourS' => 'required',
            'end_hourS' => 'required'
        ]);
        $daypart = new Daypart();
        $daypart->start_hour = $request->start_hourS;
        $daypart->end_hour = $request->end_hourS;
        $daypart->description = $request->description;
        $daypart->save();
        $lastRecord = Daypart::latest()->first();
        return $lastRecord;
    }

    public function copyparty(Request $request)
    {

        $staffparty = Staffparty::findOrFail($request->staffpartyselect);
        $newstaffparty = $staffparty->replicate();
        $newstaffparty->save();
        return redirect('organizer/staffparties');
    }

    public function deleteDaypart(Request $request)
    {
        $daypartid = $request->id;
        $daypart = Daypart::findOrFail($daypartid);
        $daypart->delete();
        return response()->json([
            'type' => 'success',
            'text' => "Het dagdeel is verwijderd!"
        ]);
    }
}
