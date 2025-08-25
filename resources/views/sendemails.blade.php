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
                  <form method="POST" action= "{{ route('sendemails') }}">
                    @csrf
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">title</label>
    <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp">

    <div class="form-group">
      <label for="my-textarea">body</label>
      <textarea id="my-textarea" class="form-control" name="body" rows="3"></textarea>
    </div>
   

  
  <button type="submit" class="btn btn-primary">send emails</button>
</form>
                  {{-- form ends --}}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
