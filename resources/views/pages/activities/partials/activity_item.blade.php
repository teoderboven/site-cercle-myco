@props(['activity', 'sameYear'])

@pushonce('styles')
    <link rel="stylesheet" href="/assets/common/css/calendar.css">
    <link rel="stylesheet" href="/assets/common/css/stib.css">
@endpushonce

@php
    $hideActivity = $activity->isPassed || $activity->cancelled;
@endphp
<article @class([
            'activity',
            'ongoing' => $activity->isOngoing,
            'passed' => $activity->isPassed,
            'cancelled' => $activity->cancelled,
            'hidden' => $hideActivity
        ])
         id="{{ $activity->id }}">
    <div class="pre-wrapper">
        <time class="date" datetime="{{ $activity->start_date->format('Y-m-d\Th:i') }}"
              title="{{ $activity->start_date->translatedFormat('d F Y') }}">
            @if(!$sameYear)
                {{ $activity->start_date->translatedFormat('l d/m/Y') }}
            @else
                {{ $activity->start_date->translatedFormat('l d/m') }}
            @endif
        </time>
        @php
            $activityStatus = getActivityStatus($activity);
        @endphp
        @if($activityStatus)
            <div class="activity-status">
                {{ $activityStatus }}
            </div>
        @endif
    </div>
    <div class="main-wrapper">
        <header>
            <div class="title-container">
                <div class="calendar-container">
                    <div class="calendar">
                        <span class="digit">{{ $activity->start_date->format('d') }}</span>
                        <span class="month">{{ $activity->start_date->translatedFormat('F') }}</span>
                    </div>
                </div>
                <h4 class="title">
                    @if($activity->cancelled)
                        <span class="crossed-out">{{ $activity->title }}</span>
                        <span class="cancel-indication">annulé</span>
                    @else
                        {{ $activity->title }}
                    @endif
                </h4>
            </div>
            @if($hideActivity)
                <button class="reveal-btn">Dévoiler les détails <img src="/assets/common/img/svg/next-arrow.svg" alt=""></button>
            @endif
        </header>
        <div class="main-content">
            <div class="info-group-container">
                @component('pages.activities.partials.info-group', ['title' => 'Où et quand ?', 'class' => 'where-when'])
                    <div class="info location">
                        <img src="/assets/common/img/svg/location.svg" alt="">
                        <a href="{{ $activity->meetingPoint->getMapsLink() }}" target="_blank">
                            Rdv&nbsp;: {{ $activity->meetingPoint->getFormatted() }}.
                        </a>
                    </div>
                    <div class="info">
                        <img src="/assets/common/img/svg/clock.svg" alt="">
                        <span>Rdv à {{ displayHourTime($activity->start_date) }}</span>
                    </div>
                    <div class="info">
                        <img src="/assets/common/img/svg/clock-duration.svg" alt="">
                        <span>Dure environ {{ displayDuration($activity->duration) }}</span>
                    </div>
                @endcomponent
                @component('pages.activities.partials.info-group', ['title' => 'Guide', 'class' => 'guide'])
                    <div class="info">
                        <img src="/assets/common/img/svg/profile.svg" alt="">
                        <span>{{ $activity->guide->name }}</span>
                    </div>
                    @isset($activity->guide->phone)
                        <div class="info">
                            <img src="/assets/common/img/svg/phone.svg" alt="">
                            <a href="tel:{{ $activity->guide->phone }}">{!! formatPhoneNumber($activity->guide->phone) !!}</a>
                        </div>
                    @endisset
                @endcomponent
                @if(count($activity->materials))
                    @component('pages.activities.partials.info-group', ['title' => 'Matériel recommandé', 'class' => 'materials'])
                        @foreach($activity->materials as $material)
                            <div class="info">
                                <img src="/assets/activites/materials/{{ $material->icon }}" alt="">
                                <span>{{ $material->name }}</span>
                            </div>
                        @endforeach
                    @endcomponent
                @endif
            </div>
            <div class="description">
                <p>
                    {!! $activity->description !!}
                </p>
            </div>
            <div class="activity-actions">
                @foreach($activity->links as $link)
                    @include('pages.activities.partials.link-button', ['url' => $link->url, 'text' => $link->text])
                @endforeach
                @if(!$hideActivity)
                    @include("pages.activities.partials.notify-button", ["activityId" => $activity->id, "activityTitle" => $activity->title])
                @endif
            </div>
        </div>
    </div>
</article>