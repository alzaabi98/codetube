@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            video player
            <div class="panel panel-default">
                

                <div class="panel-body">
                    <h4>{{$video->title}}</h4>
                    <div class="pull-right">
                        video views
                    </div>

                    <div class="media">
                        <div class="media-left"></div>
                        <div class="media-body">
                            <a href="/channel/{{ $video->channel->slug}}">
                                <img src="{{$video->channel->getImage()}}" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            @if ($video->description) 
                <div class="panel panel-default">
                    

                    <div class="panel-body">
                        {!! nl2br(e($video->description)) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
