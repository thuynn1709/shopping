<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="col-xs-3">
                    <button style="width: 150px" type="button" id="add_new" class="btn btn-block btn-primary">Thêm mới</button>  
                </div>
            </div>
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách menu</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Tên người nhập</th>
                  <th>Trọng lượng (Kg)</th>
                  <th>Số lượng sản phẩm</th>
                  <th>Tổng tiền đơn hàng (€)</th>
                  <th>Tiền ship tại Đức (€)</th>
                  <th>Tiền ship về VN (€)</th>
                  <th>Thời gian</th>
                  <th>#</th>
                </tr>
                
                <?php 
                    if (!empty($results)) {
                        $stt = 1;
                        foreach ($results as $rs) {
                    ?> 
                    <tr>
                      <td><?php echo $stt; ?></td>
                      <td><?php echo $rs->name; ?></td>
                      <td><?php echo $rs->weight; ?></td>
                      <td><?php echo $rs->product_qty; ?></td>
                      <td><?php echo $rs->product_total_price; ?></td>
                      <td><?php echo $rs->versand_in_de; ?></td>
                      <td><?php echo $rs->versand_to_vn; ?></td>
                      <td><?php echo $rs->created; ?></td>
                      <td>
                        <div class="btn-group">
                            <button type="button" ref="<?php echo base_url('admin/import/edit/'). $rs->id ; ?>" id="edit" class="btn btn-info">Sửa</button>
                            <button type="button" ref="<?php echo base_url('admin/import/delete/'). $rs->id ; ?>" id="delete" class="btn btn-warning">Xóa</button>
                        </div>  
                        
                      </td>
                    </tr>
                        <?php 
                        $stt += 1;
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
        console.log( "ready!" );
        $('#add_new').click(function() {
            window.location.href = '<?php echo base_url(); ?>admin/import/add';
            return false;
        });
        
        $('.btn-info').click(function() {      
            var url = $(this).attr('ref');          
            window.location.href = url;
            return false;
        });
        
        $('.btn-warning').click(function() {
            var r = confirm("Chắc chắn xóa !");
            if (r == true) {
                
                txt = "You pressed OK!";
                var url = $(this).attr('ref');
                window.location.href = url;
            } else {
                txt = "You pressed Cancel!";
            }
           
            return false;
        });
    });
    

</script>


