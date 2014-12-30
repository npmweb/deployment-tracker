@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="small-9 columns">
            <h1>Environments</h1>
        </div>
        <div class="small-3 columns">
            {{ link_to_route('environments.create', 'Create', null, ['class'=>'button expand']) }}
        </div>
    </div>

    <div class="row">
        <div class="columns">
            <div id="envs"></div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('includes/shared/js/utils.js')}}"></script>
<script src="{{asset('includes/shared/js/models/Environment.js')}}"></script>
<script type="text/javascript">
var app = app || {};
app.baseUrl = {{ esc_js(url()) }};

$(function(){
    app.envCollection = new app.EnvironmentCollection();
    app.envTable = new bbGrid.View({
        css: 'foundation',
        container: $('#envs'),
        collection: app.envCollection,
        autoFetch: true,
        colModel: [
            {
                property: 'uid',
                label: 'UID',
                render: function(model, view) {
                    return '<a href="'+app.baseUrl+'/environments/'+esc_url(model.get('uid'))+'">'+esc_body(model.get('uid'))+'</a>';
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
