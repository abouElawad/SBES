<x-app-layout>
	<x-slot name="header">
		<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
			{{ __('Send Emails') }}
		</h2>
	</x-slot>

	<div class="py-12">
		<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
			<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
				<div class="p-6 text-gray-900 dark:text-gray-100">

					{{-- form starts --}}
<div class="max-w-7xl mx-auto p-6">
    <!-- Newsletter Details -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg mb-6">
        <div class="p-6">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Newsletter Details
            </h2>

            <p class="text-gray-700 dark:text-gray-300"><strong>Subject:</strong> {{ $newsletter->subject }}</p>
            <p class="text-gray-700 dark:text-gray-300 font-medium mt-2">Body:</p>
            <div class="border rounded-md p-3 mt-1 bg-gray-50 dark:bg-gray-700 text-gray-800 dark:text-gray-200 whitespace-pre-line">
                {{ $newsletter->body }}
            </div>
        </div>
    </div>

    <!-- Email Delivery Status -->
    <div class="bg-white dark:bg-gray-800 shadow rounded-lg">
        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                Email Delivery Status
            </h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Subscriber</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Last Error</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-700 dark:text-gray-300">Attempts</th>
                            <th class="px-4 py-2 text-center text-sm font-medium text-gray-700 dark:text-gray-300">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($emailQueues  as $queue)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-200 truncate max-w-xs" title="{{ $queue->subscriber->email }}">
                                    {{ $queue->subscriber->email }}
                                </td>
                                <td class="px-4 py-2">
                                    @if ($queue->status == 'sent')
                                        <span class="px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 rounded-full">
                                            Sent
                                        </span>
                                    @elseif($queue->status == 'failed')
                                        <span class="px-2 py-1 text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 rounded-full">
                                            Failed
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-100 rounded-full">
                                            {{ ucfirst($queue->status) }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $queue->last_error ?? '—' }}
                                </td>
                                <td class="px-4 py-2 text-sm text-gray-600 dark:text-gray-400">
                                    {{ $queue->attempts }}
                                </td>
                                <td class="px-4 py-2 text-center">
                                    @if ($queue->status == 'failed')
                                        <form action="{{ route('email.retry', $queue->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit"
                                                class="px-3 py-1 bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium rounded-md shadow
                                                 text-xs font-medium ">
                                                Retry
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            <div>
                              {{ $emailQueues->links() }}
                            </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

					{{-- form ends --}}
				</div>
			</div>
		</div>
	</div>
</x-app-layout>
