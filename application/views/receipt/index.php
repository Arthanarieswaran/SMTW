
<style>
  .datepicker{
  z-index: 9999999 !important;
}
.select2-container {
  width: 100% !important;
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
                  Manage Receipts
                    <?php if(in_array('createCustomer', $user_permission)): ?>
                      <button class="btn btn-primary" style="padding:0 5px !important;" data-toggle="modal" data-target="#addModal">Add Receipt</button>
                    <?php endif; ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active">Receipt</li>
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
                                        <table id="manageTable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                          <tr>
                                          <th><?php echo lang('s_no'); ?></th>
                                          <th><?php echo lang('date'); ?></th>
                                          <th><?php echo lang('name'); ?></th>
                                          <th><?php echo lang('mobile'); ?></th>
                                          <th><?php echo lang('amount'); ?></th>
                                          <th><?php echo lang('balance'); ?> <?php echo lang('amount'); ?></th>
                                          <th><?php echo lang('description'); ?></th>
                                          <th><?php echo lang('payment_mode'); ?></th>
                                          <?php if(in_array('updateCustomer', $user_permission) || in_array('deleteCustomer', $user_permission)): ?>
                                            <th><?php echo lang('action'); ?></th>
                                          <?php endif; ?>
                                          </tr>
                                          </thead>
                                        </table>
                                    </div>
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>
<?php if(in_array('createCustomer', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="staticBackdropLabel">Add Receipt</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>

      <form role="form" action="<?php echo base_url('Controller_Receipt/create') ?>" method="post" id="createForm">

        <div class="modal-body" style="padding : 0 !important;">
   
        <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"> <?php echo lang('customer'); ?></label>
            <select class="form-control select_group customer" id="customer_id" name="customer_id" required>
                            <option value="">Select</option>
                            <?php foreach ($customers as $m => $n): ?>
                              <option value="<?php echo $n['id'] ?>"><?php echo $n['name'].' - '.$n['mobile'].' - '.$n['address1']  ?></option>
                            <?php endforeach ?>
                          </select>
        </div>
   
        <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('amount'); ?></label>
            <input type="text" class="form-control" id="amount" name="amount" placeholder="Amount" autocomplete="off" required>
         
          </div>
     
          <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('description'); ?></label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Description" autocomplete="off" required>
         
          </div>
         
          <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('date'); ?></label>
            <input type="text" class="form-control" id="inv_date" name="inv_date" value="<?php echo date("d-m-Y") ?>" autocomplete="off" required>
         
          </div>
     
          <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('payment_mode'); ?></label>
            <select class="form-control select_group customer" id="payment_mode" name="payment_mode" required>
                            <option value="">Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Online">Online</option>
                            <option value="Cheque">Cheque</option>
                          </select>
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
<?php endif; ?>

<?php if(in_array('updateCustomer', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="staticBackdropLabel">Edit Receipt</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>

      <form role="form" action="<?php echo base_url('Controller_Receipt/update') ?>" method="post" id="updateForm">

        <div class="modal-body" style="padding : 0 !important;">
          <div id="messages"></div>
          &nbsp;
        <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"> <?php echo lang('customer'); ?></label>
            <select class="form-control select_group customer" id="edit_customer_id" name="edit_customer_id" required >
                            <option value="">Select</option>
                            <?php foreach ($customers as $m => $n): ?>
                              <option value="<?php echo $n['id'] ?>" ><?php echo $n['name'].' - '.$n['mobile'].' - '.$n['address1']  ?></option>
                            <?php endforeach ?>
                          </select>
        </div>
        <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('amount'); ?></label>
            <input type="text" class="form-control" id="edit_amount" name="edit_amount" placeholder="Amount" autocomplete="off" required>
         
          </div>
          <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('description'); ?></label>
            <input type="text" class="form-control" id="edit_description" name="edit_description" placeholder="Description" autocomplete="off" required>
         
          </div>
          <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('date'); ?></label>
            <input type="text" class="form-control" id="edit_inv_date" name="edit_inv_date" value="<?php echo date("d-m-Y") ?>" autocomplete="off" required>
         
          </div>
          <div class="col-md-12 ">
            <label for="brand_name" style="margin: 5px 0 4px 0px;"><?php echo lang('payment_mode'); ?></label>
            <select class="form-control select_group payment_mode" id="edit_payment_mode" name="edit_payment_mode" required>
                            <option value="">Select</option>
                            <option value="Cash">Cash</option>
                            <option value="Online">Online</option>
                            <option value="Cheque">Cheque</option>
                          </select>
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
<?php endif; ?>

<?php if(in_array('deleteCustomer', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title" id="staticBackdropLabel">Remove Receipt</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>

      <form role="form" action="<?php echo base_url('Controller_Receipt/remove') ?>" method="post" id="removeForm">
        <div class="modal-body">
          <p><?php echo lang('do_you_really_want_to_remove'); ?>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
          <button type="submit" class="btn btn-danger"><?php echo lang('delete'); ?></button>
        </div>
      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>



<script type="text/javascript">
var manageTable;

$(document).ready(function() {

  $('#inv_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    endDate: "now",
    immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
  });

  $('#edit_inv_date').datepicker({
    format: 'dd-mm-yyyy',
    autoclose: true,
    endDate: "now",
    immediateUpdates: true,
            todayBtn: true,
            todayHighlight: true
  });

  $("#storeNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    dom: 'Bfrtip',
    'ajax': 'fetchStoresData',
    'order': []
  });

  // submit the create from 
  $("#createForm").unbind('submit').on('submit', function() {
    var form = $(this);

    // remove the text-danger
    $(".text-danger").remove();

    $.ajax({
      url: form.attr('action'),
      type: form.attr('method'),
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success:function(response) {

        manageTable.ajax.reload(null, false); 

        if(response.success === true) {
          $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
            '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
            '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
          '</div>');


          // hide the modal
         

          // reset the form
          $("#createForm")[0].reset();
          $("#createForm .form-group").removeClass('has-error').removeClass('has-success');

        } else {

          if(response.messages instanceof Object) {
            $.each(response.messages, function(index, value) {
              var id = $("#"+index);

              id.closest('.form-group')
              .removeClass('has-error')
              .removeClass('has-success')
              .addClass(value.length > 0 ? 'has-error' : 'has-success');
              
              id.after(value);

            });
          } else {
            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>');
          }
        }
        $("#addModal").modal('hide');
      }
    }); 

    return false;
  });

});

// edit function
function editFunc(id)
{ 
  $.ajax({
    url: 'fetchStoresDataById/'+id,
    type: 'post',
    dataType: 'json',
    success:function(responseData) {
      var response = responseData[0];
      var history = responseData[1];
      $("#edit_customer_id").val(response.customer_id);
      $("#edit_amount").val(response.amount);
      $("#edit_description").val(response.description);
      $("#edit_payment_mode").val(response.payment_method);
      var d=new Date(response.date * 1000);
      var day = moment(d).format('DD-MM-YYYY');
      $("#edit_inv_date").val(day);

      // submit the edit from 
      $("#updateForm").unbind('submit').bind('submit', function() {
        var form = $(this);

        // remove the text-danger
        $(".text-danger").remove();

        $.ajax({
          url: form.attr('action') + '/' + id,
          type: form.attr('method'),
          data: form.serialize(), // /converting the form data into array and sending it to server
          dataType: 'json',
          success:function(response) {

            manageTable.ajax.reload(null, false); 

            if(response.success === true) {
              $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
              '</div>');
              // reset the form 
              $("#updateForm .form-group").removeClass('has-error').removeClass('has-success');

            } else {

              if(response.messages instanceof Object) {
                $.each(response.messages, function(index, value) {
                  var id = $("#"+index);

                  id.closest('.form-group')
                  .removeClass('has-error')
                  .removeClass('has-success')
                  .addClass(value.length > 0 ? 'has-error' : 'has-success');
                  
                  id.after(value);

                });
              } else {
                $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
                  '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
                '</div>');
              }
            }
            $("#editModal").modal('hide');
              // $(".modal-backdrop.in").hide();
          }
        }); 

        return false;
      });

    }
  });
}

// remove functions 
function removeFunc(id)
{
  if(id) {
    $("#removeForm").on('submit', function() {

      var form = $(this);

      // remove the text-danger
      $(".text-danger").remove();

      $.ajax({
        url: form.attr('action'),
        type: form.attr('method'),
        data: { store_id:id }, 
        dataType: 'json',
        success:function(response) {

          manageTable.ajax.reload(null, false); 

          if(response.success === true) {
            $("#messages").html('<div class="alert alert-success alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-ok-sign"></span> </strong>'+response.messages+
            '</div>');

            // hide the modal
            $("#removeModal").hide();
            $(".modal-backdrop.in").hide();

          } else {

            $("#messages").html('<div class="alert alert-warning alert-dismissible" role="alert">'+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'+
              '<strong> <span class="glyphicon glyphicon-exclamation-sign"></span> </strong>'+response.messages+
            '</div>'); 
          }
        }
      }); 

      return false;
    });
  }
}

$(function(){
  $(".customer").select2();
})
</script>
