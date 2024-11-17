
<input type="checkbox"
    {!! $attributes ->
        merge([
            'class' =>
            'appearance-none h-6 w-6 border border-gray-300 rounded-md checked:bg-indigo-600  hover:cursor-pointer focus:ring-2 focus:ring-indigo-500'
        ])
    !!}
>
