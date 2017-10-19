 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Quản lý sản phẩm</a></li>
        <li class="active">Thêm mới sản phẩm</li>
      </ol>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm mới sản phẩm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/product/add') ; ?>">
              <div class="box-body">
                <div class="form-group">
                    
                    <?php if($this->session->flashdata('exist_name')) {?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-ban"></i> Alert!</h4>
                        <?php echo $this->session->flashdata('exist_name');?>
                    </div>
                    <?php }?>
                    <div class="row" >
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên sản phẩm">
                        </div>
                        <div class="col-md-6">
                            <label>Danh mục sản phẩm</label>
                            <select name="category" class="form-control">
                               <?php 
                               if (!empty($category)){
                                  foreach ($category as $ct) {                  
                              ?>
                                      <option value="<?php echo $ct->id; ?>"> <?php echo $ct->name; ?></option>
                               <?php                      
                                  }                        
                              }                
                              ?>
                            </select>
                        </div>
                    </div>
                </div>
                  
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label>Thương hiệu</label>
                            <select name="marken" class="form-control">
                                <option value=""> Chọn thương hiệu</option>
                               <?php 
                               if (!empty($marken)){
                                  foreach ($marken as $mk) {                  
                              ?>
                                      <option value="<?php echo $mk->id; ?>"> <?php echo $mk->name; ?></option>
                               <?php                      
                                  }                        
                              }                
                              ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Số lượng</label>
                            <input type="text" name="amount" class="form-control" id="exampleInputAmount" placeholder="000">
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label for="exampleInputFile">Ảnh trang sản phẩm</label>
                            <input type="file" name="images[]" multiple="multiple">
                            <p class="help-block">268 x 249 px.</p>
                        </div>

                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Giá tiền</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-money"></i>
                              </div>
                                <input type="text" class="form-control" id="price" name="price"><br>
                            </div>
                        </div>
                    </div>
                </div>  
                  
                  
                  
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label for="exampleInputFile">Ảnh menu con trang chủ</label>
                            <input type="file" name="images[]" multiple="multiple">
                            <p class="help-block">208 x 183 px.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputFile">Ảnh recommended</label>
                            <input type="file" name="images[]" multiple="multiple">
                            <p class="help-block">268 x 134 px.</p>
                        </div>
                    </div>
                </div> 
                  
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label for="exampleInputFile">Ảnh trang chi tiết sản phẩm</label>
                            <input type="file" name="images[]" multiple="multiple">
                            <p class="help-block">266 x 381 px.</p>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleInputFile">Ảnh trang chi tiết 3</label>
                            <input type="file" name="images[]" multiple="multiple">
                            <p class="help-block">330 x 380 px.</p>
                        </div>
                    </div>
                </div>   
              
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Mô tả chi tiết sản phẩm
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
                      
                        <textarea class="textarea" name="detail" placeholder="Viết mô tả thông tin sản phẩm"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      
                    </div>
                </div>
                  
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Thành phần sản phẩm
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
                      
                        <textarea class="textarea" name="element" placeholder="Viết mô tả thông tin sản phẩm"
                                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      
                    </div>
                </div>
                  
                <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Hướng dẫn sử dụng
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
                      
                        <textarea class="textarea" name="guide" placeholder="Viết mô tả thông tin sản phẩm"
                            style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                                      
                        </textarea>
                      
                    </div>
                </div>
                
                  
                <div class="form-group">
                    <div class="row" >
                        <div class="col-md-6">
                            <label>Ngày hết hạn:</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                                <input type="text" class="form-control" name="expired" id="datemask" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask="">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Hiển thị</label>
                            <select name="status" class="form-control">
                              <option value="1"> Hiển thị</option>
                              <option value="0"> Không hiển thị</option> 
                            </select>
                        </div>
                    </div>
                </div>
                  
                <div class="form-group">
                    <div class="row" >
                     
                        <div class="col-md-6">
                            <label for="exampleInputEmail1">Giảm giá ($)</label>
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-sort-amount-asc"></i>
                              </div>
                                <input type="text" class="form-control" id="discount" name="discount"><br>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Màu sắc</label>
                            <input type="text" id="color" name="color" class="form-control my-colorpicker1 colorpicker-element">
                        </div>
                    </div>
                </div>  
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                  <button type="submit" class="btn btn-primary">Thêm mới</button>
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

<!-- InputMask -->

<script src="<?php echo base_url(); ?>public/admin/plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url(); ?>public/admin/plugins/input-mask/jquery.inputmask.numeric.extensions.js"></script>
<script src="<?php echo base_url(); ?>public/admin/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url(); ?>public/admin/plugins/input-mask/jquery.inputmask.extensions.js"></script>
<script src="<?php echo base_url(); ?>public/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url(); ?>public/admin/bower_components/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
   
    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    
    $('#price').inputmask('decimal', {
        radixPoint: ".",
        groupSeparator: ",",
        digits: 2,
        autoGroup: true,
        prefix: 'VNĐ', //No Space, this will truncate the first character
        rightAlign: false
       
    });
    
    //Colorpicker
    $('#color').colorpicker()
    
    $( "#cancel" ).click(function() {
        window.location.href = '<?php echo base_url(); ?>admin/product/index';
        return false;
    });
  })
</script>
