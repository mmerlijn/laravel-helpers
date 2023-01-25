@props(['name','label'=>'','size','rounded','type'=>'text','disabled'=>false,'readonly'=>false,'id','error'=>false,'help'=>false,'layout'=>'default'])

@php
    $id = $id ?? md5(random_int(1,999999999));

    if($layout=='default'){
        $color = match($color??''){
            'blue'=>'focus:ring-blue-500 focus:border-blue-500  dark:focus:ring-blue-500 dark:focus:border-blue-500',
            'indigo'=>'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500',
            default=> 'focus:ring-indigo-500 focus:border-indigo-500 dark:focus:ring-indigo-500 dark:focus:border-indigo-500',
        };
        $padding = match($size??''){
            'xs','extra-small'=>'p-0.5 pl-2 ',
            'sm','small'=>'p-1  pl-2 ',
            'base','medium'=>'p-1 pl-2 ',
            'large','lg'=>'p-2 pl-3 ',
            'extra-large','xl' => 'p-3 ',
            default =>'p-1 pl-2 '
        };
        $size = match($size??''){
            'xs','extra-small'=>'text-xs ',
            'sm','small'=>'text-sm ',
            'base','medium'=>'',
            'large','lg'=>'text-lg ',
            'extra-large','xl' => 'text-xl ',
            default=> '',
        };
    }elseif($layout=='google'){
        $color_input = match($color??''){
            'blue'=>'dark:focus:border-blue-500 focus:border-blue-600 ',
            'indigo'=>'dark:focus:border-indigo-500 focus:border-indigo-600 ',
            default=> 'dark:focus:border-indigo-500 focus:border-indigo-600 ',
        };
        $color_label = match($color??''){
            'blue'=>'peer-focus:text-bue-600 peer-focus:dark:text-blue-500 ',
            'indigo'=>'peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 ',
            default=> 'peer-focus:text-indigo-600 peer-focus:dark:text-indigo-500 ',
        };
        $padding = match($size??''){
            'xs','extra-small'=>'pb-1 ',
            'sm','small'=>'py-1 ',
            'base','medium'=>'pb-1 pt-2 ',
            'large','lg'=>'pb-1 pt-2.5 ',
            'extra-large','xl' => 'pb-1 pt-3 ',
            default =>'pb-1 pt-2 '
        };
        $size = match($size??''){
            'xs','extra-small'=>'text-xs  top-1 ',
            'sm','small'=>'text-sm  top-2 ',
            'base','medium'=>'top-3 ',
            'large','lg'=>'text-lg top-3 ',
            'extra-large','xl' => 'text-xl  top-3 ',
            default=> 'top-3 ',
        };
    }

    $rounded = match($rounded??'rounded') {
        '','none' => '',
        'full'=> 'rounded-full ',
        'lg' => 'rounded-lg ',
        default => 'rounded-lg '
    };
    $border = $error?
      'border-red-500 dark:border-red-700 ':
      'border-gray-300 dark:border-gray-600 '

@endphp


@switch($layout)
    @case('default')
        <div {{$attributes->only('class')}}>
            @if($label)
                <label for="{{$id}}" class="{{$size}}block mb-1 font-medium text-gray-900 dark:text-white">{{$label}}</label>
            @endif
            <input type="{{$type}}" id="{{$id}}" {{$attributes->except(['class','placeholder'])}} {{$disabled?' disabled':''}}{{$readonly?' readonly':''}} class="{{$rounded}}{{$padding}}{{$size}}{{($disabled or $readonly)?'cursor-not-allowed opacity-50 ':''}}border {{$border}}bg-gray-50/50 text-gray-900 block dark:bg-gray-700 dark:placeholder-gray-400 dark:text-white mb-1 w-full">
            @if($help)
                <p class="text-sm italic text-gray-500 dark:text-gray-400">{{$help}}</p>
            @endif
            @if($error)
                <p class="text-sm italic text-red-600 dark:text-red-300">{{$error}}</p>
            @endif
        </div>
        @break
    @case("google")
        <div {{ $attributes->merge(['class'=>'relative z-0 mb-6 group'])->only('class') }}>
            <input type="{{$type}}" name="{{$name}}" id="{{$id}}"
                   class="{{$color_input}}{{$size}}{{$padding}}block w-full text-gray-900 bg-transparent border-0 border-b-2 border-gray-300
     appearance-none dark:text-white dark:border-gray-600 px-0 focus:outline-none focus:ring-0 peer" placeholder=" " {{$attributes->except(['class','placeholder'])}}/>
            <label for="{{$id}}" class="{{$color_label}}{{$size}}peer-focus:font-medium absolute text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 -z-10 origin-[0] peer-focus:left-0 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 ">{{$label}}</label>
            @if($help)
                <p class="text-sm italic text-gray-500 dark:text-gray-400">{{$help}}</p>
            @endif
            @if($error)
                <p class="text-sm italic text-red-600 dark:text-red-300">{{$error}}</p>
            @endif
        </div>
        @break

@endswitch



