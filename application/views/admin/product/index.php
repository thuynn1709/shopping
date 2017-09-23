<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <form action="<?php echo site_url('admin/product/index');?>" method = "post">
            <div class="col-xs-12">
                    <div class="col-xs-3">
                        <button style="width: 150px; margin-top: 25px;" id="add_new" type="button" class="btn btn-block btn-primary">Thêm mới</button>  
                    </div>
                    
                    <div class="col-xs-3">
                        <label>Loại sản phẩm</label> 
                        <select name="category" class="form-control">
                            <option value=""> Chọn loại sản phẩm</option>
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
                    <div class="col-xs-3">
                        <label>Nhãn hiệu</label> 
                        <select name="marken" class="form-control">
                            <option value=""> Chọn thương hiệu</option>
                            <?php 
                            if (!empty($marken)){
                               foreach ($marken as $ct) {                  
                           ?>
                                   <option value="<?php echo $ct->id; ?>"> <?php echo $ct->name; ?></option>
                            <?php                      
                               }                        
                           }                
                           ?>
                         </select>
                    </div>
                    <div class="col-xs-3">
                        <label>Tên sản phẩm</label> 
                        <div class="input-group">
                            <input type="text" name="search" value="<?php echo $search; ?>" class="form-control pull-right" placeholder="Search">
                            <div class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                          </div>
                        </div>
                    </div>
            </div>
        </form>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh mục sản phẩm</h3>
              <div class="box-tools">
              </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Danh mục sản phẩm</th>
                  <th>Ngày tạo</th>
                  <th>Trạng thái</th>
                  <th>Action</th>
                </tr>
                
                <?php 
                    if (!empty($results)) {
                        $offset = $offset + 1;
                      
                        foreach ($results as $rs) {
                    ?> 
                    <tr>
                      <td><?php echo $offset; ?></td>
                      <td><?php echo $rs->name; ?></td>
                      <td><?php echo $rs->created; ?></td>
                      <?php 
                        if ($rs->status == 1) {
                        ?> 
                      <td><span class="label label-success">Hiển thị</span></td>
                        <?php } else {  ?> 
                      <td><span class="label label-danger">Không hiển thị</span></td>
                      <?php } ?> 
                      <td>
                        <div class="btn-group">
                            <button type="button" data-value="<?php echo $rs->id; ?>" class="btn btn-info">Sửa</button>
                            <button type="button" data-value="<?php echo $rs->id; ?>" class="btn btn-warning">Xóa</button>
                        </div>  
                        
                      </td>
                    </tr>
                        <?php 
                        $offset += 1;
                        }
                    }?> 
              </table>
            </div>
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <?php echo $links; ?>
              </ul>
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
    </section>
    
  </div>

<script type="text/javascript">
    $( document ).ready(function() {
       
        $('#add_new').click(function() {
            window.location.href = '<?php echo base_url(); ?>admin/product/add';
            return false;
        });
        
        $('.btn-info').click(function() {
            var id = $(this).attr('data-value');
            window.location.href = '<?php echo base_url(); ?>admin/product/edit/' + id;
            return false;
        });
        
        $('.btn-warning').click(function() {
           
            var r = confirm("Chắc chắn xóa !");
            if (r == true) {
                var id = $(this).attr('data-value');
                window.location.href = '<?php echo base_url(); ?>admin/product/delete/' + id;
                return false;
            } else {
                txt = "Bạn đã hủy xóa!";
            }
           
            return false;
        });
    });
    

</script>


