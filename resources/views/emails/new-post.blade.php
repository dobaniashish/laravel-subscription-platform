<x-mail::message>

A new post has been published.

Title: {{ $postTitle }}

<x-mail::button :url="$postUrl">View Post</x-mail::button>

Thanks,<br>

{{ config('app.name') }}

</x-mail::message>
