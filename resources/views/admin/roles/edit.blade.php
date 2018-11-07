@extends('layouts.admin')

@section('title', 'Edit Role')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
		<br/>
		<h3 class="panel-title">Ispravi dozvolu</h3>
        <br/>
		<div class="panel panel-default">
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('roles.update', $role->id) }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Naziv" name="name" type="text" value="{{ $role->name }}" />
                        {!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('slug')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="slug" name="slug" type="text" value="{{ $role->slug }}" />
                        {!! ($errors->has('slug') ? $errors->first('slug', '<p class="text-danger">:message</p>') : '') !!}
                    </div>

                    <h5>Permissions:</h5>
					<div class="col-md-4 col-md-offset-1">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.create]" value="1" {{ $role->hasAccess('users.create') ? 'checked' : '' }}>
								users.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.update]" value="1" {{ $role->hasAccess('users.update') ? 'checked' : '' }}>
								users.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.view]" value="1" {{ $role->hasAccess('users.view') ? 'checked' : '' }}>
								users.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.destroy]" value="1" {{ $role->hasAccess('users.destroy') ? 'checked' : '' }}>
								users.destroy
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.create]" value="1" {{ $role->hasAccess('roles.create') ? 'checked' : '' }}>
								roles.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.update]" value="1" {{ $role->hasAccess('roles.update') ? 'checked' : '' }}>
								roles.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.view]" value="1" {{ $role->hasAccess('roles.view') ? 'checked' : '' }}>
								roles.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.delete]" value="1" {{ $role->hasAccess('roles.delete') ? 'checked' : '' }}>
								roles.delete
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.create]" value="1" {{ $role->hasAccess('cities.create') ? 'checked' : '' }}>
								cities.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.update]" value="1" {{ $role->hasAccess('cities.update') ? 'checked' : '' }}>
								cities.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.view]" value="1" {{ $role->hasAccess('cities.view') ? 'checked' : '' }}>
								cities.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.delete]" value="1" {{ $role->hasAccess('cities.delete') ? 'checked' : '' }}>
								cities.delete
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.create]" value="1" {{ $role->hasAccess('customers.create') ? 'checked' : '' }}>
								customers.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.update]" value="1" {{ $role->hasAccess('customers.update') ? 'checked' : '' }}>
								customers.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.view]" value="1" {{ $role->hasAccess('customers.view') ? 'checked' : '' }}>
								customers.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.delete]" value="1" {{ $role->hasAccess('customers.delete') ? 'checked' : '' }}>
								customers.delete
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[projects.create]" value="1" {{ $role->hasAccess('projects.create') ? 'checked' : '' }}>
								projects.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[projects.update]" value="1" {{ $role->hasAccess('projects.update') ? 'checked' : '' }}>
								projects.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[projects.view]" value="1" {{ $role->hasAccess('projects.view') ? 'checked' : '' }}>
								projects.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[projects.delete]" value="1" {{ $role->hasAccess('projects.delete') ? 'checked' : '' }}>
								projects.delete
							</label>
						</div>
					</div>
					
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input name="_method" value="PUT" type="hidden">
                    <input class="btn btn-lg btn btn-block" type="submit" value="Ispravi dozvolu" id="input2">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
