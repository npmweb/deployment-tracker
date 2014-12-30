@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>Servers</h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('servers.create', 'Create', null, ['class'=>'button expand']) }}
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <div id="servers"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/Server.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};

$(function(){
    app.serverCollection = new app.ServerCollection();
    app.serverTable = new bbGrid.View({
        css: 'foundation',
        container: $('#servers'),
        collection: app.serverCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'uid',
                label: 'UID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/servers/'+esc_url(model.get('uid'))+'">'+esc_body(model.get('uid'))+'</a>';
                }
            },
            {
                property: 'environment',
                label: 'Environment',
                render: function(model, view) {
                    return model.get('environment').name;
                }
            },
            {
                property: 'display_name',
                label: 'Display Name',
                defaultSort: 'asc'
            },
            {
                property: 'hostname',
                label: 'Hostname'
            },
            {
                property: 'ip_addresses',
                label: 'IP Addresses',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/servers/'+esc_url(model.get('uid'))+'/ip_addresses">Show</a>';
                }
            }
        ],
        events: {}
    });

});
</script>
@stop
