<?php

namespace App\Http\Controllers\Organizer;


use App\Transportoption;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransportoptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transportoptions = Transportoption::orderBy('name')
            ->get();
        $result = compact('transportoptions');
        Json::dump($result);
        return view('organizer.vervoersmogelijkheid.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $transportoption = new Transportoption();
        $result = compact('transportoption');
        return view('organizer.vervoersmogelijkheid.create', $result);
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
            'name' => 'required|min:3',

        ],
            [
                'name.required' => "De naam is verplicht",
                'name.min' => "De naam moet minimaal 3 karakters zijn"

            ]);
        if ($request->active != 1){
            $request->active = 0;
        }
        $transportoption = new Transportoption();
        $transportoption->name = $request->name;
        $transportoption->description = $request->description;
        $transportoption->active = $request->active;
        $transportoption->save();

        session()->flash('success', "De vervoersmogelijkheid <b>$transportoption->name</b> is toegevoegd");
        return redirect('organizer/vervoersmogelijkheid');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transportoption  $transportoption
     * @return \Illuminate\Http\Response
     */
    public function show(Transportoption $transportoption)
    {
        return redirect('organizer/vervoersmogelijkheid');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transportoption  $transportoption
     * @return \Illuminate\Http\Response
     */
    public function edit(Transportoption $transportoption)
    {
        $result = compact('transportoption');
        Json::dump($result);
        return view('organizer.vervoersmogelijkheid.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transportoption  $transportoption
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transportoption $transportoption)
    {
        $this->validate($request,[
            'name' => 'required|min:3',

        ],
            [
                'name.required' => "De naam is verplicht",
                'name.min' => "De naam moet minimaal 3 karakters zijn"
            ]);
        if ($request->active != 1){
            $request->active = 0;
        }

        $transportoption->name = $request->name;
        $transportoption->description = $request->description;
        $transportoption->active = $request->active;
        $transportoption->save();

        session()->flash('success', "De vervoersmogelijkheid <b>$transportoption->name</b> is bijgewerkt");
        return redirect('organizer/vervoersmogelijkheid');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transportoption  $transportoption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transportoption $transportoption)
    {
        $transportoption->delete();

        session()->flash('success', "De vervoersmogelijkheid <b>$transportoption->name</b> is verwijderd");
        return redirect('organizer/vervoersmogelijkheid');
    }
}
