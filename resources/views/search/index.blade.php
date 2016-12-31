@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">search "{{ Request::get('q')}}"</div>

                <div class="panel-body">
                    @if ($channels->count())
                        <h4>channels</h4>
                        <div class="well">
                            @foreach ($channels as $channel)
                                <div class="media">
                                    <div class="media-left">
                                        <a href="/channel/{{ $channel->slug}}">
                                            <img src="{{$channel->getImage()}}" alt="{{$channel->name}} image" class="media-object">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <a href="/channel/{{ $channel->slug}}" class="media-heading">{{$channel->name}}</a>

                                        subsciption count
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @endif

                    @if ($videos->count())

                        @foreach($videos as $video)
                            <div class="well">
                                @include('video.partials._video_result',[

                                    'videos' => $videos,

                                ])
                            </div>

                        @endforeach 

                    @else
                        <p>No videos found</p>

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
