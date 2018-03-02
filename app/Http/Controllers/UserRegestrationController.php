<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use Session;
use Redirect;
use \App\UserRef;
use DB;
class UserRegestrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('user_reg.all_users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        return view('user_reg.add_user',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $refering_user = $request->get('refering_user');
        $phone_number = $request->get('phone_number');
        $user = new User([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'phone_number' => $request->get('phone_number'),
        ]);

        if($user->save())
        {   
            //adding refreence;
            if($refering_user != 0)
            {
                //new user id.
                $user_id = DB::table('users')->select('id')
                ->where('phone_number', $phone_number)->first();
                $ref_user = new UserRef([
                    'main_user_id' => $refering_user,
                    'user_id' => $user_id->id,
                ]);

                if($ref_user->save())
                {
                    Session::flash('message', "$user->name was Added with REFERENCE!");
                     return Redirect::back();
                }else {
                    Session::flash('error_txt', "Error in adding new user && Refrence USE DIFFRENT PHONE NUMBER");
                    return Redirect::back();
                }
            }
             Session::flash('message', "$user->name was Added");
             return Redirect::back();
        } else {
            Session::flash('error_txt', "Error in adding new user");
            return Redirect::back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
