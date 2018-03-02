<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\UserPoints;
use DB;
use Session;
use Redirect;
class UserPointsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $points = UserPoints::all();
        return view('user_points.view_points', compact('points'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user_points.add_points');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {           
           //getting user id for the phone number        
            $phone_number = $request->get('phone_number');
            $price = $request->get('price');

            $user_id = DB::table('users')->select('id')
            ->where('phone_number', $phone_number)->first();

            if($user_id)
            {

                        $get_user_points = DB::table('user_points')->select('points')
                        ->where('user_id',$user_id->id)->first();


        //if its first time for the user
                        if(!$get_user_points)
                        {
                            //getting points from price
                             $points = $price / 100;

                             $user_point = new UserPoints([
                                'user_id' => $user_id->id,
                                'points' => $points,
                                'price' => $price
                            ]);
                                if($user_point->save())
                                    {
                                         Session::flash('message', "$points was Added");
                                         return Redirect::back();
                                    } else {
                                        Session::flash('error_txt', "Error in adding new points please write it down");
                                        return Redirect::back();
                                    }
                        }elseif($get_user_points){

                            $get_user_price = DB::table('user_points')->select('price')
                                ->where('user_id',$user_id->id)->first();
                                //getting points from price
                                $points = $price / 100;
                                //adding user prices
                                $total_price = $get_user_price->price + $price;
                                //adding previous points with the new points
                                $main_user_points = $get_user_points->points + $points;

                                 $user_point = new UserPoints([
                                    'user_id' => $user_id->id,
                                    'points' => $main_user_points,
                                    'price' => $total_price
                                ]);
                                 // dd($user_point);

                                  if($user_point->save())
                            {
                                 Session::flash('message', "$points was Added");
                                 return Redirect::back();
                            } else {
                                Session::flash('error_txt', "Error in adding new points please write it down");
                                return Redirect::back();
                            }   
                        }else{
                            Session::flash('error_txt', "Something went wrong");
                        return Redirect::back();
                        }


                        
            }else {
                Session::flash('error_txt', "USER NOT FOUND ADD NEW USER");
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
