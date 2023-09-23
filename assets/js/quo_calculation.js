function getPaymentData() {
    var payment = $('input[name="radios"]:checked').val();

    if (payment == 'Cash') {
        $('#transactions').hide();
        $('#transaction').val("");
        $('#payment_method').val(payment);
    } else {
        $('#transactions').show();
        $('#payment_method').val(payment);
    }
}
hhhh();

function hhhh() {
    var gstDt = $('#gstData').val();
    if (gstDt == '0') {
        $('.with').show();
        $('.without').hide();
    } else {
        $('.with').hide();
        $('.without').show();
    }
}

function getGst(data) {
    $('#gstData').val(data);
    if (data == '0') {
        $('.with').show();
        $('.without').hide();
    } else {
        $('.with').hide();
        $('.without').show();
    }
}


function getFullRate(rowId) {
    var rate = $('#rate_' + rowId).val();
    $('#rate_value_' + rowId).val(rate);
    getFullTotal(rowId);
}

function getFullNetRate(rowId) {
    var rate = $('#net_rate_' + rowId).val();
    $('#net_rate_value_' + rowId).val(rate);
    getFullNetTotal(rowId);
}

function getTotal(row = null) {
    if (row) {
        var product_id = $("#product_" + row).val();
        $.ajax({
            url: base_url + 'Controller_Orders/getProductQtyId',
            type: 'post',
            data: { product_id: product_id },
            dataType: 'json',
            success: function(response) {
                getFullTotal(row);
            }
        });

    } else {
        alert('no row !! please refresh the page');
    }
}

function getCustomerDetails(customerId) {
    $.ajax({
        url: base_url + 'Controller_Customer/getCustomerDetailsSingle',
        type: 'post',
        data: { id: customerId },
        dataType: 'json',
        success: function(response) {
                // var cust = $('#customer').val();
                // var splitWord = cust.substring(0,3)
                // $('#customer_name').val(splitWord);
                if (response.length > 0 && response[0].net_amount && response[0].paid_amount) {
                    $('#dueAmount').show();
                    var balance = (parseFloat(response[0].net_amount) + parseFloat(response[0].due_amount)) - parseFloat(response[0].paid_amount);

                    $('#balanceDueAmount').html(balance.toFixed(2));
                    $("#net_balance_amount").val(balance.toFixed(2));
                    $("#net_balance_amount_value").val(balance.toFixed(2));
                    if ($("#net_amount").val()) {
                        var netAmt = $("#net_amount").val();
                        var total = parseFloat(netAmt) + parseFloat(balance);
                        $("#total_amount").val(total.toFixed(2));
                        $("#total_amount_value").val(total.toFixed(2));
                        subAmount();
                    }

                } else {
                    $('#balanceDueAmount').html('0.00');
                    $('#dueAmount').hide();
                    $("#net_balance_amount").val(0);
                    $("#net_balance_amount_value").val(0);
                    subAmount();
                }

            } // /success
    });
}

function getFullTotal(row = null) {
    if (row) {
        var sgst = 0;
        var cgst = 0;
        if ($("#ptype_" + row).val() == 'SquareMeter') {
            if ($("#sbit1_" + row).val() && $("#sbit2_" + row).val()) {
                var squarBit = $("#sbit1_" + row).val() * $("#sbit2_" + row).val();
                var tSq = ((squarBit * 0.305));
                $("#sbit3_" + row).val(tSq.toFixed(3));
                var qty = $("#qty_" + row).val() * (tSq);
                var total = Number($("#rate_value_" + row).val()) * qty;
                if ($("#rate_value_" + row).val()) {
                    var totalGST = parseFloat($("#gst_rate_" + row).val());
                    var gstPerRate = totalGST / 100;
                    var gstRate = parseFloat($("#rate_value_" + row).val()) * parseFloat(gstPerRate);
                    var netRate = parseFloat($("#rate_value_" + row).val()) + gstRate;
                    $("#net_rate_value_" + row).val(parseFloat(netRate).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(netRate).toFixed(2));
                    var total1 = Number($("#net_rate_" + row).val()) * qty;
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }

            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else if ($("#ptype_" + row).val() == 'SquareFeet') {
            if ($("#sbit1_" + row).val() && $("#sbit2_" + row).val()) {
                var squarBit = $("#sbit1_" + row).val() * $("#sbit2_" + row).val();
                var tSq = (squarBit);
                $("#sbit3_" + row).val(tSq.toFixed(3));
                var qty = $("#qty_" + row).val() * (tSq);
                var total = Number($("#rate_value_" + row).val()) * qty;
                if ($("#rate_value_" + row).val()) {
                    var totalGST = parseFloat($("#gst_rate_" + row).val());
                    var gstPerRate = totalGST / 100;
                    var gstRate = parseFloat($("#rate_value_" + row).val()) * parseFloat(gstPerRate);
                    var netRate = parseFloat($("#rate_value_" + row).val()) + gstRate;
                    $("#net_rate_value_" + row).val(parseFloat(netRate).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(netRate).toFixed(2));
                    var total1 = Number($("#net_rate_" + row).val()) * qty;
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else if ($("#ptype_" + row).val() == 'Kgs') {
            if ($("#kgsData_" + row).val()) {
                // var ttlkg = $("#ttlkg").val();
                // $("#ttlkg").val(parseFloat(ttlkg) + parseFloat($("#kgsData_" + row).val()));
                var qty = $("#kgsData_" + row).val();
                var total = Number($("#rate_value_" + row).val() * qty);
                if ($("#rate_value_" + row).val()) {
                    var totalGST = parseFloat($("#gst_rate_" + row).val());
                    var gstPerRate = totalGST / 100;
                    var gstRate = parseFloat($("#rate_value_" + row).val()) * parseFloat(gstPerRate);
                    var netRate = parseFloat($("#rate_value_" + row).val()) + gstRate;
                    $("#net_rate_value_" + row).val(parseFloat(netRate).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(netRate).toFixed(2));
                    var total1 = Number($("#net_rate_" + row).val() * qty);
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#kgs_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else {
            if ($("#kgsData_" + row).val()) {
                var qty = $("#kgsData_" + row).val() * $("#qty_" + row).val();
                var total = Number($("#rate_value_" + row).val()) * qty;
                if ($("#rate_value_" + row).val()) {
                    var totalGST = parseFloat($("#gst_rate_" + row).val());
                    var gstPerRate = totalGST / 100;
                    var gstRate = parseFloat($("#rate_value_" + row).val()) * parseFloat(gstPerRate);
                    var netRate = parseFloat($("#rate_value_" + row).val()) + gstRate;
                    $("#net_rate_value_" + row).val(parseFloat(netRate).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(netRate).toFixed(2));
                    var total1 = Number($("#net_rate_" + row).val()) * qty;
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#kgs_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        }

        total = (total).toFixed(2);
        $("#amount_" + row).val(total);
        $("#amount_value_" + row).val(total);
        total1 = (total1).toFixed(2);
        $("#net_Amount" + row).val(total1);
        subAmount();

    } else {
        alert('no row !! please refresh the page');
    }
}

function getFullNetTotal(row = null) {
    if (row) {
        if ($("#net_rate_value_" + row).val()) {
            var totalGST = parseFloat($("#gst_rate_" + row).val());
            var netRateData = $("#net_rate_value_" + row).val();
            var withoutGst = (Number(netRateData) * Number(100)) / (Number(100) + Number(totalGST));
            $("#rate_" + row).val(parseFloat(withoutGst).toFixed(2));
            $("#rate_value_" + row).val(parseFloat(withoutGst).toFixed(2));
        } else {
            $("#rate_" + row).val(parseFloat(0).toFixed(2));
            $("#rate_value_" + row).val(parseFloat(0).toFixed(2));
        }
        getFullNetTotalCalc(row);

    } else {
        alert('no row !! please refresh the page');
    }
}

function getFullNetTotalCalc(row = null) {
    if (row) {
        var sgst = 0;
        var cgst = 0;
        if ($("#ptype_" + row).val() == 'SquareMeter') {
            if ($("#sbit1_" + row).val() && $("#sbit2_" + row).val()) {
                var squarBit = $("#sbit1_" + row).val() * $("#sbit2_" + row).val();
                var tSq = ((squarBit * 0.305) * 1.06);
                $("#sbit3_" + row).val(tSq.toFixed(3));
                var qty = $("#qty_" + row).val() * (tSq);
                var total = Number($("#rate_value_" + row).val()) * qty;
                var total1 = Number($("#net_rate_" + row).val()) * qty;

            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else if ($("#ptype_" + row).val() == 'SquareFeet') {
            if ($("#sbit1_" + row).val() && $("#sbit2_" + row).val()) {
                var squarBit = $("#sbit1_" + row).val() * $("#sbit2_" + row).val();
                var tSq = (squarBit);
                $("#sbit3_" + row).val(tSq.toFixed(3));
                var qty = $("#qty_" + row).val() * (tSq);
                var total = Number($("#rate_value_" + row).val()) * qty;
                var total1 = Number($("#net_rate_" + row).val()) * qty;
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else if ($("#ptype_" + row).val() == 'Kgs') {
            if ($("#kgsData_" + row).val()) {
                var qty = $("#kgsData_" + row).val();
                var total = Number($("#rate_value_" + row).val()) * qty;
                var total1 = Number($("#net_rate_" + row).val()) * qty;
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#kgs_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else {
            if ($("#kgsData_" + row).val()) {
                var qty = $("#kgsData_" + row).val() * $("#qty_" + row).val();
                var total = Number($("#rate_value_" + row).val()) * qty;
                var total1 = Number($("#net_rate_" + row).val()) * qty;
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#kgs_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        }

        total = (total).toFixed(2);
        $("#amount_" + row).val(total);
        $("#amount_value_" + row).val(total);
        total1 = (total1).toFixed(2);
        $("#net_Amount" + row).val(total1);
        subAmount();

    } else {
        alert('no row !! please refresh the page');
    }
}


// get the product information from the server
function getProductData(row_id) {
    var product_id = $("#product_" + row_id).val();
    if (product_id == "") {
        $("#rate_" + row_id).val("");
        $("#rate_value_" + row_id).val("");

        $("#qty_" + row_id).val("");
        $("#sgst_" + row_id).val("");
        $("#cgst_" + row_id).val("");
        $("#amount_" + row_id).val("");
        $("#amount_value_" + row_id).val("");
        // $("#ptype_"+row_id).val("");
    } else {
        $.ajax({
            url: base_url + 'Controller_Orders/getProductValueById',
            type: 'post',
            data: { product_id: product_id },
            dataType: 'json',
            success: function(response) {
                    // setting the rate value into the rate input field

                    // $("#rate_"+row_id).val(response.price);
                    // $("#rate_value_"+row_id).val(response.price);
                    $("#net_rate_" + row_id).val(response.price);
                    $("#net_rate_value_" + row_id).val(response.price);
                    $("#sgst_" + row_id).val(response.sgst_tax);
                    $("#cgst_" + row_id).val(response.cgst_tax);
                    $("#ptype_" + row_id).val(response.product_type);
                    $("#sgst_value_" + row_id).val(response.sgst_tax);
                    $("#cgst_value_" + row_id).val(response.cgst_tax);
                    var totalGST = parseFloat(response.sgst_tax) + parseFloat(response.cgst_tax);
                    $("#qty_" + row_id).val(1);
                    $("#qty_value_" + row_id).val(1);
                    $("#gst_rate_" + row_id).val(totalGST);
                    // $("#prodDetailquo_" + row_id).val(response.name);
                    var gstPerRate = totalGST / 100;
                    var gstRate = parseFloat(response.price) * parseFloat(gstPerRate);
                    var netRate = parseFloat(response.price) - gstRate;

                    var totalGST = parseFloat($("#gst_rate_" + row_id).val());
                    var netRateData = $("#net_rate_value_" + row_id).val();
                    var withoutGst = (Number(netRateData) * Number(100)) / (Number(100) + Number(totalGST));
                    $("#rate_" + row_id).val(parseFloat(withoutGst).toFixed(2));
                    $("#rate_value_" + row_id).val(parseFloat(withoutGst).toFixed(2));
                    // $("#ptype_"+row_id).val(response.product_type);
                    var total = Number(netRate) * 1;

                    $("#amount_" + row_id).val(parseFloat(total).toFixed(2));
                    $("#amount_value_" + row_id).val(parseFloat(total).toFixed(2));
                    var prodData = '';
                    var prodDataQuo = '';
                    if (response.product_type == "SquareFeet") {
                        $('#sqm_' + row_id).show();
                        $('#kgs_' + row_id).hide();
                        prodData = response.inv_sqf + ' sqf';
                        prodDataQuo = response.quo_sqf + ' sqf';
                    } else if (response.product_type == "SquareMeter") {
                        $('#sqm_' + row_id).show();
                        $('#kgs_' + row_id).hide();
                        prodData = response.inv_sqm + ' sqm';
                        prodDataQuo = response.quo_sqm + ' sqm';
                    } else {
                        $('#sqm_' + row_id).hide();
                        $('#kgs_' + row_id).show();
                        prodData = response.inv_kgs + ' kgs';
                        prodDataQuo = response.quo_kgs + ' kgs';
                    }
                    $("#prodDetailin_" + row_id).html(response.name + '<br><b>HSN - </b>' + response.hsn);
                    $("#prodDetailquo_" + row_id).html(response.name);
                    addRow();
                    productFullTotal(row_id);

                } // /success
        }); // /ajax function to fetch the product data 
    }
}

function getPaidAmount() {
    var allTotal = 0;
    if ($.isNumeric($('#cash_amount').val())) {
        allTotal = parseFloat(allTotal) + parseFloat($('#cash_amount').val());
    }
    if ($.isNumeric($('#cheque_amount').val())) {
        allTotal = parseFloat(allTotal) + parseFloat($('#cheque_amount').val());
    }
    if ($.isNumeric($('#online_amount').val())) {
        allTotal = parseFloat(allTotal) + parseFloat($('#online_amount').val());
    }
    $('#paid_amount').val(allTotal);
    var paid = $('#paid_amount').val();
    if (paid) {
        var netamount = $('#total_amount_value').val();
        var totalAmtValue = parseFloat($('#net_amount_value').val());
        var due = parseFloat(netamount) - parseFloat(paid);
        var tdue = parseFloat(totalAmtValue) - parseFloat(paid);
        $('#due_amount').val(due.toFixed(2));
        $('#due_amount_value').val(due.toFixed(2));
        if (tdue >= 0) {
            $('#todaybalance').val(tdue.toFixed(2));
        } else {
            $('#todaybalance').val('No Due');
        }


    } else {
        $('#due_amount').val('');
        $('#due_amount_value').val('');
        $('#todaybalance').val('');
    }
}

function productFullTotal(row = null) {
    if (row) {
        var sgst = 0;
        var cgst = 0;
        if ($("#ptype_" + row).val() == 'SquareMeter') {
            if ($("#sbit1_" + row).val() && $("#sbit2_" + row).val()) {
                var squarBit = $("#sbit1_" + row).val() * $("#sbit2_" + row).val();
                var tSq = ((squarBit * 0.305));
                $("#sbit3_" + row).val(tSq.toFixed(3));
                var qty = $("#qty_" + row).val() * (tSq);
                var total = Number($("#rate_value_" + row).val()) * qty;
                if ($("#rate_value_" + row).val()) {
                    var total1 = Number($("#net_rate_" + row).val()) * qty;
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }

            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else if ($("#ptype_" + row).val() == 'SquareFeet') {
            if ($("#sbit1_" + row).val() && $("#sbit2_" + row).val()) {
                var squarBit = $("#sbit1_" + row).val() * $("#sbit2_" + row).val();
                var tSq = (squarBit);
                $("#sbit3_" + row).val(tSq.toFixed(3));
                var qty = $("#qty_" + row).val() * (tSq);
                var total = Number($("#rate_value_" + row).val()) * qty;
                if ($("#rate_value_" + row).val()) {

                    var total1 = Number($("#net_rate_" + row).val()) * qty;
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#qty_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else if ($("#ptype_" + row).val() == 'Kgs') {
            if ($("#kgsData_" + row).val()) {
                // var ttlkg = $("#ttlkg").val();
                // $("#ttlkg").val(parseFloat(ttlkg) + parseFloat($("#kgsData_" + row).val()));
                var qty = $("#kgsData_" + row).val();
                var total = Number($("#rate_value_" + row).val() * qty);
                if ($("#rate_value_" + row).val()) {

                    var total1 = Number($("#net_rate_" + row).val() * qty);
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#kgs_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        } else {
            if ($("#kgsData_" + row).val()) {
                var qty = $("#kgsData_" + row).val() * $("#qty_" + row).val();
                var total = Number($("#rate_value_" + row).val()) * qty;
                if ($("#rate_value_" + row).val()) {

                    var total1 = Number($("#net_rate_" + row).val()) * qty;
                } else {
                    $("#net_rate_value_" + row).val(parseFloat(0).toFixed(2));
                    $("#net_rate_" + row).val(parseFloat(0).toFixed(2));
                }
            } else {
                var total = Number($("#rate_value_" + row).val()) * Number($("#kgs_" + row).val());
                var total1 = Number($("#net_rate_" + row).val()) * Number($("#qty_" + row).val());
            }
        }

        total = (total).toFixed(2);
        $("#amount_" + row).val(total);
        $("#amount_value_" + row).val(total);
        total1 = (total1).toFixed(2);
        $("#net_Amount" + row).val(total1);
        subAmount();

    } else {
        alert('no row !! please refresh the page');
    }
}


// calculate the total amount of the order
function subAmount() {
    hhhh();
    var extra = 0;
    if ($("#extra_amount").val()) {
        extra = $("#extra_amount").val();
    }
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var totalNetAmount = 0;
    var totalGstSubAmount = 0;
    var kgsss = 0;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#product_info_table tbody tr")[x];
        var count = $(tr).attr('id');
        count = count.substring(4);
        // totalGstSubAmount = Number
        totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
        totalNetAmount = Number(totalNetAmount) + Number($("#net_Amount" + count).val());
        if ($("#ptype_" + count).val() == 'Kgs') {
            kgsss = Number(kgsss) + Number($("#kgsData_" + count).val());
        }


    } // /for
    $("#ttlkg").val(kgsss);
    totalSubAmount = totalSubAmount.toFixed(2);
    totalNetAmount = totalNetAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat

    var totalAmount = (Number(totalSubAmount));
    totalAmount = totalAmount.toFixed(2);
    if (totalNetAmount) {
        var gstData = Number(totalNetAmount) - Number(totalSubAmount);
        var eachGst = Number(gstData) / 2;
        $('#sgst_amount').val(eachGst.toFixed(2));
        $('#cgst_amount').val(eachGst.toFixed(2));
        totalAmount = Number(totalAmount) + Number(gstData);

    }
    totalAmount = Number(totalAmount) + Number(extra);
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var discount = $("#discount").val();
    var extra_gst = $("#extra_gst").val();

    if (extra_gst) {
        var eachGst = Number(totalSubAmount) * (Number(extra_gst) / 100);
        $('#extra_gst_amount').val(eachGst.toFixed(2));
        totalAmount = Number(totalAmount) + Number(eachGst);
        totalAmount = totalAmount.toFixed(2);
    } else {
        $('#extra_gst_amount').val(0);
    }
    if (discount) {
        var grandTotal = Number(totalAmount) - Number(discount);
        grandTotal = grandTotal.toFixed(2);
        $("#net_amount").val(grandTotal);
        $("#net_amount_value").val(grandTotal);
    } else {
        $("#net_amount").val(totalAmount);
        $("#net_amount_value").val(totalAmount);

    } // /else discount 
    var balance = $("#net_balance_amount").val();
    if (balance) {
        var totalAmount1 = $("#net_amount").val();
        var grandTotal1 = Number(totalAmount1) + Number(balance);
        grandTotal1 = grandTotal1.toFixed(2);
        $("#total_amount").val(grandTotal1);
        $("#total_amount_value").val(grandTotal1);
    }
    getPaidAmount();
    serialNumber();
} // /sub total amount

function removeRow(tr_id) {
    $("#product_info_table tbody tr#row_" + tr_id).remove();
    subAmount();
}
setTimeout(() => {
    var data = $('#gstData').val();
    if (data == '0') {
        $('.with').show();
        $('.without').hide();
    } else {
        $('.with').hide();
        $('.without').show();
    }
}, 2000);

function serialNumber() {
    var tableProductLength = $("#product_info_table tbody tr").length;
    for (x = 0; x < tableProductLength; x++) {
        var tr = $("#product_info_table tbody tr")[x];
        var count = $(tr).attr('id').match(/\d+/);
        $('#sno_' + count).html(parseInt(x) + 1);

    }
}