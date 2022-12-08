@component('mail::message')
# Good Day!

Your Application in BMS Online was Disapproved!

<!-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent -->

Thanks,<br>
{{ config('app.name') }}
@endcomponent
