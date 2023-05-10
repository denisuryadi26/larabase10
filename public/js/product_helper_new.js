var index;
$(function () {
    'use strict';

    var bsStepper = document.querySelectorAll('.bs-stepper'),
        select = $('.select2'),
        verticalWizard = document.querySelector('.vertical-wizard-example'),
        form = $(verticalWizard).find('form');

    // Adds crossed class
    if (typeof bsStepper !== undefined && bsStepper !== null) {

        for (var el = 0; el < bsStepper.length; ++el) {
            bsStepper[el].addEventListener('show.bs-stepper', function (event) {
                index = event.detail.indexStep;
                var numberOfSteps = $(event.target).find('.step').length - 1;
                var line = $(event.target).find('.step');


                // The first for loop is for increasing the steps,
                // the second is for turning them off when going back
                // and the third with the if statement because the last line
                // can't seem to turn off when I press the first item. ¯\_(ツ)_/¯

                for (var i = 0; i < index; i++) {
                    line[i].classList.add('crossed');

                    for (var j = index; j < numberOfSteps; j++) {
                        line[j].classList.remove('crossed');
                    }
                }
                if (event.detail.to == 0) {
                    for (var k = index; k < numberOfSteps; k++) {
                        line[k].classList.remove('crossed');
                    }
                    line[0].classList.remove('crossed');
                }
            });
        }
    }

    // select2
    /*select.each(function () {
        var $this = $(this);
        $this.wrap('<div class="position-relative"></div>');
        $this.select2({
            placeholder: 'Select value',
            dropdownParent: $this.parent()
        });
    });*/

    // Vertical Wizard
    // --------------------------------------------------------------------
    if (typeof verticalWizard !== undefined && verticalWizard !== null) {

        //disable number click stepper
        var numberedStepper = new Stepper(verticalWizard),
        form = $(verticalWizard).find('form');
        // console.log(form);
        form.each(function () {
            var $this = $(this);

            $this.validate({
                rules: {
                    sku: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    // rating: {
                    //     required: true
                    // },
                    category_id: {
                        required: true
                    },
                    brand_id: {
                        required: true
                    },
                    image: {
                        required: true
                    },
                    variant_id: {
                        required: true
                    },
                    variant_value: {
                        required: true
                    }


                }
            });
        });

        var verticalStepper = new Stepper(verticalWizard, {
            linear: false
        });
        $(verticalWizard)
            .find('.btn-next')
            .on('click', function (e) {
                // verticalStepper.next();
                // console.log(e)

                var isValid = $(this).parent().siblings('form').valid();
                // console.log( $(this).parent().siblings('form'))


                //SET COOKIE FOR SELECTED VARIANT
                /*if (index == 1)
                {

                }*/
                // let variantId = []  ;
                // let variantIdForm = $('#formVariant').serializeArray()
                // console.log(variantIdForm)
                // for (var i=0; i<variantIdForm.length; i++) {
                //     if(i % 4 === 1)
                //     {
                //         variantId.push( variantIdForm[i].value)
                //     }
                // }
                // document.cookie = `variantid=${variantId}`;
                //
                // //get cookie
                // let parameter = $.cookie("variantid");
                //
                // $.get(url.getVariant, {param: parameter}, function (result){
                //     let response = result.data
                //
                //     if (response !== undefined)
                //     {
                //         //variantStockId
                //         fillVariantInput(response);
                //     }
                // })

                getVariant();
                getSegment();

                //GENERATE BASE PRICE
                if (index === 2){
                    showLoading();
                    generateBasePriceInput()
                    swalStatus({'status': 'success'}, "myModal", '', '');

                    // console.log(variantStock)

                    // generateBasePriceInput()
                    // let basePriceHtml = '';

                    // $('#priceDiv').html(basePriceHtml);
                }


                if (isValid) {
                    verticalStepper.next();
                } else {
                    e.preventDefault();
                }
            });
        $(verticalWizard)
            .find('.btn-prev')
            .on('click', function () {
                verticalStepper.previous();
            });

        $(verticalWizard)
            .find('.btn-submit')
            .on('click', function () {

                var isValid = $(this).parent().siblings('form').valid();
                if (isValid) {
                    var CSRF_TOKEN = "{{@csrf_token()}}";

                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': CSRF_TOKEN
                        }
                    });
                    let id = $('#id').val();
                    let is_active = $('#is_active').val();

                    let description = (CKEDITOR.instances.description) ? CKEDITOR.instances.description.getData() : $('#description').val();
                    let how_to_save = (CKEDITOR.instances.how_to_save) ? CKEDITOR.instances.how_to_save.getData() : $('#how_to_save').val();

                    let file_data = $('#fileUpload').prop('files'),
                        form_data = new FormData(document.getElementById('formProduct'));

                    // console.log(file_data);

                    let variantData = [];
                    let stockData = [];
                    let priceData = [];
                    var poVariant = $('#formVariant').serializeArray();
                    var poStock = $('#formStock').serializeArray();
                    var poPrice = $('#formPrice').serializeArray();

                    for (var i=0; i<poVariant.length; i++) {
                        variantData.push( poVariant[i].value)
                    }

                    for (var i=0; i<poStock.length; i++) {
                        stockData.push( poStock[i].value)
                    }

                    for (var i=0; i<poPrice.length; i++) {
                        priceData.push( poPrice[i].value)
                    }

                    form_data.append('_token' , $("input[name=_token]").val());
                    // form_data.append('_cache_id' , localStorage.getItem('cache_id'));
                    form_data.append('image', file_data);
                    form_data.append('id', id);
                    form_data.append('variant', variantData);
                    form_data.append('stock', stockData);
                    // form_data.append('price', priceData);
                    form_data.append('base_price', priceData);
                    form_data.append('description', description);
                    form_data.append('how_to_save', how_to_save);
                    form_data.append('is_active', is_active);


                    $.ajax({
                        url: url.submit,
                        data: form_data,
                        type: 'POST',
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        beforeSend: function () {
                            showLoading();
                        },
                        success: function (response) {
                            swalStatus(response,"myModal", 1)

                        }

                    });
                    event.preventDefault();
                    // console.log(form_data)
                } else {
                    e.preventDefault();
                }


            });
    }

});

function getVariant()
{
    let variantId = []  ;
    let variantIdForm = $('#formVariant').serializeArray()
    for (var i=0; i<variantIdForm.length; i++) {
        if(i % 4 === 1)
        {
            variantId.push( variantIdForm[i].value)
        }
    }
    document.cookie = `variantid=${variantId}`;

    //get cookie
    let parameter = $.cookie("variantid");
    // console.log(parameter);

    $.get(url.getVariant, {param: parameter}, function (result){
        let response = result.data
        variantStock = response['variant'];
        console.log(response);


        if (response !== undefined)
        {
            generateStockAllHub(response)
            //variantStockId
            // fillVariantInput(response);
        }
    })
}

function getSegment()
{
    $.get(url.getSegment, function (result){
        let response = result.data
        allSegment = response;

    })
}

function generateInputStockModalDiv()
{
    let html = '';


    $.each(variantStock, function(k, v){
        html +=

            `<div class='col-md-6'>
                            <div class='form-group'>
                                        <label for='invoice-from' class='form-label'>Variant</label>
                                        <input class='form-control' name='variant_stock_id' value="${v.id}" type='hidden'  >
                                        <input class='form-control stockHubVariantName' name="stock_hub_variant_name" type='text' value="${v.name} - (${v.code})" readonly >
                            </div>

                        </div>

                        <div class='col-md-6'>
                            <div class='form-group'>
                                        <label for='invoice-from' class='form-label'>Value</label>
                                        <input class='form-control' name= 'variant_stock_value' type='number' value="0" >
                            </div>

                        </div>
                        `

    })

    $('#inputStockModalDiv').html(html);
    // console.log(variantId);
    // document.cookie = `variantid=${variantId}`;


}

function generateInputPriceModalDiv(allSegment)
{
    // console.log()

    let html = '';

    $.each(allSegment, function(k, v){


        $.each(variantStock, function (key, val){
            html +=

                `           
                        <input class='form-control' name='price_id' value="" type='hidden'  >

                        <div class='col-md-4'>
                            <div class='form-group'>
                                        <label for='invoice-from' class='form-label'>Segment</label>
                                        <input class='form-control' name='price_segment_id' value="${v.id}" type='hidden'  >
                                        <input class='form-control priceSegmentName' name="price_segment_name" type='text' value="${v.name}" readonly >
                            </div>

                        </div>
                         
                        <div class='col-md-4'>
                            <div class='form-group'>
                                        <label for='invoice-from' class='form-label'>Variant</label>
                                        <input class='form-control' name='price_variant_id' value="${val.id}" type='hidden'  >
                                        <input class='form-control' name="price_variant_name" type='text' value="${val.name} - (${val.code})" readonly >
                            </div>

                        </div>

                        <div class='col-md-4'>
                            <div class='form-group'>
                                        <label for='invoice-from' class='form-label'>Price</label>
                                        <input class='form-control' name= 'price_price_value' type='number' value="0" required >
                            </div>

                        </div>
                        `
        })


    })

    $('#inputPriceModalDiv').html(html);
    // console.log(variantId);
    // document.cookie = `variantid=${variantId}`;


}


function generateStockAllHub(variantData)
{
    let html = '',
        allHub = variantData['hub'],
        allVariant = variantData['variant'];


    $.each(allHub, function (k,v){

        html += `<div class='col-md-12'>
                    <div class='form-group'>
                        <div class="badge badge-success">${v.name}</div>
                    </div>
                </div>`;

        $.each(allVariant, function (key, val){
            html +=`
                        <input class='form-control' name="id" type='hidden' value="" readonly >
                        <div class='hidden'>
                            <div class='form-group'>
                                <label for='invoice-from' class='form-label'>HUB</label>
                                <input class='form-control' name="stock_hub_id" type='text' value="${v.id}" readonly >
                            </div>

                        </div>

                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='invoice-from' class='form-label'>Variant</label>
                                <input class='form-control' name='variant_stock_id' value="${val.id}" type='hidden'  >
                                <input class='form-control' type='text' value="${val.name}" readonly >
                            </div>

                        </div>

                        <div class='col-md-6'>
                            <div class='form-group'>
                                <label for='invoice-from' class='form-label'>Value</label>
                                <input class='form-control' name= 'variant_stock_value' type='number' value="0" >
                            </div>

                        </div>
                        `
        })
    })

    $('#variantStockDiv').html(html);

}

function fillVariantInput(variantData)
{
    let html = '';
    $.each(variantData, function (k, v){
        html += `<option value="${v.id}">${v.name} - (${v.code})</option>`
    })

    $('.variantStockId').html(html);
    $('.variantPriceId').html(html);


}


function generateBasePriceInput()
{
    let html = '';

    $.each(variantStock, function (v, variantVal){
        $.each(allSegment, function (k, segmentVal){
            html +=
                `
                <input class="form-control" name="price_id" value="" type="hidden">

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="invoice-from" class="form-label">Segment</label>
                        <input class="form-control" name="price_segment_id" value="${segmentVal.id}" type="hidden">
                        <input class="form-control" type="text" value="${segmentVal.name}" readonly="">
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <label for="invoice-from" class="form-label">Variant</label>
                        <input class="form-control" name="price_variant_id" value="${variantVal.id}" type="hidden">
                        <input class="form-control" type="text" value="${variantVal.name} - (${variantVal.code})" readonly="">
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="invoice-from" class="form-label">Price</label>
                        <input class="form-control" name="price_price_value" type="number" value="0">
                    </div>
                </div>
                `;
        })


    })

    $('#BasepriceDiv').html(html)

}

function reformatDataInputStock(dataInputStock)
{
    let key = ['variant_stock_id','variant_stock_value','stock_hub_variant_name'];
    let stockIdArray = [];
    let stockValueArray = [];
    let result = [];
    let response =  [];
    delete dataInputStock["product_stock_id"];
    delete dataInputStock["_token"];
    $.each(dataInputStock, function (k, v){
        if (key.includes(v.name)){
            result.push(v.value)
        }
    });


    // const input = ['a', 'x', 'c', 'r']
    return splitArrayByIndex(result, 3)
}


function createObject(index,value){
    var data = {};
    data[index] = value;
    return data;
}
function reformatDataInputPrice(dataInputPrice)
{
    let key = ['price_segment_id','price_variant_id','price_price_value','price_segment_name','price_variant_name'];

    // let stockIdArray = [];
    // let stockValueArray = [];
    let result = [];
    // let response =  [];
    // console.log(dataInputStock);
    delete dataInputPrice["product_stock_id"];
    delete dataInputPrice["_token"];
    $.each(dataInputPrice, function (k, v){
        if (key.includes(v.name)){
            // let indexObject = v.name;
            let data = createObject(v.name , v.value);
            // result[indexObject] += v.value;
            result.push(data)
            // result.push({"v.name":v.value})
        }
    });


    // split arrays
    const array1 = [];
    const array2 = [];
    const array3 = [];
    const array4 = [];
    const array5 = [];

    result.forEach(obj => {
        // if statements or switch statement depending on how you want to split
        switch(Object.keys(obj).toString()) {
            case 'price_segment_id':
                array1.push(obj);
                break;
            case 'price_segment_name':
                array2.push(obj);
                break;
            case 'price_variant_id':
                array3.push(obj);
                break;
            case 'price_variant_name':
                array4.push(obj);
                break;
            case 'price_price_value':
                array5.push(obj);
                break;
            default:
                // array3.push(obj);
                // break;
        }
    });

    let response = {'segment_id' : array1, 'segment_name': array2, 'variant_id': array3,
        'variant_name': array4, 'price_value':array5};
    return response;

}

const splitArrayByIndex = (arr, index) => {
    if (index > 0 && index < arr.length) {
        return [arr.slice(0, index), arr.slice(-1 * (arr.length - index))]
    }
}