
@props(['size-text' => 'xs'])

<strong {!! $attributes->merge(['class' => 'text-xs p-2 uppercase focus:ring-indigo-500 rounded-md ']) !!}>
    {{$slot}}
</strong>
