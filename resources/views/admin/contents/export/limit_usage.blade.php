

<html>
{{--{{ HTML::style('css/pdf/print_pdf.css') }}--}}

<style>
    .table th {
        border: 1px solid black;
    }

    .table tr td {
        border: 0.1px solid black;
    }

    .table thead tr th, .table tbody tr td {
        padding: 10px;
    }

    .table thead tr th, .table tbody tr td {
        padding: 10px;
    }

    .table thead tr th {
        text-align: center;
        background-color: #ccc;
    }

    table tbody tr td ol {
        margin: 5px;
        padding: 5px;
    }

    ol {
        margin: 0 0 0 10px;
        padding: 0;
    }
</style>

<table>
    <tr>
        <td rowspan="2" colspan="11" style="text-align: center; font-weight: bold; font-size: 20pt"><h1>REPORT - LIMIT
                USAGE</h1></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    @if($filter)
        <tr>
            <td colspan="11" style="text-align: center; font-weight: bold; font-size: 10pt"><h1>PERIODE
                    : {{pg2form_word($filter['start_date'])}} s/d {{pg2form_word($filter['end_date'])}}</h1></td>
        </tr>
    @endif
</table>

<table class="table">
    <thead>
    <tr class="table100-head">
        <th class="5%" style="text-align: center">#</th>
        <th>NIK</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>No Telpon</th>
        <th>Total Limit</th>
        <th>Sisa Limit</th>
        <th>Pemakaian</th>
        <th>Order Code</th>
        <th>Timestamp</th>
    </tr>
    </thead>

    <tbody>
    @foreach($limitUsages as $item => $value)
        <tr>
            <td>{{($item+1)}}</td>
            <td>{{ $value->userDetail->nik }}</td>
            <td>{{ $value->userDetail->nama_lengkap }}</td>
            <td>{{ $value->userDetail->email }}</td>
            <td>{{ $value->userDetail->alamat }}</td>
            <td>{{ $value->userDetail->no_telpon }}</td>
            <td class="text-right">{{ ($value->total_limit > 0 ? number_format($value->total_limit,0) : 0) }}</td>
            <td class="text-right">{{ ($value->sisa_limit > 0 ? number_format($value->sisa_limit,0) : 0) }}</td>
            <td class="text-right">{{ ($value->pemakaian > 0 ? number_format($value->pemakaian,0) : 0) }}</td>
            <td>{{ $value->order->order_code }}</td>
            <td>{{ $value->created_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</html>