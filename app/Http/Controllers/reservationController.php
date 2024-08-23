<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Reservation;
use App\Models\Times;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class reservationController extends Controller
{
    public function userReserv(Request $request)
    {
        $experts = DB::table('days')->where('expert_id' , 'like' , $request->expert_id)->get();
        if ($experts->isNotEmpty()){
        foreach ($experts as $expert) {
//            $days = DB::table('days')->where('day' , 'like', $request->day)->first();
            if ($expert->day == $request->day) {
                $times = DB::table('times')->where('days_id', 'like', $expert->id)->get();
                if ($times->isNotEmpty()) {
                    foreach ($times as $time) {
                      if ($time->from==$request->time) {
                            $x = Times::find($time->id);
                            $checkIfAva = DB::table('reservations')->where('time_id', 'like',$time->id)->get();
                            if ($checkIfAva->isEmpty()) {
                                $x->is_reservation = 1;
                                $x->save();
                                $reservation = new Reservation();
                                $reservation->user_id = $request->user_id;
                                $reservation->expert_id = $request->expert_id;
                                $reservation->time_id = $time->id;
                                $reservation->save();
                                $expert_id = Expert::find($request->expert_id);
                                $expertWallet = User::find($expert_id->user_id);
                                $x = $expertWallet->wallet + $expert_id->cost;
                                $expertWallet->wallet = $x;
                                $expertWallet->save();
                                $userWallet = User::find($request->user_id);
                                $userWallet->wallet = $userWallet->wallet - $expert_id->cost;
                                $userWallet->save();
                                return response()->json([
                                    "message" => "done"
                                ], 200);
                            }else{
                                 return response()->json([
                                    "message" => "reservation is not avaliable"
                                ], 404);
                            }
                      }
                    }
                } else {
                    return response()->json([
                        "message" => "not available"
                    ], 404);
                }
            }
        }
        }else{
            return response()->json([
                "message" => "expert not found"
            ],422);
        }
    }
    public function getAvailableReservation($id)
    {
        $days = DB::table('days')->where('expert_id','like',$id)->get();
        if ($days->isNotEmpty())
        {
            foreach ($days as $day)
            {
                $times = DB::table('times')->where('days_id','like',$day->id)->get();
                if ($times->isNotEmpty())
                {
                    foreach ($times as $time)
                    {
                        if (!$time->is_reservation)
                        {
                            $packet = [
                                "dayName" => $day->day,
                                "from" => $time->from,
                                "to" => $time->to
                            ];
                            $data[][] = $packet;
                        }
                    }
                }
            }
            return response()->json([
                'data' => $data
            ],200);
        }
        return response()->json([
            'message' => 'there is no reservation available'
        ],400);
    }
    public function myReservation($id)
    {
        $users = DB::table('reservations')->where('expert_id','like',$id)->get();
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                $username = DB::table('users')->where('id', 'like', $user->user_id)->first();
                $time = DB::table('times')->where('id', 'like', $user->time_id)->first();
                $packet = [
                    "userName" => $username->name,
                    "from" => $time->from,
                    "to" => $time->to
                ];
                $data[][] = $packet;
            }
            return response()->json([
                $data
            ]);
        }else{
            return response()->json([
                "there is no reservation"
            ],400);
        }
    }
}
