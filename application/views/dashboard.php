<div class="main-content">
<style>
/* This is what we are focused on */
.table-wrapper{
    overflow-y: scroll;
    height: 260px;
}

.table-wrapper th{
    position: sticky;
    top: 0;
}

/* A bit more styling to make it look better */
.table-wrapper{
  background: white;
}

table{
  border-collapse: collapse;
  width: 100%;
}

th{
    background: #DDD;
}

td,th{
  padding: 10px;
  text-align: center;
}
.datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-bottom{
    z-index: 10000 !important;
}
</style>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0"><?php echo lang('dashboard'); ?></h4>

                    <div class="page-title-right">
                   
                        <ol class="breadcrumb m-0">
                        <li>
                        <select name="daterange" class="form-control" onclick="getDurationData(this.value)" id="daterange" style="padding: 0; height: 24px; margin-left: -9px; margin-right: 20px;">
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                    <option value="custom">Custom Date</option>
                    </select>
                        </li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('dashboard'); ?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><?php echo lang('today_order_list'); ?> <button class="btn btn-sm btn-primary" onclick="demoPdf('quotation')">PDF</button> <button class="btn btn-sm btn-success" onclick="ExportToExcel('quotation','xlsx')">Excel</button><button class="btn btn-sm  btn-secondary "  onclick="printdiv('quotation');" style="margin-left:.8vh;">Print</button></h4>
                        <div class="table-responsive quo table-wrapper" id="quotation">
                            <table class="table table-centered  mb-0" >
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th> <?php echo lang('date'); ?></th>
                                    <th><?php echo lang('bill_no'); ?></th>
                                    <th><?php echo lang('customer_name'); ?></th>
                                    <th><?php echo lang('address'); ?></th>
                                    <th> <?php echo lang('mobile_number'); ?></th>
                                    <th><?php echo lang('total'); ?></th>
                                    <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="quoList">
                                <?php if(count($total_paid_orders) > 0): ?>
                                <?php foreach($total_paid_orders as $key => $order): ?>
                                    <tr class="winner__table" style="font-size: 12px;">
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo date('d/m/Y', $order['date_time']) ?></td>
                                        <td><?php echo $order['bill_no'] ?></td>
                                        <td><?php echo $order['name'] ?></td>
                                    
                                        <td style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;"><?php echo $order['address1'].','. $order['address2'].','. $order['taluk'] ?></td>
                                        <td><?php echo $order['mobile'] ?></td>
                                        <td style="font-weight: bold;"><?php echo $order['net_amount'] ?></td>
                                        <td>
                                        <a target="__blank" href=<?php echo base_url("Controller_Orders/printDiv/".$order['orderid'])?> class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>
                                        <a href="<?php echo base_url('Controller_Orders/update/'.$order['orderid'])?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(<?php echo $order['orderid']?>)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                                <?php else: ?>
                                <tr class="winner__table">
                                    <td colspan="7"><?php echo lang('no_data_found'); ?></td>
                                    
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4"><?php echo lang('today_invoice_list'); ?> <button class="btn btn-sm btn-primary" onclick="demoPdf('invoice')">PDF</button> <button class="btn btn-sm btn-success" onclick="ExportToExcel('invoice','xlsx')">Excel</button><button class="btn btn-sm  btn-secondary "  onclick="printdiv('quotation');" style="margin-left:.8vh;">Print</button></h4>
                        <div class="table-responsive inv table-wrapper" id="invoice">
                            <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>
                                        <?php echo lang('v_n'); ?>
                                        </th>
                                        <th><?php echo lang('date'); ?></th>
                                        <th><?php echo lang('bill_no'); ?></th>
                                        <th><?php echo lang('customer_name'); ?></th>
                                        <th><?php echo lang('address'); ?></th>
                                        <th><?php echo lang('mobile_number'); ?></th>
                                        <th><?php echo lang('total'); ?></th>
                                        <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="invList">
                                <?php if(count($total_invoice) > 0): ?>
                                    <?php foreach($total_invoice as $key => $invoice): ?>
                                        <tr class="winner__table" style="font-size: 12px;">
                                            <td><?php echo $key+1 ?></td>
                                            <td><?php echo date('d/m/Y', $invoice['date_time']) ?></td>
                                            <td><?php echo $invoice['bill_no'] ?></td>
                                            <td><?php echo $invoice['name'] ?></td>
                                        
                                            <td style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;"><?php echo $invoice['address1'].','. $invoice['address2'].','. $invoice['taluk'] ?></td>
                                            <td><?php echo $invoice['mobile'] ?></td>
                                            <td style="font-weight:bold;"><?php echo $invoice['net_amount'] ?></td>
                                            <td>
                                        <a target="__blank" href=<?php echo base_url("Controller_Invoice/printDiv/".$invoice['orderid'])?> class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>
                                        <a href="<?php echo base_url('Controller_Invoice/update/'.$invoice['orderid'])?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc1(<?php echo $invoice['orderid']?>)" ><i class="fa fa-trash"></i></button>
                                        </td>
                                        </tr>
                                    <?php endforeach ?>
                                    <?php else: ?>
                                    <tr class="winner__table">
                                        <td colspan="7"><?php echo lang('no_data_found'); ?></td>
                                        
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
        <h4 class="card-title mb-4"><?php echo lang('orders'); ?> <?php echo lang('amount'); ?></h4>
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="total-revenue-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹<span data-plugin="counterup" id="dh_cash"><?php  echo $cash[0]['paid_amount']   ?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('cash'); ?></p>
                        </div>
                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-success mr-1"><i class="mdi mdi-arrow-up-bold ml-1"></i>2.65%</span>  -->
                        <!-- </p> -->
                    </div>
                </div>
            </div> <!-- end col-->
 
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="orders-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹<span data-plugin="counterup" id="dh_cheque"><?php echo $cheque[0]['paid_amount']  ?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('cheque'); ?></p>
                        </div>
                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i class="mdi mdi-arrow-down-bold ml-1"></i>0.82%</span>  -->
                        <!-- </p> -->
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="customers-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹<span data-plugin="counterup" id="dh_online"><?php echo $online[0]['paid_amount']  ?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('online'); ?></p>
                        </div>
                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i class="mdi mdi-arrow-down-bold ml-1"></i>6.24%</span>  -->
                        <!-- </p> -->
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">

                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="growth-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹ <span data-plugin="counterup" id="dh_balance"><?php echo number_format($balance[0]['net_amount']-$balance[0]['paid_amount'],2)?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('balance'); ?></p>
                        </div>
                       
                    </div>
                </div>
            </div> 
        </div> <!-- end row-->
        <h4 class="card-title mb-4"><?php echo lang('invoice'); ?> <?php echo lang('amount'); ?></h4>
        <div class="row">
        
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="total-revenue-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹<span data-plugin="counterup" id="dh_cash"><?php  echo $cash1[0]['paid_amount']   ?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('cash'); ?></p>
                        </div>
                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-success mr-1"><i class="mdi mdi-arrow-up-bold ml-1"></i>2.65%</span>  -->
                        <!-- </p> -->
                    </div>
                </div>
            </div> <!-- end col-->
 
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="orders-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹<span data-plugin="counterup" id="dh_cheque"><?php echo $cheque1[0]['paid_amount']  ?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('cheque'); ?></p>
                        </div>
                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i class="mdi mdi-arrow-down-bold ml-1"></i>0.82%</span>  -->
                        <!-- </p> -->
                    </div>
                </div>
            </div> <!-- end col-->

            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="customers-chart"> </div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹<span data-plugin="counterup" id="dh_online"><?php echo $online1[0]['paid_amount']  ?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('online'); ?></p>
                        </div>
                        <!-- <p class="text-muted mt-3 mb-0"><span class="text-danger mr-1"><i class="mdi mdi-arrow-down-bold ml-1"></i>6.24%</span>  -->
                        <!-- </p> -->
                    </div>
                </div>
            </div> <!-- end col-->

            <!-- <div class="col-md-6 col-xl-3">

                <div class="card">
                    <div class="card-body">
                        <div class="float-right mt-2">
                            <div id="growth-chart"></div>
                        </div>
                        <div>
                            <h4 class="mb-1 mt-1">₹ <span data-plugin="counterup" id="dh_balance"><?php echo $balance[0]['net_amount']-$balance[0]['paid_amount']?></span></h4>
                            <p class="text-muted mb-0"><?php echo lang('balance'); ?></p>
                        </div>
                       
                    </div>
                </div>
            </div>  -->
        </div> <!-- end row-->
        <div class="row">
        <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Receipt List <button class="btn btn-sm btn-primary" onclick="demoPdf('receipt')">PDF</button> <button class="btn btn-sm btn-success" onclick="ExportToExcel('receipt','xlsx')">Excel</button><button class="btn btn-sm  btn-secondary "  onclick="printdiv('quotation');" style="margin-left:.8vh;">Print</button></h4>
                        <div class="table-responsive quo table-wrapper" id="receipt">
                            <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th><?php echo lang('date'); ?></th>
                                    <th style="text-align: inherit;"> <?php echo lang('name'); ?></th>
                                    <th><?php echo lang('mobile'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="receeiptList">
                                <?php if(count($receiptItem) > 0): ?>
                                <?php foreach($receiptItem as $key => $value): ?>
                                    <tr class="winner__table" style="font-size: 12px;">
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo date('d/m/Y', $value['date']) ?></td>
                                        <td style="text-align: inherit;"><?php echo $value['name'] ?></td>
                                        <td><?php echo $value['mobile'] ?></td>
                                        <td>Rs. <?php echo number_format($value['amount'],2) ?></td>
                                        
                                    </tr>
                                <?php endforeach ?>
                                <?php else: ?>
                                <tr class="winner__table">
                                    <td colspan="6"><?php echo lang('no_data_found'); ?></td>
                                    
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
                                </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Invoice Product List <button class="btn btn-sm btn-primary" onclick="demoPdf('invoiceproduct')">PDF</button> <button class="btn btn-sm btn-success" onclick="ExportToExcel('invoiceproduct','xlsx')">Excel</button><button class="btn btn-sm  btn-secondary "  onclick="printdiv('quotation');" style="margin-left:.8vh;">Print</button></h4>
                        <div class="table-responsive quo table-wrapper" id="invoiceproduct">
                            <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th style="text-align: inherit;"> <?php echo lang('name'); ?></th>
                                    <th><?php echo lang('type'); ?></th>
                                    <th><?php echo lang('qty'); ?></th>
                                    <th><?php echo lang('net_amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="invProductList">
                                <?php if(count($invoiceItem) > 0): ?>
                                <?php foreach($invoiceItem as $key => $value): ?>
                                    <tr class="winner__table" style="font-size: 12px;">
                                        <td><?php echo $key+1 ?></td>
                                        <td style="text-align: inherit;"><?php echo $value['productname'] ?></td>
                                        <td><?php echo $value['producttype'] ?></td>
                                        <td><?php echo $value['qty'] ?></td>
                                        <td>Rs. <?php echo number_format($value['net_rate_amount'],2) ?></td>
                                        
                                    </tr>
                                <?php endforeach ?>
                                <?php else: ?>
                                <tr class="winner__table">
                                    <td colspan="6"><?php echo lang('no_data_found'); ?></td>
                                    
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Quotation Product List <button class="btn btn-sm btn-primary" onclick="demoPdf('quotationproduct')">PDF</button> <button class="btn btn-sm btn-success" onclick="ExportToExcel('quotationproduct','xlsx')">Excel</button><button class="btn btn-sm  btn-secondary "  onclick="printdiv('quotation');" style="margin-left:.8vh;">Print</button></h4>
                        <div class="table-responsive quo table-wrapper" id="quotationproduct">
                            <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th style="text-align: inherit;"> <?php echo lang('name'); ?></th>
                                    <th><?php echo lang('type'); ?></th>
                                    <th><?php echo lang('qty'); ?></th>
                                    <th><?php echo lang('net_amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="quoProductList">
                                <?php if(count($quotationItem) > 0): ?>
                                <?php foreach($quotationItem as $key => $value): ?>
                                    <tr class="winner__table" style="font-size: 12px;">
                                        <td><?php echo $key+1 ?></td>
                                        <td style="text-align: inherit;"><?php echo $value['productname'] ?></td>
                                        <td><?php echo $value['producttype'] ?></td>
                                        <td><?php echo $value['qty'] ?></td>
                                        <td>Rs. <?php echo number_format($value['net_rate_amount'],2) ?></td>
                                        
                                    </tr>
                                <?php endforeach ?>
                                <?php else: ?>
                                <tr class="winner__table">
                                    <td colspan="6"><?php echo lang('no_data_found'); ?></td>
                                    
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Vendor List <button class="btn btn-sm btn-primary" onclick="demoPdf('vendor')">PDF</button> <button class="btn btn-sm btn-success" onclick="ExportToExcel('vendor','xlsx')">Excel</button><button class="btn btn-sm  btn-secondary "  onclick="printdiv('quotation');" style="margin-left:.8vh;">Print</button></h4>
                        <div class="table-responsive quo table-wrapper" id="vendor">
                            <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th style="text-align: inherit;"> <?php echo lang('name'); ?></th>
                                    <th><?php echo lang('total_amount'); ?></th>
                                    <th><?php echo lang('paid_amount'); ?></th>
                                    <th><?php echo lang('balance_amount'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="vendorList">
                                <?php if(count($vendordetails) > 0): ?>
                                <?php foreach($vendordetails as $key => $value): ?>
                                    <tr class="winner__table" style="font-size: 12px;">
                                        <td><?php echo $key+1 ?></td>
                                        <td style="text-align: inherit;"><?php echo $value['vname'] ?></td>
                                        <td>Rs. <?php echo number_format($value['total_amount'],2)?></td>
                                        <td>Rs. <?php echo number_format($value['paid_amount'],2) ?></td>
                                       <?php $bal = $value['total_amount'] - $value['paid_amount']; if($bal > 0):?>
                                        <td style="color:red">Rs. <?php echo number_format($value['total_amount'] - $value['paid_amount'],2) ?></td>
                                        <?php else: ?>
                                            <td style="color:green">Rs. <?php echo number_format($value['total_amount'] - $value['paid_amount'],2) ?></td>
                                            <?php endif ?>
                                        
                                    </tr>
                                <?php endforeach ?>
                                <?php else: ?>
                                <tr class="winner__table">
                                    <td colspan="6"><?php echo lang('no_data_found'); ?></td>
                                    
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>
        </div>
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo lang('remove_order'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" id="removeForm">
        <div class="modal-body">
          <p><?php echo lang('do_you_really_want_to_remove'); ?>?</p>
          <input type="hidden" id="orderreid">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
          <button type="submit" class="btn btn-danger"><?php echo lang('delete'); ?></button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" tabindex="-1" role="dialog" id="removeModal1" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><?php echo lang('remove_order'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>

      <form role="form" id="removeForm1">
        <div class="modal-body">
          <p><?php echo lang('do_you_really_want_to_remove'); ?>?</p>
          <input type="hidden" id="orderreid1">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
          <button type="submit" class="btn btn-danger"><?php echo lang('delete'); ?></button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Custom Date</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name">From Date</label>
            <input type="text" class="form-control" id="from_date" name="from_date" autocomplete="off">
          </div>

          <div class="form-group col-md-6">
            <label for="brand_name">To Date</label>
            <input type="text" class="form-control" id="to_date" name="to_date" autocomplete="off">
          </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="close()">Close</button>
        <button type="button" class="btn btn-primary" onclick=getDetais()>Ok</button>
      </div>
    </div>
  </div>
</div>


<!-- End Page-content -->
<script>
    $(document).ready(function() {
    $('#from_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    endDate: "now",
    immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
  });
  $('#to_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    endDate: "now",
    immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
  });
    });
function removeFunc(data) {
    $('#orderreid').val(data);
    $("#removeModal").modal('show');
}
function removeFunc1(data) {
    $('#orderreid1').val(data);
    $("#removeModal1").modal('show');
}
function getDurationData(data){
    if(data == 'custom'){
        $('#exampleModal').modal('show');
    }else{
    $.ajax({
    url: 'Dashboard/dataUpdate',
    type: 'post',
    dataType: 'json',
    data : {dataType : data},
    success:function(responseData) {
      if(responseData.balance.length > 0){
          var balance = responseData.balance[0].net_amount - responseData.balance[0].paid_amount;
          $('#dh_balance').html(balance.toFixed(2));
      }
      var paidAmt = 0;
      if(responseData.cash[0].paid_amount){
        paidAmt = paidAmt + parseFloat(responseData.cash[0].paid_amount);
        //   $('#dh_balance').html(balance.toFixed(2));
      }
      if(responseData.cash1[0].paid_amount){
        paidAmt = paidAmt + parseFloat(responseData.cash1[0].paid_amount);
          $('#dh_cash').html(paidAmt.toFixed(2));
      }
      var onlineAmt = 0;
      if(responseData.online[0].paid_amount){
        onlineAmt = onlineAmt + parseFloat(responseData.online[0].paid_amount);
        //   $('#dh_balance').html(balance.toFixed(2));
      }
      if(responseData.online1[0].paid_amount){
        onlineAmt = onlineAmt + parseFloat(responseData.online1[0].paid_amount);
          $('#dh_online').html(onlineAmt.toFixed(2));
      }
      var chequeAmt = 0;
      if(responseData.cheque[0].paid_amount){
        chequeAmt = chequeAmt + parseFloat(responseData.cheque[0].paid_amount);
        //   $('#dh_balance').html(balance.toFixed(2));
      }
      if(responseData.cheque1[0].paid_amount){
        chequeAmt = chequeAmt + parseFloat(responseData.cheque1[0].paid_amount);
          $('#dh_cheque').html(chequeAmt.toFixed(2));
      }
      $('#invList').empty();
      var base_url = "<?php echo base_url(); ?>";
      if(responseData.total_invoice.length > 0){
       
          $.each(responseData.total_invoice,function(key,value){
           
            $('#invList').append(' <tr class="winner__table" style="font-size: 12px;"><td>'+(key+1)+'</td>'+
                                            '<td>'+value[0]+'</td>'+
                                            '<td>'+value[1]+'</td>'+
                                            '<td>'+value[2]+'</td>'+
                                            '<td style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;">'+value[3]+','+value[4]+','+value[5]+'</td>'+
                                            '<td>'+value[6]+'</td>'+
                                            '<td style="font-weight: bold;">'+value[7]+'</td>'+
                                            '<td><a target="__blank" href="'+base_url+'Controller_Orders/printDiv/'+value[8]+'" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>'+
                                        '<a href="'+base_url+'Controller_Orders/update/'+value[8]+'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>'+
                                        '<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc1('+value[8]+')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>'+
                                            
                                            
                                            '</td>'+
                                        '</tr>');
          });
      }else{
          $('#invList').append('<tr class="winner__table"><td colspan="7"><?php echo lang('no_data_found'); ?></td> </tr>')
      }

      $('#invProductList').empty();
      if(responseData.invoiceItem.length > 0){
       
          $.each(responseData.invoiceItem,function(key,value){
           
            $('#invProductList').append(' <tr class="winner__table" style="font-size: 12px;"><td>'+(key+1)+'</td>'+
                                            '<td>'+value.productname+'</td>'+
                                            '<td>'+value.producttype+'</td>'+
                                            '<td>'+value.qty+'</td>'+
                                            '<td>'+parseFloat(value.net_rate_amount).toFixed(2)+'</td>'+
                                        '</tr>');
          });
      }else{
          $('#invProductList').append('<tr class="winner__table"><td colspan="4"><?php echo lang('no_data_found'); ?></td> </tr>')
      }
      $('#quoProductList').empty();
      if(responseData.quotationItem.length > 0){
       
          $.each(responseData.quotationItem,function(key,value){
           
            $('#quoProductList').append(' <tr class="winner__table" style="font-size: 12px;"><td>'+(key+1)+'</td>'+
                                            '<td>'+value.productname+'</td>'+
                                            '<td>'+value.producttype+'</td>'+
                                            '<td>'+value.qty+'</td>'+
                                            '<td>'+parseFloat(value.net_rate_amount).toFixed(2)+'</td>'+
                                        '</tr>');
          });
      }else{
          $('#quoProductList').append('<tr class="winner__table"><td colspan="4"><?php echo lang('no_data_found'); ?></td> </tr>')
      }
      $('#quoList').empty();
      if(responseData.total_paid_orders.length > 0){
          $.each(responseData.total_paid_orders,function(key,value){
              
            $('#quoList').append(' <tr class="winner__table style="font-size: 12px;""><td>'+(key+1)+'</td>'+
                                            '<td>'+value[0]+'</td>'+
                                            '<td>'+value[1]+'</td>'+
                                            '<td>'+value[2]+'</td>'+
                                            '<td style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;">'+value[3]+','+value[4]+','+value[5]+'</td>'+
                                            '<td>'+value[6]+'</td>'+
                                            '<td style="font-weight: bold;">'+value[7]+'</td>'+
                                            '<td><a target="__blank" href="'+base_url+'Controller_Orders/printDiv/'+value[8]+'" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>'+
                                        '<a href="'+base_url+'Controller_Orders/update/'+value[8]+'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>'+
                                        '<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('+value[8]+')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>'+
                                        '</tr>');
          });
      }else{
          $('.quo .table-wrapper').css('height','height: 95px;')
          $('#quoList').append('<tr class="winner__table"><td colspan="7"><?php echo lang('no_data_found'); ?></td> </tr>')
      }

      $('#receeiptList').empty();
      if(responseData.receiptItem.length > 0){
          $.each(responseData.receiptItem,function(key,value){
            const unixTime = value.date;
            const date = new Date(unixTime*1000);
            $('#receeiptList').append(' <tr class="winner__table style="font-size: 12px;""><td>'+(key+1)+'</td>'+
                                            '<td>'+date.toLocaleDateString()+'</td>'+
                                            '<td style="text-align: inherit;">'+value.name+'</td>'+
                                            '<td>'+value.mobile+'</td>'+
                                            '<td>Rs '+value.amount+'</td>'+'</tr>');
          });
      }else{
          $('.quo .table-wrapper').css('height','height: 95px;')
          $('#receeiptList').append('<tr class="winner__table"><td colspan="7"><?php echo lang('no_data_found'); ?></td> </tr>')
      }
    }
  });
    }
}

// remove functions 

    $("#removeForm").on('submit', function(e) {

     
e.preventDefault();

      // remove the text-danger
      $(".text-danger").remove();
      var base_url = "<?php echo base_url(); ?>";
      $.ajax({
        url: base_url+'Controller_Orders/remove',
        type: 'POST',
        data: { order_id:$('#orderreid').val() }, 
        dataType: 'json',
        success:function(response) {

          window.location.reload();

            // hide the modal
            $("#removeModal").modal('hide');

          } 
        });
      }); 




 $("#removeForm1").on('submit', function(e) {

     
e.preventDefault();

      // remove the text-danger
      $(".text-danger").remove();
      var base_url = "<?php echo base_url(); ?>";
      $.ajax({
        url: base_url+'Controller_Invoice/remove',
        type: 'POST',
        data: { order_id:$('#orderreid1').val() }, 
        dataType: 'json',
        success:function(response) {

          window.location.reload();

            // hide the modal
            $("#removeModal1").modal('hide');

          } 
        });
      }); 


function getDetais(){
    if($('#from_date').val() == ''){
        alert('Select From Date');
        return false;
    }
    if($('#to_date').val() == ''){
        alert('Select To Date');
        return false;
    }
    var fromdate1 = $('#from_date').val().split('-');
    var fromdate = fromdate1[2]+'-'+fromdate1[1]+'-'+fromdate1[0]+' 00:00:00'
    var todate1 = $('#to_date').val().split('-');
    var todate = todate1[2]+'-'+todate1[1]+'-'+todate1[0]+' 23:59:59'
    $.ajax({
    url: 'Dashboard/dataCustom',
    type: 'post',
    dataType: 'json',
    data : {dataType : 'custom',fromdate : fromdate,todate : todate},
    success:function(responseData) {
        $('#exampleModal').modal('hide');
      if(responseData.balance.length > 0){
          var balance = responseData.balance[0].net_amount - responseData.balance[0].paid_amount;
          $('#dh_balance').html(balance.toFixed(2));
      }
      var paidAmt = 0;
      if(responseData.cash[0].paid_amount){
        paidAmt = paidAmt + parseFloat(responseData.cash[0].paid_amount);
        //   $('#dh_balance').html(balance.toFixed(2));
      }
      if(responseData.cash1[0].paid_amount){
        paidAmt = paidAmt + parseFloat(responseData.cash1[0].paid_amount);
          $('#dh_cash').html(paidAmt.toFixed(2));
      }
      var onlineAmt = 0;
      if(responseData.online[0].paid_amount){
        onlineAmt = onlineAmt + parseFloat(responseData.online[0].paid_amount);
        //   $('#dh_balance').html(balance.toFixed(2));
      }
      if(responseData.online1[0].paid_amount){
        onlineAmt = onlineAmt + parseFloat(responseData.online1[0].paid_amount);
          $('#dh_online').html(onlineAmt.toFixed(2));
      }
      var chequeAmt = 0;
      if(responseData.cheque[0].paid_amount){
        chequeAmt = chequeAmt + parseFloat(responseData.cheque[0].paid_amount);
        //   $('#dh_balance').html(balance.toFixed(2));
      }
      if(responseData.cheque1[0].paid_amount){
        chequeAmt = chequeAmt + parseFloat(responseData.cheque1[0].paid_amount);
          $('#dh_cheque').html(chequeAmt.toFixed(2));
      }
      $('#invList').empty();
      var base_url = "<?php echo base_url(); ?>";
      if(responseData.total_invoice.length > 0){
       
          $.each(responseData.total_invoice,function(key,value){
           
            $('#invList').append(' <tr class="winner__table" style="font-size: 12px;"><td>'+(key+1)+'</td>'+
                                            '<td>'+value[0]+'</td>'+
                                            '<td>'+value[1]+'</td>'+
                                            '<td>'+value[2]+'</td>'+
                                            '<td style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;">'+value[3]+','+value[4]+','+value[5]+'</td>'+
                                            '<td>'+value[6]+'</td>'+
                                            '<td style="font-weight: bold;">'+value[7]+'</td>'+
                                            '<td><a target="__blank" href="'+base_url+'Controller_Orders/printDiv/'+value[8]+'" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>'+
                                        '<a href="'+base_url+'Controller_Orders/update/'+value[8]+'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>'+
                                        '<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc1('+value[8]+')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>'+
                                            
                                            
                                            '</td>'+
                                        '</tr>');
          });
      }else{
          $('#invList').append('<tr class="winner__table"><td colspan="7"><?php echo lang('no_data_found'); ?></td> </tr>')
      }

      $('#quoList').empty();
      if(responseData.total_paid_orders.length > 0){
          $.each(responseData.total_paid_orders,function(key,value){
              
            $('#quoList').append(' <tr class="winner__table style="font-size: 12px;""><td>'+(key+1)+'</td>'+
                                            '<td>'+value[0]+'</td>'+
                                            '<td>'+value[1]+'</td>'+
                                            '<td>'+value[2]+'</td>'+
                                            '<td style="display: inline-block; width: 200px; white-space: nowrap; overflow: hidden !important; text-overflow: ellipsis;">'+value[3]+','+value[4]+','+value[5]+'</td>'+
                                            '<td>'+value[6]+'</td>'+
                                            '<td style="font-weight: bold;">'+value[7]+'</td>'+
                                            '<td><a target="__blank" href="'+base_url+'Controller_Orders/printDiv/'+value[8]+'" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>'+
                                        '<a href="'+base_url+'Controller_Orders/update/'+value[8]+'" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>'+
                                        '<button type="button" class="btn btn-danger btn-sm" onclick="removeFunc('+value[8]+')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>'+
                                        '</tr>');
          });
      }else{
          $('.quo .table-wrapper').css('height','height: 95px;')
          $('#quoList').append('<tr class="winner__table"><td colspan="7"><?php echo lang('no_data_found'); ?></td> </tr>')
      }
      $('#invProductList').empty();
      if(responseData.invoiceItem.length > 0){
       
          $.each(responseData.invoiceItem,function(key,value){
           
            $('#invProductList').append(' <tr class="winner__table" style="font-size: 12px;"><td>'+(key+1)+'</td>'+
                                            '<td>'+value.productname+'</td>'+
                                            '<td>'+value.producttype+'</td>'+
                                            '<td>'+value.qty+'</td>'+
                                            '<td>'+parseFloat(value.net_rate_amount).toFixed(2)+'</td>'+
                                        '</tr>');
          });
      }else{
          $('#invProductList').append('<tr class="winner__table"><td colspan="4"><?php echo lang('no_data_found'); ?></td> </tr>')
      }
      $('#quoProductList').empty();
      if(responseData.quotationItem.length > 0){
       
          $.each(responseData.quotationItem,function(key,value){
           
            $('#quoProductList').append(' <tr class="winner__table" style="font-size: 12px;"><td>'+(key+1)+'</td>'+
                                            '<td>'+value.productname+'</td>'+
                                            '<td>'+value.producttype+'</td>'+
                                            '<td>'+value.qty+'</td>'+
                                            '<td>'+parseFloat(value.net_rate_amount).toFixed(2)+'</td>'+
                                        '</tr>');
          });
      }else{
          $('#quoProductList').append('<tr class="winner__table"><td colspan="4"><?php echo lang('no_data_found'); ?></td> </tr>')
      }
    }
  });
}

function demoPdf(data) {
    var pdf = new jsPDF('l', 'pt', 'a4');
    source = $('#'+data)[0];
    specialElementHandlers = {
        '#bypassme': function (element, renderer) {
            return true
        }
    };
    margins = {
        top: 0,
   bottom: 0,
   left: 25,
   right: 25
    };
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },
    function (dispose) {
        pdf.save(data+'.pdf');
    }, margins);
}

function ExportToExcel(data,type, fn, dl) {
       var elt = document.getElementById(data);
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || (data+'.' + (type || 'xlsx')));
    }


    function printdiv(elem) {
  var header_str = '<html><head><title>' + document.title  + '</title></head><body>';
  var footer_str = '</body></html>';
  var new_str = document.getElementById(elem).innerHTML;
  var old_str = document.body.innerHTML;
  document.body.innerHTML = header_str + new_str + footer_str;
  window.print();
  document.body.innerHTML = old_str;
  return false;
}

</script>

