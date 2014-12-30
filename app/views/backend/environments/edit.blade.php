@extends('layouts.layout')

@section('content')
    <div class="row">
        <div class="columns">
            <h1>Environment</h1>
        </div>
    </div>
    <div class="row">
        <div class="columns">
            @if ($environment->id)
                {{ Form::model( $environment, ['route' => ['environments.update', $environment->uid], 'method' => 'put', 'validate'=>true, 'data-abide'=>''])}}
            @else
                {{ Form::model( $environment, ['route' => 'environments.store', 'validate'=>true, 'data-abide'=>''])}}
            @endif

                {{ Form::text('name',null,['errors'=>$errors]) }}

                <div class="medium-6 medium-offset-3">
                    {{ Form::submit('Submit', ['class'=>'button']) }}
                    @if ($environment->id)
                        {{ link_to_route('environments.show','Cancel',$environment->uid, ['class'=>'button secondary'])}}
                    @else
                        {{ link_to_route('environments.index','Cancel', null, ['class'=>'button secondary']) }}
                    @endif
                </div>
            {{ Form::close() }}
        </div>
    </div>
@stop
