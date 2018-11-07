@extends('layouts.admin')

@section('title', 'Edit User')
<link rel="stylesheet" href="{{ URL::asset('css/create.css') }}" type="text/css" 
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
		<br/>
		<h3 class="panel-title">Ispravi podatke korisnika</h3>
		<br/>
        <div class="register panel panel-default">
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('users.update', $user->id) }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('status')) ? 'has-error' : '' }}">
						<input type="radio" name="status" value="pravna" {!!  $user->status ==  'pravna' ? 'checked'  : '' !!} > Pravna osoba
						<input type="radio" name="status" value="fizicka" {!!  $user->status ==  'fizicka' ? 'checked'  : '' !!}> Fizička osoba<br>
						{!! ($errors->has('status') ? $errors->first('status', '<p class="text-danger">:message</p>') : '') !!}
					</div>
					<div class="form-group {{ ($errors->has('first_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Ime" name="first_name" type="text" value="{{ $user->first_name }}" />
                        {!! ($errors->has('first_name') ? $errors->first('first_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('last_name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Prezime" name="last_name" type="text" value="{{ $user->last_name }}" />
                        {!! ($errors->has('last_name') ? $errors->first('last_name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('company')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Poduzeće" name="company" type="text" value="{{ $user->company }}">
                        {!! ($errors->has('company') ? $errors->first('company', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('address')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Adresa" name="address" type="text" value="{{ $user->address }}">
                        {!! ($errors->has('address') ? $errors->first('address', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('city')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Grad" name="city" type="text" value="{{ $user->city }}">
                        {!! ($errors->has('city') ? $errors->first('city', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					<div class="form-group {{ ($errors->has('telefon')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Telefon" name="telefon" type="text" value="{{ $user->telefon }}">
                        {!! ($errors->has('telefon') ? $errors->first('telefon', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
					
                    <div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="E-mail" name="email" type="text" value="{{ $user->email }}">
                        {!! ($errors->has('email') ? $errors->first('email', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group  {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
					<span>Kategorije potražnja</span>
						@foreach($categories as $category)
							<div class="category">
								@if($demand_category)
									<label><input type="checkbox" name="demand_category_id[]" value="{{ $category->id }}"<?php foreach($demand_category as $demand){ ?>  {!!  $demand ==  $category->id ? 'checked'  : '' !!}<?php } ?>/>{{ $category->name }} </label>
								@else
									<label><input type="checkbox" name="demand_category_id[]" value="{{ $category->id }}"/>{{ $category->name }} </label>
								@endif
							</div>
						@endforeach
					</div>
					<div class="form-group  {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
					<span>Kategorije ponuda</span>
						@foreach($categories as $category)
							<div class="category">
								@if($offer_category)
									<label><input type="checkbox" name="offer_category_id[]" value="{{ $category->id }}" <?php foreach($offer_category as $offer){ ?>  {!!  $offer ==  $category->id ? 'checked'  : '' !!}<?php } ?> >{{ $category->name }}</label>
								@else
									<label><input type="checkbox" name="offer_category_id[]" value="{{ $category->id }}">{{ $category->name }}</label>
								@endif
							</div>
						@endforeach
					</div>
				
					<div class="roles form-group">
						<span>Roles</span>
						@foreach ($roles as $role)
							<div class="checkbox">
								<label>
									<input type="checkbox" name="roles[{{ $role->slug }}]" value="{{ $role->id }}" {{ $user->inRole($role) ? 'checked' : '' }}>
									{{ $role->name }}
								</label>
							</div>
						@endforeach
					</div>
                    <hr />
                    <div class="form-group">
                        <input class="form-control" placeholder="Password" name="password" type="password" value="">
                    </div>
                    <div class="form-group {{ ($errors->has('password_confirmation')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Potvrdi password" name="password_confirmation" type="password" value="{{ old('password_confirmation') }}" />
                        {!! ($errors->has('password_confirmation') ? $errors->first('password_confirmation', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input name="_method" value="PUT" type="hidden">
                    <input class="btn btn-lg btn-default btn-block" type="submit" value="Ispravi korisnika" id="input2">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
