@extends('mails.activity.notification-layout')

@push('styles')
    <style>
        {!! file_get_contents(resource_path('views/mails/activity/reminder/reminder.css')) !!}
        {!! file_get_contents(resource_path('views/mails/common/button.css')) !!}
    </style>
@endpush

@section('mainContent')
    @yield('introduction')
    <div class="c_activity_resume">
        <table class="c_activity-info-table">
            <tbody>
                @yield('activity-details')
            </tbody>
        </table>
        <a href="{{ $activity->getDetailLink() }}" target="_blank" class="c_button">Voir l'activité en ligne</a>
    </div>
    <p>
        Nous serons heureux de vous voir lors de cette sortie afin de partager avec vous un moment riche en découvertes et en convivialité.
    </p>
    <p>
        À {{ $activity->start_date->translatedFormat('l') }}&nbsp;!
    </p>
@endsection
