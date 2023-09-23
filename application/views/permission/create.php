<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                     <?php echo lang('user_permission'); ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('permission'); ?></li>
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
          
         

            <form role="form" action="<?php base_url('Controller_Permission/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>

                <div class="form-group">
                  <label for="group_name"><?php echo lang('permission_name'); ?></label>
                  <input type="text" class="form-control" id="group_name" name="group_name" placeholder="Enter group name">
                </div>
                <div class="form-group">
                  <label for="permission"><?php echo lang('permission'); ?></label>

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
                        <td><input type="checkbox" name="permission[]" id="permission" value="createUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewUser" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteUser" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('permission'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewGroup" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteGroup" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('items'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewBrand" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteBrand" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('category'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCategory" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCategory" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('warehouse'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewStore" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteStore" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('elements'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewAttribute" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteAttribute" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('products'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewProduct" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteProduct" class="minimal"></td>
                      </tr>
                      <tr>
                        <td><?php echo lang('orders'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewOrder" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteOrder" class="minimal"></td>
                      </tr>

                      <tr>
                        <td><?php echo lang('invoice'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createInvoice" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateInvoicer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewInvoice" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteInvoice" class="minimal"></td>
                      </tr>

                      <tr>
                        <td><?php echo lang('customer'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewCustomer" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteCustomer" class="minimal"></td>
                      </tr>

                      <tr>
                        <td><?php echo lang('vendor'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createVendor" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateVendor" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewVendor" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deleteVendor" class="minimal"></td>
                      </tr>

                      <tr>
                        <td><?php echo lang('purchase'); ?></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="createPurchase" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updatePurchase" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="viewPurchase" class="minimal"></td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="deletePurchase" class="minimal"></td>
                      </tr>
                      
                      <tr>
                        <td><?php echo lang('company'); ?></td>
                        <td> - </td>
                        <td><input type="checkbox" name="permission[]" id="permission" value="updateCompany" class="minimal"></td>
                        <td> - </td>
                        <td> - </td>
                      </tr>
                  
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo lang('save_&_close'); ?></button>
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
