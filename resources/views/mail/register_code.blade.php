@component('mail::message')
    # Email Confirmation
    Please refer to the following link:
    @component('mail::button', ['url' => route('verify', ['token' => $code,'userId'=>$userId])])
        Verify Email
    @endcomponent
    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
