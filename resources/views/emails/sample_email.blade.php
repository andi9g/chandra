<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $content }}</p>

    <br>
    <h3><b>INVOICE</b></h3>
    
    <hr>
    <table style="border-collapse: collapse">
        <tr>
            <td>INVOICE NUMBER</td>
            <td>:</td>
            <td><b>{{ $invoice_number }}</b></td>
        </tr>
        <tr>
            <td>EMAIL</td>
            <td>:</td>
            <td><b>{{ $email }}</b></td>
        </tr>
        <tr>
            <td>ACCOMODATION & VESSEL</td>
            <td>:</td>
            <td><b>{{ $accomodation." & ".$vessel }}</b></td>
        </tr>
        <tr>
            <td>START</td>
            <td>:</td>
            <td><b>{{ date("d F Y", strtotime($datestart)) }}</b></td>
        </tr>
        <tr>
            <td>END</td>
            <td>:</td>
            <td><b>{{ date("d F Y", strtotime($dateend)) }}</b></td>
        </tr>
        <tr>
            <td>TOTAL PAYMENT</td>
            <td>:</td>
            <td><b>Rp{{ number_format($total_payment, 0,",",".") }}</b></td>
        </tr>
    </table>

    <hr>
    <a href="{{ $link }}">
        <button style="background: rgba(9, 129, 226, 0.993);padding:10px 70px;border:none;border-radius: 5px">
            GOTO PAYMENT LINK
        </button>
    </a>

</body>
</html>