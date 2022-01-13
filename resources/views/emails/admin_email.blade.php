@component('mail::message')
# {{ $maildata['title'] }} 

{{ $maildata['message'] }} 

Sign up and use Bhorer Kagoj Prokashan now

@component('mail::button', ['url' => $maildata['url']])
Sign up
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
