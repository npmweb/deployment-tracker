@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Application</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            @if ($application->id)
                {{ Form::model( $application, ['route' => ['applications.update', $application->uid], 'method' => 'put', 'validate'=>true, 'data-abide'=>''])}}
            @else
                {{ Form::model( $application, ['route' => 'applications.store', 'validate'=>true, 'data-abide'=>''])}}
            @endif

                {{ Form::text('name',null,['errors'=>$errors]) }}

                <div class="medium-6 medium-offset-3">
                    {{ Form::submit('Submit', ['class'=>'button']) }}
                    @if ($application->id)
                        {{ link_to_route('applications.show','Cancel',$application->uid, ['class'=>'button secondary'])}}
                    @else
                        {{ link_to_route('applications.index','Cancel', null, ['class'=>'button secondary']) }}
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
