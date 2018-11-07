@extends('layouts.admin')

@section('title', 'Kategorije')
<link rel="stylesheet" href="{{ URL::asset('css/create.css') }}" type="text/css" >
@section('content')
<div class="category">
    <div class="page-header">
        <div class='btn-toolbar pull-right' >
            <a class="btn btn-primary btn-lg" href="{{ route('categories.create') }}"  id="stil1" >
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                Unesi novu kategoriju
            </a>
        </div>
        <h1>Kategorije</h1>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="table-responsive">
			@if(count($categories) > 0)
                 <table id="table_id" class="display" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width:30%">Naziv</th>
							<th style="width:60%">opis</th>
                            <th class="not-export-column" style="width:10%">Opcije</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
								<td>{{ $category->description }}</td>
                                <td style="text-align:center">
                                    <a href="{{ route('categories.edit', $category->id) }}">
                                        <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                                    </a>
                                    <a href="{{ route('categories.destroy', $category->id) }}" class="action_confirm" data-method="delete" data-token="{{ csrf_token() }}">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
						
                    </tbody>
                </table>
				@else
					{{'Nema podataka!'}}
				@endif
            </div>
        </div>
    </div>
</div>

@stop
