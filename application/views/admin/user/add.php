 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Quản lý người dùng</a></li>
        <li class="active">Thêm mới người dùng</li>
      </ol>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/user/add') ; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Họ tên</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Họ tên">
                </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <input type="text" name="email" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ Email">
                </div>
                  
                <div class="form-group">
                  <label for="exampleInputEmail1">Mật khẩu</label>
                  <input type="password" name="password" class="form-control" id="exampleInputEmail1" placeholder="Mật khẩu">
                </div>
                <div class="form-group">
                    <label>Group</label>
                    <select name="group" class="form-control">
                        <option value="0"> Admin </option>
                        <option value="1"> Mode </option>
                        <option value="2"> User </option>
                    </select>
                </div>
                  
                  <div class="form-group">
                  <label>Hiển thị</label>
                  <select name="status" class="form-control">
                    <option value="1"> Active</option>
                    <option value="0"> No Active</option>
                   
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="submit" id="cancel" class="btn btn-warning">Cancel</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </div>
        <!--/.col (left) -->
        
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  
  <script type="text/javascript">
    $( document ).ready(function() {
        $('#cancel').click(function() {
            window.location.href = '<?php echo base_url(); ?>admin/user/index';
            return false;
        });
    });
    

</script>

