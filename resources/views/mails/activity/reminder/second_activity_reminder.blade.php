@extends('mails.activity.reminder.layout')

@section('introduction')
    <p>
        L'activité &ldquo;<span class="c_activity-name">{{ $activity->title }}</span>&rdquo; se tiendra ce
        <span class="c_activity-time">{{ $fullDate }} à {{ $hour }}</span>.
    </p>
    <p>
        Voici les derniers détails&nbsp;:
    </p>
@endsection

@section('activity-details')
    <tr>
        <td class="c_dot">&bull;</td>
        <td>Lieu de rendez-vous&nbsp;:
            <a href="{{ $activity->meetingPoint->getMapsLink() }}" target="_blank">
                {{ $activity->meetingPoint->getFormatted() }}
            </a>
        </td>
    </tr>
    @if(count($activity->materials))
        <tr>
            <td class="c_dot">&bull;</td>
            <td>
                <table>
                    <tbody>
                    <tr>
                        <td>Matériel recommandé&nbsp;:</td>
                    </tr>
                    <tr>
                        <td>
                            <table>
                                <tbody>
                                @foreach($activity->materials as $material)
                                    <tr>
                                        <td class="c_dash">-</td>
                                        <td>{{ $material->name }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    @endif
    <tr>
        <td class="c_dot">&bull;</td>
        <td>
            Guide&nbsp;: {{ $activity->guide->name }}
            @isset($activity->guide->phone)
                (<a href="tel:{{ $activity->guide->phone }}">{!! formatPhoneNumber($activity->guide->phone) !!}</a>)
            @endisset
        </td>
    </tr>
@endsection
