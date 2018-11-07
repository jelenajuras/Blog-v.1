@extends('layouts.admin')

@section('title', 'Dozvole')

@section('content')
    <div class='btn-toolbar pull-right'>
		<a class="btn btn-default btn-md" href="{{ route('roles.create') }}" id="font12" >
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			Dodaj dozvolu
		</a>
	</div>
	<h3>Dozvole</h3>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Naziv</th>
                            <th>Slug</th>
                            <th>Dozvole</th>
                            <th>Opcije</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->slug }}</td>
                                <td>{{ implode(", ", array_keys($role->permissions)) }}</td>
                                <td>
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-default" id="btn1">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                        Ispravi
                                    </a>
                                   <!-- <a href="{{ route('roles.destroy', $role->id) }}" class="btn btn-danger action_confirm" data-method="delete" data-token="{{ csrf_token() }}">
                                        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                                        Obriši
                                    </a>-->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop
