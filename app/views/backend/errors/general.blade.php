@extends('layouts.layout')

@section('content')
	<div class="row">
		<div class="columns">
			<h1>Sorry, an error occurred</h1>
		</div>
	</div>
	<div class="row">
		<div class="columns">
			<p>We're sorry, but a server error has occurred.</p>
			<p>Code {{ esc_body($exception->getStatusCode()) }}</p>
		</div>
	</div>
@stop
