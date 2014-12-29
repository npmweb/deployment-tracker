@extends('layouts.layout')

@section('content')
	<h1 class="entry-title">Monitor</h1> 
	<p>{{ esc_body(url()) }} is functional.</p>
	<p>{{ esc_body($_SERVER['SERVER_ADDR']) }}</p>
	<hr /> 
	<p><strong>Please do not delete or alter this page unless specifically requested to do so. This page allows our provider to monitor this site.</strong></p> 
@stop
