

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
        <td rowspan="2" colspan="9" style="text-align: center; font-weight: bold; font-size: 20pt"><h1>REPORT - ORDER</h1></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
</table>

<table class="table">
    <thead>
    <tr class="table100-head">
        <th class="5%" style="text-align: center">#</th>
        <th>Order No</th>
        <th>Reseller Name</th>
        <th>Phone Number</th>
        <th>Status</th>
        <th>Order Date</th>
        <th>Order Type</th>
        <th>Process Hub</th>
        <th>Total Payment</th>
    </tr>
    </thead>

    <tbody>
    @foreach($reportOrder as $item => $value)
        <tr>
            <td>{{($item+1)}}</td>
            <td>{{ $value->order_code }}</td>
            <td>{{ isset($value->reseller['nama_lengkap']) ? $value->reseller['nama_lengkap'] : '-' }}</td>
            <td>{{ isset($value->reseller['nama_lengkap']) ? $value->reseller['no_telpon'] : '-' }}</td>
            <td>{{ $value->status }}</td>
            <td>{{ $value->order_date }}</td>
            <td class="text-right">{{ ($value->is_cross = 0 ? "Normal Order" : "Cross Hub Order") }}</td>
            <td>{{ $value->hub->name }}</td>
            <td class="text-right">{{ ($value->total_payment > 0 ? number_format($value->total_payment,0) : 0) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</html>