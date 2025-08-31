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
    <h2 class="text-xl font-bold text-gray-700">All Emails</h2>
    <p class="text-3xl font-extrabold text-green-600">{{ $allEmails }}</p>
  </div>
  <div class="bg-white shadow rounded-lg p-6 text-center">
    <h2 class="text-xl font-bold text-gray-700">Sent Emails</h2>
    <p class="text-3xl font-extrabold text-green-600">{{ $succeedEmails }}</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6 text-center">
    <h2 class="text-xl font-bold text-gray-700">Processing Emails</h2>
    <p class="text-3xl font-extrabold text-green-600">{{ $processingEmails }}</p>
  </div>
  <div class="bg-white shadow rounded-lg p-6 text-center">
    <h2 class="text-xl font-bold text-gray-700">Pending Emails</h2>
    <p class="text-3xl font-extrabold text-green-600">{{ $PendingEmails }}</p>
  </div>

  <div class="bg-white shadow rounded-lg p-6 text-center">
    <h2 class="text-xl font-bold text-gray-700">Failed Emails</h2>
    <p class="text-3xl font-extrabold text-red-600">{{ $failedEmails }}</p>
  </div>
</div>

<div class="bg-white shadow rounded-lg p-6">
  <h2 class="text-xl font-bold text-gray-700 mb-4">Recent Newsletters</h2>
  <table class="w-full text-left border-collapse">
    <thead>
      <tr class="border-b text-gray-600">
        <th class="py-2">Title</th>
        <th class="py-2">Date Sent</th>
        <th class="py-2">Delivered</th>
        <th class="py-2">Status</th>
        <th class="py-2">Retry</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($newsLetters as $newsLetter )
         <tr class="border-b">
        <td class="py-2"><a href="{{ route('newsletter.show',$newsLetter) }}">{{ $newsLetter->subject }}</a></td>
        <td class="py-2">{{ $newsLetter->created_at }}</td>
        
        @php
         $totalSentNewsLetters =  $newsLetter->emailQueue()->count();
         $sentNewsLetterCount = $newsLetter->emailQueue()->where('status','sent')->count();
        @endphp
        
        <td class="py-2">{{ $sentNewsLetterCount .'/'. $totalSentNewsLetters }}</td>
        @if ( $totalSentNewsLetters && $sentNewsLetterCount / $totalSentNewsLetters == 1)
          <td class="py-2 text-green-600 font-semibold">Completed</td>
        @elseif ($totalSentNewsLetters && $sentNewsLetterCount / $totalSentNewsLetters > 0)
          <td class="py-2 text-yellow-600 font-semibold">Partial</td>
        @else
          <td class="py-2 text-red-600 font-semibold">Failed</td>
        @endif

          {{-- <td>
        <form action="{{ route('email.retry', $newsLetter->id) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning btn-sm">
                Retry
            </button>
        </form>
    </td> --}}
      </tr>
    
      @endforeach

    </tbody>
  </table>
</div>
                    {{-- /code here --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
