 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Quản lý nhập hàng</a></li>
        <li class="active">Thêm mới đơn nhập hàng</li>
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
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/import/add/'); ?>">
                <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tên người nhập</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="" placeholder="Tên người nhập">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Trọng lượng</label>
                      <input type="text" name="weight" class="form-control" id="exampleInputEmail1" value="" placeholder="Trọng lượng">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tổng số sản phẩm</label>
                      <input type="text" name="product_qty" class="form-control" id="exampleInputEmail1" value="" placeholder="Tổng số sản phẩm">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tổng giá trị </label>
                      <input type="text" name="product_total_price" class="form-control" id="exampleInputEmail1" value="" placeholder="Tổng giá trị">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiền ship tại đức</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                          </div>
                            <input type="text" class="form-control" id="versand_in_de" name="versand_in_de"><br>
                        </div>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Tiền ship về VNam</label>
                      <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-money"></i>
                          </div>
                            <input type="text" class="form-control" id="versand_to_vn" name="versand_to_vn"><br>
                        </div>
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
  
<script>
    $(function () {
        $( "#cancel" ).click(function() {
            window.location.href = '<?php echo base_url(); ?>admin/import/index';
            return false;
        });
    })
</script>
