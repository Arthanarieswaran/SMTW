
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                    Customer View
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"> Customer View</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
      <div class="col-md-12 col-xs-12">

        </div>
        </div>
        <div class="row">
        <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <h4>Customer Details : </h4>
                                    &nbsp;
                                            <div class="row">
                                                <div class="col-md-4">
                                                    Name : <b><?php echo($view['name']); ?></b>
                                                </div>
                                                <div class="col-md-4">
                                                    Mobile : <b><?php echo($view['mobile']); ?></b>
                                                </div>
                                                <div class="col-md-4">
                                                    GST : <b><?php echo($view['gst_no']); ?></b>
                                                </div>
                                            </div>
                                            <br>
                                          
                                            <div class="row">
                                                <div class="col-md-12">
Address : <b><?php echo($view['address1']); ?>,<?php echo($view['address2']); ?>,<?php echo($view['taluk']); ?>,<?php echo($view['district']); ?></b>
                                                </div>
                                                </div>
                                                <br>
                                                <hr>
<h4>Quotation List : </h4>
                                                <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th> <?php echo lang('date'); ?></th>
                                    <th><?php echo lang('bill_no'); ?></th>
                                    <th><?php echo lang('total'); ?></th>
                                    <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="quoList">
                                <?php if(count($quo) > 0): ?>
                                <?php foreach($quo as $key => $order): ?>
                                    <tr class="winner__table">
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo date('d/m/Y', $order['date_time']) ?></td>
                                        <td><?php echo $order['bill_no'] ?></td>
                                        <td><?php echo $order['net_amount'] ?></td>
                                        <td>
                                        <a target="__blank" href=<?php echo base_url("Controller_Orders/printDiv/".$order['id'])?> class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>
                                        <a href="<?php echo base_url('Controller_Orders/update/'.$order['id'])?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <!-- <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(<?php echo $order['id']?>)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button> -->
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

<hr>

                            <h4>Invoice List : </h4>
                                                <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th> <?php echo lang('date'); ?></th>
                                    <th><?php echo lang('bill_no'); ?></th>
                                    <th><?php echo lang('total'); ?></th>
                                    <th><?php echo lang('action'); ?></th>
                                    </tr>
                                </thead>
                                <tbody id="quoList">
                                <?php if(count($inv) > 0): ?>
                                <?php foreach($inv as $key => $invoice): ?>
                                    <tr class="winner__table">
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo date('d/m/Y', $invoice['date_time']) ?></td>
                                        <td><?php echo $invoice['bill_no'] ?></td>
                                        <td><?php echo $invoice['net_amount'] ?></td>
                                        <td>
                                        <a target="__blank" href=<?php echo base_url("Controller_Orders/printDiv/".$invoice['id'])?> class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>
                                        <a href="<?php echo base_url('Controller_Orders/update/'.$invoice['id'])?>" class="btn btn-warning btn-sm"><i class="fa fa-pencil"></i></a>
                                        <!-- <button type="button" class="btn btn-danger btn-sm" onclick="removeFunc(<?php echo $invoice['id']?>)" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button> -->
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

                            <hr>
                            <h4>Receipt List : </h4>
                                                <table class="table table-centered  mb-0">
                                <thead class="thead-light">
                                    <tr>
                                    <th><?php echo lang('v_n'); ?></th>
                                    <th> <?php echo lang('date'); ?></th>
                                    <th><?php echo lang('amount'); ?></th>
                                    <th><?php echo lang('description'); ?></th>
                                   
                                    </tr>
                                </thead>
                                <tbody id="quoList">
                                <?php if(count($receipt) > 0): ?>
                                <?php foreach($receipt as $key => $receipts): ?>
                                    <tr class="winner__table">
                                        <td><?php echo $key+1 ?></td>
                                        <td><?php echo date('d/m/Y', $receipts['date']) ?></td>
                                        <td>Rs. <?php echo $receipts['amount'] ?></td>
                                        <td><?php echo $receipts['description'] ?></td>
                                        
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
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>


<script type="text/javascript">
 
</script>