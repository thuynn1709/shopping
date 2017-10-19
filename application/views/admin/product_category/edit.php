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
            <form role="form" name="submit" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/product_category/edit/'). $item->id ; ?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Tên menu</label>
                  <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $item->name; ?> " placeholder="Enter menu">
                </div>
                  
                <div class="form-group">
                  <label>Ưu tiên</label>
                  <select name="menu_id" class="form-control">
                    <?php 
                     if (!empty($menu)){
                        foreach ($menu as $mn) {                  
                    ?>
                            <option value="<?php echo $mn->id; ?>" <?php echo ($item->menu_id == $mn->id) ? 'selected="selected"' : '' ?>> <?php echo $mn->name; ?></option>
                     <?php                      
                        }                        
                    }                
                    ?>  
                  </select>
                </div>  
                  
                <div class="form-group">
                  <label>Ưu tiên</label>
                  <select name="priority" class="form-control">
                    <option value="1" <?php echo ($item->priority == 1) ? 'selected="selected"' : '' ?>> 1</option>
                    <option value="2" <?php echo ($item->priority == 2) ? 'selected="selected"' : '' ?>> 2</option>
                    <option value="3" <?php echo ($item->priority == 3) ? 'selected="selected"' : '' ?>> 3</option>
                    <option value="4" <?php echo ($item->priority == 4) ? 'selected="selected"' : '' ?>> 4</option>
                    <option value="5" <?php echo ($item->priority == 5) ? 'selected="selected"' : '' ?>> 5</option>
                  </select>
                </div>
                  
                  <div class="form-group">
                  <label>Hiển thị</label>
                  <select name="status" class="form-control">
                    <option value="1" <?php echo ($item->priority == 1) ? 'selected="selected"' : '' ?>> Hiển thị</option>
                    <option value="0" <?php echo ($item->priority == 0) ? 'selected="selected"' : '' ?>> Không hiển thị</option>
                   
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
