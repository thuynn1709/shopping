 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/extracost') ; ?>">Quản lý chi tiêu</a></li>
        <li class="active">Cập nhật thông tin chi tiêu</li>
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
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/extracost/edit/'). $item->id ; ?>">
              <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên người chi tiêu</label>
                    <input type="text" name="author" class="form-control" id="exampleInputEmail1" value="<?php echo $item->author; ?> " placeholder="Họ tên">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số tiền</label>
                    <input type="text" name="price" class="form-control" id="exampleInputEmail1" value="<?php echo $item->price; ?> " placeholder="Số tiền">
                </div>
                  
                <div class="form-group">
                    <label for="exampleInputEmail1">Nội dung</label>
                    <textarea class="form-control" name="notice" rows="3"  placeholder="Mô tả chi tiết nội dung chi tiêu ..."> <?php echo $item->notice; ?></textarea>
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
