 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/menu/edit/'). $item->id ; ?>">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên người nhập</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $item->name; ?> " placeholder="Tên người nhập">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Trọng lượng</label>
                      <input type="text" name="weight" class="form-control" id="exampleInputEmail1" value="<?php echo $item->name; ?> " placeholder="Trọng lượng">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tổng số sản phẩm</label>
                      <input type="text" name="product_qty" class="form-control" id="exampleInputEmail1" value="<?php echo $item->name; ?> " placeholder="Tổng số sản phẩm">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tổng giá trị </label>
                      <input type="text" name="product_total_price" class="form-control" id="exampleInputEmail1" value="<?php echo $item->name; ?> " placeholder="Tổng giá trị">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ship tại đức</label>
                      <input type="text" name="versand_in_de" class="form-control" id="exampleInputEmail1" value="<?php echo $item->name; ?> " placeholder="Ship tại đức">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Ship về VNam</label>
                      <input type="text" name="versand_to_vn" class="form-control" id="exampleInputEmail1" value="<?php echo $item->name; ?> " placeholder="Ship về VNam">
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
