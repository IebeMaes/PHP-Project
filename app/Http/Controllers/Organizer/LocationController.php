<?php

namespace App\Http\Controllers\Organizer;


use App\Location;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Json;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $location = '%' . $request->input('search') . '%';
        $locations = Location::orderby('id')
            ->where('name', 'like', $location)
            ->orwhere('street', 'like', $location)
            ->orwhere('town', 'like', $location)
            ->paginate(5)
            ->appends(['search' => $request->input('search')]);

        //Iebe,Arno,Robin,Stef
        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);

        $result = compact('functies','locations');
        Json::dump($result);
        return view('organizer.locatie.index', $result);
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
            'name' => 'required|min:3',
            'town' => 'required|min:3',
            'postalcode' => 'required|min:3',
            'street' => 'required|min:3|unique:locations,street,'
        ],
            [
                'name.required' => 'Gelieve een naam in te vullen.',
                'name.min' => 'De naam moet minimaal 3 karakters lang zijn.',
                'town.required' => 'Gelieve een gemeente in te vullen.',
                'town.min' => 'De naam van de gemeente moet minimaal 3 karakters lang zijn.',
                'postalcode.required' => 'Gelieve een postcode in te vullen.',
                'postalcode.min' => 'De postcode moet minimaal 3 karakters lang zijn.',
                'street.required' => 'Gelieve een straatnaam en huisnummer in te vullen.',
                'street.min' => 'De straatnaam moet minimaal 3 karakters lang zijn.',
                'street.unique' => 'Deze straatnaam en huisnummer staan al in het systeem.' ,
            ]);

        $location = new Location();
        $location->name = $request->name;
        $location->town = $request->town;
        $location->postalcode = $request->postalcode;
        $location->street = $request->street;
        $location->save();
        $lastrecord = Location::latest()->first();
        return response()->json([
            'type' => 'success',
            'text' => "De locatie is toegevoegd!",
            'laatste' => $lastrecord
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        $result = compact('location');
        Json::dump($result);
        return view('organizer.locatie.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'town' => 'required|min:3',
            'postalcode' => 'required|min:3',
            'street' => 'required|min:3|unique:locations,street,' . $location->id
        ],
            [
                'name.required' => 'Gelieve een naam in te vullen.',
                'name.min' => 'De naam moet minimaal 3 karakters lang zijn.',
                'town.required' => 'Gelieve een gemeente in te vullen.',
                'town.min' => 'De naam van de gemeente moet minimaal 3 karakters lang zijn.',
                'postalcode.required' => 'Gelieve een postcode in te vullen.',
                'postalcode.min' => 'De postcode moet minimaal 3 karakters lang zijn.',
                'street.required' => 'Gelieve een straatnaam en huisnummer in te vullen.',
                'street.min' => 'De straatnaam moet minimaal 3 karakters lang zijn.',
                'street.unique' => 'Deze straatnaam en huisnummer staan al in het systeem.' ,
            ]);


        $location->name = $request->editnamelocation;
        $location->town = $request->edittownlocation;
        $location->postalcode = $request->editpostalcodelocation;
        $location->street = $request->editstreetlocation;
        $location->save();

        return response()->json([
            'type' => 'success',
            'text' => "De locatie is gewijzigd!"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        return response()->json([
            'type' => 'success',
            'text' => "De locatie is verwijderd!"
        ]);
    }
}
