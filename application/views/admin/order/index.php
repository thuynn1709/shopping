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
                    
                    <div class="col-xs-2">
                        <label>Phương thức thanh toán</label> 
                        <select name="pay_method" class="form-control">
                            <option value="">Tất cả</option>
                            <option value="0">Chuyển khoản</option>
                            <option value="1">Tiền mặt</option>
                         </select>
                    </div>
                    <div class="col-xs-2">
                        <label>Trạng thái thanh toán</label> 
                        <select name="pay_method" class="form-control">
                            <option value="">Tất cả</option>
                            <option value="0">Chưa thanh toán</option>
                            <option value="1">Đã thanh toán</option>
                         </select>
                    </div>
                    <div class="col-xs-2">
                        <label>Trạng thái giao hàng</label> 
                        <select name="pay_method" class="form-control">
                            <option value="">Tất cả</option>
                            <option value="0">Đã giao</option>
                            <option value="1">Chưa giao</option>
                         </select>
                    </div>
                    <div class="col-xs-3">
                        <label>Tên người đặt hàng</label> 
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
              <h3 class="box-title">Danh sách đặt hàng</h3>
              <div class="box-tools">
              </div>
             
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Họ tên</th>
                  <th>SĐT</th>
                  <th>Số lượng</th>
                  <th>Tổng tiền</th>
                  <th>Các thanh toán</th>
                  <th>Thanh toán</th>
                  <th>Trạng thái</th>
                  <th>Ngày đặt</th>
                  <th>Action</th>
                </tr>
                
                <?php 
                    if (!empty($results)) {
                        $offset = $offset + 1;
                      
                        foreach ($results as $rs) {
                    ?> 
                    <tr>
                        <td><?php echo $offset; ?></td>
                        <td><?php echo $rs->fullname; ?></td>
                        <td><?php echo $rs->phone; ?></td>
                        <td><?php echo $rs->amount; ?></td>
                        <td><?php echo $rs->pricetotal; ?></td>
                        <?php 
                          if ($rs->pay_method == 1) {
                          ?> 
                        <td><span class="label label-success">Tiền mặt</span></td>
                          <?php } else {  ?> 
                        <td><span class="label label-danger">Chuyển khoản</span></td>
                        <?php } ?> 
                        
                        <?php 
                          if ($rs->pay_status == 0) {
                          ?> 
                        <td><span class="label label-danger">Chưa thanh toán</span></td>
                          <?php } else {  ?> 
                        <td><span class="label label-success">Đã thanh toán</span></td>
                        <?php } ?> 
                        
                        <?php 
                          if ($rs->status == 0) {
                          ?> 
                        <td><span class="label label-danger">Chưa giao hàng</span></td>
                          <?php } else {  ?> 
                        <td><span class="label label-success">Đã giao hàng</span></td>
                        <?php } ?> 
                        
                        <td><?php echo $rs->created; ?></td>
                        <td>    
                            <div class="btn-group">
                                <button type="button" data-value="<?php echo $rs->id; ?>" class="btn btn-info">Chi tiết</button>
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
            window.location.href = '<?php echo base_url(); ?>admin/order/add';
            return false;
        });
        
        $('.btn-info').click(function() {
            var id = $(this).attr('data-value');
            window.location.href = '<?php echo base_url(); ?>admin/order/detail/' + id;
            return false;
        });
        
        $('.btn-warning').click(function() {
           
            var r = confirm("Chắc chắn xóa !");
            if (r == true) {
                var id = $(this).attr('data-value');
                window.location.href = '<?php echo base_url(); ?>admin/order/delete/' + id;
                return false;
            } else {
                txt = "Bạn đã hủy xóa!";
            }
           
            return false;
        });
    });
    

</script>


