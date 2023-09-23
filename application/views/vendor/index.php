<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                    <?php echo lang('manage_vendor'); ?>
                    <?php if(in_array('createVendor', $user_permission)): ?>
                      <button class="btn btn-primary"  style="padding:0 5px !important;" data-toggle="modal" data-target="#addModal">Add Vendor</button>
                      
                    <?php endif; ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('vendor'); ?></li>
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
                                          <th><?php echo lang('name'); ?></th>
                                          <th><?php echo lang('mobile'); ?></th>
                                          <th><?php echo lang('gst_no'); ?></th>
                                          <th><?php echo lang('balance'); ?></th>
                                          <th><?php echo lang('address'); ?></th>
                                          <th><?php echo lang('district'); ?></th>
                                          <?php if(in_array('updateVendor', $user_permission) || in_array('deleteVendor', $user_permission)): ?>
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

<?php if(in_array('createVendor', $user_permission)): ?>
<!-- create brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="addModal" data-backdrop="static">
  <div class="modal-dialog" role="document" >
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"><?php echo lang('add_vendor'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vendor/create') ?>" method="post" id="createForm">

        <div class="modal-body" style="padding : 0 !important;">
        <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name"> <?php echo lang('name'); ?></label>
            <input type="text" class="form-control" id="vendor_name" name="vendor_name" placeholder="Enter name" autocomplete="off" required>
          </div>

          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('mobile_number'); ?></label>
            <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter Mobile Number" autocomplete="off" required>
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
            <label for="active"><?php echo lang('taluk'); ?></label>
            <input type="text" class="form-control" id="taluk" name="taluk" placeholder="Enter Taluk" autocomplete="off" required>

          </div>

          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('district'); ?></label>
            <input type="text" class="form-control" id="district" name="district" placeholder="Enter District" autocomplete="off" required>

          </div>
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('state'); ?></label>
            <input type="text" class="form-control" id="state" name="state" placeholder="Enter State" autocomplete="off" required>

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
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><?php echo lang('save_changes'); ?></button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('updateVendor', $user_permission)): ?>
<!-- edit brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="editModal" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"><?php echo lang('edit_vendor'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vendor/update') ?>" method="post" id="updateForm">

        <div class="modal-body" style="padding : 0 !important;">
          <div id="messages"></div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name"> <?php echo lang('name'); ?></label>
            <input type="text" class="form-control" id="edit_vendor_name" name="edit_vendor_name" placeholder="Enter name" autocomplete="off">
          </div>
          
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('mobile_number'); ?></label>
            <input type="text" class="form-control" id="edit_mobile" name="edit_mobile" placeholder="Enter Mobile Number" autocomplete="off">
          </div>
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('address'); ?> 1</label>
            <input type="text" class="form-control" id="edit_address1" name="edit_address1" placeholder="Enter Address1" autocomplete="off">
          </div>
          
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('address'); ?> 2</label>
            <input type="text" class="form-control" id="edit_address2" name="edit_address2" placeholder="Enter address2" autocomplete="off">
          </div>
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('taluk'); ?></label>
            <input type="text" class="form-control" id="edit_taluk" name="edit_taluk" placeholder="Enter Taluk" autocomplete="off" required>
           
          </div>
          
          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('district'); ?></label>
            <input type="text" class="form-control" id="edit_district" name="edit_district" placeholder="Enter District" autocomplete="off" required>
          
          </div>
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="active"><?php echo lang('state'); ?></label>
            <input type="text" class="form-control" id="edit_state" name="edit_state" placeholder="Enter State" autocomplete="off" required>
          
          </div>
          
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('gst_number'); ?></label>
            <input type="text" class="form-control" id="edit_gst_no" name="edit_gst_no" placeholder="Enter GST number" autocomplete="off">
          </div>
          </div>
          <div class="col-md-12 d-flex">
          <div class="form-group col-md-6">
            <label for="brand_name"><?php echo lang('balance'); ?></label>
            <input type="text" class="form-control" value="0" id="edit_balance_amt" name="edit_balance_amt" placeholder="Enter GST number" autocomplete="off">
          </div>
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary"><?php echo lang('save_changes'); ?></button>
        </div>

      </form>


    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php endif; ?>

<?php if(in_array('deleteVendor', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"><?php echo lang('remove_vendor'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      
      </div>

      <form role="form" action="<?php echo base_url('Controller_Vendor/remove') ?>" method="post" id="removeForm">
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
          $("#addModal").modal('hide');
          // $(".modal-backdrop.in").hide();
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
      $("#edit_vendor_name").val(response.name);
      $("#edit_mobile").val(response.mobile);
      $("#edit_address1").val(response.address1);
      $("#edit_address2").val(response.address2);
      $("#edit_taluk").val(response.taluk);
      $("#edit_district").val(response.district);
      $("#edit_gst_no").val(response.gst_no);
      $("#edit_state").val(response.state);
      if(history){
        $("#edit_balance_amt").val(history.vendor_bal);
      }else{
        $("#edit_balance_amt").val(0);
      }
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


              // hide the modal
              $("#editModal").modal('hide');
              // $(".modal-backdrop.in").hide();
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
            $("#removeModal").modal('hide');
            // $(".modal-backdrop.in").hide();

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


</script>