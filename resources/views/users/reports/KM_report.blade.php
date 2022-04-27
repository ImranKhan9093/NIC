@extends('users.master')
@section('title', 'KM report')
    
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
    <h1>KM Report</h1>
    <a href="{{ url("users/kmDownload/$kmReport") }}"
        onclick="event.preventDefault();document.getElementById('kmDownload').submit();">Download PDF Report</a>
    <form action="{{ URL("users/kmDownload/$kmReport") }}" method="POST" id="kmDownload">
        @csrf
    </form>
    <a href="{{ route('users.KMExcelReport') }}">Download Excel Report</a>
    <table>
        <tr>
            <th>District</th>
            <th>Subdivision</th>
            <th>Blockmuni</th>
            <th>Reporting Month</th>
            <th>Reporting year</th>
            <th>KM Operational</th>

            <th>KM Sanctioned</th>

            <th>User</th>
            <th>Posted Date</th>
        </tr>
        @foreach ($kmReport as $report)
            <tr>


                <td>{{ $report->district }}</td>
                <td>{{ $report->subdivision }}</td>
                <td>{{ $report->blockmuni }}</td>
                <td>{{ $report->month_name }}</td>
                <td>{{ $report->reporting_year }}</td>
                <td>{{ $report->KM_operational }}</td>
                <td>{{ $report->KM_sanctioned }}</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->posted_date }}</td>

            </tr>
        @endforeach
    </table>

@endsection