

<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                    <?php echo lang('edit_products'); ?>
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
                                    <form role="form" action="<?php base_url('users/update') ?>" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="text-danger"><?php echo validation_errors(); ?></div>
                <div class="form-group col-md-12">
                  <label><?php echo lang('image_preview'); ?>: </label>
                  <img src="<?php echo base_url() . $product_data['image'] ?>" width="80" height="80" class="img-circle">
                </div>
                <div class="form-group col-md-12">

                  <label for="product_image"><?php echo lang('update_image'); ?></label>
                  <div class="kv-avatar">
                      <div class="file-loading">
                          <input id="product_image" name="product_image" type="file">
                      </div>
                  </div>
                </div>

                <div class="col-md-12 d-flex">
                <div class="form-group col-md-6">
                  <label for="product_name"><?php echo lang('product_name'); ?></label>
                  <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name" autocomplete="off" value="<?php echo $product_data['name']; ?>" required/>
                </div>
                <div class="form-group col-md-3" >
                  <label for="price">MRP</label>
                  <input type="text" class="form-control" id="mrp" name="mrp" placeholder="Enter MRP" value="<?php echo $product_data['mrp']; ?>" autocomplete="off" required/>
                </div>
                <div class="form-group col-md-6" >
                  <label for="price"><?php echo lang('price'); ?></label>
                  <input type="text" class="form-control" id="price" name="price" placeholder="Enter price" value="<?php echo $product_data['price']; ?>" autocomplete="off" required/>
                </div>
                </div>
                <div class="col-md-12 d-flex">
                <div class="form-group col-md-3">
                  <label for="qty"><?php echo lang('quotation'); ?> <?php echo lang('qty'); ?></label>
                  <input type="text" class="form-control" id="quqty" name="quqty" placeholder="Enter Quatation Qty" autocomplete="off" value="<?php echo $product_data['quotation_qty']; ?>"/>
                </div>
                <div class="form-group col-md-3">
                  <label for="qty"><?php echo lang('invoice'); ?> <?php echo lang('qty'); ?></label>
                  <input type="text" class="form-control" id="inqty" name="inqty" placeholder="Enter Invoice Qty" autocomplete="off" value="<?php echo $product_data['invoice_qty']; ?>"/>
                </div>

                <div class="form-group col-md-6">
                  <label for="qty"><?php echo lang('type'); ?> </label>
                  <select class="form-control select_group" id="product_type" name="product_type" value="<?php echo $product_data['product_type']; ?>">
                    <option value="Piece" <?php if($product_data['product_type'] == "Piece") { echo 'selected="selected"'; } ?>><?php echo lang('piece'); ?></option>
                    <option value="Kgs" <?php if($product_data['product_type'] == "Kgs") { echo 'selected="selected"'; } ?>><?php echo lang('kgs'); ?></option>
                    <option value="SquareFeet" <?php if($product_data['product_type'] == "SquareFeet") { echo 'selected="selected"'; } ?>><?php echo lang('square_feet'); ?></option>
                    <option value="SquareMeter" <?php if($product_data['product_type'] == "SquareMeter") { echo 'selected="selected"'; } ?>>Square Meter</option>
                  </select>
                </div>
                </div>
                <div class="col-md-12 d-flex">
                <div class="form-group col-md-6">
                  <label for="category"><?php echo lang('category'); ?></label>
                  <?php $category_data = json_decode($product_data['category_id']); ?>
                  <select class="form-control select_group" id="category" name="category[]" >
                  <?php foreach ($category as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>" <?php if(in_array($v['id'], $category_data)) { echo 'selected="selected"'; } ?>><?php echo $v['name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="form-group col-md-6">
                  <label for="store"><?php echo lang('availability'); ?></label>
                  <select class="form-control" id="availability" name="availability">
                  <option value="1" <?php if($product_data['availability'] == 1) { echo "selected='selected'"; } ?>><?php echo lang('yes'); ?></option>
                    <option value="2" <?php if($product_data['availability'] != 1) { echo "selected='selected'"; } ?>><?php echo lang('no'); ?></option>
                  </select>
                </div>
                </div>

                <div class="col-md-12 d-flex">
                <div class="form-group col-md-6">
                  <label for="category">SGST</label>
                  <input type="text" class="form-control" id="sgst" name="sgst" pattern="[.0-9]+" title="please enter number only" placeholder="Enter SGST" autocomplete="off" value="<?php echo $product_data['sgst_tax']; ?>" required/>
                </div>
                <div class="form-group col-md-6">
                  <label for="store">CGST</label>
                  <input type="text" class="form-control" id="cgst" name="cgst" pattern="[.0-9]+" title="please enter number only" placeholder="Enter CGST" autocomplete="off" value="<?php echo $product_data['cgst_tax']; ?>" required/>
                </div>
                </div>
                <div class="col-md-12 d-flex">
                <div class="form-group col-md-6">
                  <label for="category">HSN</label>
                  <input type="text" class="form-control" id="hsn" name="hsn" placeholder="Enter HSN" value="<?php echo $product_data['hsn']; ?>" autocomplete="off" required/>
                </div>
                </div>

                <div class="form-group col-md-12">
                  <label for="description"><?php echo lang('description'); ?></label>
                  <textarea type="text" class="form-control" id="description" name="description" placeholder="Enter 
                  description" autocomplete="off">
                  <?php echo $product_data['description']; ?>
                  </textarea>
                </div>

                <!-- <?php if($attributes): ?>
                  <?php foreach ($attributes as $k => $v): ?>
                    <div class="form-group">
                      <label for="groups"><?php echo $v['attribute_data']['name'] ?></label>
                      <select class="form-control select_group" id="attributes_value_id" name="attributes_value_id[]" multiple="multiple">
                        <?php foreach ($v['attribute_value'] as $k2 => $v2): ?>
                          <option value="<?php echo $v2['id'] ?>"><?php echo $v2['value'] ?></option>
                        <?php endforeach ?>
                      </select>
                    </div>    
                  <?php endforeach ?>
                <?php endif; ?> -->
              </div>
              <!-- /.box-body -->

              <div class="box-footer col-md-12">
                <button type="submit" class="btn btn-primary"><?php echo lang('save_changes'); ?></button>
                <a href="<?php echo base_url('Controller_Products/') ?>" class="btn btn-warning"><?php echo lang('back'); ?></a>
              </div>
            </form>
                                    </div>
                                </div>
                            </div> <!-- end col -->
       
        <!-- end row -->


    </div> <!-- container-fluid -->
</div>

<script type="text/javascript">
  
  $(document).ready(function() {
    $(".select_group").select2();
    $("#description").wysihtml5();

    $("#mainProductNav").addClass('active');
    $("#manageProductNav").addClass('active');
    
    var btnCust = '<button type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: '<i class="">Image</i>',
        removeIcon: '<i class="">Remove</i>',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        // layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>