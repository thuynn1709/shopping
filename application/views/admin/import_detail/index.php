<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-3">
                <button style="width: 150px" type="button" id="add_new" value="<?php echo $import_id ; ?>" class="btn btn-block btn-primary">Thêm mới</button>  
            </div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3">
                <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#modal-info">
                    Import file Excel
                  </button>
            </div>
           
        </div>
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Chi tiết nhập hàng ngày : <?php echo $import->created ; ?> / <?php echo $import->name ; ?> </h3>
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
                  <th>Tên sản phẩm</th>
                  <th>Giá (€)</th>
                  <th>Số lượng</th>
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
                            <a href="<?php echo base_url('admin/import_detail/index/'). $rs->id ; ?>" class="btn btn-default">Edit <span class="glyphicon glyphicon-pencil"></span></a>
                            <button type="button" ref="<?php echo base_url('admin/import/edit/'). $rs->id ; ?>" id="edit" class="btn btn-info edit_button">Sửa</button>
                            <button type="button" ref="<?php echo base_url('admin/import/delete/'). $rs->id ; ?>" id="delete" class="btn btn-warning delete_button">Xóa</button>
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

<div class="modal fade" id="modal-info">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Default Modal</h4>
              </div>
              <div class="modal-body">
                <p>One fine body&hellip;</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<!-- /.modal -->

<script type="text/javascript">
    $( document ).ready(function() {
        
        $('#add_new').click(function() {
            var id = $(this).val();
            window.location.href = '<?php echo base_url(); ?>admin/import_detail/add/'+ id ;
            return false;
        });
        
        $('.edit_button').click(function() {      
            var url = $(this).attr('ref');          
            window.location.href = url;
            return false;
        });
        
        $('.delete_button').click(function() {
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
        
        $("#fileSelected").click(function(){
            $(".modal").show();
        });
    });
    

</script>


