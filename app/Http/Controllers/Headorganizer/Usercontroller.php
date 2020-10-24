<?php
/**
 * Created by PhpStorm.
 * User: Gebruiker
 * Date: 27/02/2020
 * Time: 13:20
 */

namespace App\Http\Controllers\Headorganizer;


use App\Helpers\Json;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
//use mysql_xdevapi\Collection;


class Usercontroller extends Controller
{
    public function index()
    {

        $users = User::orderBY('id')
            ->paginate(5);
        //Iebe,Arno,Robin,Stef
        $functies = collect(["", "", "T","O"]);

        $result = compact('users','functies');

        //Json::dump($result);

        //naar view met data

        return view('headorganizer.organisatoren.index', $result);

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
        $this->validate($request,[
         'first_name' => 'required|min:3|unique:users,first_name',
        'last_name' => 'required|min:3|unique:users,last_name',
            'email' => 'required|min:3|unique:users,email'
        ]);


        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = $request->wachtwoord;
        $user->head_organizer = $request->hoofdorganisator;
        $user->active = $request->actief;
        $user->save();

        return redirect('/headorganizer/users');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, User $user)
    {
        $this->validate($request,[
            'first_name' => 'required|min:3',
            'last_name' => 'required|min:3',
            'email' => 'required|min:3'
        ]);

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email=$request->email;
        $user->active=$request->active;
        $user->head_organizer=$request->headorganizer;

        $user->save();

        return redirect('/headorganizer/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */

    public function destroy(User $user)
    {

        $user->delete();

        return redirect('/headorganizer/users');
    }
}