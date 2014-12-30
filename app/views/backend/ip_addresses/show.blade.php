@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>IP Address</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">

            {{ Form::open(['route'=>['servers.ip_addresses.destroy',$ipaddress->server->uid, $ipaddress->uid],'method'=>'delete']) }}
                <div class="row">
                    <div class="small-4 columns">
                        {{ link_to_route('servers.ip_addresses.index', 'Done', $ipaddress->server->uid, ['class'=>'button expand secondary']) }}
                    </div>
                    <div class="small-4 columns">
                        {{ link_to_route('servers.ip_addresses.edit', 'Edit', [$ipaddress->server->uid, $ipaddress->uid], ['class'=>'button expand'] ) }}
                    </div>
                    <div class="small-4 columns">
                        {{ Form::submit('Delete', ['onclick'=>'return confirm("Are you sure you want to delete this record?")', 'class'=>'button expand alert']) }}
                    </div>
                </div>
            {{ Form::close() }}

            <div data-abide="data-abide">
                {{ Form::setModel($ipaddress) }}
                {{ Form::readonly('public_address') }}
                {{ Form::readonly('private_address') }}
            </div>
        </div>
    </div>

@stop
