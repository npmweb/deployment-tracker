@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Endpoint</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            @if ($endpoint->id)
                {{ Form::model( $endpoint, ['route' => ['applications.endpoints.update', $endpoint->application->uid, $endpoint->uid], 'method' => 'put', 'validate'=>true, 'data-abide'=>''])}}
            @else
                {{ Form::model( $endpoint, ['route' => ['applications.endpoints.store', $endpoint->application->uid], 'validate'=>true, 'data-abide'=>''])}}
            @endif

                {{ Form::text('name',null,['errors'=>$errors]) }}

                <div class="medium-6 medium-offset-3">
                    {{ Form::submit('Submit', ['class'=>'button']) }}
                    @if ($endpoint->id)
                        {{ link_to_route('applications.endpoints.show','Cancel',$endpoint->application->uid, ['class'=>'button secondary'])}}
                    @else
                        {{ link_to_route('applications.endpoints.index','Cancel', $endpoint->application->uid, ['class'=>'button secondary']) }}
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
