<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                     <?php echo lang('add_new_member'); ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('member'); ?></li>
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
        <form role="form" action="<?php base_url('Controller_Members/create') ?>" method="post">
              <div class="box-body">

                <?php echo validation_errors(); ?>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label for="groups"><?php echo lang('permission'); ?></label>
                  <select class="form-control" id="groups" name="groups">
                    <option value="">Select permission</option>
                    <?php foreach ($group_data as $k => $v): ?>
                      <option value="<?php echo $v['id'] ?>"><?php echo $v['group_name'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                </div>
               <div class="col-md-6">
                <div class="form-group">
                  <label for="fname"><?php echo lang('first_name'); ?></label>
                  <input type="text" class="form-control" id="fname" name="fname" placeholder="First name" autocomplete="off">
                </div>
                </div>

                <div class="col-md-6">
                <div class="form-group">
                  <label for="username"><?php echo lang('username'); ?></label>
                  <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off">
                </div>
                </div>
                
               
                 <div class="col-md-6">
                <div class="form-group">
                  <label for="lname"><?php echo lang('last_name'); ?></label>
                  <input type="text" class="form-control" id="lname" name="lname" placeholder="Last name" autocomplete="off">
                </div>
                </div>






              
                  
                  <div class="col-md-6">
                <div class="form-group">
                  <label for="password"><?php echo lang('password'); ?></label>
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off">
                </div>
                </div>

                 <div class="col-md-6">

                <div class="form-group">
                  <label for="email"><?php echo lang('email'); ?></label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email" autocomplete="off">
                </div>
                </div>
                <div class="col-md-6">
                <div class="form-group">
                  <label for="cpassword"><?php echo lang('confirm_password'); ?></label>
                  <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm Password" autocomplete="off">
                </div>
                </div>
                
                
              
                <div class="col-md-6">

                <div class="form-group">
                  <label for="phone"><?php echo lang('phone'); ?></label>
                  <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" autocomplete="off">
                </div>
                </div>
                </div>

                <div class="form-group">
                  <label for="gender"><?php echo lang('gender'); ?></label>
                  <div class="radio">
                    <label>
                      <input type="radio" name="gender" id="male" value="1">
                      <?php echo lang('male'); ?>
                    </label>
                    <label>
                      <input type="radio" name="gender" id="female" value="2">
                      <?php echo lang('female'); ?>
                    </label>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><?php echo lang('save_&_close'); ?></button>
                <a href="<?php echo base_url('Controller_Members/') ?>" class="btn btn-warning"><?php echo lang('back'); ?></a>
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
