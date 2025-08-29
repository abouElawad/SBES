<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
@include('sweetalert::alert')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    
                    @yield('content')
                    {{-- code here --}}
                    <div class="grid grid-cols-3 gap-6">
  <div class="bg-white shadow rounded-lg p-6 text-center">
    <h2 class="text-xl font-bold text-gray-700">Subscribers</h2>
    <p class="text-3xl font-extrabold text-blue-600">{{ $subscribersCount }}</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6 text-center">
    <h2 class="text-xl font-bold text-gray-700">Sent Emails</h2>
    <p class="text-3xl font-extrabold text-green-600">{{ $succeedEmails }}</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6 text-center">
    <h2 class="text-xl font-bold text-gray-700">Failed Emails</h2>
    <p class="text-3xl font-extrabold text-red-600">{{ $failedEmails }}</p>
  </div>
</div>
                    {{-- /code here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
