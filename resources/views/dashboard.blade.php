<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div wire:poll.1000ms class="col-5 visible-print text-center">
            {!! QrCode::size(300)->generate("http://192.168.1.21:8080/time-keep/timekeeps/chamcong/$key") !!}
        </div>



    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <x-jet-welcome />
            </div>
        </div>
    </div>
</x-app-layout>
