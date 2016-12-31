<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Video ;

class VideoViewController extends Controller
{
    

    public function create(Request $request,Video $video) {


       //return response()->json('ok',200);
        return response()->json([

         'name' =>  'abdulaziz al zaabi',
         'age' => 36.3 ,
        ]);

    	// if (!$video->canBeAccessed($request->user())) {

    	// 	return ;
    	// }

    	// $video->views()->create([

    	// 	'user_id' => $request->user() ? $request->user()->id : null ,
    	// 	'ip' => $request->ip();

    	// ]);

    	// return response()->json('null',200);
    	
    }
    
}
