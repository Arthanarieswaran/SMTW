
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
                    <?php echo lang('edit_quotation'); ?>
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
                                    <form role="form" action="<?php base_url('Controller_Orders/update') ?>" method="post" class="form-horizontal">
              <div class="box-body">

                <?php echo validation_errors(); ?>

               
                
                <div class="col-md-12 col-xs-12 pull pull-left d-flex">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="gross_amount" class="ontrol-label" style="text-align:left;"><b><?php echo lang('customer'); ?></b></label>
                    <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $order_data['order']['customer_id'] ?>">

                      <select class="form-control select_group customer" disabled onchange="getCustomerDetails(this.value)" id="customer" name="customer" required>
                            <option value=""></option>
                            <?php foreach ($customers as $m => $n): ?>
                              <option value="<?php echo $n['id'] ?>" <?php if($order_data['order']['customer_id'] == $n['id']) { echo "selected='selected'"; } ?>  ><?php echo $n['name'].' - '.$n['mobile'].' - '.$n['address1']  ?></option>
                            <?php endforeach ?>
                          </select>

                    </div>
                    </div>
                    <div class="col-md-3">
                     <b> <?php echo lang('balance_amount'); ?> </b><br><span id="balanceDueAmount"><?php echo $order_data['order']['old_balance'] ?></span>
                    </div>
                    <div class="col-md-2">
                     <b> Invoice Date </b><br> <input type="text" class="form-control" id="inv_date" name="inv_date" value="<?php if($order_data['order']['update_date']){echo date("d-m-Y",$order_data['order']['update_date']);}else{echo date("d-m-Y",$order_data['order']['date_time']);}?>" autocomplete="off">
                    </div>
                    <div class="form-group col-sm-3">
                  <label for="gross_amount" class=" control-label"><b><?php echo lang('date'); ?></b> <br><?php echo date('Y-m-d')?> <?php echo date('h:i a') ?></label>
                </div>

                </div>
                
                
               
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

<?php if(isset($order_data['order_item'])): ?>
  <?php $x = 1; ?>
  <?php foreach ($order_data['order_item'] as $key => $val): ?>
    <?php //print_r($v); ?>
   <tr id="row_<?php echo $x; ?>">
     <td id="sno_<?php echo $x; ?>"><?php echo $x; ?></td>
     <td>
      <select class="form-control select_group product" data-row-id="row_<?php echo $x; ?>" id="product_<?php echo $x; ?>" name="product[]" style="width:100%;" onchange="getProductData(<?php echo $x; ?>)" required>
          <option value=""></option>
          <?php foreach ($products as $k => $v): ?>
            <option value="<?php echo $v['id'] ?>" <?php if($val['product_id'] == $v['id']) { $productDeatil = $v;echo "selected='selected'"; } ?>><?php echo $v['hsn'].'-'.$v['name'].'-'.$v['mrp'].'-'.$v['price'].'-'.$v['product_type'] ?></option>
          <?php endforeach ?>
        </select>
        <p class="productss" id="prodDetailquo_<?php echo $x; ?>"><?php echo $productDeatil['name']; ?></p>
        
      </td>
     
      <td><input type="text" name="pType[]" id="ptype_<?php echo $x; ?>" value="<?php echo $val['product_type'] ?>" class="form-control" required readonly ></td>
    <td  style=" <?php if($val['product_type'] == 'SquareMeter' || $val['product_type'] == 'SquareFeet'): ?> display:flex; <?php else:  ?> display: none;<?php endif ?>" id="sqm_<?php echo $x; ?>" >
        <input type="text" name="sbit1[]" id="sbit1_<?php echo $x; ?>" value="<?php echo $val['square_bit_1'] ?>" class="form-control"  onblur="getFullTotal(<?php echo $x; ?>)" style="padding: 0;"> 
        <b style="padding: 6px 13px 0 9px;">*</b>
        <input type="text" name="sbit2[]" id="sbit2_<?php echo $x; ?>" class="form-control" style="padding: 0;"  onblur="getFullTotal(<?php echo $x; ?>)" value="<?php echo $val['square_bit_2'] ?>" >
        <b style="padding: 6px 13px 0 9px;">=</b> <input type="text" style="padding: 0;" name="sbit3[]" id="sbit3_<?php echo $x; ?>" class="form-control"  readonly value="<?php  if($val['product_type'] == 'SquareFeet'){ $sf = (($val['square_bit_1']*$val['square_bit_2'])); echo number_format($sf, 3, '.', ''); }else{ $sf = ((($val['square_bit_1']*$val['square_bit_2'])*0.305)*1.06); echo number_format($sf, 3, '.', '');}?>">
        </td>
       
        <td style="<?php if($val['product_type'] == 'Kgs' || $val['product_type'] == 'Piece'): ?> display:block; <?php else:  ?> display: none;<?php endif ?>" id="kgs_<?php echo $x; ?>">
        <input type="text" name="kgs[]" id="kgsData_<?php echo $x; ?>" class="form-control" onblur="getFullTotal(<?php echo $x; ?>)" value="<?php echo $val['kgs'] ?>">
        </td>
      <td><input type="text" name="qty[]" id="qty_<?php echo $x; ?>" class="form-control" required onkeyup="getTotal(<?php echo $x; ?>)" value="<?php echo $val['qty'] ?>" autocomplete="off"></td>
      <td>
                          <input type="hidden" id="gst_rate_<?php echo $x; ?>" value="<?php echo $val['gst_rate'] ?>" name="gst_rate[]">
                          <input type="text" name="net_rate[]" id="net_rate_<?php echo $x; ?>" class="form-control" autocomplete="off"  onblur="getFullNetRate(<?php echo $x; ?>)" value="<?php echo $val['net_rate'] ?>">
                          <input type="hidden" name="net_rate_value[]" id="net_rate_value_<?php echo $x; ?>" class="form-control"  autocomplete="off" value="<?php echo $val['net_rate'] ?>">
                        </td>
      <td>
        <input type="text" name="rate[]" id="rate_<?php echo $x; ?>" class="form-control" onkeyup="getFullRate(<?php echo $x; ?>)" value="<?php echo $val['rate'] ?>" autocomplete="off">
        <input type="hidden" name="rate_value[]" id="rate_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['rate'] ?>" autocomplete="off">
      </td>
      <td>
      <input type="text" id="net_Amount<?php echo $x; ?>" class="form-control with" value="<?php echo $val['net_rate_amount'] ?>" name="net_Amount[]"/>
        <input type="text" name="amount[]" id="amount_<?php echo $x; ?>" class="form-control without" disabled value="<?php echo $val['amount'] ?>" autocomplete="off">
        <input type="hidden" name="amount_value[]" id="amount_value_<?php echo $x; ?>" class="form-control" value="<?php echo $val['amount'] ?>" autocomplete="off">
      </td>
      <td><button type="button" class="btn btn-danger btn-sm" onclick="removeRow('<?php echo $x; ?>')"><i class="fa fa-close"></i></button></td>
   </tr>
   <?php $x++; ?>
 <?php endforeach; ?>
<?php endif; ?>
</tbody>

                </table>

                <br /> <br/>

                <div class="col-md-6 col-xs-12 pull pull-right">
                  <div class="without" style="    margin-bottom: -12px;">
                  <div class="form-group d-flex ">
                    <label for="gross_amount" class="col-sm-5 control-label"><?php echo lang('gross_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" disabled value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                      <input type="hidden" class="form-control" id="gross_amount_value" name="gross_amount_value" value="<?php echo $order_data['order']['gross_amount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="sgst_amount" class="col-sm-5 control-label">SGST</label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="sgst_amount" name="sgst_amount" readonly autocomplete="off" value="<?php echo $order_data['order']['service_charge_rate'] ?>">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="cgst_amount" class="col-sm-5 control-label">CGST</label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -8px;" class="form-control" id="cgst_amount" name="cgst_amount" readonly autocomplete="off" value="<?php echo $order_data['order']['vat_charge_rate'] ?>">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="cgst_amount" class="col-sm-5 control-label d-flex">Extra GST  <input type="text" style="margin-top: -5px;width: 22%; margin-left: 6px;" class="form-control" id="extra_gst" name="extra_gst" value = "<?php echo $order_data['order']['extra_gst'] ?>" autocomplete="off" onkeyup="subAmount()"> </label>
                    <div class="col-sm-5">
                      <input type="text" style="margin-top: -6px;" class="form-control" id="extra_gst_amount" name="extra_gst_amount" readonly autocomplete="off" <?php echo $order_data['order']['extra_gst_amount'] ?>>
                    </div>
                  </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="discount" class="col-sm-5 control-label"><?php echo lang('discount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" value="<?php echo $order_data['order']['discount'] ?>" autocomplete="off">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('extra_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="extra_amount" name="extra_amount" onkeyup="subAmount()" autocomplete="off" value="<?php echo $order_data['order']['extra_amount'] ?>" >
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('total_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" disabled autocomplete="off" value="<?php echo $order_data['order']['net_amount'] ?>">
                      <input type="hidden" class="form-control" id="net_amount_value" name="net_amount_value" autocomplete="off" value="<?php echo $order_data['order']['net_amount'] ?>">
                    </div>
                  </div>

                  <div class="form-group d-flex" id="net_balance">
                    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('balance_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="net_balance_amount" name="net_balance_amount" disabled autocomplete="off" value="<?php echo $order_data['order']['old_balance'] ?>" >
                      <input type="hidden" class="form-control" id="net_balance_amount_value" name="net_balance_amount_value" autocomplete="off" value="<?php echo $order_data['order']['old_balance'] ?>" >
                    </div>
                  </div>
                  
                  <div class="form-group d-flex">
                    <label for="net_amount" class="col-sm-5 control-label"><?php echo lang('net_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="total_amount" name="total_amount" disabled autocomplete="off" value="<?php echo ($order_data['order']['net_amount'] + $order_data['order']['old_balance']) ?>">
                      <input type="hidden" class="form-control" id="total_amount_value" name="total_amount_value" autocomplete="off" value="<?php echo ($order_data['order']['net_amount'] + $order_data['order']['old_balance']) ?>">
                    </div>
                  </div>

                  </div>
                  <div class="col-md-6 col-xs-12 pull pull-left">

                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('cash'); ?> <?php echo lang('amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="cash_amount" name="cash_amount" onkeyup="getPaidAmount()" autocomplete="off" value="<?php echo $order_data['order']['cash_amount'] ?>" required>
                    </div>
                  </div>

                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('cheque'); ?> <?php echo lang('amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="cheque_amount" name="cheque_amount" onkeyup="getPaidAmount()" autocomplete="off" value="<?php echo $order_data['order']['cheque_amount'] ?>" required>
                    </div>
                  </div>

                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('online'); ?> <?php echo lang('amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="online_amount" name="online_amount" onkeyup="getPaidAmount()" autocomplete="off" value="<?php echo $order_data['order']['online_amount'] ?>" required>
                    </div>
                  </div>

                  <div class="form-group d-flex">
                    <label for="paid_amount" class="col-sm-5 control-label"><?php echo lang('paid_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="paid_amount" name="paid_amount" onkeyup="getPaidAmount()" autocomplete="off" required value="<?php echo $order_data['order']['paid_amount'] ?>" readonly>
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('due_amount'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="due_amount" name="due_amount" disabled autocomplete="off" value="<?php echo $order_data['order']['due_amount'] ?>">
                      <input type="hidden" class="form-control" id="due_amount_value" name="due_amount_value" autocomplete="off" value="<?php echo $order_data['order']['due_amount'] ?>">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-5 control-label">Today Balance</label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="todaybalance" name="todaybalance" disabled autocomplete="off" value="<?php $tdue = $order_data['order']['net_amount'] - $order_data['order']['paid_amount']; if($tdue >= 0){ echo $tdue; }  else { echo 'No Due';} ?>">
                    </div>
                  </div>
                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('due_date'); ?></label>
                    <div class="col-sm-5">
                      <input type="text" class="form-control" id="due_date" name="due_date" autocomplete="off" value="<?php echo $order_data['order']['due_date'] ?>">
                    </div>
                  </div>
                  <div class="form-group" style="display:none;">
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('payment_mode'); ?></label>
                    <div class="col-sm-7">
                    <div class="ui_radio_hd">
                    <input type="hidden" id="payment_method" name="payment_method" value="Cash">
                    <label><input type="checkbox" class="radio-inline ui_radio" onclick="getPaymentData()" name="radios" value="Cash" <?php if($order_data['order']['payment_method'] == 'Cash') echo "checked" ?> ><span class="outside"><span class="inside"></span></span> &nbsp;<?php echo lang('cash'); ?></label>&nbsp;&nbsp;
                      <label><input type="checkbox" class="radio-inline ui_radio" onclick="getPaymentData()" name="radios" value="Cheque"  <?php if($order_data['order']['payment_method'] == 'Cheque') echo "checked" ?>><span class="outside"><span class="inside"></span></span> &nbsp;<?php echo lang('cheque'); ?></label>&nbsp;&nbsp;
                      <label><input type="checkbox" class="radio-inline ui_radio" onclick="getPaymentData()" name="radios" value="Online"  <?php if($order_data['order']['payment_method'] == 'Online') echo "checked" ?>><span class="outside"><span class="inside"></span></span> &nbsp;<?php echo lang('online'); ?></label>
                    </div>
                    </div>
                  </div>
                  
                  <div class="form-group d-flex" >
                    <label for="due_amount" class="col-sm-5 control-label"><?php echo lang('transaction_number'); ?></label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="transaction" name="transaction" autocomplete="off" value="<?php echo $order_data['order']['transaction_number'] ?>">
                    </div>
           
                  </div>

                  <div class="form-group d-flex">
                    <label for="due_amount" class="col-sm-3 control-label">GST</label>
                    <div class="col-sm-7" style="margin-top: -5px;">
                    <div class="ui_radio_hd">
                      <label><input type="radio" class="radio-inline ui_radio" onclick="getGst(0)" name="gstCheck" value="0" <?php if($order_data['order']['gst'] == '0' ) echo 'Checked' ?>><span class="outside"><span class="inside"></span></span> &nbsp;Without GST</label>&nbsp;&nbsp;
                      <label><input type="radio" class="radio-inline ui_radio" onclick="getGst(1)" name="gstCheck" value="1" <?php if($order_data['order']['gst'] == '1' ) echo 'Checked' ?>><span class="outside"><span class="inside"></span></span> &nbsp;With GST</label>&nbsp;&nbsp;
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
              <input type="hidden" id="gstData" name="gstData" value="<?php echo $order_data['order']['gst'] ?>">
             
              <input type="hidden" name="service_charge_rate" value="<?php echo $company_data['service_charge_value'] ?>" autocomplete="off">
                <input type="hidden" name="vat_charge_rate" value="<?php echo $company_data['vat_charge_value'] ?>" autocomplete="off">
</div>
              <div class="box-footer col-md-12" style="margin-bottom: 7px; text-align: center;">
              <a target="__blank" href="<?php echo base_url() . 'Controller_Orders/printDiv/'.$order_data['order']['id'] ?>" class="btn btn-info" ><?php echo lang('print'); ?></a>
                <button type="submit" class="btn btn-primary"><?php echo lang('save_changes'); ?></button>
                <a href="<?php echo base_url('Controller_Orders/') ?>" class="btn btn-warning"><?php echo lang('back'); ?></a>
                <a href="<?php echo base_url('Controller_Orders/create') ?>" class="btn btn-primary"><?php echo lang('new_order'); ?></a>
              </div>
            </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<script src="<?php echo base_url('assets/js/quo_calculation.js')?>"></script>
<script type="text/javascript">
  var base_url = "<?php echo base_url(); ?>";
  $(document).ready(function() {
    var checked = $('#gstCheck:checked').val();
   setTimeout(() => {
    subAmount();
   }, 1000);
   
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
  function getPaymentData(){
    var payment = $('input[name="radios"]:checked').val();
    if(payment == 'Cash'){
      $('#transactions').hide();
      $('#transaction').val("");
      $('#payment_method').val(payment);
    }else{
      $('#transactions').show();
      $('#payment_method').val(payment);
    }
  }
  

  $(document).ready(function() {
    $(".select_group").select2();
    // $("#description").wysihtml5();

    $("#mainOrdersNav").addClass('active');
    $("#manageOrdersNav").addClass('active');
 
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
                      '<p class="productss" id="prodDetailquo_'+row_id+'"></p>'+
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

 
</script>