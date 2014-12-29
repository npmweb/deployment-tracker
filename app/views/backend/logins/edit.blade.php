@extends('layouts.layout')

@section('content')
	<div class="row">
		<div class="columns">
			<h1>Log In</h1>
		</div>
	</div>
	<div class="row">
		<div class="columns">
			{{ Form::model( $model, ['route' => 'logins.store', 'validate'=>false, 'data-abide'=>''])}}

				{{ Form::text('username',null,['errors'=>$errors]) }}
				{{ Form::password('password',['errors'=>$errors]) }}

				<div class="medium-6 medium-offset-3">
					{{ Form::submit('Log in', ['class'=>'button']) }}
				</div>

			{{ Form::close() }}
		</div>
	</div>
@stop
