

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
        <td rowspan="2" colspan="9" style="text-align: center; font-weight: bold; font-size: 20pt"><h1>REPORT - ORDER DETAIL</h1></td>
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
        <th>Order Code</th>
        <th>Product ID</th>
        <th>SKU</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Product Variant ID</th>
        <th>Variant</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Nama Lengkap</th>
        <th>Reseller Code</th>
        <th>Alamat</th>
        <th>Nama Product</th>
        <th>Brands</th>
        <th>Category</th>
        <th>DT Code</th>
        <th>Hub</th>
        <th>Principle ID</th>
        <th>Principle</th>
    </tr>
    </thead>

    <tbody>
    @foreach($reportOrderDetail as $item => $value)
        <tr>
            <td>{{($item+1)}}</td>
            <td>{{ $value->order_code }}</td>
            <td>{{ isset($value->product_id) ? $value->product_id : '-' }}</td>
            <td class="text-left">{{ isset($value->sku) ? $value->sku : '-' }}</td>
            <td class="text-right">{{ ($value->price > 0 ? number_format($value->price,0) : 0) }}</td>
            <td>{{ isset($value->quantity) ? $value->quantity : '-' }}</td>
            <td>{{ isset($value->product_variant_id) ? $value->product_variant_id : '-' }}</td>
            <td>{{ isset($value->variant) ? $value->variant : '-' }}</td>
            <td>{{ isset($value->order_date) ? $value->order_date : '-' }}</td>
            <td>{{ isset($value->status) ? $value->status : '-' }}</td>
            <td>{{ isset($value->nama_lengkap) ? $value->nama_lengkap : '-' }}</td>
            <td>{{ isset($value->reseller_code) ? $value->reseller_code : '-' }}</td>
            <td>{{ isset($value->alamat) ? $value->alamat : '-' }}</td>
            <td>{{ isset($value->product_name) ? $value->product_name : '-' }}</td>
            <td>{{ isset($value->brands) ? $value->brands : '-' }}</td>
            <td>{{ isset($value->category) ? $value->category : '-' }}</td>
            <td class="text-left">{{ isset($value->dt_code) ? $value->dt_code : '-' }}</td>
            <td>{{ isset($value->hub) ? $value->hub : '-' }}</td>
            <td>{{ isset($value->principle_id) ? $value->principle_id : '-' }}</td>
            <td>{{ isset($value->principle) ? $value->principle : '-' }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</html>