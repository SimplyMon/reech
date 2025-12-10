<x-mail::message>

    # {{ $subjectLine }}

    @php

        $body_content = $body;

        $greeting = isset($client) && isset($client->first_name) ? 'Hello ' . $client->first_name . ',' : 'Hello,';
    @endphp

    {{ $greeting }}

    {!! $body_content !!}

    Best Regards,

    <x-mail::panel>
        **{{ Auth::user()->detail->full_name ?? config('app.name') }}**<br>
        Real Estate Agent<br>
        {{ Auth::user()->email }}
    </x-mail::panel>

</x-mail::message>
