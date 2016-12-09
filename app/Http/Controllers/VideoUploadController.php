<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\UploadVideo;
use Storage;
use File;

class VideoUploadController extends Controller
{
    
    public function index() {
    	
    	return view('video.upload') ;
    }


    public function store(Request $request) {
    	
    	//grap user channel
    	$channel = $request->user()->channel->first();
    	//lookup video
    	$video = $channel->videos()->where('uid', $request->uid)->firstOrFail() ;

    	//move to temp location

    	$request->file('video')->move(storage_path() . '/uploads', $video->video_filename);

    	//upload to s2

    	//$file = storage_path() . '/uploads/' . $video->video_filename ;

    	

    	$this->dispatch(new UploadVideo($video->video_filename) );

    	// if (Storage::disk('s3drop')->put($video->video_filename, fopen($file,'r+')) ) {

     //        File::delete($file);
     //    }



    	return response()->json(null,200);
    }
    
    
}
