@props(['type','size','width'=>'','color','rounded','link'=>'','target'=>'','disabled'=>null])

@php
    $size = match ($size??''){
        'extra-small','xs' => 'py-1 px-2 text-xs ',
        'small','sm' => 'py-2 px-3 text-xs ',
        'large','lg' => 'py-3 px-5 text-base ',
        'extra-large','xl' =>  'px-6 py-3.5 text-base ',
        default => 'px-5 py-2.5 '
    };
    $color = match($color??''){
        'blue' => 'text-white bg-blue-700 hover:bg-blue-800 focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ', //shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80
        'blue-gradient' => 'text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-blue-300 dark:focus:ring-blue-800 ',
        'purple'=> 'text-white bg-purple-700 hover:bg-purple-800 focus:ring-purple-300 dark:bg-purple-600 dark:hover:bg-purple-700 dark:focus:ring-purple-900 ',
        'indigo'=> 'text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-900' ,
        'indigo-gradient' => 'text-white bg-gradient-to-r from-indigo-500 via-indigo-600 to-indigo-700 hover:bg-gradient-to-br focus:ring-indigo-300 dark:focus:ring-indigo-800 ',
        'orange'=> 'text-white bg-orange-600 hover:bg-orange-700 focus:ring-orange-300 dark:bg-orange-600 dark:hover:bg-orange-700 dark:focus:ring-orange-900 ',
        'red' => 'text-white bg-red-700 hover:bg-red-800 focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 ',
        'red-gradient'=>'text-white bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-red-300 dark:focus:ring-red-800 ',
        'green' => 'text-white bg-green-500 hover:bg-green-600 focus:ring-green-200 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800 ',
        'dark' => 'text-white bg-gray-800 hover:bg-gray-900 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 ',
        'light' => 'text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 ',
        default => 'text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-indigo-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-indigo-900 ',
    };
    $rounded = match($rounded??'lg'){
        ''=>'rounded ',
        'lg'=>'rounded-lg ',
        'full'=>'rounded-full ',
        default=>'rounded-lg '
    };
    $disabled = $disabled?'opacity-30 cursor-not-allowed ':'';

@endphp
@if($link??'')
    <a href="{{$link}}" @if($target) target="{{$target}}" @endif>
        @endif
        <button type="{{$type??'submit'}}" {{$attributes->except(['class','target'])}} {{$disabled?'disabled':''}} class="{{$size}}{{$color}}{{$rounded}}{{$disabled}}{{$width}} inline-flex justify-center items-center gap-2  font-medium text-center  focus:ring-4 focus:outline-none">
            {{$slot}}
        </button>
        @if($link)
    </a>
@endif
