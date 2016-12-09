<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Video;

class EncodingWebhookController extends Controller
{
    
    public function handle(Request $request) {

    	$event = camel_case($request->event) ;

    	if (method_exists($this, $event)) {
    		
    		$this->{$event}($request) ;
    	}
    	
    }

    protected function videoEncoded(Request $request){

    	//lookup video

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

    	return Video::where('vide_filename', $filename)->firstorFail();

    }
    
}
