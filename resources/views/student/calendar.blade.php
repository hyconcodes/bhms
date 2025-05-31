@extends('layouts.app')
@section('title', 'Calendar')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    <!-- Left side - Search and Info -->
    <div class="">

        <h1 class="display-4 mb-4">Calendar</h1>
        <!-- Calendar Container -->
        <div class="card border-0">
            <div class="card-body">
                <div class="calendar-container">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-center">
                                    {{ now()->format('F Y') }}
                                </th>
                            </tr>
                            <tr>
                                <th>Sun</th>
                                <th>Mon</th>
                                <th>Tue</th>
                                <th>Wed</th>
                                <th>Thu</th>
                                <th>Fri</th>
                                <th>Sat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use Carbon\Carbon;

                                // Start of the month and end of the month
                                $firstDayOfMonth = now()->startOfMonth();
                                $lastDayOfMonth = now()->endOfMonth();

                                // Start of the calendar grid (first Sunday before or equal to the first day of the month)
                                $startOfCalendar = $firstDayOfMonth->copy()->startOfWeek(Carbon::SUNDAY);

                                // End of the calendar grid (last Saturday after or equal to the last day of the month)
                                $endOfCalendar = $lastDayOfMonth->copy()->endOfWeek(Carbon::SATURDAY);

                                // Today's date
                                $today = now();
                            @endphp

                            @while($startOfCalendar <= $endOfCalendar)
                                <tr>
                                    @for($i = 0; $i < 7; $i++)
                                        <td class="{{ $startOfCalendar->month != now()->month ? 'text-muted' : '' }} 
                                                 {{ $startOfCalendar->isSameDay($today) ? 'bg-primary text-white' : '' }}">
                                            {{ $startOfCalendar->day }}
                                            @php $startOfCalendar->addDay(); @endphp
                                        </td>
                                    @endfor
                                </tr>
                            @endwhile
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
