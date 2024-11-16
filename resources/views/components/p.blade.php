

<p  {!!
        $attributes ->
        merge([
            'class'
                =>
            "italic mr-2 tracking-widest min-w-max max-w-min overflow-hidden"
        ])
    !!}
>
    {{ $slot }}
</p>
