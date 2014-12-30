@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>
                {{ link_to_route('applications.endpoints.show', $endpoint->application->name . ' ' . $endpoint->name, [$endpoint->application->uid, $endpoint->uid] ) }}
                Environment Endpoints
            </h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('applications.endpoints.environment_endpoints.create', 'Create', [$endpoint->application->uid, $endpoint->uid], ['class'=>'button expand']) }}
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <div id="envEndpoints"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/EnvironmentEndpoints.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};
app.applicationUid = {{ esc_js($endpoint->application->uid) }};
app.endpointUid = {{ esc_js($endpoint->uid) }};

$(function(){
    app.envEndpointCollection = new app.EnvironmentEndpointCollection(app.applicationUid, app.endpointUid);
    app.domainTable = new bbGrid.View({
        css: 'foundation',
        container: $('#envEndpoints'),
        collection: app.envEndpointCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'id',
                label: 'ID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl
                        +'/applications/'+esc_url(app.applicationUid)
                        +'/endpoints/'+esc_url(app.endpointUid)
                        +'/environment_endpoints/'+esc_url(model.get('id'))+'">'
                        +esc_body(model.get('id'))+'</a>';
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
                property: 'domain',
                label: 'Domain',
                render: function(model, view) {
                    return model.get('domain').name
                        + ' ('
                        + model.get('domain').ip_address.server.display_name
                        + ')';
                }
            },
            {
                property: 'path',
                label: 'Path'
            }
        ],
        events: {}
    });

});
</script>
@stop
