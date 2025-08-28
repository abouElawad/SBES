<x-mail::message>


<strong>check {{ $request['subject'] }}</strong>
<strong>{{ $request['body'] }}</strong>
{{ config('app.name') }}
</x-mail::message>
