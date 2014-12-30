@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Domain</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            @if ($domain->id)
                {{ Form::model( $domain, ['route' => ['servers.ip_addresses.domains.update', $domain->ipaddress->server->uid, $domain->ipaddress->uid, $domain->uid], 'method' => 'put', 'validate'=>true, 'data-abide'=>''])}}
            @else
                {{ Form::model( $domain, ['route' => ['servers.ip_addresses.domains.store', $domain->ipaddress->server->uid, $domain->ipaddress->uid], 'validate'=>true, 'data-abide'=>''])}}
            @endif

                {{ Form::text('name',null,['errors'=>$errors]) }}

                <div class="medium-6 medium-offset-3">
                    {{ Form::submit('Submit', ['class'=>'button']) }}
                    @if ($domain->id)
                        {{ link_to_route('servers.ip_addresses.domains.show','Cancel',[$domain->ipaddress->server->uid, $domain->ipaddress->uid], ['class'=>'button secondary'])}}
                    @else
                        {{ link_to_route('servers.ip_addresses.domains.index','Cancel', [$domain->ipaddress->server->uid, $domain->ipaddress->uid], ['class'=>'button secondary']) }}
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
