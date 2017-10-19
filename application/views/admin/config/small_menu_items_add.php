 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/config/small_menu_items'); ?>">Danh mục SP ở menu con trang chủ </a></li>
        <li class="active">Thêm mới</li>
     </ol>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm tên sản phẩm hiển thị</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="add_new" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/config/small_menu_items_add/'); ?>">
                <div class="box-body">
                    <input type="hidden" name="count" id="count" value="1" />
                    <div class="control-group" id="form-add-multi">
                        <div class="row">
                            <div class="col-md-6"><label>Tên danh mục sản phẩm</label></div>
                            <div class="col-md-2 pull-left"></div>
                            <div class="col-md-2"></div>
                            <div class="col-md-2"></div>
                        </div>
                        <small>Ấn + để thêm nhiều danh mục sản phẩm cùng lúc :)</small>
                        <div class="row" id="fields">
                            <div class="col-md-6"><input autocomplete="on" class="form-control" id="field1" name="field1" type="text" placeholder="Tên danh mục sản phẩm" data-items="8"/></div>
                            <div class="col-md-2 pull-left"><button id="b1" class="btn btn-primary add-more" type="button">+</button></div>
                            <div class="col-md-2 pull-left"></div>
                            <div class="col-md-2"></div>
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
            window.location.href = '<?php echo base_url(); ?>admin/config/featuresitems';
            return false;
        });
        
        var total = 1; // Our default for how many contacts we have
        $(".add-more").click(function(e){

            var addBlockId = total = total + 1;

            var addBlock = '<div class="row" style="padding-top:5px;padding-bottom:5px" id="fields'+ addBlockId +'">' +
                            '<div class="col-md-6"><input autocomplete="off" class="form-control" id="field'+ addBlockId +'" name="field'+ addBlockId +'" type="text" placeholder="Tên sản phẩm" data-items="8"/></div>' +
                            '<div class="col-md-2 pull-left"><button id="remove' + (addBlockId - 1) + '" class="btn btn-danger remove-me" >-</button></div>' +                    
                            '<div class="col-md-2 pull-left"></div>' +
                            '<div class="col-md-2"></div>' +
                            
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
