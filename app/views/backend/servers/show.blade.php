@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Server</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">

            {{ Form::open(['route'=>['servers.destroy',$server->uid],'method'=>'delete']) }}
                <div class="row">
                    <div class="small-4 columns">
                        {{ link_to_route('servers.index', 'Done', null, ['class'=>'button expand secondary']) }}
                    </div>
                    <div class="small-4 columns">
                        {{ link_to_route('servers.edit', 'Edit', $server->uid, ['class'=>'button expand'] ) }}
                    </div>
                    <div class="small-4 columns">
                        {{ Form::submit('Delete', ['onclick'=>'return confirm("Are you sure you want to delete this record?")', 'class'=>'button expand alert']) }}
                    </div>
                </div>
            {{ Form::close() }}

            <div data-abide="data-abide">
                {{ Form::setModel($server) }}
                {{ Form::readonly('display_name') }}
                {{ Form::readonly('hostname') }}
            </div>
        </div>
    </div>

@stop
