@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Environment Endpoint</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            @if ($environmentendpoint->id)
                {{ Form::model( $environmentendpoint, ['route' => ['applications.endpoints.environment_endpoints.update', $environmentendpoint->endpoint->application->uid, $environmentendpoint->endpoint->uid, $environmentendpoint->id], 'method' => 'put', 'validate'=>true, 'data-abide'=>''])}}
            @else
                {{ Form::model( $environmentendpoint, ['route' => ['applications.endpoints.environment_endpoints.store', $environmentendpoint->endpoint->application->uid, $environmentendpoint->endpoint->uid], 'validate'=>true, 'data-abide'=>''])}}
            @endif

                {{ Form::select('environment_id', \NpmWeb\DeploymentTracker\Models\Environment::forDropdownValues(), null, ['errors'=>$errors,'label'=>'Environment'] )}}
                {{ Form::select('domain_id', \NpmWeb\DeploymentTracker\Models\Domain::forDropdownValues(), null, ['errors'=>$errors,'label'=>'Domain'] )}}
                {{ Form::text('path',null,['errors'=>$errors]) }}

                <div class="medium-6 medium-offset-3">
                    {{ Form::submit('Submit', ['class'=>'button']) }}
                    @if ($environmentendpoint->id)
                        {{ link_to_route('applications.endpoints.environment_endpoints.show','Cancel',[$environmentendpoint->endpoint->application->uid, $environmentendpoint->endpoint->uid], ['class'=>'button secondary'])}}
                    @else
                        {{ link_to_route('applications.endpoints.environment_endpoints.index','Cancel', [$environmentendpoint->endpoint->application->uid, $environmentendpoint->endpoint->uid], ['class'=>'button secondary']) }}
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
