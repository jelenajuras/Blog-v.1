@extends('layouts.index')

@section('title', 'Register')
<link rel="stylesheet" href="{{ URL::asset('css/create.css') }}" type="text/css" >
@section('content')
<div class="row">
    <div class="col-md-4 col-md-offset-4">
	<br/>
	<h3 class="panel-title">Registriraj se</h3>
	<br/>
</div>
<div class="register row">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-default">
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('auth.register.attempt') }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('status')) ? 'has-error' : '' }}">
						<input type="radio" name="status" value="pravna" checked> Pravna osoba
						<input type="radio" name="status" value="fizicka"> Fizička osoba<br>
						{!! ($errors->has('status') ? $errors->first('status', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					<div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Ime" name="first_name" type="text" value="{{ old('first_name') }}">
                        {!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Prezime" name="last_name" type="text" value="{{ old('last_name') }}">
                        {!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('company')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Poduzeće" name="company" type="text" value="{{ old('company') }}">
                        {!! ($errors->has('company') ? $errors->first('company', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('address')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Adresa" name="address" type="text" value="{{ old('address') }}">
                        {!! ($errors->has('address') ? $errors->first('address', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('city')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Grad" name="city" type="text" value="{{ old('city') }}">
                        {!! ($errors->has('city') ? $errors->first('city', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('telefon')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Telefon" name="telefon" type="text" value="{{ old('telefon') }}">
                        {!! ($errors->has('telefon') ? $errors->first('telefon', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ old('email') }}">
                        {!! ($errors->has('email') ? $errors->first('email', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group  {{ ($errors->has('password')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Lozinka" name="password" type="password">
                        {!! ($errors->has('password') ? $errors->first('password', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group  {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Potvrdi lozinku" name="password_confirmation" type="password">
                        {!! ($errors->has('password_confirmation') ? $errors->first('password_confirmation', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group  {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
					<span>Kategorije potražnja</span>
						@foreach($categories as $category)
							<div class="form-group">
								<div class="category">
									<label><input type="checkbox" name="demand_category_id[]" value="{{ $category->id }}">{{ $category->name }}</label>
								</div>
							</div>
						@endforeach
					</div>
					<div class="form-group  {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
					<span>Kategorije ponuda</span>
						@foreach($categories as $category)
							<div class="form-group">
								<div class="category">
									<label><input type="checkbox" name="offer_category_id[]" value="{{ $category->id }}">{{ $category->name }}</label>
								</div>
							</div>
						@endforeach
					</div>
					
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn btn-block" type="submit" value="Registracija" id="input2">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
