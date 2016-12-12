@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Videos</div>

                    <div class="panel-body">
                        @if($videos->count())

                            @foreach ($videos as $video)

                                <div class="well">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <a href="/vidoes/{{ $video->uid}}">
                                                <img src="{{ $video->getThumbnail()}}" alt="{{$video->title}} thumbnail" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="col-sm-9">
                                            <a href="/vidoes/{{ $video->uid}}">{{ $video->title}}</a>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    @if (!$video->isProcessed())

                                                        Processing ({{ $video->processedPercentage() ? $video->processedPercentage() . '%' : 'starting up' }})
        
                                                    @else
                                                        <span> {{$video->created_at->toDateTimeString() }}</span>

                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p>
                                                        {{ ucfirst($video->visibility) }}    
                                                    </p>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach

                        @else

                            you have no vidoes

                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
