@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Environment Endpoint</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">

            {{ Form::open(['route'=>['applications.endpoints.environment_endpoints.destroy',$environmentendpoint->endpoint->application->uid, $environmentendpoint->endpoint->uid, $environmentendpoint->id],'method'=>'delete']) }}
                <div class="row">
                    <div class="small-4 columns">
                        {{ link_to_route('applications.endpoints.environment_endpoints.index', 'Done', [$environmentendpoint->endpoint->application->uid, $environmentendpoint->endpoint->uid], ['class'=>'button expand secondary']) }}
                    </div>
                    <div class="small-4 columns">
                        {{ link_to_route('applications.endpoints.environment_endpoints.edit', 'Edit', [$environmentendpoint->endpoint->application->uid, $environmentendpoint->endpoint->uid, $environmentendpoint->id], ['class'=>'button expand'] ) }}
                    </div>
                    <div class="small-4 columns">
                        {{ Form::submit('Delete', ['onclick'=>'return confirm("Are you sure you want to delete this record?")', 'class'=>'button expand alert']) }}
                    </div>
                </div>
            {{ Form::close() }}

            <div data-abide="data-abide">
                {{ Form::setModel($environmentendpoint) }}
                {{ Form::readonly('environment') }}
                {{ Form::readonly('endpoint') }}
                {{ Form::readonly('domain') }}
                {{ Form::readonly('path') }}
            </div>
        </div>
    </div>

@stop
