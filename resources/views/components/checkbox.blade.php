@props(['id'=>null,'label','color','size'=>''])

@php
    $id = $id ?? md5(random_int(1,999999999));
        $color = match($color??''){
            'green'=>'focus:ring-green-300 dark:focus:ring-red-600 accent-green-500 ',
            'red'=>'focus:ring-red-300 dark:focus:ring-red-600 accent-red-500 ',
            'gray'=>'focus:ring-gray-300 dark:focus:ring-gray-600 accent-gray-500 ',
            'blue'=>'focus:ring-blue-300 dark:focus:ring-blue-600 accent-blue-500 ',
            'indigo'=>'focus:ring-indigo-300 dark:focus:ring-indigo-600 accent-indigo-500 ',
            default=> 'focus:ring-indigo-300 dark:focus:ring-indigo-600 accent-indigo-500 ',
        };
        $size_input = match($size){
            'xs'=>'w-3 h-3 ',
            'sm'=>'w-3 h-3 ',
            'base','normal'=>'w-4 h-4 ',
            'lg'=>'w-5 h-5 ',
            'xl'=>'w-6 h-6 ',
            default => 'w-4 h-4 ',
        };
        $size_label = match($size){
            'xs'=> 'text-xs ',
            'sm'=>'text-sm ',
            'base','normal'=>'',
            'lg'=>'text-lg ',
            'xl'=>'text-xl ',
            default => '',
        };
@endphp


<div {{$attributes->only('class')}}>
    <div class="flex items-center">
        <input id="{{$id}}" type="checkbox" {{$attributes->except('class')}} class="{{$color}}{{$size_input}} border border-gray-300 rounded bg-gray-50/50 focus:ring-3 dark:bg-gray-700 dark:border-gray-600 dark:ring-offset-gray-800">
        <label for="{{$id}}" class="{{$size_label}}ml-2 font-medium text-gray-900 dark:text-gray-300">{{$label}}</label>
    </div>

</div>
