@extends('layouts.admin')

@section('title', 'Posts')
<link rel="stylesheet" href="{{ URL::asset('css/index.css') }}" type="text/css" >
@section('content')
<div class="page-header">
	<div class='btn-toolbar pull-right'>
		<a class="btn btn-primary btn-lg" href="{{ route('admin.posts.create') }}">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
			Create Post
		</a>
	</div>
	<h1>Poruke</h1>
</div>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		@if(count($posts) > 0)
			@if(count($demand_categories) > 0)
				<h3>{{ 'Moji upiti' }}</h3>
				@foreach($demand_categories as $demand_category)
				<?php $category = $categories->where('id',$demand_category)->first(); ?>
					<h4>{{ $category->name }}</h4>
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Title</th>
								<th>User</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
					
						@foreach($posts as $post)
							@if($post->user_id == $user->id && $post->category_id == $demand_category)
								<tr>
									<td>
										<a href="{{ route('admin.posts.show', $post->id) }}">
											{{ $post->title }}
										</a>
									</td>
									<td>{{ $post->user->email }}</td>
									<td>
										<a href="{{ route('admin.posts.edit', $post->id) }}" {{ Sentinel::getUser()->id != $post->user_id ? 'disabled' : '' }}">
											<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
											
										</a>
										<a href="{{ route('admin.posts.destroy', $post->id) }}" class="action_confirm" data-method="delete" data-token="{{ csrf_token() }}">
											<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
											
										</a>
									</td>
								</tr>
							@endif
						@endforeach
					
						</tbody>
					</table>
				@endforeach
			@endif
			@if(count($offer_categories) > 0)
				<h3>{{ 'Primljeni upiti' }}</h3>
				@foreach($offer_categories as $offer_category)
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Title</th>
								<th>User</th>
								<th>Options</th>
							</tr>
						</thead>
						<tbody>
						<?php $category = $categories->where('id',$offer_category)->first(); ?>
							<h4>{{ $category->name }}</h4>
								@foreach ($posts as $post)
									@if($post->category_id == $offer_category)
										<tr>
											<td>
												<a href="{{ route('admin.posts.show', $post->id) }}">
													{{ $post->title }}
												</a>
											</td>
											<td>{{ $post->user->email }}</td>
											<td>
												<a href="{{ route('admin.posts.edit', $post->id) }}" {{ Sentinel::getUser()->id != $post->user_id ? 'disabled' : '' }}">
													<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
													
												</a>
												<a href="{{ route('admin.posts.destroy', $post->id) }}" class="action_confirm" data-method="delete" data-token="{{ csrf_token() }}">
													<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
												</a>
											</td>
										</tr>
									@endif
								@endforeach
						</tbody>
					</table>
				@endforeach
			
			@endif
		@else
			{{ 'Nema poruka' }}
		@endif
	</div>
</div>
@stop
