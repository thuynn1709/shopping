<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/import/'); ?>">Cấu hình</a></li>
        <li class="active">Danh sách sản phẩm FUETURES ITEMS ( Trang chủ)</li>
    </ol>
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-3">
                <button style="width: 150px" type="button" id="add_new" class="btn btn-block btn-primary">Thêm mới</button>  
            </div>
            <div class="col-xs-3"></div>
            <div class="col-xs-3">
                
            </div>
            <div class="col-xs-3">
                
            </div>
           
        </div>
          
        
        
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            
              <h3 class="box-title">Danh sách sản phẩm</h3>
              <div class="box-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>
              </div>
            </div>
              
            <?php if($this->session->flashdata('error')) {?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error');?>
                </div>
            <?php }?>  

            <?php if($this->session->flashdata('success')) {?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success');?>
                </div>
            <?php }?>  
              
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
                <tr>
                  <th>ID</th>
                  <th>Tên sản phẩm</th>
                  <th>Trạng thái</th>
                  <th>#</th>
                </tr>
                
                <?php 
                    if (!empty($results)) {
                        $offset = $offset + 1;
                        foreach ($results as $rs) {
                    ?> 
                    <tr>
                      <td><?php echo $offset; ?></td>
                      <td><?php echo $rs->name; ?></td>
                      <?php 
                        if ($rs->status == 1) {
                        ?> 
                      <td><span class="label label-success">Hiển thị</span></td>
                        <?php } else {  ?> 
                      <td><span class="label label-danger">Không hiển thị</span></td>
                      <?php } ?> 
                      <td>
                        <div class="btn-group">
                           
                            <button type="button" ref="<?php echo base_url('admin/config/featuresitmesdelete/'). $rs->id ; ?>" id="delete" class="btn btn-warning delete_button">Xóa</button>
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
            var id = $(this).val();
            window.location.href = '<?php echo base_url(); ?>admin/config/featuresitmesadd' ;
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
        
    });
    

</script>


