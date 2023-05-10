

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
        <td rowspan="2" colspan="9" style="text-align: center; font-weight: bold; font-size: 20pt"><h1>REPORT - ORDER MANUAL</h1></td>
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
        <th>Tanggal</th>
        <th>Agent</th>
        <th>Kode Agent</th>
        <th>Area</th>
        <th>No OD</th>
        <th>Nominal</th>
    </tr>
    </thead>

    <tbody>
    @foreach($reportOrder as $item => $value)
        <tr>
            <td>{{($item+1)}}</td>
            <td>{{ $value->order_date }}</td>
            <td>{{ isset($value->agentOrder['fullname']) ? $value->agentOrder['fullname'] : '-' }}</td>
            <td>{{ isset($value->agentOrder['agent_code']) ? $value->agentOrder['agent_code'] : '-' }}</td>
            <td>{{ isset($value->agentOrder->agentArea['name']) ? $value->agentOrder->agentArea['name'] : '-' }}</td>
            <td>{{ $value->order_code }}</td>
            <td class="text-right">{{ ($value->total_payment > 0 ? number_format($value->total_payment,0) : 0) }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</html>