 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Quản lý danh mục sản phẩm</a></li>
        <li class="active">Thêm mới danh mục sản phẩm</li>
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
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/import_detail/edit/'). $item->id ; ?>">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên sản phẩm</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $item->product_name; ?> " placeholder="Tên người nhập">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Giá</label>
                      <input type="text" name="price" class="form-control" id="exampleInputEmail1" value="<?php echo $item->price; ?> " placeholder="Trọng lượng">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Số lượng</label>
                      <input type="text" name="amount" class="form-control" id="exampleInputEmail1" value="<?php echo $item->amount; ?> " placeholder="Tổng số sản phẩm">
                    </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="submit" id="cancel" class="btn btn-primary">Hủy bỏ</button>
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
