@extends('layouts.admin')

@section('title', 'Users')
<link rel="stylesheet" href="{{ URL::asset('css/index.css') }}" type="text/css" >
@section('content')
<div class="">
	<div class="page-header">
		<div class='btn-toolbar pull-right'>
			<a class="btn btn-default btn-md" href="{{ route('users.create') }}" id="stil1">
				<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
				Dodaj korisnika
			</a>
		</div>
		<h3>Korisnici</h3>
	</div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="table-responsive">
				<table id="table_id" class="display" style="width: 100%;">
					<thead>
						<tr>
							<th>Avatar</th>
							<th>Ime i prezime</th>
							<th>Tvrtka</th>
							<th>email</th>
							<th>Telefon</th>
							<th>Uloge</th>
							<th class="option not-export-column">Opcije</th>
						</tr>
					</thead>
					<tbody id="myTable">
						@foreach($users as $user)
							<tr>
								<td><img src="//www.gravatar.com/avatar/{{ md5($user->email) }}?d=mm" alt="{{ $user->email }}" class="img-circle"></td>
								<td>{{ $user->first_name . " ". $user->last_name }}</td>
								<td>{{ $user->company }}</td>
								<td>{{ $user->email }}</td>
								<td>{{ $user->telefon }}</td>
								<td>@if ($user->roles->count() > 0)
									{{ $user->roles->implode('name', ', ') }}
								@else
									<em>No Assigned Role</em>
								@endif</td>

								<td class="option not-export-column" ><a href="{{ route('users.edit', $user->id) }}" >
									<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
									
								</a>
								<a href="{{ route('users.destroy', $user->id) }}" class="action_confirm" data-method="delete" data-token="{{ csrf_token() }}">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</a></td>
							</tr>
						@endforeach

					</tbody>
                </table>
			</div>
        </div>
    </div>
</div>
@stop
