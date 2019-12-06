@extends('admin.default')

@section('page-header')
    <style>
        pre {
            display: block;
            font-size: 87.5%;
            background: #dbdbdb;
            color: #212529;
            padding: 5px;
            border-radius: 2px;
            border: 1px solid;
        }
    </style>
    {{ ucfirst(Str::singular($model)) }}: <small>{{ $item['name'] ?? $item['title'] ?? "Id:".$item['id'] }}</small>
@endsection

@section('content')
    <div class="mB-20">
        @if($tableEloquent->allow['edit'])
            <a href="{{ url(ADMIN . "/$model/".$item['id']."/edit") }}" class="btn d-inline btn-sm btn-info">
                {{ trans('app.edit_button') }}
            </a>
        @endif

        {!! Form::open([
            'class'=>'delete d-inline m-10',
            'url'  => route(ADMIN . ".$model.destroy", $item['id']),
            'method' => 'DELETE',
            ])
        !!}

        <button class="btn {{ ($itemCollection->is_trashed()?"btn-success":"btn-danger") }} btn-sm">
        {{ ($itemCollection->is_trashed()?'Restore item': trans('app.delete_title')) }}
        {!! Form::close() !!}
    </div>

    <div class="row">
        <div class="col-md-{{ (isset($itemCollection->user)?"9":"12") }}">
            @if (isset($item['avatar']) || isset($item['img']) || isset($item['media']))
                <div class="w-auto m-auto text-center">
                    <div class="bgc-white bd bdrs-3 p-20 mB-20">
                        <h6 class="text-left">Media file:</h6>
                        @if(isset($item['media_type']) && $item['media_type'] == 'video')
                            <video src="{{ $item['avatar'] ?? $item['img'] ?? $item['media'] ?? '' }}" height="300"
                                   controls>
                                <source src="{{ $item['avatar'] ?? $item['img'] ?? $item['media'] ?? '' }}"
                                        type="video/mp4"/>
                            </video>
                        @else
                            <img height="300" src="{{ $item['avatar'] ?? $item['img'] ?? $item['media'] ?? '' }}"
                                 alt="">
                        @endif
                    </div>
                </div>
            @endif

            @if(isset($item['desc']) || isset($item['content']) || isset($item['description']) || isset($item['details']) || isset($item['bio']))
                <div class="bgc-white bd bdrs-3 p-20 mB-20">
                    <h6>Details and Description:</h6>
                    {!! ($item['desc']) ?? ($item['content']) ?? ($item['description']) ?? ($item['details']) ?? ($item['bio']) !!}
                </div>
            @endif

            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h4>All details:</h4>
                @foreach($item as $key=>$value)
                    @if(!is_array($value) and !empty($value))
                        <p>{!! "<b>".strtoupper($key)."</b>".': '."<pre>$value</pre>" !!}</p>
                    @endif
                @endforeach
            </div>

            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                <h6>Dates info:</h6>
                <div class="btn btn-info">Created
                    at: {{ \Carbon\Carbon::parse($item['created_at'])->diffForHumans() }}</div>
                <div class="btn btn-primary">Updated
                    at: {{ \Carbon\Carbon::parse($item['updated_at'])->diffForHumans() }}</div>
                @if(isset($item['deleted_at']))
                    <div class="btn btn-danger">Deleted
                        at: {{ \Carbon\Carbon::parse($item['deleted_at'])->diffForHumans() }}</div>
                @endif
            </div>

            <hr>
            @if(!empty($itemCollection->relationships(true)))
                <div class="">
                    <h4>#More Info:
                        @foreach($itemCollection->relationships(true) as $key)
                            @if($itemCollection->{$key}->count()) @if($key != 'user')
                            <div
                                class="badge badge-info">{{ $itemCollection->{$key}->count().' '.Str::studly($key)}}</div>
                            @endif @endif @endforeach
                    </h4>
                    @foreach($itemCollection->relationships(true) as $relations)
                            @php($className = get_class($itemCollection->$relations()->getRelated()))
                            @php($tableEloquent = (new $className))
                            @php($model = getTableByModel($className))

                            <div class="bgc-white bd bdrs-3 p-20 mB-20">
                                <h6 id="{{Str::slug($relations)}}"><a
                                        href="#{{Str::slug($relations)}}">{{ Str::studly($relations).': '.($itemCollection->{$relations}->count()) }}</a>
                                </h6>
                                @php($items = $itemCollection->{$relations})
                                @include('admin.crud.viewStyle.'.$tableEloquent->getFieldsType()['viewStyle'])
                            </div>
                    @endforeach
                </div>
            @endif
        </div>


        @if(isset($itemCollection->user))
            <div class="col-md-3">
                <div class="profile-card py-3 card text-center">
                    <a class=" btn btn-info m-5" href="{{ route('admin.users.show',$itemCollection->user->id) }}"
                       style="position: absolute; top: 1rem; right: 1.2rem; font-size: 12px;">
                        <i class="fa fa-eye"></i>
                    </a>
                    <div class="card-body py-4">
                        <img class="profile-picture rounded-circle" src="{{ $itemCollection->user->avatar }}"/>
                        <h2 class="text-dark h5 font-weight-bold mt-4 mb-1">
                            {{ $itemCollection->user->name }} <small>{{ '@'.$itemCollection->user->username }}</small>
                        </h2>
                        <p class="text-muted font-weight-bold small">
                            <i class="fa fa-map-marker"></i>
                            <small class="small">[This is paid future]</small>
                        </p>
                        <p class="px-1 mt-4 mb-4 text-left text-muted quote-text">{{ $itemCollection->user->bio }}</p>
                        <hr>
                        <div class="d-flex px-1 w-100 align-items-center text-left">
                            <div class="w-100">
                                <label class="mb-1 font-weight-light text-muted small text-uppercase">Membership</label>
                                <strong class="d-block text-danger">
                                    <i class="fa fa-user"></i>
                                    {{ config('filters.role')[$itemCollection->user->role] }} Member
                                </strong>
                            </div>
                            <div>
                                {{--                            <button class="btn btn-sm btn-outline-success">--}}
                                {{--                                Renew--}}
                                {{--                            </button>--}}
                            </div>
                        </div>
                        <h5 class="mt-4 pt-3 h6 text-muted mb-0">Get Connected</h5>
                        <div class="d-flex social-section justify-content-center">
                            {{--                        <a href=""><i class="fa fa fa-facebook"></i></a>--}}
                            {{--                        <a href=""><i class="fa fa fa-twitter"></i></a>--}}
                            {{--                        <a href=""><i class="fa fa fa-google-plus"></i></a>--}}
                            {{--                        <a href=""><i class="fa fa fa-instagram"></i></a>--}}
                            {{--                        -------------------------}}
                            <a class="btn btn-link" href="tel:{{ $itemCollection->user->phone }}"><i
                                    class="fa fa-phone"></i></a>
                            <a class="btn btn-link" href="mailto:{{ $itemCollection->user->email }}"><i
                                    class="fa fa-envelope"></i></a>


                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

@endsection
