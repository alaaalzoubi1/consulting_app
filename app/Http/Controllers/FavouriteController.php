<?php

namespace App\Http\Controllers;

use App\Models\Expert;
use App\Models\Favourite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ExpertController;

class FavouriteController extends Controller
{
    public function makeFavouriteList(Request $request)
    {
        
        $favourite = new Favourite();
        $favourite->user_id = $request->user_id;
        $favourite->expert_id = $request->expert_id;
        $favourite->save();
        return response()->json(['status' => 200]);
    }

    public function getFav ($id)
    {
        $users = DB::table('favourites')->where('user_id', 'Like', $id)->get();
        if ($users->isNotEmpty()){
        foreach($users as $user) {
            $experts = DB::table('experts')->where('id', 'Like', $user->expert_id)->first();
            $x = $experts->user_id;
            $name = User::find($x);
            $packet = [
              "x" => $name->name,
              "y" => $experts
            ];
            $data[][]=$packet;
        }

return response()->json([
    'status' => 200,
    'data' => $data,
],200);}
        else{
            return response()->json([
                "status" => 422],422);
        }
}
}
