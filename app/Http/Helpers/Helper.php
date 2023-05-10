<?php
/**
 * @author Dodi Priyanto<dodi.priyanto76@gmail.com>
 */

use App\Models\Generator\SequenceCode;
use App\Models\Menu;
use Illuminate\Support\Facades\Cookie;

function get_breadcrumbs($url)
{
    $route = collect(\Route::getRoutes())->first(function ($route) use ($url) {
        return $route->matches(request()->create($url));
    });

    if (filled($route)) {
        $route_name = $route->action['as'];
        $menu = Menu::withTrashed()->with('parent')->where('route_name', '=', "$route_name")->first();
        return $menu;
    }


}

function getPagesAccess($current_path)
{
    $group_menu = \Illuminate\Support\Facades\Auth::user()->group()->with('group_menu')->first()->group_menu;
    $data = searchForRouteName($current_path, $group_menu);

    if ($data->is_addable == 1) {


        echo '<button type="button" class="btn btn-rounded btn-primary text-bold addModal" data-target="#myModal" data-toggle="modal" style="float: right !important;">
                        <i data-feather="plus-circle" class="mr-25"></i>
                        <span>ADD</span>
                    </button>
                    <br>
                    <br>';
    } else {
        echo '';
    }
}


function getPagesAccessImport($current_path)
{
    $group_menu = \Illuminate\Support\Facades\Auth::user()->group()->with('group_menu')->first()->group_menu;
    $data = searchForRouteName($current_path, $group_menu);

    if ($data->is_addable == 1) {


        echo '<button type="button" class="btn btn-rounded btn-primary text-bold addModal" data-target="#myModal" data-toggle="modal" style="float: right !important;">
                        <i data-feather="plus-circle" class="mr-25"></i>
                        <span>ADD</span>
                    </button>
                    <br>
                    <br>';
    } else {
        echo '';
    }
}


function getFileName($file)
{
    return basename($file->getClientOriginalName(), '.'.$file->getClientOriginalExtension());
}

function getExtension($file)
{
    return $file->getClientOriginalExtension();
}


function pg2form_date($tgl)
{
    $date = date_create($tgl);
    return date_format($date, "d-m-Y");
}

function pg2form_word($tgl)
{
    $date = date_create($tgl);
    switch (date_format($date, "n")) {
        case 1:
            $bln = ' Januari ';
            break;
        case 2:
            $bln = ' Februari ';
            break;
        case 3:
            $bln = ' Maret ';
            break;
        case 4:
            $bln = ' April ';
            break;
        case 5:
            $bln = ' Mei ';
            break;
        case 6:
            $bln = ' Juni ';
            break;
        case 7:
            $bln = ' Juli ';
            break;
        case 8:
            $bln = ' Agustus ';
            break;
        case 9:
            $bln = ' Sepetember ';
            break;
        case 10:
            $bln = ' Oktober ';
            break;
        case 11:
            $bln = ' November ';
            break;
        case 12:
            $bln = ' Desember ';
            break;
    }
    return date_format($date, "d") . $bln . date_format($date, "Y");
}

function pg2form_word_with_time($tgl)
{
    $date = date_create($tgl);
    switch (date_format($date, "n")) {
        case 1:
            $bln = ' Januari ';
            break;
        case 2:
            $bln = ' Februari ';
            break;
        case 3:
            $bln = ' Maret ';
            break;
        case 4:
            $bln = ' April ';
            break;
        case 5:
            $bln = ' Mei ';
            break;
        case 6:
            $bln = ' Juni ';
            break;
        case 7:
            $bln = ' Juli ';
            break;
        case 8:
            $bln = ' Agustus ';
            break;
        case 9:
            $bln = ' Sepetember ';
            break;
        case 10:
            $bln = ' Oktober ';
            break;
        case 11:
            $bln = ' November ';
            break;
        case 12:
            $bln = ' Desember ';
            break;
    }
    return date_format($date, "d") . $bln . date_format($date, "Y").' '.date_format($date,'H:i');
}


function number_to_alphabet($number)
{
    $number = intval($number);
    if ($number <= 0) {
        return '';
    }
    $alphabet = '';
    while ($number != 0) {
        $p = ($number - 1) % 26;
        $number = intval(($number - $p) / 26);
        $alphabet = chr(65 + $p) . $alphabet;
    }
    return $alphabet;
}

function alphabet_to_number($string)
{
    $string = strtoupper($string);
    $length = strlen($string);
    $number = 0;
    $level = 1;
    while ($length >= $level) {
        $char = $string[$length - $level];
        $c = ord($char) - 64;
        $number += $c * (26 ** ($level - 1));
        $level++;
    }
    return $number;
}


function searchForRouteName($id, $array)
{
    foreach ($array as $key => $val) {
        if ($val['route_name'] === $id) {
            return $val->pivot;
        }
    }
    return null;
}


function removeSpace(array $data)
{
    $result = [];
    foreach ($data as $datum => $val) {
        $result[strtolower(str_replace(' ', '', $datum))] = $val;
    }

    return $result;

}

function searchForId($stock, $variant)
{
    $retStock = [];
    foreach ($variant as $key => $val) {
        if ($val->variant_id === $stock->variant_id) {
            return $val->value;
        }
    }

    return null;
}

function generateUnicode($lastCode)
{
    $newCode = (integer)str_replace('0', '', $lastCode) + 1;
    $digitLengt = 2;
    $strDigit = 0;

    for ($i = 1; $i <= $digitLengt; $i++) {
        $strDigit .= '0';
    }
    return $strDigit . $newCode;
}

function generateCode(SequenceCode $param)
{
    $type = $param->type;
    $prefix = $param->prefix;
    $numberSeq = $param->sequence;
    $digitLengt = $param->sequence_digit;
    $strDigit = '';
    for ($i = 0; $i <= $digitLengt; $i++) {
        $strDigit .= '0';
    }


    if ($type == 'RES') {
        $code = $type . '-' . strtoupper($param->area->slug) . '-' . $prefix . '-' . digitLogic($strDigit, $numberSeq);
    } elseif ($type == 'REG') {
        $code = $type . '-' . strtoupper($param->area->slug) . '-' . digitLogic($strDigit, $numberSeq);
    } elseif ($type == 'VA_HUB') {
        $code = $prefix . digitLogic($strDigit, $numberSeq);
    } elseif ($type == 'HUBTR'){
        $code = digitLogic($strDigit, $numberSeq);
    }
    else {
        return '-';
    }

    return $code;
}


function digitLogic($strDigit, $numberSeq)
{
    $result = substr($strDigit, 0, -strlen($numberSeq)) . $numberSeq;
    return $result;
}

function clearArrayString($param)
{
    $resultStr = str_replace(array('"', '[', ']'), '', $param);
    $result = explode(',', $resultStr);

    return $result;
}

function getAddressFromJson($address)
{
    $rawAddress = json_decode($address);
    $result = "$rawAddress->alamat , " . ucwords(strtolower($rawAddress->regency)) . ", " . ucwords(strtolower($rawAddress->district)) . " , " . ucwords(strtolower($rawAddress->village)) . "";
    return $result;
}

function showAddress($address)
{
    $result = "$address->alamat , " . ucwords(strtolower($address->regency)) . ", " . ucwords(strtolower($address->district)) . " , " . ucwords(strtolower($address->village)) . "";
    return $result;
}

function generateTableOrder($order, $fromHubTransaction = null)
{
    $html = '';
    $tableContent = '';

    $hubPickUp = [];
    $hubName = '-';
    $hubQty = '-';


    //generate hub pickup
    if ($order->hubTransaction) {
        foreach ($order->hubTransaction->detail as $key => $val) {
            $arrayKey = $val->detailProductVariant->product->name . ' - (' . $val->detailProductVariant->productVariantToVariant->name . ')';
            $hubPickUp[$val->hubTransaction->hub->name][$arrayKey] = $val->value;
            $hubName = $val->hubTransaction->hub->name;
        }
    }

    $NotIncludePPN = [];

    foreach ($order->item as $item => $value) {
        array_push($NotIncludePPN, [
            'not_include'=> $value->product->brand->principal->ppn_is_active,
            'value' => $value->product->brand->principal->ppn_percentage,
            'total_price' => (int) round($value->total_price)
        ]);
        $productName = $value->product->name;
        $productPrice = number_format($value->price, 0);
        $quantityPrice = number_format($value->quantity_price, 0);
        $productDiscount = number_format($value->product_discount, 0);
        $discountPerItem = $value->product_discount > 0 ? round($value->product_discount / $value->quantity) : 0;
        $fixPricePerItem = number_format(($value->price - $discountPerItem),0);
        $ppn = number_format($value->ppn, 0);
//        $totalPrice = number_format((int)$value->ppn + (int)$value->total_price, 0);
        $totalPrice = number_format((int)$value->total_price, 0);
        $productVariant = $value->productVariant->productVariantToVariant->name;

        $productPriceFix = ($productDiscount > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$productPrice </small>" .
             $fixPricePerItem : number_format($value->price,0));

        $totalPriceText = ($productDiscount > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$quantityPrice </small>" . $totalPrice : $totalPrice);
        $productDiscountText = ($value->product_discount > 0 ? 'Discount : ' . number_format($value->product_discount, 0) : '');
        $ppnText = ($value->ppn > 0 ? 'PPN : ' . number_format($value->ppn, 0) : '');

        if ($order->hubTransaction) {
//            dd($order->hubTransaction);
            $productKey = $productName . ' - (' . $productVariant . ')';
//            dd($productKey);
            $hubQty = $hubPickUp[$hubName][$productKey];
        }


        $tableContent .=
            " <tr>
                    <td class='py-1'>
                        <p class='card-text font-weight-bold mb-25'>$productName - ($productVariant)</p>
                        <p class='card-text text-nowrap'>
                        <small class='text-muted'>$productDiscountText </small>
                        </p>
                    </td>   
                    <td class='py-1 text-left'>
                        <span class='font-weight-bold'>$hubName</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$hubQty</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$value->quantity</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$productPriceFix</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$totalPriceText</span>
                    </td>
              </tr>";
    }

//    dump($NotIncludePPN);

    $table = "<table class='table'>
                <thead>
                <tr>
                    <th class='py-1' width='45%'>Product Info</th>
                    <th class='py-1 text-left' width='20%'>Hub Pickup</th>
                    <th class='py-1 text-right' width='15%'>Assign Quantity</th>
                    <th class='py-1 text-right' width='10%'>Order Quantity</th>
                    <th class='py-1 text-right' width='12%'>Price</th>
                    <th class='py-1 text-right' width='17%'>Total</th>
                </tr>
                </thead>
                <tbody>
                    $tableContent              
                </tbody>
              </table>";

    return [
        'table' => $table,
        'not_include_ppn' => $NotIncludePPN
    ];
//    return $table;
}

function generateTableOrderModal($orderItem)
{
    $html = '';
    $tableContent = '';
    foreach ($orderItem as $item => $value) {
        $productName = $value->product->name;
        $productPrice = number_format($value->price, 0);
        $quantityPrice = number_format($value->quantity_price, 0);
        $productDiscount = number_format($value->product_discount, 0);
        $ppn = number_format($value->ppn, 0);
        $totalPrice = number_format((int)$value->ppn + (int)$value->total_price, 0);
        $productVariant = $value->productVariant->productVariantToVariant->name;

        $totalPriceText = ($productDiscount > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$quantityPrice </small>" . $totalPrice : $totalPrice);
        $productDiscountText = ($value->product_discount > 0 ? 'Discount : ' . number_format($value->product_discount, 0) : '');
        $ppnText = ($value->ppn > 0 ? 'PPN : ' . number_format($value->ppn, 0) : '');

        $tableContent .=
            " <tr>
                    <td class='py-1'>
                        <p class='card-text font-weight-bold mb-25'>$productName - ($productVariant)</p>
                       
                    </td>   
                  
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$value->quantity</span>
                    </td>
                 
              </tr>";
    }

    $table = "<table class='table'>
                <thead>
                <tr>
                    <th class='py-1' width='70%'>Product Info</th>
                  
                    <th class='py-1 text-right' width='30%'>Order Quantity</th>
                 
                </tr>
                </thead>
                <tbody>

                    $tableContent              
                </tbody>
              </table>";

//    dd($table);
    return $table;
}

function generateText($title, $value)
{
    $html = " <tr class='ccd'>
                    <td width='60%'></td>
    
                    <td class='py-1 text-left' width='20%'>
                        <span class='font-weight-bold'>$title</span>
                    </td>
                    <td class='py-1 text-center' width='3%'>:</td>
                    <td class='py-1 text-right' width='17%'>
                        <span class='font-weight-bold'>$value</span>
                    </td>
                </tr>";
    return $html;
}

function generateSummaryTextOrder($order, $fromHubTransaction = null, $hubTransaction = null, $notIncludePPN = null)
{
//    dump($notIncludePPN, $order->total_ppn, $notIncludePPN[0]['value'] * $notIncludePPN[0]['total_price'] / 100 );

//    $totalPrice = number_format(($order->total_price + $order->total_ppn), 0);

    $totalPrice = number_format(($order->total_price - $order->discount_price), 0);
    $priceShipping = number_format($order->price_shipping, 0);
    $totalShipping = number_format($order->total_shipping);
    $shippingCost = ($order->discount_shipping > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$order->price_shipping </small>" . $totalShipping : $totalShipping);
    $serviceCost = '';
    $totalPayment = '';
    $totalCoin = '';
    $shippingCostText = '';
    $ppn = number_format($order->total_ppn,0);
    $ppnText = "";
    $ppnTextInclude = "";
    $ppnTextFull = "";
    $ppnPrice = 0;
    $notInclude = [];
//    dump($notIncludePPN);

    if ($notIncludePPN)
    {
        foreach ($notIncludePPN as $item => $value)
        {
            $ppnDesc = "";
            $ppnPercentage = $value['value'];
            array_push($notInclude, $value['not_include']);
            if ($value['not_include'] == 0)
            {
                $ppnDesc = "Sudah Termasuk";
                $ppnPrice += (int) round($value['total_price'] * $value['value']/100);
                $color = "<div class='badge badge-danger'><span class='font-weight-bold'>".number_format($ppnPrice,0)."</span></div>";
            }else{
                $ppnDesc = "Belum Termasuk";
                $ppnPrice += (int) round($value['total_price'] * $value['value']/100);
                $color = "<span class='font-weight-bold'>".number_format($ppnPrice,0)."</span>";
            }

//            $ppnText .= "
//                    <tr class='ccd'>
//                        <td width='60%'></td>
//
//                        <td class='py-1 text-left' width='40%'>
//                            <span class='font-weight-bold'>Harga $ppnDesc PPN ($ppnPercentage%)</span>
//                        </td>
//                        <td class='py-1 text-center' width='3%'>:
//                        </td>
//                        <td class='py-1 text-right' width='17%'>
//                            $color
//                        </td>
//                    </tr>
//            ";
//        dump($ppnPrice);

        }

        foreach (array_unique($notInclude) as $item => $value)
        {
            //include
            if($value == 0)
            {
                $color = "<div class='badge badge-danger'><span class='font-weight-bold'>".number_format($ppnPrice,0)."</span></div>";
                $ppnText .= "
                    <tr class='ccd'>
                        <td width='60%'></td>
            
                        <td class='py-1 text-left' width='40%'>
                            <span class='font-weight-bold'>Harga Sudah Termasuk PPN (11%)</span>
                        </td>
                        <td class='py-1 text-center' width='3%'>:
                        </td>
                        <td class='py-1 text-right' width='17%'>
                            $color  
                        </td>
                    </tr>
            ";
            }else{
                $color = "<span class='font-weight-bold'>".number_format($ppnPrice,0)."</span>";
                $ppnText .= "
                    <tr class='ccd'>
                        <td width='60%'></td>
            
                        <td class='py-1 text-left' width='40%'>
                            <span class='font-weight-bold'>Harga Belum Termasuk PPN (11%)</span>
                        </td>
                        <td class='py-1 text-center' width='3%'>:
                        </td>
                        <td class='py-1 text-right' width='17%'>
                            $color  
                        </td>
                    </tr>";
            }
        }

        $ppnTextFull =
            "<tr class='ccd'>
            <td width='60%'></td>

            <td class='py-1 text-left' width='40%'>
                <span class='font-weight-bold'>PPN</span>
            </td>
           
        </tr>
        
       $ppnText
        ";

    }




    //show serve price for hub transaction
    if ($hubTransaction)
    {
//        $totalPrice = ($hubTransaction->detail ? number_format($hubTransaction->detail->sum('serve_price'),0) : number_format(($order->total_price + $order->total_ppn), 0));
        $totalPrice = ($hubTransaction->detail ? number_format($hubTransaction->detail->sum('serve_price'),0) : number_format(($order->total_price), 0));
    }


    if ($fromHubTransaction == null) {
        $serviceCost = ($order->service_cost > 0 ? generateText('Service Cost', number_format($order->service_cost, 0)) : "");
        $totalPayment = ($order->service_cost > 0 ? generateText('Total Payment', number_format($order->total_payment, 0)) : "");
        $totalCoin = ($order->total_coin_use > 0 ? generateText('Total Coin Use', '-' . number_format($order->total_coin_use, 0)) : "");
        $shippingCostText =
            "
                        <tr class='ccd'>
                            <td width='60%'></td>
            
                            <td class='py-1 text-left' width='20%'>
                                <span class='font-weight-bold'>Shipping Cost</span>
                            </td>
                            <td class='py-1 text-center' width='3%'>:</td>
                            <td class='py-1 text-right' width='17%'>
                                <span class='font-weight-bold'>$shippingCost</span>
                            </td>
                        </tr>
                        ";
    }
    $html = "<table class='table noborder-table' style='border:none !important;'>
                <tbody>
                <tr class='ccd'>
                    <td width='60%'></td>
                    <td class='py-1 text-left' width='20%'>
                        <span class='font-weight-bold'>Total Price</span>
                    </td>
                    <td class='py-1 text-center' width='3%'>:</td>
                    <td class='py-1 text-right' width='17%'>
                        <span class='font-weight-bold'>$totalPrice</span>
                    </td>
                </tr>
                
                $shippingCostText
                $serviceCost
                $totalCoin
                $ppnTextFull

                $totalPayment
                
                
                <tr class='note'>
                    <td width='60%'>NOTE : $order->notes</td>
                    <td width='40%'></td>                 
                </tr>
                
               
                </tbody>
              </table>";
//    dd($order->notes);
    return $html;
}

function generateInputConfirm($confirm, $hubQty, $orderItemId, $isServe = null, $transactionDetailItem = null)
{
    $serveQuantity = ($transactionDetailItem ? $transactionDetailItem->serve_quantity: 0);
    $isServeValue = ($transactionDetailItem ? $transactionDetailItem->is_serve: 0);
    $checkedState = ($transactionDetailItem && $transactionDetailItem->serve_quantity > 0 ? ' checked ' : ' ');
    if($confirm == true)
    {
        return "
                <td class='py-1 text-center'>
                    <div class='custom-control custom-control-primary custom-checkbox'>
                        <input type='checkbox' $checkedState value='$isServeValue' class='custom-control-input cb-serve' data-id='$orderItemId' data-hub_pickup='$hubQty' id='cb-$orderItemId'  />
                        <label class='custom-control-label' for='cb-$orderItemId'></label>
                    </div>
                </td>
                <td class='py-1 text-center'>
                    <input type='text' class='form-control input-stock-confirm' data-id='$orderItemId'
                     id='input-confirm-$orderItemId' value='$serveQuantity' min='0' max='$hubQty' required>
                </td>
                ";
    }
    $cb = ($isServe == 1 ? "<div class='badge badge-success'>v</div>" :"<div class='badge badge-danger'>x</div>" );
    return
            "
            <td class='py-1 text-center'>
                $cb
            </td>
            <td class='py-1 text-center'>".($hubQty ? $hubQty : '-')."</td>
            ";
}

function setTagColorOrderType($param)
{
    $label = '<div class="badge badge-{color}">{text}</div>';
    $color = '';
    switch ($param) {
        case 0:
            $color = 'success';
            $text = 'NORMAL ORDER';
            break;
        case 1:
            $color = 'danger';
            $text = 'CROSS HUB ORDER';
            break;
        default :
            $color = 'success';
            $text = 'NORMAL ORDER';
    }

    $label = str_replace('{color}', $color, $label);
    $label = str_replace('{text}', $text, $label);

    return $label;
}

function setTagColorTransactionStatus($param)
{
    $label = '<div class="badge badge-{color}">{text}</div>';
    $color = '';
    switch ($param) {
        case 'PACKAGED':
            $color = 'success';
            $text = $param;
            break;
        case 1:
            $color = 'danger';
            $text = $param;
            break;
        default :
            $color = 'danger';
            $text = $param;
    }

    $label = str_replace('{color}', $color, $label);
    $label = str_replace('{text}', $text, $label);

    return $label;
}




//BARU
function generateConfirmStockTableNew($hubTransaction , $detail, $needConfirm = null)
{
    $tableContent = '';
//    $totalPrice = number_format((int)$hubTransaction->ppn + (int)$hubTransaction->total_price, 0);
    $info = '';
    $th_info = '';
    $NotIncludePPN = [];

    foreach ($detail as  $item => $value)
    {
//        dd($value);
        array_push($NotIncludePPN, [
            'not_include'=> $value->detailProductVariant->product->brand->principal->ppn_is_active,
            'value' => $value->detailProductVariant->product->brand->principal->ppn_percentage,
            'total_price' => (int) round($value->total_price)
        ]);

        $productName = $value->detailProductVariant->product->name;
        $productVariant = $value->detailProductVariant->productVariantToVariant->name;
        $hubAssign = $value->value;
        $detailId = $value->id;
        $servePrice = number_format($value->serve_price,0);
        $itemPrice = number_format(($value->total_price - $value->product_discount),0);
        $serveQuantity = $value->serve_quantity;
//        $servePrice = number_format($itemPrice * $value->serve_quantity,0);

        $stockInHub = 0;
        $th_infoStock = '';
        $td_infoStock = '';
        if ($needConfirm)
        {
            $stockInHub = getStockProductInHub($hubTransaction->hub_id, $value);
            $input = generateInputConfirm(true, $hubAssign, $detailId, null, $value);
            $td_infoStock .= "             
                    <td class='py-1 text-center'>
                        <span class='font-weight-bold'>$stockInHub</span>
                    </td>
                    ";
            $th_infoStock .=  "
                         <th class='py-1 text-center' width='15%'>Stock In HUB</th>
                        ";
        }else{
            $input = generateInputConfirm(false, $serveQuantity, null, $value->is_serve);
            $info = "             
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$servePrice</span>
                    </td>
                    ";
            $th_info =
                    "
                         <th class='py-1 text-right' width='15%'>Serve Price</th>
                    ";
        }

        $tableContent .=
            " <tr>
                <td class='py-1'>
                    <p class='card-text font-weight-bold mb-25'>$productName - ($productVariant)</p
                </td>
                
                $td_infoStock
               
                <td class='py-1 text-center'>
                    <span class='font-weight-bold'>$hubAssign</span>
                </td>
                $input
                $info
          </tr>";
    }

    $table =
        "<table class='table'>
            <thead>
                <tr>
                    <th class='py-1' width='45%'>Product Info</th>
                     $th_infoStock
                    <th class='py-1 text-center' width='10%'>Assign Quantity</th>
                    <th class='py-1 text-center' width='10%'>Serve ?</th>
                    <th class='py-1 text-center' width='10%'>Serve Quantity</th>
                    $th_info
                </tr>
            </thead>
            <tbody>
                $tableContent
            </tbody>
        </table>";

    return [
        'table' => $table,
        'not_include_ppn' => $NotIncludePPN
    ];
//    return $table;
}

function getStockProductInHub($hubId, $hubTransactionitem)
{
    $product_id = $hubTransactionitem->detailProductVariant->product_id;
    $variant_id = $hubTransactionitem->detailProductVariant->variant_id;
    $data = \App\Models\Generator\ProductStock::withoutTrashed()
        ->where(["hub_id" => $hubId, 'product_id' => $product_id, 'variant_id' => $variant_id])->first();
    return ($data ? $data->stock : 0);
}


//CROSS ORDER TRANSACTION HERE
function generateTableCrossOrder($order)
{
    $tableContent = '';

    $hubPickUp = [];
    $hubName = '-';
    $NotIncludePPN = [];

    foreach ($order->item as $item => $value) {

        array_push($NotIncludePPN, [
            'not_include'=> $value->product->brand->principal->ppn_is_active,
            'value' => $value->product->brand->principal->ppn_percentage,
            'total_price' => (int) round($value->total_price)
        ]);

        $cookieHubId = Cookie::get('hub_id');
        $cookieHubName = Cookie::get('hub_name');
        $cookieOrderId = Cookie::get('order_id');
        $cookieOrderItemId = Cookie::get('order_item_id');
        $cookieAssign = Cookie::get('cross_assign_quantity');

        $arrCookieHubId = (array) json_decode($cookieHubId);
        $arrCookieHubName = (array) json_decode($cookieHubName);
        $arrCookieOrderId = (array) json_decode($cookieOrderId);
        $arrCookieOrderItemId = (array) json_decode($cookieOrderItemId);
        $arrCookieAssign = (array) json_decode($cookieAssign);

        $productName = $value->product->name;
        $productPrice = number_format($value->price, 0);
        $quantityPrice = number_format($value->quantity_price, 0);
        $productDiscount = number_format($value->product_discount, 0);
        $discountPerItem = $value->product_discount > 0 ? round($value->product_discount / $value->quantity) : 0;
        $fixPricePerItem = number_format(($value->price - $discountPerItem),0);

//        $ppn = number_format($value->ppn, 0);
//        $totalPrice = number_format((int)$value->ppn + (int)$value->total_price, 0);
        $totalPrice = number_format((int)$value->total_price, 0);
        $productVariant = $value->productVariant->productVariantToVariant->name;
        $productPriceFix = ($productDiscount > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$productPrice </small>" .
            $fixPricePerItem : number_format($value->price,0));
        $totalPriceText = ($productDiscount > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$quantityPrice </small>" . $totalPrice : $totalPrice);
        $productDiscountText = ($value->product_discount > 0 ? 'Discount : ' . number_format($value->product_discount, 0) : '');
//        $ppnText = ($value->ppn > 0 ? 'PPN : ' . number_format($value->ppn, 0) : '');

//        if ($order->hubTransaction) {
//            $productKey = $productName . ' - (' . $productVariant . ')';
//            $hubQty = $hubPickUp[$hubName][$productKey];
//        }

        $dataProductId = $value->product->id;
        $dataProductVariantId = $value->product_variant_id;
        $dataProductToVariantId = $value->productVariant->productVariantToVariant->id;

        $input = "";
        $hubQty = "";


        $datacookie[$value->id] = reformatDataArrayCookie($value->id, $arrCookieHubId, $arrCookieHubName, $arrCookieOrderId,
            $arrCookieOrderItemId, $arrCookieAssign);

        //exist cookies
        if (is_array($arrCookieOrderItemId)) {
            //key index order item id
            $arrKey = searchArray($value->id, $arrCookieOrderItemId);

            if (isset($arrKey)) {

                //cookies same as order item id
                if ($value->id == $arrCookieOrderItemId[$arrKey]) {

                    foreach ($datacookie[$value->id]['hub'] as $cookieHubItem => $cookieHub)
                    {
                        $hub =  ($cookieHub ? $cookieHub : '-');
                        $assign = ($datacookie[$value->id] ? $datacookie[$value->id]['assign'][$cookieHubItem] : '-');
                        $hubQty .= "<span class='font-weight-bold hubPickUpQuantity' data-value='$assign'>$assign   </span><br><br>";
                        $input .= "<span class='font-weight-bold hubPickUpName' data-value = '$hub'>$hub   </span><br><br>";

                        if (array_sum($datacookie[$value->id]['assign']) < $value->quantity)
                        {
                            $hubQty .= "<span class='font-weight-bold'>-</span> <br><br>";
                            $input .= " <input type='text' class='form-control input-hub' data-order_id='$value->order_id' data-order_item_id='$value->id' data-product_name='$productName' data-variant_name='$productVariant' data-order_quantity='$value->quantity'
                                        data-product_variant_id='$dataProductVariantId' data-product_to_variant='$dataProductToVariantId' data-product_id='$dataProductId'>
                                        ";
                        }
                    }
                }

            }else{
                $input = " <input type='text' class='form-control input-hub' data-order_id='$value->order_id' data-order_item_id='$value->id' data-product_name='$productName' data-variant_name='$productVariant' data-order_quantity='$value->quantity'
                    data-product_variant_id='$dataProductVariantId' data-product_to_variant='$dataProductToVariantId' data-product_id='$dataProductId'>
                 ";
            }
        }

        $tableContent .=
            " <tr>
                    <td class='py-1'>
                        <p class='card-text font-weight-bold mb-25'>$productName - ($productVariant)</p>
                        <p class='card-text text-nowrap'>
                        <small class='text-muted'>$productDiscountText </small>
                        </p>
                    </td>   
                    <td class='py-1 text-left'>
                        $input
                    </td>
                    <td class='py-1 text-right'>
                        $hubQty
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$value->quantity</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$productPriceFix</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$totalPriceText</span>
                    </td>
              </tr>";
    }

    $table = "<table class='table'>
                <thead>
                <tr>
                    <th class='py-1' width='45%'>Product Info</th>
                    <th class='py-1 text-left' width='20%'>Hub Pickup</th>
                    <th class='py-1 text-right' width='15%'>Assign Quantity</th>
                    <th class='py-1 text-right' width='10%'>Order Quantity</th>
                    <th class='py-1 text-right' width='12%'>Price</th>
                    <th class='py-1 text-right' width='17%'>Total</th>
                </tr>
                </thead>
                <tbody>
                    $tableContent              
                </tbody>
              </table>";
    return [
        'table' => $table,
        'not_include_ppn' => $NotIncludePPN
    ];
//    return $table;
}

function generateTableCrossOrderHasTransaction($order, $crossOrder)
{
    $tableContent = '';
    $dataDetailPerItem = [];
    $NotIncludePPN = [];

    foreach ($order->item as $item => $value) {
        $hubPickup = [];
        $assignQuantity = [];
        array_push($NotIncludePPN, [
            'not_include'=> $value->product->brand->principal->ppn_is_active,
            'value' => $value->product->brand->principal->ppn_percentage,
            'total_price' => (int) round($value->total_price)
        ]);


        foreach ($crossOrder as $key => $val)
        {
            foreach ($val->detail  as $item => $val2)
            {
                if ($val2->product_variant_id == $value->product_variant_id)
                {
//                    dd($val2);
                    $hubName = \App\Models\Generator\Hub::withoutTrashed()->find($val->hub_id);
                    $hubPickup[$val->hub_id] = $hubName->name;
                    $assignQuantity[$val->hub_id] = $val2->value;
                }
            }
        }
//        dump(array_values($hubPickup));
//        dump($assignQuantity);



        $productName = $value->product->name;
        $productPrice = number_format($value->price, 0);
        $quantityPrice = number_format($value->quantity_price, 0);
        $productDiscount = number_format($value->product_discount, 0);
        $discountPerItem = $value->product_discount > 0 ? round($value->product_discount / $value->quantity) : 0;
        $fixPricePerItem = number_format(($value->price - $discountPerItem),0);

//        $ppn = number_format($value->ppn, 0);
//        $totalPrice = number_format((int)$value->ppn + (int)$value->total_price, 0);
        $totalPrice = number_format((int)$value->total_price, 0);
        $productVariant = $value->productVariant->productVariantToVariant->name;
        $productPriceFix = ($productDiscount > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$productPrice </small>" .
            $fixPricePerItem : number_format($value->price,0));

        $totalPriceText = ($productDiscount > 0 ? "<small class='text-muted' style='text-decoration: line-through;'>$quantityPrice </small>" . $totalPrice : $totalPrice);
        $productDiscountText = ($value->product_discount > 0 ? 'Discount : ' . number_format($value->product_discount, 0) : '');
        $ppnText = ($value->ppn > 0 ? 'PPN : ' . number_format($value->ppn, 0) : '');

//        $dataProductId = $value->product->id;
//        $dataProductVariantId = $value->product_variant_id;
//        $dataProductToVariantId = $value->productVariant->productVariantToVariant->id;

//        $productVariantId = $value->product_variant_id;
//
//        dd($crossOrder);
//        dd($value);

        $hubQty = '';
        $input = '';
        foreach ($hubPickup as $hub => $h)
        {
            $hubQty .= "<span class='font-weight-bold hubPickUpQuantity' data-value='$assignQuantity[$hub]'>$assignQuantity[$hub]   </span><br><br>";
            $input .= "<span class='font-weight-bold hubPickUpName' data-value = '$h'>$h   </span><br><br>";
        }

        $tableContent .=
            " <tr>
                    <td class='py-1'>
                        <p class='card-text font-weight-bold mb-25'>$productName - ($productVariant)</p>
                        <p class='card-text text-nowrap'>
                        <small class='text-muted'>$productDiscountText </small>
                        </p>
                    </td>   
                    <td class='py-1 text-left'>
                        $input
                    </td>
                    <td class='py-1 text-right'>
                        $hubQty
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$value->quantity</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$productPriceFix</span>
                    </td>
                    <td class='py-1 text-right'>
                        <span class='font-weight-bold'>$totalPriceText</span>
                    </td>
              </tr>";

    }

    $table = "<table class='table'>
                <thead>
                <tr>
                    <th class='py-1' width='45%'>Product Info</th>
                    <th class='py-1 text-left' width='20%'>Hub Pickup</th>
                    <th class='py-1 text-right' width='15%'>Assign Quantity</th>
                    <th class='py-1 text-right' width='10%'>Order Quantity</th>
                    <th class='py-1 text-right' width='12%'>Price</th>
                    <th class='py-1 text-right' width='17%'>Total</th>
                </tr>
                </thead>
                <tbody>
                    $tableContent              
                </tbody>
              </table>";

    return [
        'table' => $table,
        'not_include_ppn' => $NotIncludePPN
    ];
//    return $table;
}


function getPriceFromOrderItem($orderId,$productVariantId)
{
    $orderItem = \App\Models\Generator\OrderItem::withTrashed()->where(['order_id' => $orderId, 'product_variant_id' => $productVariantId])->first();

    return $orderItem;
}

function reformatDataArrayCookie($detailId, $hubId, $hubName, $orderId, $orderItemId, $assign)
{
    $result = [];

    $arrHubId = [];
    $arrHubName = [];
    $arrAssign = [];

    foreach ($orderItemId as $item => $val)
    {
        if ($val == $detailId)
        {
            $arrHubId[] = $hubId[$item];
            $arrHubName[] = $hubName[$item];
            $arrAssign[] = $assign[$item];
        }

    }

//    $result['itemId'] = $arrHubName;
    $result['hub'] = $arrHubName;
    $result['assign'] = $arrAssign;

//    dd($result);

    return $result;
//    dd($arrHubName, $arrAssign);

//    dd($detailId, $hubId, $hubName, $orderId, $orderItemId, $assign);

}


function searchArray2($id, $array) {
    foreach ($array as $key => $val) {
        if ($id == $val) {
            return $val;
        }
    }
    return null;
}

function searchArray($id, $array) {
    foreach ($array as $key => $val) {
        if ($id == $val) {
            return $key;
        }
    }
    return null;
}



?>
