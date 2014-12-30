@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Endpoint</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">

            {{ Form::open(['route'=>['applications.endpoints.destroy',$endpoint->application->uid, $endpoint->uid],'method'=>'delete']) }}
                <div class="row">
                    <div class="small-4 columns">
                        {{ link_to_route('applications.endpoints.index', 'Done', $endpoint->application->uid, ['class'=>'button expand secondary']) }}
                    </div>
                    <div class="small-4 columns">
                        {{ link_to_route('applications.endpoints.edit', 'Edit', [$endpoint->application->uid, $endpoint->uid], ['class'=>'button expand'] ) }}
                    </div>
                    <div class="small-4 columns">
                        {{ Form::submit('Delete', ['onclick'=>'return confirm("Are you sure you want to delete this record?")', 'class'=>'button expand alert']) }}
                    </div>
                </div>
            {{ Form::close() }}

            <div data-abide="data-abide">
                {{ Form::setModel($endpoint) }}
                {{ Form::readonly('name') }}
            </div>
        </div>
    </div>

@stop
