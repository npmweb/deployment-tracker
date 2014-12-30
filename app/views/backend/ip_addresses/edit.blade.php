@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>IP Address</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            @if ($ipaddress->id)
                {{ Form::model( $ipaddress, ['route' => ['servers.ip_addresses.update', $ipaddress->server->uid, $ipaddress->uid], 'method' => 'put', 'validate'=>true, 'data-abide'=>''])}}
            @else
                {{ Form::model( $ipaddress, ['route' => ['servers.ip_addresses.store', $ipaddress->server->uid], 'validate'=>true, 'data-abide'=>''])}}
            @endif

                {{ Form::text('public_address',null,['errors'=>$errors]) }}
                {{ Form::text('private_address',null,['errors'=>$errors]) }}

                <div class="medium-6 medium-offset-3">
                    {{ Form::submit('Submit', ['class'=>'button']) }}
                    @if ($ipaddress->id)
                        {{ link_to_route('servers.ip_addresses.show','Cancel',$ipaddress->server->uid, ['class'=>'button secondary'])}}
                    @else
                        {{ link_to_route('servers.ip_addresses.index','Cancel', $ipaddress->server->uid, ['class'=>'button secondary']) }}
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
