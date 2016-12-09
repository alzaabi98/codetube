<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class EncodingWebhookController extends Controller
{
    
    public function handle(Request $request) {

    	
    	$event = camel_case($request->event) ;
    	//$event = str_replace('-', '', $event);


    	if (method_exists($this, $event)) {
    		
    		$this->{$event}($request) ;
    	}
    	
    }

    protected function videoEncoded(Request $request){

    	//lookup video

    	Log::info($request);

    	$video = getVideoByFileName($request->original_filename) ;



    	$video->processed = true ;
    	$video->video_id = $request->encoding_ids[0];
    	$video->save();

    	//update processed column

    }

    protected function encodingProgress(Request $request){

   		$video = getVideoByFileName($request->original_filename) ;

   		$video->processed_percentage = $request->progress ;


    }

    protected function getVideoByFileName($filename){

    	return Video::where('video_filename', $filename)->firstOrFail();

    }
    
}
