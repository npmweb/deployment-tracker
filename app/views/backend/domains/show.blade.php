@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Domain</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">

            {{ Form::open(['route'=>['servers.ip_addresses.domains.destroy',$domain->ipaddress->server->uid, $domain->ipaddress->uid, $domain->uid],'method'=>'delete']) }}
                <div class="row">
                    <div class="small-4 columns">
                        {{ link_to_route('servers.ip_addresses.domains.index', 'Done', [$domain->ipaddress->server->uid, $domain->ipaddress->uid], ['class'=>'button expand secondary']) }}
                    </div>
                    <div class="small-4 columns">
                        {{ link_to_route('servers.ip_addresses.domains.edit', 'Edit', [$domain->ipaddress->server->uid, $domain->ipaddress->uid, $domain->uid], ['class'=>'button expand'] ) }}
                    </div>
                    <div class="small-4 columns">
                        {{ Form::submit('Delete', ['onclick'=>'return confirm("Are you sure you want to delete this record?")', 'class'=>'button expand alert']) }}
                    </div>
                </div>
            {{ Form::close() }}

            <div data-abide="data-abide">
                {{ Form::setModel($domain) }}
                {{ Form::readonly('name') }}
            </div>
        </div>
    </div>

@stop
