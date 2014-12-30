@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>
                {{ link_to_route('applications.show', $application->name, $application->uid ) }}
                Endpoints
            </h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('applications.endpoints.create', 'Create', [$application->uid], ['class'=>'button expand']) }}
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <div id="endpoints"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/Endpoint.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};
app.applicationUid = {{ esc_js($application->uid) }};

$(function(){
    app.endpointCollection = new app.EndpointCollection(app.applicationUid);
    app.endpointTable = new bbGrid.View({
        css: 'foundation',
        container: $('#endpoints'),
        collection: app.endpointCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'uid',
                label: 'UID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/applications/'+esc_url(app.applicationUid)+'/endpoints/'+esc_url(model.get('uid'))+'">'+esc_body(model.get('uid'))+'</a>';
                }
            },
            {
                property: 'name',
                label: 'Name',
                defaultSort: 'asc'
            },
            {
                property: 'environment_endpoints',
                label: 'Environment Endpoints',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/applications/'+esc_url(app.applicationUid)+'/endpoints/'+esc_url(model.get('uid'))+'/environment_endpoints">Show</a>';
                }
            }
        ],
        events: {}
    });

});
</script>
@stop
