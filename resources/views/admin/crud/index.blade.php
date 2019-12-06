@extends('admin.default')

@section('page-header')
    {{ ucfirst($model) }} <small>{{ trans('app.manage') }}</small>
@endsection

@section('content')
    @if($tableEloquent->allow['add'])
    <div class="mB-20">
        <a href="{{ url(ADMIN . "/$model/create") }}" class="btn btn-info">
            {{ trans('app.add_button') }}
        </a>
    </div>
    @endif


    <div class="bgc-white bd bdrs-3 p-20 mB-20">
        @include('admin.crud.viewStyle.'.$tableEloquent->viewStyle)
    </div>

@endsection
