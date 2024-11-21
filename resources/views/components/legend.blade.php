

<legend
    {!!
        $attributes ->
            merge([
                'class'
                    =>
                '
                    italic capitalize text-sm text-gray-900 font-semibold
                '
            ])
    !!}
>

    {{$slot}}

</legend>
