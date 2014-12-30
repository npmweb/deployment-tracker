@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>
                {{ link_to_route('servers.ip_addresses.show', $ipAddress->public_address, [$ipAddress->server->uid, $ipAddress->uid] ) }}
                Domains
            </h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('servers.ip_addresses.domains.create', 'Create', [$ipAddress->server->uid, $ipAddress->uid], ['class'=>'button expand']) }}
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <div id="domains"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/Domains.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};
app.serverUid = {{ esc_js($ipAddress->server->uid) }};
app.ipAddressUid = {{ esc_js($ipAddress->uid) }};

$(function(){
    app.domainCollection = new app.DomainCollection(app.serverUid, app.ipAddressUid);
    app.domainTable = new bbGrid.View({
        css: 'foundation',
        container: $('#domains'),
        collection: app.domainCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'uid',
                label: 'UID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl
                        +'/servers/'+esc_url(app.serverUid)
                        +'/ip_addresses/'+esc_url(app.ipAddressUid)
                        +'/domains/'+esc_url(model.get('uid'))+'">'
                        +esc_body(model.get('uid'))+'</a>';
                }
            },
            {
                property: 'name',
                label: 'Name',
                defaultSort: 'asc'
            }
        ],
        events: {}
    });

});
</script>
@stop
