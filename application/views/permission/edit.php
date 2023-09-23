
<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                     <?php echo lang('edit_user_permission'); ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"> <?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('permission '); ?></li>
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
                                    <div class="box box-default">

        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
        <div class="col-md-12 col-xs-12">
          
         

        <form role="form" action="<?php base_url('Controller_Permission/update') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name"><?php echo lang('permission_name'); ?></label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter permission name" value="<?php echo $group_data['group_name']; ?>">
                </div>
                <div class="form-group">
                  <label for="permission"><?php echo lang('permission'); ?></label>

                  <?php $serialize_permission = unserialize($group_data['permission']); ?>
                  
                  <table class="table table-responsive">
                    <thead>
                      <tr>
                        <th></th>
                        <th><?php echo lang('create'); ?></th>
                        <th><?php echo lang('update'); ?></th>
                        <th><?php echo lang('view'); ?></th>
                        <th><?php echo lang('delete'); ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td><?php echo lang('members'); ?></td>
                        <td><input type="checkbox" class="minimal" name="permission[]" id="permission" class="minimal" value="createUser" <?php if($serialize_permission) {
                          if(in_array('createUser', $serialize_permission)) { echo "checked"; } 
                        } ?> ></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateUser" <?php 
                        if($serialize_permission) {
                          if(in_array('updateUser', $serialize_permission)) { echo "checked"; } 
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewUser" <?php 
                        if($serialize_permission) {
                          if(in_array('viewUser', $serialize_permission)) { echo "checked"; }   
                        }
                        ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteUser" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteUser', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('permission'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('createGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('updateGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('viewGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteGroup" <?php 
                        if($serialize_permission) {
                          if(in_array('deleteGroup', $serialize_permission)) { echo "checked"; }  
                        }
                         ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('items'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createBrand" <?php if($serialize_permission) {
                          if(in_array('createBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateBrand" <?php if($serialize_permission) {
                          if(in_array('updateBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewBrand" <?php if($serialize_permission) {
                          if(in_array('viewBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteBrand" <?php if($serialize_permission) {
                          if(in_array('deleteBrand', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('category'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCategory" <?php if($serialize_permission) {
                          if(in_array('createCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCategory" <?php if($serialize_permission) {
                          if(in_array('updateCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCategory" <?php if($serialize_permission) {
                          if(in_array('viewCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCategory" <?php if($serialize_permission) {
                          if(in_array('deleteCategory', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('warehouse'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createStore" <?php if($serialize_permission) {
                          if(in_array('createStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateStore" <?php if($serialize_permission) {
                          if(in_array('updateStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewStore" <?php if($serialize_permission) {
                          if(in_array('viewStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteStore" <?php if($serialize_permission) {
                          if(in_array('deleteStore', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('elements'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createAttribute" <?php if($serialize_permission) {
                          if(in_array('createAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateAttribute" <?php if($serialize_permission) {
                          if(in_array('updateAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewAttribute" <?php if($serialize_permission) {
                          if(in_array('viewAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteAttribute" <?php if($serialize_permission) {
                          if(in_array('deleteAttribute', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('products'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createProduct" <?php if($serialize_permission) {
                          if(in_array('createProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateProduct" <?php if($serialize_permission) {
                          if(in_array('updateProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewProduct" <?php if($serialize_permission) {
                          if(in_array('viewProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteProduct" <?php if($serialize_permission) {
                          if(in_array('deleteProduct', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('orders'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createOrder" <?php if($serialize_permission) {
                          if(in_array('createOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateOrder" <?php if($serialize_permission) {
                          if(in_array('updateOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewOrder" <?php if($serialize_permission) {
                          if(in_array('viewOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteOrder" <?php if($serialize_permission) {
                          if(in_array('deleteOrder', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td><?php echo lang('invoice'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createInvoice" <?php if($serialize_permission) {
                          if(in_array('createInvoice', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateInvoice" <?php if($serialize_permission) {
                          if(in_array('updateInvoice', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewInvoice" <?php if($serialize_permission) {
                          if(in_array('viewInvoice', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteInvoice" <?php if($serialize_permission) {
                          if(in_array('deleteInvoice', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <tr>
                        <td><?php echo lang('customer'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createCustomer" <?php if($serialize_permission) {
                          if(in_array('createCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCustomer" <?php if($serialize_permission) {
                          if(in_array('updateCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewCustomer" <?php if($serialize_permission) {
                          if(in_array('viewCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteCustomer" <?php if($serialize_permission) {
                          if(in_array('deleteCustomer', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <td><?php echo lang('vendor'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createVendor" <?php if($serialize_permission) {
                          if(in_array('createVendor', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateVendor" <?php if($serialize_permission) {
                          if(in_array('updateVendor', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewVendor" <?php if($serialize_permission) {
                          if(in_array('viewVendor', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deleteVendor" <?php if($serialize_permission) {
                          if(in_array('deleteVendor', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>

                      <td><?php echo lang('purchase'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="createPurchase" <?php if($serialize_permission) {
                          if(in_array('createPurchase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updatePurchase" <?php if($serialize_permission) {
                          if(in_array('updatePurchase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="viewPurchase" <?php if($serialize_permission) {
                          if(in_array('viewPurchase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="deletePurchase" <?php if($serialize_permission) {
                          if(in_array('deletePurchase', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                      </tr>
                     
                      <tr>
                        <td><?php echo lang('company'); ?></td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" class="minimal" value="updateCompany" <?php if($serialize_permission) {
                          if(in_array('updateCompany', $serialize_permission)) { echo "checked"; } 
                        } ?>></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                    
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo lang('update_&_close'); ?></button>
                <a href="<?php echo base_url('Controller_Permission/') ?>" class="btn btn-warning"><?php echo lang('back'); ?></a>
              </div>
            </form>
          </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- col-md-12 -->
      </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
       
      </div>
                                    </div>
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>


<script type="text/javascript">
  $(document).ready(function() {
    $("#mainGroupNav").addClass('active');
    $("#manageGroupNav").addClass('active');

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    });
  });
</script>
