<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Http\Requests ;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;


class EncodingWebhookController extends Controller
{
    

    
    public function handle(Request $request) {


    	Log::info($request);

    	
    	$event = camel_case($request->event) ;
    	//$event = str_replace('-', '', $event);

    	//return $event ;

    	if (method_exists($this, $event)) {
    		
    		$this->{$event}($request) ;
    		//$this->videoEncoded($request);
    	}
    	
    }


    public function videoEncoded(Request $request){

    	//lookup video

    	//return("yes");

   		$video = $this->getVideoByFileName($request->original_filename) ;



    	$video->processed = true ;
    	$video->video_id = $request->encoding_ids[0];
    	$video->save();

    	//update processed column

    }

    public function encodingProgress(Request $request){

   		$video = $this->getVideoByFileName($request->original_filename) ;

   		$video->processed_percentage = $request->progress ;

   		$video->save();


    }

    protected function getVideoByFileName($filename){

    	return Video::where('video_filename', $filename)->firstOrFail();

    }
    
}
