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
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/menu/add') ; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên menu</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter menu">
                </div>
                <div class="form-group">
                  <label>Ưu tiên</label>
                  <select name="priority" class="form-control">
                    <option value="1"> 1</option>
                    <option value="2"> 2</option>
                    <option value="3"> 3</option>
                    <option value="4"> 4</option>
                    <option value="5"> 5</option>
                  </select>
                </div>
                  
                  <div class="form-group">
                  <label>Hiển thị</label>
                  <select name="status" class="form-control">
                    <option value="1"> Hiển thị</option>
                    <option value="0"> Không hiển thị</option>
                   
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
