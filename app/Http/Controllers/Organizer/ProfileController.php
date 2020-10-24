<?php

namespace App\Http\Controllers\Organizer;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function index()
    {
        $functies = collect(["(Ontwikkelaar)", "(Tester)", "",""]);
        $result = compact('functies');
        return view('organizer.profile.index', $result);
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'naamprof' => 'required|min:3',
            'emailprof' => 'required|min:3|email|unique:users,email,' . auth()->id()
        ],
            [
                'naamprof.required' => 'Gelieve een naam in te vullen.',
                'naamprof.min' => 'De naam moet minimaal 3 karakters lang zijn.',
                'emailprof.required' => 'Gelieve een e-mail adres in te vullen.',
                'emailprof.min' => 'Het e-mail adres moet minimaal 3 karakters lang zijn.',
                'emailprof.email' => 'Gelieve een geldig e-mail adres in te vullen.',
                'emailprof.unique' => 'Het e-mail adres moet uniek zijn.',
            ]);

        $str = explode(' ', $request->naamprof, 2);
        $voornaam = $str[0];
        $achternaam = $str[1];

        $user = User::findOrFail(auth()->id());
        $user->first_name =$voornaam;
        $user->last_name =$achternaam;
        $user->email = $request->emailprof;
        $user->save();

        return response()->json([
            'type' => 'success',
            'text' => "Uw account is gewijzigd!"
        ]);

    }
}
