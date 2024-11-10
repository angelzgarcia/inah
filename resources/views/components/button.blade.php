
<button
    type="{{$type}}"
    {{
        $attributes -> merge(['class' => "btn-comp btn-$class uppercase flex flex-row gap-3 text-center justify-evenly items-center"
        . ($class == 'x' ? ' !min-w-8 !h-8 !shadow-md' : '')
    ])}}
>

    {!! $svg !!}

    {{$slot}}
</button>
