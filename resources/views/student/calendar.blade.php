@extends('layouts.app')
@section('title', 'Student Dashboard')
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
                                $firstDayOfMonth = now()->startOfMonth();
                                $lastDayOfMonth = now()->endOfMonth();
                                $currentDay = $firstDayOfMonth->copy()->startOfWeek();
                                $today = now()->day;
                            @endphp

                            @while($currentDay <= $lastDayOfMonth)
                                <tr>
                                    @for($i = 0; $i < 7; $i++)
                                        <td class="{{ $currentDay->format('m') != now()->format('m') ? 'text-muted' : '' }} 
                                                 {{ $currentDay->day == $today && $currentDay->format('m') == now()->format('m') ? 'bg-primary text-white' : '' }}">
                                            {{ $currentDay->day }}
                                            @php $currentDay->addDay(); @endphp
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