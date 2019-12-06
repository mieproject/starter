@extends('admin.default')

@section('page-header')
    {{ Str::singular(ucfirst($model)) }} <small>{{ trans('app.add_new_item') }}</small>
@stop

@section('content')
	{!! Form::open([
			'route' => [ADMIN.'.'.$model.'.store'],
			'files' => true
		])
	!!}

		@include('admin.crud.form')

		<button type="submit" class="btn btn-primary">{{ trans('app.add_button') }}</button>

	{!! Form::close() !!}

@stop
