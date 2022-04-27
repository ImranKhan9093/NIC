@extends('users.master')
@section('title', 'KCC report')

@section('style')
    <style>
        table,
        th,
        td {
            border: 1px solid;
        }

        table {
            width: 100%;
        }

        td {
            padding: 8px;
        }

        th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: beige;
        }

    </style>
@endsection
@section('content')

    <h1>KCC_Report</h1>
    {{-- <a href="{{ url("users/kccDownload/$kccReport") }}"
        onclick="event.preventDefault();document.getElementById('kccDownload').submit();">Download PDF Report</a> --}}
    <form action="{{ route('users.kccDownload') }}" method="POST" id="kccDownload">
        @csrf
        <button type="submit">Download Kcc report</button>
    </form> 
    {{-- <a href="{{ route('users.kccDownload') }}">Download Kcc report</a> --}}
    <a href="{{ route('users.KCCExcelReport') }}">Download Excel Report</a>
    <table>
        <tr>
            <th>District</th>
            <th>Subdivision</th>
            <th>Blockmuni</th>
            <th>Reporting Month</th>
            <th>Reporting year</th>
            <th>Kcc Target</th>
            <th>Kcc Sponsored</th>
            <th>Kcc Sanctioned</th>
            <th>Precentage Sponsored</th>
            <th>User</th>
            <th>Posted Date</th>
        </tr>
        @foreach ($kccReport as $report)
            <tr>


                <td>{{ $report->district }}</td>
                <td>{{ $report->subdivision }}</td>
                <td>{{ $report->blockmuni }}</td>
                <td>{{ $report->month_name }}</td>
                <td>{{ $report->reporting_year }}</td>
                <td>{{ $report->KCC_target }}</td>
                <td>{{ $report->KCC_sponsored }}</td>
                <td>{{ $report->KCC_sanctioned }}</td>
                <td>{{ number_format($report->Percentage_sponsored, 2) }}%</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->posted_date }}</td>

            </tr>
        @endforeach
    </table>


@endsection