<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Video ;

class VideoViewController extends Controller
{
    

    public function create(Request $request,Video $video) {

    	if (!$video->canBeAccessed($request->user())) {

    		return ;
    	}

    	$video->views()->create([

    		'user_id' => $request->user() ? $request->user()->id : null ,
    		'ip' => $request->ip();

    	]);

    	return response()->json('null',200);
    	
    }
    
}
