@extends('layouts.admin')

@section('title', 'Create New Role')

@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <br/>
		<h3 class="panel-title">Dodaj dozvolu</h3>
		<br/>
		<div class="panel panel-default">
            <div class="panel-body">
                <form accept-charset="UTF-8" role="form" method="post" action="{{ route('roles.store') }}">
                <fieldset>
                    <div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="Naziv" name="name" type="text" value="{{ old('name') }}" />
                        {!! ($errors->has('name') ? $errors->first('name', '<p class="text-danger">:message</p>') : '') !!}
                    </div>
                    <div class="form-group {{ ($errors->has('slug')) ? 'has-error' : '' }}">
                        <input class="form-control" placeholder="slug" name="slug" type="text" value="{{ old('slug') }}" />
                        {!! ($errors->has('slug') ? $errors->first('slug', '<p class="text-danger">:message</p>') : '') !!}
                    </div>

                    <h5>Permissions:</h5>
					<div class="col-md-4 col-md-offset-1">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.create]" value="1">
								users.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.update]" value="1">
								users.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.view]" value="1">
								users.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[users.destroy]" value="1">
								users.destroy
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.create]" value="1">
								roles.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.update]" value="1">
								roles.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.view]" value="1">
								roles.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[roles.delete]" value="1">
								roles.delete
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[posts.create]" value="1">
								posts.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[posts.update]" value="1">
								posts.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[posts.view]" value="1">
								posts.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[posts.delete]" value="1">
								posts.delete
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.create]" value="1">
								cities.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.update]" value="1">
								cities.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.view]" value="1">
								cities.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[cities.delete]" value="1">
								cities.delete
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.create]" value="1">
								customers.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.update]" value="1">
								customers.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.view]" value="1">
								customers.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.delete]" value="1">
								customers.delete
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.create]" value="1">
								projects.create
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.update]" value="1">
								projects.update
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.view]" value="1">
								projects.view
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input type="checkbox" name="permissions[customers.delete]" value="1">
								projects.delete
							</label>
						</div>
					</div>
					<div class="col-md-4 col-md-offset-1">
					
					</div>
					
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    <input class="btn btn-lg btn btn-block" type="submit" value="Dodaj dozvolu" id="input2">
                </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
