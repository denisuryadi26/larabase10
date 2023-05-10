

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
        <td rowspan="2" colspan="8" style="text-align: center; font-weight: bold; font-size: 20pt"><h1>REPORT - HUB TRANSAKSI</h1></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    @if($filter)
        <tr>
            <td colspan="8" style="text-align: center; font-weight: bold; font-size: 10pt"><h1>PERIODE
                    : {{pg2form_word($filter['start_date'])}} s/d {{pg2form_word($filter['end_date'])}}</h1></td>
        </tr>
    @endif
    <!-- @if($filter === 'order_code')
        <tr>
            <td colspan="8" style="text-align: center; font-weight: bold; font-size: 10pt"><h1>ORDER CODE
                    : {{pg2form_word($filter['hub'])}}</h1></td>
        </tr>
    @endif -->
</table>

<table class="table">
    <thead>
    <tr class="table100-head">
        <th class="5%" style="text-align: center">#</th>
        <th>HUB</th>
        <th>Agent Delivery</th>
{{--                                <th>Type</th>--}}
        <th>Delivery Type</th>
        <th>Status</th>
        <th>Transaction Date</th>
        <th>Transaction Code</th>
        <th>Order Code</th>
    </tr>
    </thead>

    <tbody>
    @foreach($reportOrder as $item => $value)
        <tr>
            <td>{{($item+1)}}</td>
            <td>{{ $value->hub_name }}</td>
            <td>{{ $value->agent_name }}</td>
            <td>{{ $value->delivery_type }}</td>
            <td>{{ $value->order_status }}</td>
            <td>{{ $value->created_at }}</td>
            <td>{{ $value->code }}</td>
            <td>{{ $value->order_code }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</html>