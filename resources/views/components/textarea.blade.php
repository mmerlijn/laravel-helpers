@props(['help'=>'','error'=>'','value'=>'','label'=>'','color'=>'','size'=>''])

@php
    $color = match($color){
    'blue'=>'focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 ',
    'indigo'=>'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 ',
    default=> 'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 ',
};
    $size = match($size??''){
            'xs','extra-small'=>'text-xs ',
            'sm','small'=>'text-sm ',
            'base','medium'=>'',
            'large','lg'=>'text-lg ',
            'extra-large','xl' => 'text-xl ',
            default=> '',
        };
@endphp

<div {{$attributes->only('class')}}>
    @if($label)
        <label for="message" class="{{$size}}block mb-1 font-medium text-gray-900 dark:text-white">{{$label}}</label>
    @endif
    <textarea {{$attributes->except('class')}}  class="{{$color}}block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white ">{{$value}}</textarea>
    @if($help)
        <p class="text-sm italic text-gray-500 dark:text-gray-400">{{$help}}</p>
    @endif
    @if($error)
        <p class="text-sm italic text-red-600 dark:text-red-300">{{$error}}</p>
    @endif
</div>
