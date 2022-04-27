@extends('users.master')
@section('title', 'Mgnregs report')
    
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
    <h1>Mgnregs Report</h1>
    <a href="{{ url("users/mgnregsDownload/$mgnregsReport") }}" onclick="event.preventDefault();document.getElementById('mgnregsDownload').submit();">Download PDF Report</a>
    <form action="{{ URL("users/mgnregsDownload/$mgnregsReport") }}" method="POST" id="mgnregsDownload">
        @csrf
    </form>
    <a href="{{ route('users.MGNREGSReport') }}">Download Excel Report</a>
    <table>
        <tr>
            <th>District</th>
            <th>Subdivision</th>
            <th>Blockmuni</th>
            <th>Reporting Month</th>
            <th>Reporting year</th>
            <th>ToT person days generate</th>
            <th>Kcc Sponsored</th>
            <th>Avg persondays per household</th>
            <th>Percentage of labour budget achieved</th>
            <th>User</th>
            <th>Posted Date</th>
        </tr>
        @foreach ($mgnregsReport as $report)
            <tr>


                <td>{{ $report->district }}</td>
                <td>{{ $report->subdivision }}</td>
                <td>{{ $report->blockmuni }}</td>
                <td>{{ $report->month_name }}</td>
                <td>{{ $report->reporting_year }}</td>
                <td>{{ $report->tot_person_days_generate }}</td>
                <td>{{ $report->KCC_sponsored }}</td>
                <td>{{ $report->avg_persondays_per_household }}</td>
                <td>{{ number_format($report->percentage_of_labour_budget_achieved, 2) }}%</td>
                <td>{{ $report->name }}</td>
                <td>{{ $report->posted_date }}</td>

            </tr>
        @endforeach
    </table>

@endsection

