@props(['size','color','rounded','link'=>false,'target'=>false])

@php
    $color = match($color??''){
        'blue' => 'bg-blue-100 text-blue-800 rounded dark:bg-blue-200 dark:text-blue-800 ',
        'indigo'=>'bg-indigo-100 text-indigo-800 rounded dark:bg-indigo-200 dark:text-indigo-900 ',
        'indigo-gradient' => 'bg-gradient-to-r from-indigo-100 via-indigo-200 to-indigo-300 hover:bg-gradient-to-br focus:ring-indigo-100 dark:focus:ring-indigo-300 ',
        'dark',' gray'=>'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300 ',
        'red' =>'bg-red-100 text-red-800 dark:bg-red-200 dark:text-red-900 ',
        'dark-red'=>'bg-red-600 text-red-100 dark:bg-red-200 dark:text-red-900 ',
        'green'=>'bg-green-100 text-green-800 dark:bg-green-200 dark:text-green-900 ',
        'yellow'=>'bg-yellow-100 text-yellow-800 dark:bg-yellow-200 dark:text-yellow-900 ',
        'orange'=>'bg-orange-100 text-orange-800 dark:bg-orange-200 dark:text-orange-900 ',
        default=>'bg-indigo-100 text-indigo-800 rounded dark:bg-indigo-200 dark:text-indigo-900 ',
    };
    $size = match($size??''){
        'large','lg' => 'text-sm ',
        'extra-large','xl'=> '',
        '2xl'=>'text-2xl ',
        default=>'text-xs ',
    };
    $rounded = match($rounded??'rounded'){
        'lg'=>'rounded-lg ',
        'full'=>'rounded-full ',
        'none','' => '',
        default => 'rounded ',
    };
@endphp
@if ($link)
    <a href="{{$link}}" @if($target) target="{{$target}}" @endif>
        @endif
        <span class="{{$color}}{{$size}}{{$rounded}}inline-flex items-center gap-1 justify-center font-semibold  mr-2 px-2.5 py-0.5">{{$slot}}</span>
        @if($link)
    </a>
@endif
