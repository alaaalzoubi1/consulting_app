<?php

namespace App\Http\Controllers;

use App\Models\Days;
use App\Models\Expert;
use App\Models\Expert_con;
use App\Models\Times;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class  UserController extends Controller
{
    
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required",
            "phone_num" => "required|unique:users",
            "password" => "required|confirmed",
            "is_expert" => "required|boolean",
            "wallet" => "required|integer"
        ]);
//
        if ($validator->fails()) {
            return response()->json([
                "message" => "An error was occurred",
                "error" => $validator->errors(),
            ],422);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->wallet = $request->wallet;
            $user->phone_num = $request->phone_num;
            $user->password = Hash::make($request->password);
            $user->is_expert = $request->is_expert;
            $user->save();
            return response()->json([
                "status" => 200,
                "message" => "user registered succesfully",
                "id" => $user->id,
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "phone_num" => "required",
            "password" => "required",

        ]);
        if ($validator->fails()) {
            return response()->json([
                "message" => "An error was occurred",
                "error" => $validator->errors(),
            ],422);
        } else {
            $user = User::where("phone_num", "=", $request->phone_num)->first();
            if (isset($user->id)) {
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken("auth_token")->plainTextToken;

                    return response()->json([
                        "status" => 1,
                        "message" => " Expert logged in succesfully",
                        "access_token" => $token,
                        "is_expert" => $user->is_expert
                    ]);
                } else {
                    return response()->json([
                        "status" => 0,
                        "message" => "password did not match"
                    ], 404);
                }
            } else {
                return response()->json([
                    "status" => 0,
                    "message" => "Expert did not found"
                ], 404);
            }
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "status" => 1,
            "message" => "thanks for using our application"
        ]);
    }
    public function getExperts($con)
    {
        $consultings = DB::table('expert_cons')->where('con_id','like',$con)->get();
        if ($consultings->isNotEmpty()){
        foreach ($consultings as $consulting)
            {
                $expert = DB::table('experts')->where('id','like',$consulting->expert_id)->first();
                $name = DB::table('users')->where('id','like',$expert->user_id)->first();
                $days = DB::table('days')->where('expert_id' , 'like' , $expert->id)->get();
                foreach ($days as $day)
                {
                    $times = DB::table('times')->where('days_id' , 'like' , $day->id)->get();
                    foreach ($times as $time)
                    {
                        if (!$time->is_reservation)
                        $reservation = [
                            "dayName" => $day->day,
                            "from" => $time->from,
                            "to" => $time->to
                        ];
                        $timeData[] = $reservation;
                    }
                }
                $packet = [
                    "username" => $name->name,
                    "id" => $expert->id,
                    "cost" => $expert->cost,
                    "address" => $expert->address,
                    "rate" => $expert->rate,
                    "description" => $expert->description,
                    "reservation" => $timeData
                ];
                $data[]=$packet;
            }
        return response()->json([
            "data" => $data
        ]);
    }
    else{
        return response()->json([
        ],422);
}
}}
