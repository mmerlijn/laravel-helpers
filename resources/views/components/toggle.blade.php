@props(['color'=>'','label'=>'','disabled'=>false,'readonly'=>false,'size'=>''])

@php
    $color = match($color??''){
        'green'=>'peer-focus:ring-green-300 dark:peer-focus:ring-green-800 peer-checked:bg-green-600 ',
        'red'=>'peer-focus:ring-red-300 dark:peer-focus:ring-red-800 peer-checked:bg-red-600 ',
        'gray'=>'peer-focus:ring-gray-300 dark:peer-focus:ring-gray-800 peer-checked:bg-gray-600 ',
        'blue'=>'peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 peer-checked:bg-blue-600 ',
        'indigo'=>'peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 peer-checked:bg-indigo-600 ',
        default=> 'peer-focus:ring-indigo-300 dark:peer-focus:ring-indigo-800 peer-checked:bg-indigo-600 ',
    };
    $size = match($size){
            'xs'=>'w-9 h-5 after:absolute after:top-[2px] after:left-[2px] after:h-4 after:w-4 ',
            'sm'=>'w-9 h-5 after:absolute after:top-[2px] after:left-[2px] after:h-4 after:w-4 ',
            'base','normal'=>'w-11 h-6 after:absolute after:top-[2px] after:left-[2px] after:h-5 after:w-5 ',
            'lg'=>'w-14 h-7 after:absolute after:top-0.5 after:left-[4px] after:h-6 after:w-6 ',
            'xl'=>'w-14 h-7 after:absolute after:top-0.5 after:left-[4px] after:h-6 after:w-6 ',
            default => 'w-11 h-6 after:absolute after:top-[2px] after:left-[2px] after:h-5 after:w-5 ',
        };


@endphp
<div {{$attributes->only('class')}}>
    <label class="inline-flex relative items-center cursor-pointer">
        <input type="checkbox" class="sr-only peer" {{$attributes->except('class')}} {{$disabled?' disabled':''}}{{$readonly?' readonly':''}}>
        <div class="{{$color}}{{($disabled or $readonly)?'cursor-not-allowed opacity-50 ':''}}{{$size}} bg-gray-200 peer-focus:outline-none peer-focus:ring-4 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:bg-white after:border-gray-300 after:border after:rounded-full after:transition-all dark:border-gray-600"></div>
        <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">{{$label}}</span>
    </label>
</div>
