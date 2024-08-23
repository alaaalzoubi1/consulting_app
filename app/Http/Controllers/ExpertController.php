<?php

namespace App\Http\Controllers;

use App\Models\Consulting;
use App\Models\Days;
use App\Models\Expert;
use App\Models\Expert_con;
use App\Models\Times;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExpertController extends Controller
{
    public function expertDetails(Request $request)
    {
        $is_expert = User::find($request->id);
        $x = DB::table('experts')->where("user_id", "=", $request->id)->get();
//        $expert = E::find($request->id);
        $validator = Validator::make($request->all(), [

            "address" => "required",

            "description" => "required",

        ]);

        if ($validator->fails()) {
            return response()->json([
                "message" => "An error was occurred",
                "error" => $validator->errors(),
            ],422);
        } else {
            if ($is_expert->is_expert) {
                if ($x->isEmpty()) {
                    $expert = new Expert();
                    $expert->address = $request->address;
                    $expert->description = $request->description;
                    $expert->cost = $request->cost;
                    $expert->user_id = $request->id;
                    $expert->save();
                } else {
                    return response()->json([
                        "status" => 400,
                        "message" => "expert already exist",
                    ],400);
                }
                $validator = Validator::make($request->all(), [
                    "medical" => "required|boolean",
                    "professional" => "required|boolean",
                    "psychlogical" => "required|boolean",
                    "family" => "required|boolean",
                    "business" => "required|boolean",
                ]);
//
                if ($validator->fails()) {
                    return response()->json([
                        "message" => "An error was occurred",
                        "error" => $validator->errors(),
                    ],422);
                } else {
                    if ($request->medical) {
                        $consulting = new Expert_con();
                        $consulting->con_id = 1;
                        $consulting->expert_id = $expert->id;
                        $consulting->save();
                    }
                    if ($request->professional) {
                        $consulting = new Expert_con();
                        $consulting->con_id = 2;
                        $consulting->expert_id = $expert->id;
                        $consulting->save();
                    }
                    if ($request->psychlogical) {
                        $consulting = new Expert_con();
                        $consulting->con_id = 3;
                        $consulting->expert_id = $expert->id;
                        $consulting->save();
                    }
                    if ($request->family) {
                        $consulting = new Expert_con();
                        $consulting->con_id = 4;
                        $consulting->expert_id = $expert->id;
                        $consulting->save();
                    }
                    if ($request->business) {
                        $consulting = new Expert_con();
                        $consulting->con_id = 5;
                        $consulting->expert_id = $expert->id;
                        $consulting->save();
                    }
                    $validator = Validator::make($request->all(), [
                        "sun" => "required|boolean",
                        "mon" => "required|boolean",
                        "tus" => "required|boolean",
                        "wed" => "required|boolean",
                        "thu" => "required|boolean",
                        "fri" => "required|boolean",
                        "sat" => "required|boolean",
                    ]);
//
                    if ($validator->fails()) {
                        return response()->json([
                            "message" => "An error was occurred",
                            "error" => $validator->errors(),
                        ],422);
                    } else {
                        if ($request->sun) {
                            $validator = Validator::make($request->all(), [
                                "from1" => "required|integer",
                                "to1" => "required|integer",
                            ]);
                            if ($validator->fails()) {
                                return response()->json([
                                    "message" => "An error was occurred",
                                    "error" => $validator->errors(),
                                ],422);
                            } else {
                                $day = new Days();
                                $day->expert_id = $expert->id;
                                $day->day = "sunday";
                                $day->save();
                                for ($i = $request->from1; $i < $request->to1; $i++) {
                                    $time = new Times();
                                    $time->days_id = $day->id;
                                    $time->from = $i;
                                    $time->to = $i + 1;
                                    $time->save();
                                }
                            }
                        }
                        if ($request->mon) {
                            $validator = Validator::make($request->all(), [
                                "from2" => "required|integer",
                                "to2" => "required|integer",
                            ]);
                            if ($validator->fails()) {
                                return response()->json([
                                    "message" => "An error was occurred",
                                    "error" => $validator->errors(),
                                ],422);
                            } else {
                                $day = new Days();
                                $day->expert_id = $expert->id;
                                $day->day = "monday";
                                $day->save();
                                for ($i = $request->from2; $i < $request->to2; $i++) {
                                    $time = new Times();
                                    $time->days_id = $day->id;
                                    $time->from = $i;
                                    $time->to = $i + 1;
                                    $time->save();
                                }
                            }
                        }
                        if ($request->tue) {
                            $validator = Validator::make($request->all(), [
                                "from3" => "required|integer",
                                "to3" => "required|integer",
                            ]);
                            if ($validator->fails()) {
                                return response()->json([
                                    "message" => "An error was occurred",
                                    "error" => $validator->errors(),
                                ],422);
                            } else {
                                $day = new Days();
                                $day->expert_id = $expert->id;
                                $day->day = "tuesday";
                                $day->save();
                                for ($i = $request->from3; $i < $request->to3; $i++) {
                                    $time = new Times();
                                    $time->days_id = $day->id;
                                    $time->from = $i;
                                    $time->to = $i + 1;
                                    $time->save();
                                }

                            }
                        }
                        if ($request->wed) {
                            $validator = Validator::make($request->all(), [
                                "from4" => "required|integer",
                                "to4" => "required|integer",
                            ]);
                            if ($validator->fails()) {
                                return response()->json([
                                    "message" => "An error was occurred",
                                    "error" => $validator->errors(),
                                ],422);
                            } else {
                                $day = new Days();
                                $day->expert_id = $expert->id;
                                $day->day = "wednesday";
                                $day->save();
                                for ($i = $request->from4; $i < $request->to4; $i++) {
                                    $time = new Times();
                                    $time->days_id = $day->id;
                                    $time->from = $i;
                                    $time->to = $i + 1;
                                    $time->save();
                                }
                            }
                        }
                        if ($request->thu) {
                            $validator = Validator::make($request->all(), [
                                "from5" => "required|integer",
                                "to5" => "required|integer",
                            ]);
                            if ($validator->fails()) {
                                return response()->json([
                                    "message" => "An error was occurred",
                                    "error" => $validator->errors(),
                                ],422);
                            } else {
                                $day = new Days();
                                $day->expert_id = $expert->id;
                                $day->day = "thursday";
                                $day->save();
                                for ($i = $request->from5; $i < $request->to5; $i++) {
                                    $time = new Times();
                                    $time->days_id = $day->id;
                                    $time->from = $i;
                                    $time->to = $i + 1;
                                    $time->save();
                                }
                            }
                        }
                        if ($request->fri) {
                            $validator = Validator::make($request->all(), [
                                "from6" => "required|integer",
                                "to6" => "required|integer",
                            ]);
                            if ($validator->fails()) {
                                return response()->json([
                                    "message" => "An error was occurred",
                                    "error" => $validator->errors(),
                                ],422);
                            } else {
                                $day = new Days();
                                $day->expert_id = $expert->id;
                                $day->day = "friday";
                                $day->save();
                                for ($i = $request->from6; $i < $request->to6; $i++) {
                                    $time = new Times();
                                    $time->days_id = $day->id;
                                    $time->from = $i;
                                    $time->to = $i + 1;
                                    $time->save();
                                }
                            }
                        }
                        if ($request->sat) {
                            $validator = Validator::make($request->all(), [
                                "from7" => "required|integer",
                                "to7" => "required|integer",
                            ]);
                            if ($validator->fails()) {
                                return response()->json([
                                    "message" => "An error was occurred",
                                    "error" => $validator->errors(),
                                ],422);
                            } else {
                                $day = new Days();
                                $day->expert_id = $expert->id;
                                $day->day = "saturday";
                                $day->save();
                                for ($i = $request->from7; $i < $request->to7; $i++) {
                                    $time = new Times();
                                    $time->days_id = $day->id;
                                    $time->from = $i;
                                    $time->to = $i + 1;
                                    $time->save();
                                }

                            }

                        }

                        return response()->json([
                            "status" => 200,
                            "message" => "done"
                        ]); }
                }
            } else {
                return response()->json([
                    "status" => 400,
                    "message" => "you are not expert"
                ],400);
            }
        }
    }
//    public function getName(Request $request)
//    {
//        $expert = User::find($request->user_id);
//        return $expert->name;
//
//
//    }
//    public function conGet(Request $request)
//    {
//        $consulting = new Expert_con();
//        if($request->medical)
//        {$consulting = new Expert_con();
//            $consulting->con_id = 1;
//            $consulting->expert_id = $request->expert_id;
//            $consulting->save();
//        }
//        if($request->professional)
//        {$consulting = new Expert_con();
//            $consulting->con_id = 2;
//            $consulting->expert_id = $request->expert_id;
//            $consulting->save();
//        }
//        if($request->psychlogical)
//        {$consulting = new Expert_con();
//            $consulting->con_id = 3;
//            $consulting->expert_id = $request->expert_id;
//            $consulting->save();
//        }
//        if($request->family)
//        {$consulting = new Expert_con();
//            $consulting->con_id = 4;
//            $consulting->expert_id = $request->expert_id;
//            $consulting->save();
//        }
//        if($request->business)
//        {$consulting = new Expert_con();
//            $consulting->con_id = 5;
//            $consulting->expert_id = $request->expert_id;
//            $consulting->save();
//        }
//        return response()->json([
//            'status' => true,
//            'message' => "done"
//        ]);
//    }
    public function search(Request $request)
    {
        $users = DB::table('users')->where('name', 'like', $request->name . "%")->get();
        if ($users->isNotEmpty()) {
            foreach ($users as $user) {
                if ($user->is_expert) {
                    $expertname = $user->name;
                    $expertsDetails = DB::table('experts')->where('user_id', 'like', $user->id)->get();
                    $packet = [
                        "name" => $expertname,
                        "details" => $expertsDetails
                    ];
                    $data [] = $packet;
                }
            }
            sort($data);
            return response()->json([
                "status" => 1,
                "data" => $data,
            ]);
        }else{
            return response()->json([

                "message" => "not found"
            ],404);
        }
    }
}






