 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Cấu hình</a></li>
        <li class="active">Slide trang chủ</li>
      </ol>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Cập nhật thông tin slide</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/slidebar/edit/'). $item->id ; ?>">
              <div class="box-body">
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-12">
                            <label for="exampleInputEmail1">Tiêu đề slide</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" value="<?php echo $item->title; ?> "  placeholder="Nhập tiêu đề slide">
                        </div>
                        
                    </div>
                </div>
                  
             
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label for="exampleInputFile">Ảnh slide</label>
                            <input type="file" name="images[]" multiple="multiple">
                            <p class="help-block">484 x 441 px.</p>
                        </div>
                    </div>
                </div>  
              
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Mô tả chi tiết slide
                        <small>Simple and fast</small>
                      </h3>
                      <!-- tools box -->
                      <div class="pull-right box-tools">
                        <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                          <i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip"
                                title="Remove">
                          <i class="fa fa-times"></i></button>
                      </div>
                      <!-- /. tools -->
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body pad">
                      
                        <textarea class="textarea" name="describe" placeholder="Viết mô tả thông tin sản phẩm"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> 
                                      <?php echo $item->describe ; ?>
                        </textarea>
                      
                    </div>
                </div>
                  
                
                
                  
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label>Hiển thị</label>
                            <select name="status" class="form-control">
                              <option value="1" <?php echo ($item->status == 1) ? 'selected="selected"' : '' ?>> Hiển thị</option>
                              <option value="0" <?php echo ($item->status == 0) ? 'selected="selected"' : '' ?>> Không hiển thị</option> 
                            </select>
                        </div>
                    </div>
                </div>
                  
                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Cập nhật</button>
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
  

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>public/admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
    
    $( "#cancel" ).click(function() {
        window.location.href = '<?php echo base_url(); ?>admin/slidebar/index';
        return false;
    });
  })
</script>
