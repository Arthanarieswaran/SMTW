
<div class="main-content">
<style>
.ui_input_label label{
  margin-top: 8px !important;
}
.ui_input_label input{
  height: 36px !important;
}
.ui_input_label input[type="text"]:disabled{
  height: 36px !important;
}
</style>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                    <?php echo lang('edit_purchase'); ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('quotation'); ?> <?php echo lang('purchase'); ?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
      <div class="col-md-12 col-xs-12">

        <div id="messages"></div>

        <?php if($this->session->flashdata('success')): ?>
          <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php elseif($this->session->flashdata('error')): ?>
          <div class="alert alert-error alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <?php echo $this->session->flashdata('error'); ?>
          </div>
        <?php endif; ?>
        </div>
        </div>
        <div class="row">
        <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <form role="form" action="<?php base_url('Controller_Purchase/create') ?>" method="post" class="form-horizontal">
          <div class="box-body">

<?php echo validation_errors(); ?>

<div class="col-md-12 col-xs-12 pull pull-left">
  <div class="form-group d-flex">
   
    <div class="col-sm-4">
    <label for="gross_amount" class="control-label" style="text-align:left;"><?php echo lang('vendor'); ?></label>
    <input type="hidden" id="vendor" name="vendor" value="<?php echo $order_data['order']['vendor_id'] ?>">
      <select class="form-control select_group vendor" onchange="getCustomerDetails(this.value)" id="vendors" name="vendors" required disabled>
            <option value=""></option>
            <?php foreach ($vendors as $m => $n): ?>
              <option value="<?php echo $n['id'] ?>" <?php if($order_data['order']['vendor_id'] == $n['id']) { echo "selected='selected'"; } ?>  ><?php echo $n['name'].' - '.$n['mobile'].' - '.$n['address1']  ?></option>
            <?php endforeach ?>
          </select>
    </div>
    <div class="col-sm-4 col-md-4">
    <label for="gross_amount" class="control-label" style="text-align:left;"><?php echo lang('mobile'); ?></label>
    <input type="text" id="vendor_mobile" class="form-control" value="<?php echo $singlevendor[0]['mobile'] ?>" disabled>
    </div>
    <div class="col-sm-4 col-md-4">
    <label for="gross_amount" class="control-label" style="text-align:left;"><?php echo lang('address'); ?></label>
    <input type="text" id="vendor_address" class="form-control" value="<?php echo $singlevendor[0]['address1'].','.$singlevendor[0]['address2'].','.$singlevendor[0]['taluk']?>" disabled>
    </div>
    </div>
    <div class="form-group d-flex">
    <div class="col-sm-4 col-md-3">
    <label for="gross_amount" class="control-label" style="text-align:left;"><?php echo lang('bill_no'); ?></label>
    <input type="text" class="form-control" id="bill_no" name="bill_no" value="<?php echo $order_data['order']['bill_no']?>" required>
    </div>
    <div class="col-sm-4 col-md-3">
    <label for="gross_amount" class="control-label" style="text-align:left;"><?php echo lang('date'); ?></label>
    <input type="text" class="form-control" id="due_date" name="due_date" required value="<?php echo $order_data['order']['invoice_date']?>"  autocomplete="off">
    </div>
    <div class="col-sm-4 col-md-3">
    <label for="gross_amount" class="control-label" style="text-align:left;"><?php echo lang('gst_no'); ?></label>
    <input type="text" class="form-control" id="gst_no" name="gst_no" value="<?php echo $singlevendor[0]['gst_no']?>" disabled>
    </div>
    <div class="col-sm-4 col-md-3">
    <label for="gross_amount" class="control-label" style="text-align:left;"><?php echo lang('balance'); ?></label>
    <input type="text" class="form-control" id="v_bal" name="v_bal" value="<?php echo $order_data['order']['old_balance']?>" readonly>
    </div>
    </div>
  </div>

</div>


<br /> <br/>
<table class="table table-bordered" id="product_info_table">
  <thead>
  <tr>
      <th style="width:20%"><?php echo lang('product'); ?></th>
      <th style="width:10%"><?php echo lang('type'); ?></th>
      <th style="width:25%"><?php echo lang('square_bit'); ?></th>
      <th style="width:10%"><?php echo lang('qty'); ?></th>
      <th style="width:10%"><?php echo lang('rate'); ?></th>
      <th style="width:20%"><?php echo lang('amount'); ?></th>
      <th style="width:15%"><button type="button" id="add_row" onclick="addRow()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></th>
    </tr>
  </thead>

   <tbody>

    <?php if(isset($order_data['order_item'])): ?>
      <?php $x = 1; ?>
      <?php foreach ($order_data['order_item'] as $key => $val): ?>
        <?php //print_r($v); ?>
       <tr id="row_<?php echo $x; ?>">
         <td>
          <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)" required>
              <option value=""></option>
              <?php foreach ($products as $k => $v): ?>
                <option value="<?php echo $v['id'] ?>" <?php if($val['product_id'] == $v['id']) { echo "selected='selected'"; } ?>><?php echo $v['hsn'].'-'.$v['name'].'-'.$v['product_type'] ?></option>
              <?php endforeach ?>
            </select>
          </td>

        <td><input type="text" name="type[]" style="padding:0;" id="type_<?php echo $x; ?>" value="<?php echo $val['product_type'] ?>" class="form-control" required readonly ></td>
        <?php if($val['product_type'] == 'SquareMeter' || $val['product_type'] == 'SquareFeet'): ?>
        <td style="display:flex;" id="sqm_<?php echo $x; ?>" >
        <input type="text" name="sbit1[]" id="sbit1_<?php echo $x; ?>" value="<?php echo $val['square_bit_1'] ?>" class="form-control"  onblur="getFullTotal(<?php echo $x; ?>)" style="padding: 0;"> 
        <b style="padding: 6px 13px 0 9px;">*</b>
        <input type="text" name="sbit2[]" id="sbit2_<?php echo $x; ?>" class="form-control" style="padding: 0;"  onblur="getFullTotal(<?php echo $x; ?>)" value="<?php echo $val['square_bit_2'] ?>" >
        <b style="padding: 6px 13px 0 9px;">=</b> <input type="text" style="padding: 0;" name="sbit3[]" id="sbit3_<?php echo $x; ?>" class="form-control"  readonly value="<?php  if($val['product_type'] == 'SquareFeet'){ $sf = (($val['square_bit_1']*$val['square_bit_2'])); echo number_format($sf, 3, '.', ''); }else{ $sf = ((($val['square_bit_1']*$val['square_bit_2'])*0.305)*1.06); echo number_format($sf, 3, '.', '');}?>">
        <input type="hidden" name="kgs[]" id="kgsData_<?php echo $x; ?>" class="form-control" value="0">
        </td>
        <?php else:  ?>
        <td style="<?php if($val['product_type'] == 'Kgs' || $val['product_type'] == 'Piece'): ?> display:block; <?php else:  ?> display:none;<?php endif ?>" id="kgs_<?php echo $x; ?>">
        <input type="text" name="kgs[]" id="kgsData_<?php echo $x; ?>" class="form-control" onblur="getFullTotal(<?php echo $x; ?>)" value="<?php echo $val['kgs_value'] ?>">
        <input type="hidden" name="sbit1[]" id="sbit1_<?php echo $x; ?>" class="form-control"> 
        <input type="hidden" name="sbit2[]" id="sbit2_<?php echo $x; ?>" class="form-control"> 
        </td>
        <?php endif ?>


          <td><input type="text" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" required onkeyup="getFullRate(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
          <td>
            <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control" onkeyup="getFullRate(<?php echo $x; ?>)" value="<?php echo $val['rate'] ?>" autocomplete="off">
            <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['rate'] ?>" autocomplete="off">
          </td>
          <td>
            <input type="text" name="amount[]" id="amount_<?php echo $x; ?>" class="form-control" disabled value="<?php echo $val['amount'] ?>" autocomplete="off">
            <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['amount'] ?>" autocomplete="off">
          </td>
          <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
       </tr>
       <?php $x++; ?>
     <?php endforeach; ?>
   <?php endif; ?>
   </tbody>
</table>

<div class="col-md-6 col-xs-12 pull pull-right ui_input_label">

  <div class="form-group d-flex">
    <label for="gross_amount" class="col-sm-5 control-label"><?php echo lang('gross_amount'); ?></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $order_data['order']['total_amount'] ?>" autocomplete="off">
      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['total_amount'] ?>" autocomplete="off">
    </div>
  </div>
  <?php if($is_service_enabled == true): ?>
  <div class="form-group d-flex">
    <label for="service_charge" class="col-sm-5 control-label"><?php echo lang('cgst'); ?> <?php echo $company_data['service_charge_value'] ?> %</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="service_charge" name="service_charge" disabled value="<?php echo $order_data['order']['cgst_amount'] ?>" autocomplete="off">
      <input type="hidden" class="form-control" id="service_charge_value" name="service_charge_value" value="<?php echo $order_data['order']['cgst_amount'] ?>" autocomplete="off">
    </div>
  </div>
  <?php endif; ?>
  <?php if($is_vat_enabled == true): ?>
  <div class="form-group d-flex">
    <label for="vat_charge" class="col-sm-5 control-label"> <?php echo lang('sgst'); ?><?php echo $company_data['vat_charge_value'] ?> %</label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="vat_charge" name="vat_charge" disabled value="<?php echo $order_data['order']['sgst_amount'] ?>" autocomplete="off">
      <input type="hidden" class="form-control" id="vat_charge_value" name="vat_charge_value" value="<?php echo $order_data['order']['sgst_amount'] ?>" autocomplete="off">
    </div>
  </div>
  <?php endif; ?>
  <div class="form-group  d-flex">
    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('extra_amount'); ?></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="extra_amount" name="extra_amount" onkeyup="subAmount()" value="<?php echo $order_data['order']['extra_amount'] ?>" autocomplete="off">
    </div>
  </div>
  <div class="form-group  d-flex">
    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('discount'); ?></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="discount" name="discount" onkeyup="subAmount()" value="<?php echo $order_data['order']['discount'] ?>"  autocomplete="off">
    </div>
  </div>
  <div class="form-group d-flex">
    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('total_amount'); ?></label>
    <div class="col-sm-7">
      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" value="<?php echo $order_data['order']['net_amount'] ?>" autocomplete="off">
    </div>
  </div>
  </div>

  <div class="col-md-6 col-xs-12 pull pull-left ui_input_label" >
                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-3 control-label"><?php echo lang('paid_amount'); ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="paid_amount" name="paid_amount" value="<?php echo $order_data['order']['paid_amount'] ?>" onkeyup="getPaidAmount()" autocomplete="off" required>
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-3 control-label"><?php echo lang('due_amount'); ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="due_amount" name="due_amount" disabled autocomplete="off" value="<?php echo $order_data['order']['due_amount'] ?>">
                      <input type="hidden" class="form-control" id="due_amount_value" name="due_amount_value" autocomplete="off" value="<?php echo $order_data['order']['due_amount'] ?>">
                    </div>
                  </div>
                  </div>

  </div>
<!-- /.box-body -->
              <!-- /.box-body -->

              <div class="box-footer" style="padding: 0 0 20px 17px;">

                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">

                <button type="submit" class="btn btn-primary"><?php echo lang('save_changes'); ?></button>
                <a href="<?php echo base_url('Controller_Purchase/') ?>" class="btn btn-warning"><?php echo lang('back'); ?></a>
                <a href="<?php echo base_url('Controller_Purchase/create') ?>" class="btn btn-primary"><?php echo lang('new_purchase'); ?></a>
              </div>
            </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>

<script>
var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainPurchaseNav").addClass('active');
    $("#managePurchaseNav").addClass('active');
    
    
    // Add new row in the table 

  }); // /document


  $(document).on('focus', '.select2.select2-container', function (e) {
  
  var isOriginalEvent = e.originalEvent // don't re-open on closing focus event
  var isSingleSelect = $(this).find(".select2-selection--single").length > 0 // multi-select will pass focus to input

  if (isOriginalEvent && isSingleSelect) {
    $(this).siblings('select:enabled').select2('open');
  } 

});

  function addRow(){
  var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
      if($('#product_'+count_table_tbody_tr).val()){
      $.ajax({
          url: base_url + '/Controller_Purchase/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
              var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product" onchange="getProductData('+row_id+')" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.hsn+'-'+value.name+'-'+value.product_type+'</option>';             
                        });
                        
                      html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="type[]" style="padding:0;" id="type_'+row_id+'" class="form-control" required readonly ></td>'+
                    '<td style="display: flex;" id="sqm_'+row_id+'"><input type="text" name="sbit1[]" id="sbit1_'+row_id+'" class="form-control" required onblur="getFullTotal('+row_id+')" value="1" style="padding: 0;"> <b style="padding: 6px 13px 0 9px;">*</b><input type="text" name="sbit2[]" id="sbit2_'+row_id+'" class="form-control" style="padding: 0;" required onblur="getFullTotal('+row_id+')" value="1" >'+
                    '<b style="padding: 6px 13px 0 9px;">=</b> <input type="text" style="padding: 0;" name="sbit3[]" id="sbit3_'+row_id+'" class="form-control" required readonly value="1">'+
                    '</td>'+
                    '<td id="kgs_'+row_id+'"><input value="1" type="text" name="kgs[]" onblur="getFullTotal('+row_id+')" id="kgsData_'+row_id+'" class="form-control" required ></td>'+
                    '<td><input type="text" name="qty[]"  id="qty_'+row_id+'" onkeyup="getFullRate('+row_id+')" class="form-control" onkeyup="getFullTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]"  id="rate_'+row_id+'" onkeyup="getFullRate('+row_id+')"  class="form-control"><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';
                       
                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();
              $('#kgs_'+row_id).hide();
          }
        });
      }else{
        return false;
      }
      return false;
}
function getFullRate(rowId){
    var rate = $('#rate_'+rowId).val();
    $('#rate_value_'+rowId).val(rate);
    getFullTotal(rowId);
  }

  function getCustomerDetails(customerId) {
      $.ajax({
        url: base_url + 'Controller_Vendor/getVendorDetailsSingle',
        type: 'post',
        data: {id : customerId},
        dataType: 'json',
        success:function(response) {
          if(response.length > 0 ){
            $('#vendor_mobile').val(response[0][0].mobile);
            $('#vendor_address').val(response[0][0].address1+','+response[0][0].address1+','+response[0][0].taluk);
            $('#gst_no').val(response[0][0].gst_no);
            var balance = (parseFloat(response[1][0].net_amount) + parseFloat(response[1][0].due_amount)) - parseFloat(response[1][0].paid_amount);
            $('#v_bal').val(balance.toFixed(2));
          }else{
            $('#vendor_mobile').val();
            $('#vendor_address').val();
            $('#vendor_gst_no').val();
            $('#v_bal').val(0);
          }
        } // /success
      });
  }

  function getFullTotal(row = null) {
    if(row) {
      var sgst = 0;
      var cgst = 0;
      if($("#type_"+row).val() == 'SquareMeter'){
        if($("#sbit1_"+row).val() && $("#sbit2_"+row).val()){
        var squarBit = $("#sbit1_"+row).val() * $("#sbit2_"+row).val();
        
        var tSq = (squarBit * 0.305);
        $("#sbit3_"+row).val(tSq.toFixed(3));
        var qty = $("#qty_"+row).val() * (tSq);
        var total = Number($("#rate_value_"+row).val()) * qty;
        
      } else{
        var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
        
      }
      }else if($("#type_"+row).val() == 'Kgs'){
        if($("#kgsData_"+row).val() ){
        var qty = $("#kgsData_"+row).val();
        var total = Number($("#rate_value_"+row).val()) * qty;
        
      } else{
        var total = Number($("#rate_value_"+row).val()) * Number($("#kgs_"+row).val());
        
      }
      }else if($("#type_"+row).val() == 'SquareFeet'){
        if($("#sbit1_"+row).val() && $("#sbit2_"+row).val()){
        var squarBit = $("#sbit1_"+row).val() * $("#sbit2_"+row).val();
        
        var tSq = (squarBit);
        $("#sbit3_"+row).val(tSq.toFixed(3));
        var qty = $("#qty_"+row).val() * (tSq);
        var total = Number($("#rate_value_"+row).val()) * qty;
        
      } else{
        var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
        
      }
      }else{var total = Number($("#rate_value_"+row).val()) * Number($("#qty_"+row).val());
      }
      
      total = (total).toFixed(2);
      $("#amount_"+row).val(total);
      $("#amount_value_"+row).val(total);
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }
  // get the product information from the server
 
    function getProductData(row_id)
  {
    var product_id = $("#product_"+row_id).val();    
    if(product_id == "") {
      // $("#ptype_"+row_id).val("");
    } else {
      $.ajax({
        url: base_url + 'Controller_Invoice/getProductValueById',
        type: 'post',
        data: {product_id : product_id},
        dataType: 'json',
        success:function(response) {
          // setting the rate value into the rate input field
          $("#type_"+row_id).val(response.product_type);
          if(response.product_type == "SquareFeet"){
            $('#sqm_'+row_id).show();
            $('#kgs_'+row_id).hide();
          }else if(response.product_type == "SquareMeter"){
            $('#sqm_'+row_id).show();
            $('#kgs_'+row_id).hide();
          }else{
            $('#sqm_'+row_id).hide();
            $('#kgs_'+row_id).show();
          }
          addRow();
        }
         // /success
      }); // /ajax function to fetch the product data 
    }
  }
  
 // calculate the total amount of the order
 function subAmount() {
    var service_charge = <?php echo ($company_data['service_charge_value'] > 0) ? $company_data['service_charge_value']:0; ?>;
    var vat_charge = <?php echo ($company_data['vat_charge_value'] > 0) ? $company_data['vat_charge_value']:0; ?>;

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

    // sub total
    $("#gross_amount").val(totalSubAmount);
    $("#gross_amount_value").val(totalSubAmount);

    // vat
    var vat = (Number($("#gross_amount").val())/100) * vat_charge;
    vat = vat.toFixed(2);
    $("#vat_charge").val(vat);
    $("#vat_charge_value").val(vat);

    // service
    var service = (Number($("#gross_amount").val())/100) * service_charge;
    service = service.toFixed(2);
    $("#service_charge").val(service);
    $("#service_charge_value").val(service);
    
    // total amount
    var totalAmount = (Number(totalSubAmount) + Number(vat) + Number(service));
    totalAmount = totalAmount.toFixed(2);
    // $("#net_amount").val(totalAmount);
    // $("#totalAmountValue").val(totalAmount);

    var extra = $("#extra_amount").val();
    if(extra) {
      var grandTotal1 = Number(totalAmount) + Number(extra);
      $("#net_amount").val(grandTotal1.toFixed(2));
      $("#net_amount_value").val(grandTotal1.toFixed(2));
    } else{
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
    }
    var discount = $("#discount").val();
    if(discount) {
      var grandTotal1 = Number($("#net_amount").val()) - Number(discount);
      $("#net_amount").val(grandTotal1.toFixed(2));
      $("#net_amount_value").val(grandTotal1.toFixed(2));
    } else{
      $("#net_amount").val(totalAmount);
      $("#net_amount_value").val(totalAmount);
    }
    getPaidAmount();
  } // /sub total amount

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }

  function getPaidAmount(){
    var paid = $('#paid_amount').val();
    if(paid){
    var netamount = $('#net_amount_value').val();
    
      var due = parseFloat(netamount) - parseFloat(paid);
      $('#due_amount').val(due.toFixed(2));
      $('#due_amount_value').val(due.toFixed(2));
    }else{
      $('#due_amount').val('');
      $('#due_amount_value').val('');
    }
  }
</script>