@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Server</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            @if ($server->id)
                {{ Form::model( $server, ['route' => ['servers.update', $server->uid], 'method' => 'put', 'validate'=>true, 'data-abide'=>''])}}
            @else
                {{ Form::model( $server, ['route' => 'servers.store', 'validate'=>true, 'data-abide'=>''])}}
            @endif

                {{ Form::text('display_name',null,['errors'=>$errors]) }}
                {{ Form::text('hostname',null,['errors'=>$errors]) }}

                <div class="medium-6 medium-offset-3">
                    {{ Form::submit('Submit', ['class'=>'button']) }}
                    @if ($server->id)
                        {{ link_to_route('servers.show','Cancel',$server->uid, ['class'=>'button secondary'])}}
                    @else
                        {{ link_to_route('servers.index','Cancel', null, ['class'=>'button secondary']) }}
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
