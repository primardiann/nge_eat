@extends('layouts.navigation')

@section('content')
<div class="py-12" style="padding: 24px;">
    <div style="max-width: 1120px; margin: auto; display: flex; flex-direction: column; gap: 24px;">

        @php
            $sections = [
                'profile.partials.update-profile-information-form',
                'profile.partials.update-password-form',
                'profile.partials.delete-user-form',
            ];
        @endphp

        @foreach ($sections as $section)
            <div style="background: #fff; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); border-radius: 12px; padding: 32px;">
                <div style="max-width: 480px; margin: auto;">
                    @include($section)
                </div>
            </div>
        @endforeach

    </div>
</div>
@endsection
