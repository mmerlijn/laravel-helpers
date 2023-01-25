<div x-data="flashHandler" @flash.window="add($event.detail)">

    <div class="fixed right-0 bottom-0 mb-5 mr-6 md:w-1/2">
        <template x-for="flash in flashes" :key="flash.id">
            <div
                    x-show="visible.includes(flash)"
                    x-transition:enter="transition ease-in duration-200"
                    x-transition:enter-start="transform opacity-0 translate-y-2"
                    x-transition:enter-end="transform opacity-100"
                    x-transition:leave="transition ease-out duration-500"
                    x-transition:leave-start="transform translate-x-0 opacity-100"
                    x-transition:leave-end="transform translate-x-full opacity-0"
                    @click="remove(flash.id)"

                    style="pointer-events:all"
                    class="flex items-center text-white font-bold rounded-t py-2 px-3 shadow-md mb-2 border-l-4"
                    :class="{
                    'bg-green-500 border-green-700': flash.type === 'success',
                    'bg-blue-500 border-blue-700': flash.type === 'notice',
                    'bg-orange-400 border-orange-700': flash.type === 'warning',
                    'bg-red-500 border-red-700': flash.type === 'danger',
                    }"
            >
                <div class="rounded-full bg-white mr-3"
                     :class="{
                    'text-green-500 ': flash.type === 'success',
                    'text-blue-500': flash.type === 'notice',
                    'text-orange-400': flash.type === 'warning',
                    'text-red-500': flash.type === 'danger',
                    }"
                >
                    <div x-show="flash.type ==='success'" class='text-green-500 rounded-full bg-white float-left'>
                        <svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-check' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd' d='M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.236.236 0 0 1 .02-.022z'/>
                        </svg>
                    </div>
                    <div x-show="flash.type ==='notice'" class='text-blue-500 rounded-full bg-white float-left'>
                        <svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-info' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M8.93 6.588l-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588z'/>
                            <circle cx='8' cy='4.5' r='1'/>
                        </svg>
                    </div>
                    <div x-show="flash.type ==='warning'" class='text-orange-500 rounded-full bg-white float-left'>
                        <svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-exclamation' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path d='M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z'/>
                        </svg>
                    </div>
                    <div x-show="flash.type ==='danger'" class='text-red-500 rounded-full bg-white float-left'>
                        <svg width='1.8em' height='1.8em' viewBox='0 0 16 16' class='bi bi-x' fill='currentColor' xmlns='http://www.w3.org/2000/svg'>
                            <path fill-rule='evenodd' d='M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z'/>
                            <path fill-rule='evenodd' d='M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z'/>
                        </svg>
                    </div>
                </div>
                <div class="text-white max-w-xs " x-text="flash.text">
                </div>
            </div>
        </template>
    </div>
</div>
@if(session()->has('flash'))
    @push('scripts')
        <script>
            {!! \mmerlijn\laravelHelpers\Facades\Flash::get() !!}
        </script>
    @endpush
@endif

