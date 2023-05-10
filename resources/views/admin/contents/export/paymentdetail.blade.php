

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
        <td rowspan="2" colspan="15" style="text-align: center; font-weight: bold; font-size: 20pt"><h1>REPORT - PAYMENT DETAIL</h1></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    @if($filter)
        <tr>
            <td colspan="15" style="text-align: center; font-weight: bold; font-size: 10pt"><h1></h1></td>
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
        <th class="">Hub Name</th>
        <th class="">Nama Reseller</th>
        <th class="">Kode Reseller</th>
        <th class="">Kode Invoice</th>
        <th class="">Order Date</th>
        <th class="">Due Date</th>
        <th class="">Discount</th>
        <th class="">Discount Detail</th>
        <th class="">Total Amount</th>
        <th class="">Unpaid Amount</th>
        <th class="">Paid Amount</th>
        <th class="">Payment Method</th>
        <th class="">Delivery Status</th>
        <th class="">Status Pembayaran</th>
    </tr>
    </thead>
    <?php
        // echo "<pre>";
        // $json_alamat = json_decode($reportOrder[0]->delivery_address, true);
        // print_r($json_alamat['alamat'].", ".$json_alamat['regency'].", ".$json_alamat['district'].", ".$json_alamat['village']);die;
    ?>

    <tbody>
    @foreach($reportOrder as $item => $value)
        <!-- @php($discount_detail = json_decode($value->discount_detail, true)); -->
        <!-- @dd($discount_detail, $value->discount_detail); -->
        <!-- @php -->
        <!-- @endphp -->
        <tr>
            <td>{{($item+1)}}</td>
            <td>{{ $value->hub }}</td>
            <td>{{ $value->nama_reseller }}</td>
            <td>{{ $value->kode_reseller }}</td>
            <td>{{ $value->invoice_code }}</td>
            <td>{{ $value->order_date }}</td>
            <td>{{ $value->due_date }}</td>
            <td>{{ $value->discount }}</td>
            <td>
                <?php
                    $discount_detail = json_decode($value->discount_detail, true);

                    foreach ($discount_detail as $a => $val){
                        $product = $val['product'];
                        $product_discount = $val['product_discount'];
                        $result = "Product : " . $product . ' | Discount : Rp. ' . number_format($product_discount, 0);
                        // echo $result."\n";
                        print_r($result.";\n");
                    }


                ?>
            </td>
            <td>{{ $value->total_amount }}</td>
            <td>{{ $value->unpaid_ammount }}</td>
            <td>{{ $value->paid_ammount }}</td>
            <td>{{ $value->payment_method }}</td>
            <td>{{ $value->delivery_status }}</td>
            <td>{{ $value->status_pembayaran }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</html>