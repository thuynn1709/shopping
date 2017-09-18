 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Quản lý người dùng</a></li>
        <li class="active">Cập nhật thông tin người dùng</li>
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
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/user/edit/'). $item->id ; ?>">
              <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Họ tên</label>
                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $item->fullname; ?> " placeholder="Họ tên">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="text" name="email" class="form-control" id="exampleInputEmail1" value="<?php echo $item->email; ?> " placeholder="Địa chỉ email">
                </div>
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <textarea class="form-control" name="address" rows="3" placeholder="Địa chỉ ..."></textarea>
                </div>
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Phone</label>
                    <input type="text" name="phone" class="form-control" id="exampleInputEmail1" value="<?php echo $item->phone; ?> " placeholder="Địa chỉ email">
                </div>
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">ChangePassword</label>
                    <input type="text" name="password" class="form-control" id="exampleInputEmail1" value="" placeholder="Nhập password muốn đổi">
                </div>
                <div class="form-group">
                    <label>Group</label>
                    <select name="status" class="form-control">
                        <option value="1" <?php echo ($item->group == 0) ? 'selected="selected"' : '' ?>> Admin</option>
                        <option value="0" <?php echo ($item->group == 1) ? 'selected="selected"' : '' ?>> Mode</option>
                        <option value="0" <?php echo ($item->group == 2) ? 'selected="selected"' : '' ?>> User</option>       
                    </select>
                </div>
                  
                <div class="form-group">
                    <label>Hiển thị</label>
                    <select name="status" class="form-control">
                      <option value="1" <?php echo ($item->status == 1) ? 'selected="selected"' : '' ?>> Hiển thị</option>
                      <option value="0" <?php echo ($item->status == 0) ? 'selected="selected"' : '' ?>> Không hiển thị</option>

                    </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
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
