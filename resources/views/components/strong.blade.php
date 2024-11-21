
@props(['size-text' => 'xs'])

<strong
        {!!
            $attributes ->
                merge([
                    'class'
                        =>
                    '
                        p-2 uppercase focus:ring-indigo-500 rounded-md
                    '
                ])
        !!}
>

    {{$slot}}

</strong>
