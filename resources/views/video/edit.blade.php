@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit Video "{{$video->title}}"</div>

                <div class="panel-body">
                    <form action="/videos/{{$video->uid}}" method="put">

                        <div class="form-group{{$errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Title</label>

                            <input type="text"  class="form-control" id="title" name="title"   value="{{ old('title') ? old('title') : $video->title  }}">
                        
                            @if ($errors->has('title'))

                                    <div class="help-block">
                                       {{$errors->first('title')}}
                                    </div>
                            @endif
                         </div>

                        <div class="form-group{{$errors->has('description') ? ' has-error' : '' }}">
                            <label for="description">Description</label>
                            
                            <textarea name="description" id="description" class="form-control">{{ old('description') ? old('description') : $video->description }}</textarea> 
                        
                            @if ($errors->has('description'))

                                    <div class="help-block">
                                       {{$errors->first('description')}}
                                    </div>
                            @endif
                         </div>

                        <div class="form-group{{$errors->has('visibility') ? ' has-error' : '' }}">
                            <label for="visibility">Visibility</label>
                            <select name="visibility" id="visibility" class="form-control">
                                @foreach(['priavate', 'public', 'unlisted'] as $visibility)
                                    <option value="$visibility"{{ $visibility == $video->visibility ? ' selected="selected"' : ''}}> {{ ucfirst($visibility) }}</option>
                                @endforeach

                            </select>
                        
                            @if ($errors->has('visibility'))

                                    <div class="help-block">
                                       {{$errors->first('visibility')}}
                                    </div>
                            @endif
                         </div>

                        {{ csrf_field() }}
                        {{ method_field('PUT')}}
                        

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
