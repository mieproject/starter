<div class="row">
    @forelse ($items as $key=>$item)
        <div class="col-md-3">
            <style>
                .card-badge {
                    position: absolute;
                    top: 10px;
                    left: 10px;
                }

            </style>
            <div class="card" @if($item->is_trashed()) style="border: red 3px solid;" @endif>
                @if(is_array($tableEloquent->getBoxFields('badge')))
                    <div class="card-badge">
                        @foreach($tableEloquent->getBoxFields('badge') as $badge)
                            <span
                                class="badge {{ (isset($badge['class'])?$badge['class']:'badge-info') }}">{!!  ElzahabyDynamicLaravelString($item,$badge['syntax']) !!}</span>
                        @endforeach
                    </div>
                @endif
                <img class="card-img-top" src="{{ $item->{$tableEloquent->getBoxFields('img')} }}" alt="Card image cap">
                    <hr>
                <div class="card-body">
                    <h5 class="card-title">{{ $item->{$tableEloquent->getBoxFields('name')} }}
                        @if($item->is_trashed()) <small class="small badge badge-danger">this item is deleted</small> @endif
                    </h5>
                    <p class="card-text">{{ $item->{$tableEloquent->getBoxFields('desc')} }}</p>

                    <div class="btn-group btn-group-sm btn-block" role="group">
                        @foreach($tableEloquent->getBoxFields('btns') as $btn)
                            <a href="{{ (isset($btn['link'])?ElzahabyDynamicLaravelString($item,$btn['link']):'#OPS-NO-link') }}"
                               class="{{ (isset($btn['class'])?$btn['class']:'btn btn-info') }}">{!! (isset($btn['title'])?$btn['title']:'OPS,NO `title`') !!}</a>
                        @endforeach
                        @if($tableEloquent->allow['edit'])
                            <a href="{{ route(ADMIN . ".$model.edit", $item->id) }}"
                               title="{{ trans('app.edit_title') }}" class="btn btn-primary ">
                                <i class="ti-pencil"></i>
                            </a>
                        @endif
                        {!! Form::open([
                            'class'=>'delete btn-group',
                            'url'  => route(ADMIN . ".$model.destroy", $item->id),
                            'method' => 'DELETE',
                            ])
                        !!}
                        <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}">
                            <i class="ti-trash"></i></button>
                        {!! Form::close() !!}


                    </div>

                </div>
            </div>
        </div>
    @empty
       <div class="p-10">no data found</div>
    @endforelse
</div>
