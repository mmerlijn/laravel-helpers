@props(['id'=>null,'size'=>'','label'=>'','options'=>[],'value'=>'','placeholder'=>'','layout'=>'default','help'=>'','error'=>''])

@php
    $id = $id ?? md5(random_int(1,999999999));
        $color = match($color??''){
            'green'=>'focus:ring-green-500 focus:border-green-500 dark:focus:ring-green-500 dark:focus:border-green-500 ',
            'red'=>'focus:ring-red-500 focus:border-red-500 dark:focus:ring-red-500 dark:focus:border-red-500 ',
            'gray'=>'focus:ring-gray-500 focus:border-gray-500 dark:focus:ring-gray-500 dark:focus:border-gray-500 ',
            'blue'=>'focus:ring-blue-500 focus:border-blue-500 dark:focus:ring-blue-500 dark:focus:border-blue-500 ',
            'indigo'=>'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 ',
            default=> 'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500 ',
        };
        $size_label = match($size){
            'xs','extra-small'=>'text-xs ',
            'sm','small'=>'text-sm ',
            'base','medium'=>'',
            'large','lg'=>'text-lg ',
            'extra-large','xl' => 'text-xl ',
            default=> '',
        };
        $padding = match($size){
            'xs','extra-small'=>'p-1 ',
            'sm','small'=>'p-2 ',
            'base','medium'=>'p-2 ',
            'large','lg'=>'p-2 ',
            'extra-large','xl' => 'p-3 ',
            default=> 'p-2 ',
        };
@endphp
@if($layout=='default')
    <div {{$attributes->only('class')}}>
        @if($label)
            <label for="{{$id}}" class="{{$size_label}}block mb-1 font-medium text-gray-900 dark:text-white">{{$label}}</label>
        @endif
        <select id="{{$id}}" {{$attributes->except(['class','value','placeholder'])}} class="{{$color}}{{$size_label}}{{$padding}}bg-gray-50/50 border border-gray-300 text-gray-900 rounded-lg block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white">
            @if($placeholder and !$value)
                <option value="" disabled selected>{{$placeholder}}</option>
            @endif
            @foreach($options as $k=>$option)
                <option @if($value ==$k) selected @endif>{{$option}}</option>
            @endforeach
        </select>
        @if($help)
            <p class="text-sm italic text-gray-500 dark:text-gray-400">{{$help}}</p>
        @endif
        @if($error)
            <p class="text-sm italic text-red-600 dark:text-red-300">{{$error}}</p>
        @endif
    </div>
@elseif($layout=='google')
    <div {{ $attributes->merge(['class'=>'relative z-0 mb-6 group'])->only('class') }}>

        <select id="{{$id}}" class="{{$size_label}}block {{$padding}} bg-gray-50/0 px-0 w-full text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
            @if($placeholder and !$value)
                <option value="" disabled selected>{{$placeholder}}</option>
            @endif
            @foreach($options as $k=>$option)
                <option @if($value ==$k) selected @endif>{{$option}}</option>
            @endforeach
        </select>
        <label for="{{$id}}" class="top-3 peer-focus:font-medium absolute text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500">{{$label?:$placeholder}}</label>
        @if($help)
            <p class="text-sm italic text-gray-500 dark:text-gray-400">{{$help}}</p>
        @endif
        @if($error)
            <p class="text-sm italic text-red-600 dark:text-red-300">{{$error}}</p>
        @endif
    </div>
@endif
