<x-mail::message>


<strong>check {{ $request['title'] }}</strong>
<strong>{{ $request['body'] }}</strong>
{{ config('app.name') }}
</x-mail::message>
