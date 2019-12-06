<table class="table table-striped table-bordered dataTable" cellspacing="0" width="100%">
    <thead>
    <tr>
        <th>#</th>
        <th width="90%">{{ $tableEloquent::getListFields()['title'] }}</th>
        <th>Actions</th>
    </tr>
    </thead>

    <tfoot>
    <tr>
        <th>#</th>
        <th>{{ $tableEloquent::getListFields()['title'] }}</th>
        <th>Actions</th>
    </tr>
    </tfoot>

    <tbody>
    @foreach ($items as $key=>$item)
        <tr @if($item->is_trashed()) class="tr-trashed" @endif>
            <td>{{ $item->id }}</td>
            <td>{!! ElzahabyDynamicLaravelString($item,$tableEloquent::getListFields()['syntax']) !!}</td>
            <td>
                <ul class="list-inline">
                    @if($tableEloquent->allow['edit'])
                        <li class="list-inline-item">
                            <a href="{{ route(ADMIN . ".$model.edit", $item->id) }}"
                               title="{{ trans('app.edit_title') }}" class="btn btn-primary btn-sm"><span
                                    class="ti-pencil"></span></a>
                        </li>
                    @endif
                        @if(isset($tableEloquent->allow['view']) and $tableEloquent->allow['view'])
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
    </tbody>

</table>
