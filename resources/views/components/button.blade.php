
<button
    type="{{$type}}"
    {{ $attributes -> merge(['class' => "btn-comp btn-$class"])}}
    {{-- class="btn-comp btn-{{$class}}" --}}>

    {{$slot}}
</button>
