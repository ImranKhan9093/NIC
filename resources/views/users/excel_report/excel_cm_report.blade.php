<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CMReport</title>
    @foreach ($headings  as $heading)
        <h4>{{ $heading }}</h4>
    @endforeach
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
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Name of the Block/Muncipality</th>
                <th>Target</th>
                <th>No of KCC sponsored</th>
                <th>No of KCC sanctioned</th>
                <th>KCC spondored percentage</th>
                <th>No of kishan mandi sanctioned</th>
                <th>Number of days generated under MGNREGA</th>
                <th>Average number of person days generated under MGNREGA</th>
                <th>Expenditure made under MGNREGA</th>
                <th>% of labour budget achieved so far</th>
                <th>Total number of SHGS formed in the district</th>
                <th>Total number of SHGS got credit linkage</th>
            </tr>
        </thead>
        {{-- <tbody>
            @foreach ($kishanCreditCard as $kcc )
            <tr> 
                <td>{{ $kcc->blockmuni }}</td>
                <td>{{ $kcc->KCC_target }}</td>
                <td>{{ $kcc->KCC_sponsored }}</td>
                <td>{{ $kcc->KCC_sanctioned }}</td>
                <td>{{ number_format($kcc->Percentage_sponsored, 2) }}%</td>
            </tr>
            @endforeach
            @foreach ($kishanMandi as $km )
                <tr>
                    <td>{{ $km->KM_operational }}</td>
                </tr>
            @endforeach
            @foreach ($mgnregs as  $mgn)
                <tr>
                    <td>{{ $mgn->tot_person_days_generate }}</td>
                    <td>{{ $mgn->avg_persondays_per_household }}</td>
                    <td>{{ 'Expenditure dummy data '}}586954</td>
                    <td>{{ number_format($mgn->percentage_of_labour_budget_achieved, 2) }}%</td>
                </tr>
            @endforeach
            @foreach ($anandadhara as $ananda)
                 <tr>
                    <td>{{ $ananda->tot_SHGs_formed }}</td>
                    <td>{{ $ananda->tot_SHGs_credit_linkage }}</td>
                 </tr>
            @endforeach --}}
            
        </tbody>
    </table>
</body>
</html>