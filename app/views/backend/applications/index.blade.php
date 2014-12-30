@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>Applications</h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('applications.create', 'Create', null, ['class'=>'button expand']) }}
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <div id="apps"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/Application.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};

$(function(){
    app.appCollection = new app.ApplicationCollection();
    app.appTable = new bbGrid.View({
        css: 'foundation',
        container: $('#apps'),
        collection: app.appCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'uid',
                label: 'UID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/applications/'+esc_url(model.get('uid'))+'">'+esc_body(model.get('uid'))+'</a>';
                }
            },
            {
                property: 'name',
                label: 'Name',
                defaultSort: 'asc'
            },
            {
                property: 'endpoints',
                label: 'Endpoints',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/applications/'+esc_url(model.get('uid'))+'/endpoints">Show</a>';
                }
            }
        ],
        events: {}
    });

});
</script>
@stop
