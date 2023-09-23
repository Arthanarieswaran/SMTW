<div class="main-content">

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">
                     <?php echo lang('manage_members'); ?>

                    <?php if(in_array('createUser', $user_permission)): ?>
                      <a href="<?php echo base_url('Controller_Members/create') ?>" style="padding:0 5px !important;" class="btn btn-primary">Add New</a>
                      <br /> <br />
                    <?php endif; ?>
                    </h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo lang('home'); ?></a></li>
                            <li class="breadcrumb-item active"><?php echo lang('members'); ?></li>
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
                  <th><?php echo lang('username'); ?></th>
                  <th><?php echo lang('email'); ?></th>
                  <th><?php echo lang('name'); ?></th>
                  <th><?php echo lang('phone'); ?></th>
                  <th><?php echo lang('permission'); ?></th>

                  <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>
                  <th><?php echo lang('action'); ?></th>
                  <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                  <?php if($user_data): ?>                  
                    <?php foreach ($user_data as $k => $v): ?>
                      <tr>
                        <td><?php echo $v['user_info']['username']; ?></td>
                        <td><?php echo $v['user_info']['email']; ?></td>
                        <td><?php echo $v['user_info']['firstname'] .' '. $v['user_info']['lastname']; ?></td>
                        <td><?php echo $v['user_info']['phone']; ?></td>
                        <td><?php if($v['user_group']) echo $v['user_group']['group_name']; ?></td>

                        <?php if(in_array('updateUser', $user_permission) || in_array('deleteUser', $user_permission)): ?>

                        <td>
                          <?php if(in_array('updateUser', $user_permission)): ?>
                            <a href="<?php echo base_url('Controller_Members/edit/'.$v['user_info']['id']) ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i></a>
                          <?php endif; ?>
                          <?php if(in_array('deleteUser', $user_permission)): ?>
                            <a href="" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_users<?php echo $v['user_info']['id']; ?>"><i class="fa fa-trash"></i></a>

                             <div class="modal fade" id="delete_users<?php echo $v['user_info']['id'];?>" role="dialog"  data-backdrop="static">
                            <div class="modal-dialog modal-sm">
                              <div class="modal-content" style="width:332px;">
                                <div class="modal-header">
                                <h4 class="modal-title"><?php echo lang('are_you_sure'); ?>? </h4>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  
                                </div>
                                <div class="modal-body">
                                  <p><?php echo lang('want_to_delete'); ?> <?php echo $v['user_info']['firstname'] .' '. $v['user_info']['lastname']; ?></p>
                                </div>
                                <div class="modal-footer">
                                <form action="<?php echo base_url('Controller_Members/delete/'.$v['user_info']['id']) ?>" method="post">
                             
                              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo lang('close'); ?></button>
                               <input type="submit" class="btn btn-danger" name="confirm" value="<?php echo lang('delete'); ?>">
                              </form>
                                  
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php endif; ?>
                        </td>
                      <?php endif; ?>
                      </tr>
                    <?php endforeach ?>
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
    $(document).ready(function() {
      $('#manageTable').DataTable({
         dom: 'Bfrtip',
      });
     
        
      $("#mainUserNav").addClass('active');
      $("#manageUserNav").addClass('active');
    });
  </script>
