@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

            video player

            @if( $video->isPrivate())
                <div class="alert alert-info">
                    your video is currently private . only you can see it . 

                </div>
            @endif
            <div class="panel panel-default">
                

                <div class="panel-body">
                    <h4>{{$video->title}}</h4>
                    <div class="pull-right">
                        video views
                    </div>

                    <div class="media">
                        <div class="media-left">
                            <a href="/channel/{{ $video->channel->slug}}">
                                <img src="{{$video->channel->getImage()}}" alt="">
                            </a>
                        </div>
                        <div class="media-body">
                            <a href="/channel/{{$video->channel->slug}}" class="media-heading">{{$video->channel->name}}</a>
                            subscribe button
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


             <div class="panel panel-default">
                    

                    <div class="panel-body">
                        @if ($video->commentsAllowed())
                            Comments
                        @else
                            <p>comments are not allowed</p>
                        @endif
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
