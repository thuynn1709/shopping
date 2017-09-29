<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/import/'); ?>">Quản lý nhập hàng</a></li>
        <li class="active">Chi tiết nhập hàng ngày : <?php echo $import->created ; ?> / <?php echo $import->name ; ?></li>
    </ol>
    <section class="content">
      <!-- /.row -->
      <div class="row">
        <div class="col-xs-12">
            <div class="col-xs-6">
                <div class="col-xs-3">
                    <button  type="button" id="add_new" value="<?php echo $import_id ; ?>" class="btn btn-block btn-primary">Thêm mới</button>  
                </div>
                <div class="col-xs-3">
                    <button type="button" class="btn bg-navy btn-flat pull-left" data-toggle="modal" data-target="#modal-info">
                        Import file Excel
                    </button>
                </div>
                
            </div>
            
            <div class="col-xs-6 pull-right">
                <button type="button" value="<?php echo $import_id ; ?>" id="import_to_product" class="btn btn-success pull-right">
                    Export to Products
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
                  <th>Giá (€)</th>
                  <th>Số lượng</th>
                  <th>Thời gian</th>
                  <th>#</th>
                </tr>
                
                <?php 
                    if (!empty($results)) {
                        $offset = $offset + 1;
                        foreach ($results as $rs) {
                    ?> 
                    <tr>
                      <td><?php echo $offset; ?></td>
                      <td><?php echo $rs->product_name; ?></td>
                      <td><?php echo $rs->price; ?></td>
                      <td><?php echo $rs->amount; ?></td>
                      <td><?php echo $rs->created; ?></td>
                      <td>
                        <div class="btn-group">
                            <button type="button" ref="<?php echo base_url('admin/import_detail/edit/'). $rs->id ; ?>" id="edit" class="btn btn-info edit_button">Sửa</button>
                            <button type="button" ref="<?php echo base_url('admin/import_detail/delete/'). $rs->id ; ?>" id="delete" class="btn btn-warning delete_button">Xóa</button>
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

<div class="modal fade in" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Nhập dữ liệu chi tiết cho đơn hàng <?php echo $import->created ; ?></h4>
            </div>
            <form enctype="multipart/form-data" id="modal_form_id"  method="POST" >
                <div class="modal-body">
                    <input type="hidden" value="<?php echo $import_id ; ?>" name="import_id" />
                    <label for="exampleInputFile">File Excel </label>
                    <input type="file" name="excel" id="excel">
                </div>
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning pull-left" data-dismiss="modal">Hủy</button>
                    <button type="submit" id="save_file" class="btn btn-primary">Lưu</button>
                </div>
            </form>  
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>


<script type="text/javascript">
    $( document ).ready(function() {
        
        $('#add_new').click(function() {
            var id = $(this).val();
            window.location.href = '<?php echo base_url(); ?>admin/import_detail/add/'+ id ;
            return false;
        });
        
        $('#import_to_product').click(function() {
            var id = $(this).val();
            var r = confirm("Chắc chắn nhập dữ liệu vào bảng sản phẩm  ?");
            if (r == true) {
                window.location.href = '<?php echo base_url(); ?>admin/import_detail/import_to_product/'+ id ;
                return false;
            } else {
                txt = "You pressed Cancel!";
                return false;
            }
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
       
        $('#modal_form_id').submit(function(e) {
            var postData = new FormData($("#modal_form_id")[0]);
            var  url = "<?php echo base_url('admin/import_detail/import_excel'); ?>";
            $.ajax({
                type:'POST',
                url: url,
                processData: false,
                contentType: false,
                data : postData,
                success:function(data){
                    $('.modal').modal('hide');
                    location.reload();
                }
            });
            e.preventDefault();
        });
    });
    

</script>


