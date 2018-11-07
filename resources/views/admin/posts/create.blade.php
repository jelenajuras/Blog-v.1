@extends('layouts.admin')

@section('title', 'Create New Post')
<link rel="stylesheet" href="{{ URL::asset('css/create.css') }}" type="text/css" >
@section('content')
<div class="post row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Nova poruka</h3>
            </div>
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('admin.posts.store') }}">
                <fieldset>
					 <div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
						<label for="tražim">Tražim...</label>
						<select class="form-control" name="category_id" id="tražim" value="{{ old('category_id') }}">
							<option selected="selected" value=""></option>
							@foreach ($demands as $demand)
								<option name="category_id" value="{{ $demand['category_id'] }}">{{ $demand['naziv']}}</option>
							@endforeach	
						</select>
					</div>
					<div class="form-group {{ ($errors->has('title')) ? 'has-error' : '' }}">
                        <input class="form-control" name="title" placeholder="Naslov" type="text" value="{{ old('title') }}" />
                        {!! ($errors->has('title') ? $errors->first('title', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('content')) ? 'has-error' : '' }}">
                       <textarea class="form-control" name="content"  placeholder="Pouka"  type="text" ></textarea>
                        {!! ($errors->has('content') ? $errors->first('content', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg" type="submit" value="Pošalji" id="stil1">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
