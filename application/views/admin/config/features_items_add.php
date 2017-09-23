 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/import_detail/index/'). $import->id; ?>">Đơn hàng ngày <?php echo $import->created ; ?> </a></li>
        <li class="active">Nhập chi tiết đơn hàng</li>
     </ol>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm chi tiết đơn hàng ngày <?php echo $import->created ; ?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="add_new" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/import_detail/add/'). $import_id; ?>">
                <div class="box-body">
                    <input type="hidden" name="count" id="count" value="1" />
                    <div class="control-group" id="form-add-multi">
                        <div class="row">
                            <div class="col-md-6"><label>Tên sản phẩm</label></div>
                            <div class="col-md-2 pull-left"><label>Giá</label></div>
                            <div class="col-md-2">Số lượng</div>
                            <div class="col-md-2"></div>
                        </div>
                        <small>Ấn + để thêm nhiều sản phẩm cùng lúc :)</small>
                        <div class="row" id="fields">
                            <div class="col-md-6"><input autocomplete="on" class="form-control" id="field1" name="field1" type="text" placeholder="Tên sản phẩm" data-items="8"/></div>
                            <div class="col-md-2 pull-left"><input autocomplete="off" class="form-control" id="price1" name="price1" type="text" placeholder="Giá" data-items="8"/></div>
                            <div class="col-md-2 pull-left"><input autocomplete="off" class="form-control" id="qty1" name="qty1" type="text" placeholder="Số lượng" data-items="8"/></div>
                            <div class="col-md-2"><button id="b1" class="btn btn-primary add-more" type="button">+</button></div>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
  
<link rel="stylesheet" href="<?php echo base_url(); ?>public/jquery_ui/jquery-ui.css">
<script type="text/javascript" src="<?php echo base_url(); ?>public/jquery_ui/jquery-ui.js"></script>
<script>
    $(function () {
        var availableTags =  <?php echo $all_name_products; ?> ;
        $( "#field1" ).autocomplete({
            source: availableTags,
            delay: 10
        });
        $( "#cancel" ).click(function() {
            window.location.href = '<?php echo base_url(); ?>admin/import/index';
            return false;
        });
        
        var total = 1; // Our default for how many contacts we have
        $(".add-more").click(function(e){

            var addBlockId = total = total + 1;

            var addBlock = '<div class="row" style="padding-top:5px;padding-bottom:5px" id="fields'+ addBlockId +'">' +
                            '<div class="col-md-6"><input autocomplete="off" class="form-control" id="field'+ addBlockId +'" name="field'+ addBlockId +'" type="text" placeholder="Tên sản phẩm" data-items="8"/></div>' +
                            '<div class="col-md-2 pull-left"><input autocomplete="off" class="form-control" id="price'+ addBlockId +'" name="price'+ addBlockId +'" type="text" placeholder="Giá" data-items="8"/></div>' +                    
                            '<div class="col-md-2 pull-left"><input autocomplete="off" class="form-control" id="qty'+ addBlockId +'" name="qty'+ addBlockId +'" type="text" placeholder="Số lượng" data-items="8"/></div>' +
                            '<div class="col-md-2"><button id="remove' + (addBlockId - 1) + '" class="btn btn-danger remove-me" >-</button></div>' +
                            
                        '</div>';
            $(addBlock).appendTo($('#form-add-multi')).insertBefore( "#fields" );
            var field = '#field' + addBlockId;
            $( field ).autocomplete({
                source: availableTags,
                delay: 10
            });
            $('#count').val(total);
            $('.remove-me').click(function(e){
                e.preventDefault();
                var field = '#fields' + addBlockId;
                $(field).remove();
              
            });
        });

    })
</script>
