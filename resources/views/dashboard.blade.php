<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container" id="user-task-listing-div">
        <x-user-task-listing :tasks="$tasks"/>
    </div>
</x-app-layout>
