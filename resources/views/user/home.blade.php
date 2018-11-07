@extends('layouts.admin')

@section('title')

@section('content')

<div class="poruke">
Home page

	<div>
		<h1>Poruke</h1>
		<div>
			@foreach($posts as $post)
			<p><a href="{{ route('post.show', $post->id) }}" >{{ $post->title }}</a></p>
				<div>{{ $post->user->email }}</div>
				

			@endforeach
		
		</div>
	</div>

</div>
@stop
