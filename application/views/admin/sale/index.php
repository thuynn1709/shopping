<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <form action="<?php echo site_url('admin/product/index');?>" method = "post">
            <div class="col-xs-12">
                    <div class="col-xs-3">
                        <label>Tên sản phẩm</label> 
                        <input type="text" name="product_name" value="<?php echo $product_name; ?>" class="form-control pull-right" placeholder="Tên sản phẩm">
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
                        <label>Tên người mua</label> 
                        <div class="input-group">
                            <input type="text" name="search" value="<?php echo $user_name; ?>" class="form-control pull-right" placeholder="Search">
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
                <h3 class="box-title"><label>Danh sách hàng đã bán </label></h3>
              <div class="box-tools">
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Tên người mua</th>
                  <th>Tên sản phẩm</th>
                  <th>Số lượng</th>
                  <th>Tổng tiền</th>
                  <th>Ngày mua</th>
                </tr>
                
                <?php 
                    if (!empty($results)) {
                        $offset = $offset + 1;
                      
                        foreach ($results as $rs) {
                    ?> 
                    <tr>
                      <td><?php echo $offset; ?></td>
                      <td><?php echo $rs->fullname; ?></td>
                      <td><?php echo $rs->name; ?></td>
                      <td><?php echo $rs->amount; ?></td>
                      <td><?php echo $rs->pricetotal; ?></td>
                      <td><?php echo $rs->created; ?></td>
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


