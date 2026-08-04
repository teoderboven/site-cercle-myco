@props(['activity', 'hidden', 'sameYear'])

<article @class([
            'activity',
            'ongoing' => $activity->isOngoing,
            'passed' => $activity->isPassed,
            'cancelled' => $activity->cancelled,
            'hidden' => $hideActivity
        ])
         id="{{ $activity->id }}">
    <div class="pre-wrapper">
        <time class="date" datetime="{{ $activity->start_date->format('Y-m-d\Th:i') }}" title="{{ $activity->start_date->translatedFormat('d F Y') }}">
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
            <div class="infos">
                <div class="info location">
                    <img src="/assets/common/img/svg/location.svg" alt="">
                    <a href="{{ $activity->meetingPoint->getMapsLink() }}" target="_blank">
                        Rdv&nbsp;: {{ $activity->meetingPoint->getFormatted() }}.
                    </a>
                </div>
                <div class="info time">
                    <img src="/assets/common/img/svg/clock.svg" alt="">
                    <span>Rdv à {{ displayHourTime($activity->start_date) }}</span>
                </div>
                <div class="info duration">
                    <img src="/assets/common/img/svg/clock-duration.svg" alt="">
                    <span>Dure environ {{ displayDuration($activity->duration) }}</span>
                </div>
                <div class="info guide">
                    <img src="/assets/common/img/svg/profile.svg" alt="">
                    <span>Guide&nbsp;: {{ $activity->guide->name }}</span>
                </div>
                @isset($activity->guide->phone)
                    <div class="info phone">
                        <img src="/assets/common/img/svg/phone.svg" alt="">
                        <a href="tel:{{ $activity->guide->phone }}">{!! formatPhoneNumber($activity->guide->phone) !!}</a>
                    </div>
                @endisset
            </div>
            <div class="description">
                <p>
                    {!! $activity->description !!}
                </p>
            </div>
            <div class="activity-actions">
                @foreach($activity->links as $link)
                    @include('partials.activity.link-button', ['url' => $link->url, 'text' => $link->text])
                    @include('partials.activity.link-button', ['url' => $link->url, 'text' => $link->text])
                @endforeach
                @include("partials.activity.notify-button", ["activityId" => $activity->id])
            </div>
        </div>
    </div>
</article>