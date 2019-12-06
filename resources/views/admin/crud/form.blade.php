<div class="row mB-40">
	<div class="col-sm-8">
		<div class="bgc-white p-20 bd">
            @foreach($tableEloquent::getFieldOptions() as $key=>$input)
                @if(isset($input['type']) and $input['type'] != 'relation')
                @if($input['type'] == 'textarea')
                    {!! Form::myTextArea($key, ucfirst($input['label'])) !!}
                @elseif($input['type'] == 'select')
                    {!! Form::mySelect(((isset($input['multiple']) and $input['multiple'])?$key.'[]': $key), ucfirst($input['label']), $input['select']['data'], null, ['class' => 'form-control select2', 'multiple' =>($input['multiple']?? false)]) !!}
                @else
                    {!! Form::myInput($input['type'], $key, ucfirst($input['label'])) !!}
                @endif
                @endif
            @endforeach
		</div>
	</div>
	@if (isset($item) && $item->avatar || isset($item) && $item->img || isset($item) && $item->media)
		<div class="col-sm-4">
			<div class="bgc-white p-20 bd">
                @if(isset($item->media_type) && $item->media_type == 'video')
                    <video  src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}" width="100%" controls >
                        <source src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}" type="video/mp4" />
                    </video>
                @else
                    <img width="100%" src="{{ $item->avatar ?? $item->img ?? $item->media ?? '' }}" alt="">
                @endif
			</div>
		</div>
	@endif
</div>
