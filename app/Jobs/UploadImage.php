<?php

namespace App\Jobs;

use App\Models\Channel ;
use Storage ;
use File ;
use Image;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UploadImage implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;


    protected $channel ;
    protected $fileId ;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Channel $channel, $fileId)
    {
        $this->channel = $channel ;

        $this->fileId = $fileId ;

    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // get the image
        $path = storage_path() . '/uploads/' . $this->fileId ;

        $filename = $this->fileId . '.png' ;
        
        //resize

        Image::make($path)->encode('png')->fit(40,40, function($c) {

            $c->upsize() ;

        })->save();
        //upload to s3


        if (Storage::disk('s3images')->put('profile/' . $filename , fopen($path, 'r+') ) ) {

            File::delete($path) ;

        }
    

        //deleete the temp file
        //update chanel image

        $this->channel->image_filename = $filename ;
        $this->channel->save();

    }
}