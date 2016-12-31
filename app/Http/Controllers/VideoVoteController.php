<?php

namespace App\Http\Controllers;

use App\Models\Video ;
use App\Models\Vote;
use Illuminate\Http\Request;

class VideoVoteController extends Controller
{
    
    public function show(Request $request, Video $video) {

    	$response =[

    		'up' => null,
    		'down' => null,
			'can_vote' => $video->votesAllowed(),
    		'user_vote' => null,
    	];

    	if ($video->votesAllowed()) {

    		$response['up'] = $video->upVotes()->count();
    		$response['down'] = $video->downVotes()->count();

    	}


    	if( $request->user()) {



    		$votesFromUser = $video->voteFromUser($request->user())->first();
    		$response['user'] = $votesFromUser ? $votesFromUser->type : null ;
    	}

    	return response()->json([

    		'data' => $response 
    	],200);
    	
    }
    
}
