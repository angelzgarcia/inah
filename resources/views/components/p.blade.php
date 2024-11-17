

<p  {!!
        $attributes ->
        merge([
            'class'
                =>
            "italic mr-2 tracking-widest max-w-20 min-w-32 text-nowrap overflow-hidden text-ellipsis"
        ])
    !!}
>
    {{ $slot }}
</p>
