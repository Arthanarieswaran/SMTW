<div class="vertical-menu">

<!-- LOGO -->
<div class="navbar-brand-box">
    <a href="/dashboard" class="logo logo-dark">
        <span class="logo-sm">
        <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50" style="margin-left: -12px;">
        </span>
        <span class="logo-lg">
        <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50"> <span>SMTW</span>
        </span>
    </a>

    <a href="/dashboard" class="logo logo-light">
        <span class="logo-sm">
        <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50"> SMTW
        </span>
        <span class="logo-lg">
        <img src="<?php echo base_url('assets/images/logo123.png')?>" width="50"> SMTW
        </span>
    </a>
</div>

<button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect vertical-menu-btn">
    <i class="fa fa-fw fa-bars"></i>
</button>

<div data-simplebar class="sidebar-menu-scroll">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <!-- Left Menu Start -->
        <ul class="metismenu list-unstyled" id="side-menu">
            <li class="menu-title">Menu</li>

            <li>
            <a href="<?php echo base_url('dashboard') ?>">
            <i class="fa fa-dashboard"></i> <span><?php echo lang('dashboard'); ?></span>
            </a>
            </li>
            <?php if(in_array('createCategory', $user_permission) || in_array('updateCategory', $user_permission) || in_array('viewCategory', $user_permission) || in_array('deleteCategory', $user_permission)): ?>
            <li id="categoryNav">
              <a href="<?php echo base_url('Controller_Category/') ?>">
                <i class="fa fa-cubes"></i> <span><?php echo lang('category'); ?></span>
              </a>
            </li>
            <?php endif; ?>
            <?php if(in_array('createCustomer', $user_permission) || in_array('updateCustomer', $user_permission) || in_array('viewCustomer', $user_permission) || in_array('deleteCustomer', $user_permission)): ?>
            <li id="storeNav">
              <a href="<?php echo base_url('Controller_Customer/') ?>">
                <i class="fa fa-user"></i> <span><?php echo lang('customer'); ?></span>
              </a>
            </li>
          <?php endif; ?>
          <!-- <?php if(in_array('createAttribute', $user_permission) || in_array('updateAttribute', $user_permission) || in_array('viewAttribute', $user_permission) || in_array('deleteAttribute', $user_permission)): ?>
          <li id="attributeNav">
            <a href="<?php echo base_url('Controller_Element/') ?>">
              <i class="fa fa-files-o"></i> <span><?php echo lang('elements'); ?></span>
            </a>
          </li>
          <?php endif; ?> -->

          <?php if(in_array('createProduct', $user_permission) || in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
            <li>
                <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-cube"></i>
                    <span><?php echo lang('products'); ?></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                <?php if(in_array('createProduct', $user_permission)): ?>
                  <li id="addProductNav"><a href="<?php echo base_url('Controller_Products/create') ?>"><i class="fa fa-circle-o"></i><?php echo lang('add_product'); ?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateProduct', $user_permission) || in_array('viewProduct', $user_permission) || in_array('deleteProduct', $user_permission)): ?>
                <li id="manageProductNav"><a href="<?php echo base_url('Controller_Products') ?>"><i class="fa fa-circle-o"></i><?php echo lang('manage_products'); ?></a></li>
                <?php endif; ?>
                </ul>
            </li>
            <?php endif; ?>

            <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li>
              <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-inr"></i>
                    <span><?php echo lang('orders'); ?></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                <?php if(in_array('createOrder', $user_permission)): ?>
                  <li id="addOrderNav"><a href="<?php echo base_url('Controller_Orders/create') ?>"><i class="fa fa-circle-o"></i><?php echo lang('add_order'); ?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageOrdersNav"><a href="<?php echo base_url('Controller_Orders') ?>"><i class="fa fa-circle-o"></i><?php echo lang('manage_orders'); ?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createOrder', $user_permission) || in_array('updateOrder', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
            <li>
              <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-inr"></i>
                    <span><?php echo lang('invoice'); ?></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                
                  <li id="addInvoiceNav"><a href="<?php echo base_url('Controller_Invoice/create') ?>"><i class="fa fa-circle-o"></i><?php echo lang('add_invoice'); ?></a></li>
              
                <?php if(in_array('createInvoice', $user_permission) || in_array('viewOrder', $user_permission) || in_array('deleteOrder', $user_permission)): ?>
                <li id="manageInvoiceNav"><a href="<?php echo base_url('Controller_Invoice') ?>"><i class="fa fa-circle-o"></i><?php echo lang('manage_invoice'); ?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

          <?php if(in_array('createVendor', $user_permission) || in_array('updateVendor', $user_permission) || in_array('viewVendor', $user_permission) || in_array('deleteVendor', $user_permission)): ?>
            <li id="VendorNav">
              <a href="<?php echo base_url('Controller_Vendor/') ?>">
                <i class="fa fa-user"></i> <span><?php echo lang('vendor'); ?></span>
              </a>
            </li>
          <?php endif; ?>




          <?php if(in_array('createPurchase', $user_permission) || in_array('updatePurchase', $user_permission) || in_array('viewPurchase', $user_permission) || in_array('deletePurchase', $user_permission)): ?>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-users"></i>
                    <span><?php echo lang('quotation'); ?> <?php echo lang('purchase'); ?></span>
                </a>
              <ul class="sub-menu" aria-expanded="false">
              <?php if(in_array('createPurchase', $user_permission)): ?>
              <li id="createPurchaseNav"><a href="<?php echo base_url('Controller_Purchase/create') ?>"><i class="fa fa-circle-o"></i><?php echo lang('add_purchase'); ?></a></li>
              <?php endif; ?>

              <?php if(in_array('updatePurchase', $user_permission) || in_array('viewPurchase', $user_permission) || in_array('deletePurchase', $user_permission)): ?>
              <li id="managePurchaseNav"><a href="<?php echo base_url('Controller_Purchase') ?>"><i class="fa fa-circle-o"></i><?php echo lang('manage_purchase'); ?></a></li>
            <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(in_array('createPurchase', $user_permission) || in_array('updatePurchase', $user_permission) || in_array('viewPurchase', $user_permission) || in_array('deletePurchase', $user_permission)): ?>
            <li>
            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-users"></i>
                    <span><?php echo lang('invoice'); ?> <?php echo lang('purchase'); ?></span>
                </a>
              <ul class="sub-menu" aria-expanded="false">
              <?php if(in_array('createPurchase', $user_permission)): ?>
              <li id="createnPurchaseNav"><a href="<?php echo base_url('Controller_InPurchase/create') ?>"><i class="fa fa-circle-o"></i><?php echo lang('add_inpurchase'); ?></a></li>
              <?php endif; ?>

              <?php if(in_array('updatePurchase', $user_permission) || in_array('viewPurchase', $user_permission) || in_array('deletePurchase', $user_permission)): ?>
              <li id="manageInPurchaseNav"><a href="<?php echo base_url('Controller_InPurchase') ?>"><i class="fa fa-circle-o"></i><?php echo lang('manage_inpurchase'); ?></a></li>
            <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(in_array('createCustomer', $user_permission) || in_array('updateCustomer', $user_permission) || in_array('viewCustomer', $user_permission) || in_array('deleteCustomer', $user_permission)): ?>
            <li id="receiptNav">
              <a href="<?php echo base_url('Controller_Receipt/') ?>">
                <i class="fa fa-list"></i> <span>Receipt</span>
              </a>
            </li>
          <?php endif; ?>

          <?php if($user_permission): ?>
          <?php if(in_array('createUser', $user_permission) || in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
            <li >

            <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-users"></i>
                    <span><?php echo lang('members'); ?></span>
                </a>

              <ul class="sub-menu" aria-expanded="false">
              <?php if(in_array('createUser', $user_permission)): ?>
              <li id="createUserNav"><a href="<?php echo base_url('Controller_Members/create') ?>"><i class="fa fa-circle-o"></i> <?php echo lang('add_members'); ?></a></li>
              <?php endif; ?>

              <?php if(in_array('updateUser', $user_permission) || in_array('viewUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
              <li id="manageUserNav"><a href="<?php echo base_url('Controller_Members') ?>"><i class="fa fa-circle-o"></i> <?php echo lang('manage_members'); ?></a></li>
            <?php endif; ?>
            </ul>
          </li>
          <?php endif; ?>

          <?php if(in_array('createGroup', $user_permission) || in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
            <li >
              <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-recycle"></i>
                    <span><?php echo lang('permission'); ?></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                <?php if(in_array('createGroup', $user_permission)): ?>
                  <li id="addGroupNav"><a href="<?php echo base_url('Controller_Permission/create') ?>"><i class="fa fa-circle-o"></i><?php echo lang('add_permission'); ?></a></li>
                <?php endif; ?>
                <?php if(in_array('updateGroup', $user_permission) || in_array('viewGroup', $user_permission) || in_array('deleteGroup', $user_permission)): ?>
                <li id="manageGroupNav"><a href="<?php echo base_url('Controller_Permission') ?>"><i class="fa fa-circle-o"></i><?php echo lang('manage_permission'); ?></a></li>
                <?php endif; ?>
              </ul>
            </li>
          <?php endif; ?>

            <li >
              <a href="javascript: void(0);" class="has-arrow waves-effect">
                    <i class="fa fa-recycle"></i>
                    <span><?php echo lang('report'); ?></span>
                </a>
                <ul class="sub-menu" aria-expanded="false">
                  <li id="addGroupNav"><a href="<?php echo base_url('Controller_Report/salesreport') ?>"><i class="fa fa-circle-o"></i><?php echo lang('sales_report'); ?></a></li>
                <li id="manageGroupNav"><a href="<?php echo base_url('Controller_Report/purchasereport') ?>"><i class="fa fa-circle-o"></i><?php echo lang('purshase_report'); ?></a></li>
                <li id="manageGroupNav"><a href="<?php echo base_url('Controller_Report/hsnreport') ?>"><i class="fa fa-circle-o"></i><?php echo lang('hsn_report'); ?></a></li>
              </ul>
            </li>
         

         <!--  <?php if(in_array('viewReports', $user_permission)): ?>
            <li id="reportNav">
              <a href="<?php echo base_url('reports/') ?>">
                <i class="glyphicon glyphicon-stats"></i> <span>Reports</span>
              </a>
            </li>
          <?php endif; ?> -->


          <?php if(in_array('updateCompany', $user_permission)): ?>
            <li id="companyNav"><a href="<?php echo base_url('Controller_Company/') ?>"><i class="fa fa-bank"></i><span></i><?php echo lang('company'); ?></span></a></li>
          <?php endif; ?>

        <?php endif; ?>
        <!-- user permission info -->
        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-sign-out"></i> <span></i><?php echo lang('logout'); ?></span></a></li>
        <li><a href="" onclick="backup()"><i class="fa fa-database"></i> <span></i>Backup</span></a></li>
<!-- <li style="text-align: center;">
  <button class="btn btn-sm btn-primary" onclick="backup()"><i class="fa fa-database"></i>Backup</button>
</li> -->

        </ul>
    </div>
    <!-- Sidebar -->
</div>
</div>

<script>
  function backup(){
    $.ajax({
    url: 'Controller_Backup/db_backup',
    type: 'get',
    dataType: 'json',
    success:function(responseData) {
      console.log(responseData);
    }
  });

    $.ajax({
    url: 'Controller_Backup/sendMail',
    type: 'get',
    dataType: 'json',
    success:function(responseData) {
      console.log(responseData);
    }
  });
 

    alert("Data backup is done");

  
}
sendMail
</script>