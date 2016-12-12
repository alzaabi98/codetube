<?php

namespace App\Http\Controllers;

use App\Http\Requests ;
use Illuminate\Http\Request;
use App\Models\Video ;
use App\Http\Requests\VideoUpdateRequest;

class VideoController extends Controller
{
    

    public function index(Request $request) {

    	$videos = $request->user()->videos()->latestFirst()->paginate(10);
    	
    	
    	return view('video.index',[

    		'videos' => $videos,
    		]);
    }
    
    public function update(VideoUpdateRequest $request, Video $video) {
    	
    	$this->authorize('update', $video);

    	$video->update([

    		'title' => $request->title,
    		'description' => $request->description,
    		'visibility' => $request->visibility,
    		'allow_votes' => $request->has('allow_votes'),
    		'allow_comments' => $request->has('allow_comments'),

    		]);

    		if ($request->ajax()) {

    			return response()->json(null,200);
    			# code...
    		}

    		return redirect()->back();
    }
    
    public function store(Request $request) {

    	
    	//generate uid

    	$uid = uniqid(true) ;
    	//dd($request->description);

  //   	//grab user's chanel
		 $channel = $request->user()->channel()->first();

		// //video 

		$video = $channel->videos()->create([

			'uid' => $uid ,
			'title' => $request->title ,
			'description' => $request->description,
			'visibility' => $request->visibility,
			'video_filename' => "{$uid}.{$request->extension}",	


			]);


		return response()->json([

			'data' => [

				'uid' => $uid ,
			]

			]);
    	
    }
    
}
