<style>
.ui_radio_hd{
  margin-top : 6px;
}
.ui_radio{
  margin-bottom : 2px !important;
}
.form-control{
  height: 29px !important;
}
.select2-container {
  position: relative;
  z-index: 2;
  float: left;
  width: 100%;
  margin-bottom: 0;
  display: table;
  table-layout: fixed;
}
.productss{
  margin-bottom: 0 !important;
  font-size: 12px;
}
</style>
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                    <?php echo lang('add_new_quotation'); ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('quotation'); ?></li>
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
                                    <form role="form" action="<?php base_url('Controller_Orders/create') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

               
                
                <div class="col-md-12 col-xs-12 pull pull-left d-flex">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="gross_amount" class="ontrol-label" style="text-align:left;"><b><?php echo lang('customer'); ?></b>
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addModal" style="height: 17px; padding: 1px 6px 16px 6px;"><i class="fa fa-plus"></i></button>
                    </label>
                   
                      <select class="form-control select_group customer" onchange="getCustomerDetails(this.value)" id="customer" name="customer" required>
                            <option value=""></option>
                            <?php foreach ($customers as $m => $n): ?>
                              <option value="<?php echo $n['id'] ?>"><?php echo $n['name'].' - '.$n['mobile'].' - '.$n['address1']  ?></option>
                            <?php endforeach ?>
                          </select>
                    </div>
                    </div>
                    <div class="col-md-3">
                     <b> <?php echo lang('balance_amount'); ?> </b><br><span id="balanceDueAmount"></span>
                    </div>
                    <div class="col-md-2">
                     <b> Invoice Date </b><br> <input type="text" class="form-control" id="inv_date" name="inv_date" value="<?php echo date("d-m-Y") ?>" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-3">
                  <label for="gross_amount" style="float: right;" class=" control-label"><b><?php echo lang('date'); ?></b><br> <?php echo date('Y-m-d')?> <?php echo date('h:i a') ?></label>
                </div>

                </div>
                
                
                <br /> <br/>
                <table class="table table-bordered" id="product_info_table">
                  <thead>
                    <tr>
                    <th style="width:2%"><?php echo lang('v_n'); ?></th>
                      <th style="width:25%"><?php echo lang('product'); ?></th>
                      <th style="width:10%"><?php echo lang('type'); ?></th>
                      <th style="width:23%"><?php echo lang('square_bit'); ?></th>
                      <th style="width:10%"><?php echo lang('qty'); ?></th>
                      <th style="width:10%">Net Rate</th>
                      <th style="width:10%"><?php echo lang('rate'); ?></th>
                      <th style="width:30%"><?php echo lang('amount'); ?></th>
                      <th style="width:10%"><button type="button" id="add_row" onclick="addRow()" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>
                     <tr id="row_1">
                       <td id="sno_1">1</td>
                       <td width="20%">
                       <select class="form-control select_group product" data-row-id="row_1" id="product_1" name="product[]" style="width:100% !important;" onchange="getProductData(1)" required>
                            <option value=""></option>
                            <?php foreach ($products as $k => $v): ?>
                              <option value="<?php echo $v['id'] ?>"><?php echo $v['hsn'].'-'.$v['name'].'-'.$v['mrp'].'-'.$v['price'].'-'.$v['product_type'] ?></option>
                            <?php endforeach ?>
                          </select>
                          <p class="productss" id="prodDetailquo_1"></p>
                        </td>
                        <td>
                        <input type="text" name="pType[]" style="padding:0;" id="ptype_1" class="form-control" readonly/>
                        </td>

                        <td style="display: flex;" id="sqm_1"><input type="text" name="sbit1[]" id="sbit1_1" class="form-control" required onblur="getFullTotal(1)" value="1" style="padding: 0;"> <b style="padding: 6px 13px 0 9px;">*</b><input type="text" name="sbit2[]" id="sbit2_1" class="form-control" style="padding: 0;" required onblur="getFullTotal(1)" value="1" >
                        <b style="padding: 6px 13px 0 9px;">=</b> <input type="text" style="padding: 0;" name="sbit3[]" id="sbit3_1" class="form-control" required readonly value="1">
                        </td>
                        <td id="kgs_1"><input value="1" type="text" name="kgs[]" id="kgsData_1" class="form-control" onblur="getFullTotal(1)" required ></td>

                        <td><input type="text" name="qty[]" id="qty_1" class="form-control" required onkeyup="getTotal(1)"></td>
                        <td>
                          <input type="hidden" id="gst_rate_1" name="gst_rate[]">
                          <input type="text" name="net_rate[]" id="net_rate_1" class="form-control" onblur="getFullNetRate(1)" autocomplete="off">
                          <input type="hidden" name="net_rate_value[]" id="net_rate_value_1" class="form-control"  autocomplete="off">
                        </td>
                        <td>
                          <input type="text" name="rate[]" id="rate_1" class="form-control" onkeyup="getFullRate(1)" autocomplete="off">
                          <input type="hidden" name="rate_value[]" id="rate_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td>
                          <input type="text" id="net_Amount1" class="form-control with" name="net_Amount[]" readonly/>
                          <input type="text" name="amount[]" id="amount_1" class="form-control without" disabled autocomplete="off">
                          <input type="hidden" name="amount_value[]" id="amount_value_1" class="form-control" autocomplete="off">
                        </td>
                        <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('1')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   </tbody>
                </table>

                

                <div class="col-md-6 col-xs-12 pull pull-right">
                <div class="without" style="    margin-bottom: -7px;">
                  <div class="form-group d-flex">
                    <label for="gross_amount" class="col-sm-5 control-label"><?php echo lang('gross_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="sgst_amount" class="col-sm-5 control-label">SGST</label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="sgst_amount" name="sgst_amount" readonly autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="cgst_amount" class="col-sm-5 control-label">CGST</label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="cgst_amount" name="cgst_amount" readonly autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="cgst_amount" class="col-sm-5 control-label d-flex">Extra GST  <input type="text" style="margin-top: -5px;width: 22%; margin-left: 6px;" class="form-control" id="extra_gst" name="extra_gst" value = "0" autocomplete="off" onkeyup="subAmount()"> </label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -6px;" class="form-control" id="extra_gst_amount" name="extra_gst_amount" readonly autocomplete="off">
                    </div>
                  </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="discount" class="col-sm-5 control-label"><?php echo lang('discount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off">
                    </div>
                  </div>
                 <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('extra_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="extra_amount" name="extra_amount" onkeyup="subAmount()" value="0" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('total_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off">
                    </div>
                  </div>

                  <div class="form-group d-flex" id="net_balance">
                    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('balance_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="net_balance_amount" name="net_balance_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="net_balance_amount_value" name="net_balance_amount_value" autocomplete="off">
                    </div>
                  </div>
                  
                  <div class="form-group d-flex">
                    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('net_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="total_amount" name="total_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="total_amount_value" name="total_amount_value" autocomplete="off">
                    </div>
                  </div>

                  </div>
                  <div class="col-md-6 col-xs-12 pull pull-left">

                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('cash'); ?> <?php echo lang('amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="cash_amount" name="cash_amount" onkeyup="getPaidAmount()" autocomplete="off" value="0" required>
                    </div>
                  </div>

                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('cheque'); ?> <?php echo lang('amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="cheque_amount" name="cheque_amount" onkeyup="getPaidAmount()" autocomplete="off" value="0" required>
                    </div>
                  </div>

                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('online'); ?> <?php echo lang('amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="online_amount" name="online_amount" onkeyup="getPaidAmount()" autocomplete="off" value="0" required>
                    </div>
                  </div>
                  
                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('paid_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="paid_amount" name="paid_amount" onkeyup="getPaidAmount()" autocomplete="off" required readonly>
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('due_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="due_amount" name="due_amount" disabled autocomplete="off">
                      <input type="hidden" class="form-control" id="due_amount_value" name="due_amount_value" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-5 control-label">Today Balance</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="todaybalance" name="todaybalance" disabled autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('due_date'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="due_date" name="due_date" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group" style="display:none;">
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('payment_mode'); ?></label>
                    <div class="col-sm-7">
                    <div class="ui_radio_hd">
                    <input type="hidden" id="payment_method" name="payment_method" value="Cash">
                      <label><input type="checkbox" class="radio-inline ui_radio"  name="radios" value="Cash" checked><span class="outside"><span class="inside"></span></span> &nbsp;<?php echo lang('cash'); ?></label>&nbsp;&nbsp;
                      <label><input type="checkbox" class="radio-inline ui_radio"  name="radios" value="Cheque"><span class="outside"><span class="inside"></span></span> &nbsp;<?php echo lang('cheque'); ?></label>&nbsp;&nbsp;
                      <label><input type="checkbox" class="radio-inline ui_radio"  name="radios" value="Online"><span class="outside"><span class="inside"></span></span> &nbsp;<?php echo lang('online'); ?></label>
                    </div>
                    </div>
                  </div>
                  <div id="transactions">
                  <div class="form-group d-flex" >
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('description'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="transaction" name="transaction" autocomplete="off">
                    </div>
                  </div>
                  </div>

                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-3 control-label">GST</label>
                    <div class="col-sm-7" style="margin-top: -5px;">
                    <div class="ui_radio_hd">
                    <input type="hidden" id="gst_data" name="gst_data" value="0">
                      <label><input type="radio" class="radio-inline ui_radio" onclick="getGst(0)" name="gstCheck" value="0" checked><span class="outside"><span class="inside"></span></span> &nbsp;Without GST</label>&nbsp;&nbsp;
                      <label><input type="radio" class="radio-inline ui_radio" onclick="getGst(1)" name="gstCheck" value="1"><span class="outside"><span class="inside"></span></span> &nbsp;With GST</label>&nbsp;&nbsp;
                    </div>
                    </div>
                  </div>

                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-5 control-label">
                    Total KG
                    </label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="ttlkg" name="ttlkg" autocomplete="off" disabled value="0">
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.box-body -->
              <input type="hidden" id="customer_name" name="customer_name">
              <input type="hidden" id="gstData" name="gstData">
              <!-- <div class="" style="margin-left: 39px;">
              <input type="checkbox" id="gstCheck" class="form-check-input mr-2" onclick="getGst()" value="1"><?php echo lang('gst'); ?>
              </div> -->
              </div>
              <div class="box-footer col-md-12" style="margin-bottom: 7px; text-align: center;">
                <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
                <button type="submit" class="btn btn-primary"><?php echo lang('create_order'); ?></button>
                <a href="<?php echo base_url('Controller_Orders/') ?>" class="btn btn-warning"><?php echo lang('back'); ?></a>
              </div>
            </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="staticBackdropLabel"><?php echo lang('add_customer'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>

      <form role="form" action="<?php echo base_url('Controller_Customer/quotation') ?>" method="post" id="createForm">

        <div class="modal-body" style="padding : 0 !important;">
        <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name"> <?php echo lang('name'); ?></label>
            <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter name" autocomplete="off" required>
          </div>

          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('mobile_number'); ?></label>
            <input type="text" class="form-control" id="mobile" name="mobile" onkeyup="getMobileDuplicate(this.value)" placeholder="Enter Mobile Number" autocomplete="off" required>
            <div class="text-danger errormsg"></div>
          </div>
        </div>
        <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('address'); ?> 1</label>
            <input type="text" class="form-control" id="address1" name="address1" placeholder="Enter Address1" autocomplete="off">
          </div>

          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('address'); ?> 2</label>
            <input type="text" class="form-control" id="address1" name="address2" placeholder="Enter address2" autocomplete="off">
          </div>
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('city'); ?></label>
            <input type="text" class="form-control" id="taluk" name="taluk" placeholder="Enter City" autocomplete="off">
          
          </div>

          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('state'); ?></label>
            <input type="text" class="form-control" id="district" name="district" placeholder="Enter State" autocomplete="off">

          </div>
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('pincode'); ?></label>
            <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode" autocomplete="off">

          </div>
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('gst_number'); ?></label>
            <input type="text" class="form-control" id="gst_no" name="gst_no" placeholder="Enter GST number" autocomplete="off">
          </div>
         
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('balance'); ?></label>
            <input type="text" class="form-control" value="0" id="balance_amt" name="balance_amt" placeholder="Enter GST number" autocomplete="off">
          </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
          <button type="submit" class="btn btn-primary"><?php echo lang('save_changes'); ?></button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script src="<?php echo base_url('assets/js/quo_calculation.js')?>"></script>
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    $('#kgs_1').hide();
    $('.gstView').hide();
    $('#gstData').val(0);
    $('#transactions').show();
  $('#due_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    startDate: "now",
    immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
  });
  $('#inv_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    endDate: "now",
    immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
  });
  });
  
  $(document).ready(function() {
    $('#dueAmount').hide();
    $("#net_balance_amount").val(0);
    $("#net_balance_amount_value").val(0);
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#addOrderNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
  
    // Add new row in the table 
   

  }); // /document

  $(document).on('focus', '.select2.select2-container', function (e) {
  
  var isOriginalEvent = e.originalEvent // don't re-open on closing focus event
  var isSingleSelect = $(this).find(".select2-selection--single").length > 0 // multi-select will pass focus to input

  if (isOriginalEvent && isSingleSelect) {
    $(this).siblings('select:enabled').select2('open');
  } 

});

  function addRow() {
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr:last").attr('id').match(/\d+/);
      var row_id = parseInt(count_table_tbody_tr[0]) + 1;
      if($('#product_'+count_table_tbody_tr).val()){

      $.ajax({
          url: base_url + '/Controller_Orders/getTableProductRow/',
          type: 'post',
          dataType: 'json',
          success:function(response) {
            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td id="sno_'+row_id+'"></td>'+
                   '<td>'+ 
                    '<select class="form-control select_group product" data-row-id="'+row_id+'" id="product_'+row_id+'" name="product[]" style="width:100%;" onchange="getProductData('+row_id+')">'+
                        '<option value=""></option>';
                        $.each(response, function(index, value) {
                          html += '<option value="'+value.id+'">'+value.hsn+'-'+value.name+'-'+value.mrp+'-'+value.price+'-'+value.product_type+'</option>';             
                        });
                        
                      html += '</select>'+
                      '<p class="productss" id="prodDetailin_'+row_id+'"></p>'+
                    '</td>'+ 
                    '<td><input type="text" style="padding:0;" name="pType[]" id="ptype_'+row_id+'" class="form-control" readonly/></td>'+
                    '<td style="display: flex;" id="sqm_'+row_id+'"><input type="text" name="sbit1[]" id="sbit1_'+row_id+'" class="form-control" required onblur="getFullTotal('+row_id+')" value="1" style="padding: 0;"> <b style="padding: 6px 13px 0 9px;">*</b><input type="text" name="sbit2[]" id="sbit2_'+row_id+'" class="form-control" style="padding: 0;" required onblur="getFullTotal('+row_id+')" value="1" >'+
                        '<b style="padding: 6px 13px 0 9px;">=</b> <input type="text" style="padding: 0;" name="sbit3[]" id="sbit3_'+row_id+'" class="form-control" required readonly value="1">'+
                        '</td>'+
                        '<td id="kgs_'+row_id+'"><input value="1" type="text" name="kgs[]" id="kgsData_'+row_id+'" class="form-control" onblur="getFullTotal('+row_id+')" required ></td>'+
                    '<td><input type="text" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td> <input type="hidden" name="gst_rate[]" id="gst_rate_'+row_id+'"><input type="text" name="net_rate[]" id="net_rate_'+row_id+'" onblur="getFullNetRate('+row_id+')" class="form-control" ><input type="hidden" name="net_rate_value[]" id="net_rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" onkeyup="getFullRate('+row_id+')" class="form-control" ><input type="hidden" name="rate_value[]" id="rate_value_'+row_id+'" class="form-control"></td>'+
                    '<td> <input type="text" class="form-control with" id="net_Amount'+row_id+'" name="net_Amount[]"/>  <input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control without" disabled><input type="hidden" name="amount_value[]" id="amount_value_'+row_id+'" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();
              $("#kgs_"+row_id).hide();
				 hhhh();
          }
        });
      }else{
        return false;
      }

      return false;
    };


    function getMobileDuplicate(mobile){
  $.ajax({
        url: 'mobileduplicate',
        type: 'POST',
        data: { mobile:mobile }, 
        dataType: 'json',
        success:function(response) {
          if(response.length >0) {
            $('.errormsg').html('Already Exist!!!');
          } else {
            $('.errormsg').html('');
          }
        }
      }); 
}



</script>