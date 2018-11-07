@extends('layouts.admin')

@section('title', 'Nova kategorija')

@section('content')
<div class="page-header">
  <h2>Upis kategorije</h2>
</div> 
<div class="">
	<div class="col-md-8 col-md-offset-2 col-lg-6 col-lg-offset-3">
		<div class="panel panel-default">
			<div class="panel-body">
				 <form accept-charset="UTF-8" role="form" method="post" action="{{ route('categories.store') }}">
					<div class="form-group {{ ($errors->has('name'))  ? 'has-error' : '' }}">
                        <label>Naziv</label>
						<input name="name" type="text" class="form-control">
						{!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
						<label>Opis:</label>
						<input name="description" type="text" class="form-control">
						{!! ($errors->has('description') ? $errors->first('description', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					<input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn-primary btn-block" type="submit" value="Upiši kategoriju" id="stil1">
				</form>
			</div>
		</div>
	</div>
</div>

@stop