<table class="table table-striped  table-bordered dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        @foreach($tableEloquent::getTableFields() as $key=>$item)
            <th>{{ $key }}</th>
        @endforeach
        <th>Actions</th>
    </tr>
    </thead>

    <tfoot>
    <tr>
        @foreach($tableEloquent::getTableFields() as $key=>$item)
            <th>{{ $key }}</th>
        @endforeach
        <th>Actions</th>
    </tr>
    </tfoot>

    <tbody>
{{--    @if(isset($items->id))--}}
{{--        @php($item = $items)--}}
{{--        <tr>--}}
{{--            @foreach($tableEloquent::getTableFields() as $k=>$i)--}}

{{--                @if(is_array($i))--}}
{{--                    <td>{!! (isset($i['callback'])?$item[$i[key($i)]]->{$i['callback']}():$item[$i[key($i)]]) !!}</td>--}}
{{--                @elseif ($i == 'avatar' || $i =='img' || $i == 'media')--}}
{{--                    <td>--}}
{{--                        <div class="bgc-white p-5 rounded text-center">--}}
{{--                            @if(isset($item->mtype) && $item->mtype == 'video')--}}
{{--                                <video height="120px"--}}
{{--                                       src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}"--}}
{{--                                       width="100%" controls>--}}
{{--                                    <source src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}"--}}
{{--                                            type="video/mp4"/>--}}
{{--                                </video>--}}
{{--                            @else--}}
{{--                                <img style="max-height: 120px;min-width: 120px"--}}
{{--                                     src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}" alt="">--}}
{{--                            @endif--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                @else--}}
{{--                    <td>{{ $item->$i }}</td>--}}
{{--                @endif--}}
{{--            @endforeach--}}
{{--            <td>--}}
{{--                <ul class="list-inline">--}}
{{--                    @if($tableEloquent->allow['edit'])--}}
{{--                        <li class="list-inline-item">--}}

{{--                            <a href="{{ route(ADMIN . ".$model.edit", $item->id) }}"--}}
{{--                               title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span--}}
{{--                                    class="ti-pencil"></span></a>--}}
{{--                        </li>--}}
{{--                    @endif--}}
{{--                        @if($tableEloquent->allow['view'])--}}
{{--                        <li class="list-inline-item">--}}
{{--                            <a href="{{ route(ADMIN . ".$model.show", $item->id) }}"--}}
{{--                               title="{{ trans('app.view_item') }}" class="btn btn-primary btn-sm"><span--}}
{{--                                    class="ti-pencil"></span></a>--}}
{{--                        </li>--}}
{{--                        @endif--}}
{{--                    <li class="list-inline-item">--}}
{{--                        {!! Form::open([--}}
{{--                            'class'=>'delete',--}}
{{--                            'url'  => route(ADMIN . ".$model.destroy", $item->id),--}}
{{--                            'method' => 'DELETE',--}}
{{--                            ])--}}
{{--                        !!}--}}

{{--                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i--}}
{{--                                class="ti-trash"></i></button>--}}

{{--                        {!! Form::close() !!}--}}
{{--                    </li>--}}
{{--                </ul>--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--    @else--}}
        @foreach ($items as $key=>$item)
            <tr @if($item->is_trashed()) class="tr-trashed" @endif>
                @foreach($tableEloquent::getTableFields() as $k=>$i)
                    @if(is_array($i))
                        <td>{!! (isset($i['callback'])?$item[$i[key($i)]]->{$i['callback']}():$item[$i[key($i)]]) !!}</td>
                    @elseif ($i == 'avatar' || $i =='img' || $i == 'media')
                        <td>
                            <div class="bgc-white p-5 rounded text-center">
                                @if(isset($item->mtype) && $item->mtype == 'video')
                                    <video height="120px"
                                           src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}"
                                           width="100%" controls>
                                        <source src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}"
                                                type="video/mp4"/>
                                    </video>
                                @else
                                    <img style="max-height: 120px;min-width: 120px"
                                         src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}" alt="">
                                @endif
                            </div>
                        </td>
                    @else
                        <td>{{ $item->$i }}</td>
                    @endif
                @endforeach
                <td>
                    <ul class="list-inline">
                        @if($item->is_trashed())
                        <li class="list-item">
                            <small class="small badge badge-danger">this item is deleted</small>
                        </li>
                        @endif
                        @if($tableEloquent->allow['edit'])
                            <li class="list-inline-item">

                                <a href="{{ route(ADMIN . ".$model.edit", $item->id) }}"
                                   title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span
                                        class="ti-pencil"></span></a>
                            </li>
                        @endif
                            @if($tableEloquent->allow['view'])
                                <li class="list-inline-item">
                                    <a href="{{ route(ADMIN . ".$model.show", $item->id) }}"
                                       title="{{ trans('app.view_item') }}" class="btn btn-primary btn-sm"><span
                                            class="ti-eye"></span></a>
                                </li>
                            @endif
                        <li class="list-inline-item">
                            {!! Form::open([
                                'class'=>'delete',
                                'url'  => route(ADMIN . ".$model.destroy", $item->id),
                                'method' => 'DELETE',
                                ])
                            !!}

                            <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}"><i
                                    class="ti-trash"></i></button>

                            {!! Form::close() !!}
                        </li>
                    </ul>
                </td>
            </tr>
        @endforeach
{{--    @endif--}}

    </tbody>

</table>
