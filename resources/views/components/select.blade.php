

<select
    {!!
        $attributes ->
        merge([
                'class'
                    =>
                '
                    bg-gray-50 text-xs p-2 w-full focus:shadow-md outline-none
                    focus:ring-indigo-500 rounded-md border border-gray-200 shadow-sm
                '
        ])
    !!}
>

    {{$slot}}

</select>
