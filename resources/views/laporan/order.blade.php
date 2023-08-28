<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan</title>
</head>
<body>
    <center>
        <h1>{{ strtoupper($bulan) }} DEPATURE ITINESARY LIST</h1>

    </center>


    <table style="border-collapse: collapse" border='1' width="100%">
        <tr>
            <th rowspan="2">No</th>
            <th rowspan="2">Invoice Number</th>
            <th rowspan="2">Customer Name</th>
            <th rowspan="2">Accomodation</th>
            <th rowspan="2">Vessel</th>
            <th colspan="2">Date of Travel</th>
            <th rowspan="2">Payment status</th>
        </tr>
        <tr>
            <th>Start</th>
            <th>End</th>
        </tr>


        @foreach ($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->invoice_number }}</td>
                <td>{{ strtoupper($item->name) }}</td>
                <td>{{ $item->accomodation }}</td>
                <td>{{ $item->vessel }}</td>
                <td align="center">{{ $item->datestart }}</td>
                <td align="center">{{ $item->dateend }}</td>
                <td align="center">{{ $item->status }}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>