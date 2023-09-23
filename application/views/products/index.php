
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                     <?php echo lang('manage_products'); ?>
                    <?php if(in_array('createProduct', $user_permission)): ?>
                      <a href="<?php echo base_url('Controller_Products/create') ?>" style="padding:0 5px !important;" class="btn btn-primary">Add Product</a>
                    
                    <?php endif; ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('products'); ?></li>
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
                                          <th><?php echo lang('image'); ?></th>
                                          
                                          <th><?php echo lang('product_name'); ?></th>
                                          <th><?php echo lang('price'); ?></th>
                                          <th><?php echo lang('quotation'); ?> <?php echo lang('qty'); ?></th>
                                          <th><?php echo lang('invoice'); ?> <?php echo lang('qty'); ?></th>
                                          <th><?php echo lang('category'); ?></th>
                                          <th><?php echo lang('type'); ?></th>
                                          <th><?php echo lang('availability'); ?></th>
                                          <?php if(in_array('updateProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
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

<?php if(in_array('deleteProduct', $user_permission)): ?>
<!-- remove brand modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeModal" data-backdrop="static">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title"><?php echo lang('remove_product'); ?></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       
      </div>

      <form role="form" action="<?php echo base_url('Controller_Products/remove') ?>" method="post" id="removeForm">
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
var base_url = "<?php echo base_url(); ?>";

$(document).ready(function() {

  $("#mainProductNav").addClass('active');

  // initialize the datatable 
  manageTable = $('#manageTable').DataTable({
    dom: 'Bfrtip',
    'ajax': base_url + 'Controller_Products/fetchProductData',
    'order': []
  });

});

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
        data: { product_id:id }, 
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