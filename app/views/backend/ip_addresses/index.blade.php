@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>
                {{ link_to_route('servers.show', $server->display_name, $server->uid ) }}
                IP Addresses
            </h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('servers.ip_addresses.create', 'Create', [$server->uid], ['class'=>'button expand']) }}
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <div id="ip_addrs"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/IpAddress.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};
app.serverUid = {{ esc_js($server->uid) }};

$(function(){
    app.ipAddressCollection = new app.IpAddressCollection(app.serverUid);
    app.ipAddressTable = new bbGrid.View({
        css: 'foundation',
        container: $('#ip_addrs'),
        collection: app.ipAddressCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'uid',
                label: 'UID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/servers/'+esc_url(app.serverUid)+'/ip_addresses/'+esc_url(model.get('uid'))+'">'+esc_body(model.get('uid'))+'</a>';
                }
            },
            {
                property: 'public_address',
                label: 'Public Address',
                defaultSort: 'asc'
            },
            {
                property: 'private_address',
                label: 'Private Address'
            },
            {
                property: 'domains',
                label: 'Domains',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/servers/'+esc_url(app.serverUid)+'/ip_addresses/'+esc_url(model.get('uid'))+'/domains">Show</a>';
                }
            }
        ],
        events: {}
    });

});
</script>
@stop
