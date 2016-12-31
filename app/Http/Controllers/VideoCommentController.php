<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\models\Video;

class VideoCommentController extends Controller
{
    
    public function index(Video $video) {
    	
    	return response()->json([

    		'name' =>  'abdulaziz al zaabi',
    		'age' => 36.3 ,
    	]);
    }
    
}
