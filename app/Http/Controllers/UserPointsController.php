<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\UserPoints;
use \App\UserRef;
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

                            $user = DB::table('user_points')->select('*')
                                ->where('user_id',$user_id->id)->first();
                                //getting points from price
                                $points = $price / 100;
                                //adding user prices
                                $total_price = $user->price + $price;
                                //adding previous points with the new points
                                $main_user_points = $get_user_points->points + $points;
                                
                                //update user
                                 $user_point = UserPoints::find($user->id);
                                    $user_point->user_id = $user_id->id;
                                    $user_point->points = $main_user_points;
                                    $user_point->price = $total_price;
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

    public function reference_index()
    {
        return view('reference_user.reference');
    }
   public function reference(Request $request)
   {
        $ref_table = UserRef::all();
        $phone_number = $request->get('phone_number');
        $user = DB::table('users')->select('*')
                        ->where('phone_number',$phone_number)->first();
        //getting all refered user.
        $refered_user = \App\User::find($user->id)->user_refs;
        
        return view('reference_user.view_refered',compact('refered_user','user'));

   }
}
