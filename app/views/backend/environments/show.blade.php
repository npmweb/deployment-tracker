@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Environment</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">

            {{ Form::open(['route'=>['environments.destroy',$environment->uid],'method'=>'delete']) }}
                <div class="row">
                    <div class="small-4 columns">
                        {{ link_to_route('environments.index', 'Done', null, ['class'=>'button expand secondary']) }}
                    </div>
                    <div class="small-4 columns">
                        {{ link_to_route('environments.edit', 'Edit', $environment->uid, ['class'=>'button expand'] ) }}
                    </div>
                    <div class="small-4 columns">
                        {{ Form::submit('Delete', ['onclick'=>'return confirm("Are you sure you want to delete this record?")', 'class'=>'button expand alert']) }}
                    </div>
                </div>
            {{ Form::close() }}

            <div data-abide="data-abide">
                {{ Form::setModel($environment) }}
                {{ Form::readonly('name') }}
            </div>
        </div>
    </div>

@stop
