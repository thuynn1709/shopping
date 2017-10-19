 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <ol class="breadcrumb">
        <li><a href="<?php echo base_url('admin/dashboard') ; ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo base_url('admin/sale/index') ; ?>">Quản lý đơn hàng </a></li>
        <li class="active">Tạo mới đơn hàng</li>
     </ol>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Tạo mới đơn hàng của khách</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" name="add_new" method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/sale/add/') ; ?>">
                <div class="box-body">
                    <input type="hidden" name="count" id="count" value="1" />
                    <div class="control-group" id="form-add-multi">
                        <input type="hidden" name="user_id" id="user_id" value="" />
                        <div class="box-body" style=" border: 1px solid #ccc;border-radius: 4px;">
             
                                <div class="box-header with-border" id="info-user">
                                    <h3 class="box-title">Thông tin khách hàng</h3>
                                </div>
                                <div class="row" >
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Tên người mua</label>
                                        <input type="text" name="name" class="form-control" id="name" placeholder="Nhập tên người mua">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="text" name="email" class="form-control" id="email" placeholder="Email">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="exampleInputEmail1">Số điện thoại</label>
                                        <input type="text" name="phone" class="form-control" id="phone"   placeholder="Số điện thoại">
                                    </div>

                                </div>

                                <div class="row" >
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Địa chỉ</label>
                                        <input type="text" name="address" class="form-control" id="address"   placeholder="Địa chỉ khách hàng">
                                    </div>
                                </div>
                                <div class="row" >
                                    <div class="col-md-12">
                                        <label for="exampleInputEmail1">Địa chỉ ship</label>
                                        <input type="text" name="address_ship" class="form-control" id="address_ship" placeholder="Địa chỉ giao hàng ">
                                    </div>
                                </div>
                            
                        </div>
                        
                        <div class="box-body"  style=" border: 1px solid #ccc;border-radius: 4px;margin-top: 10px">
                            <div class="box-header with-border">
                                <h3 class="box-title">Chi tiết đơn hàng</h3>
                            </div>

                            <div class="row">
                                <div class="col-md-6"><label>Tên sản phẩm</label></div>
                                <div class="col-md-2 pull-left"><label>Giảm giá ( nếu có )</label></div>
                                <div class="col-md-2"><label>Số lượng</label></div>
                                <div class="col-md-2"></div>
                            </div>
                            <small>Ấn + để thêm nhiều sản phẩm cùng lúc :)</small>
                            <div class="row" id="fields">
                                <input autocomplete="off" class="form-control" id="pid1" value="" name="pid1" type="hidden"/>
                                <div class="col-md-6">
                                    <input autocomplete="on" class="form-control" id="field1" name="field1" type="text" placeholder="Tên sản phẩm" data-items="8"/>
                                </div>
                                
                                <div class="col-md-2 pull-left">
                                    <input autocomplete="off" class="form-control" id="price1" name="price1" type="text" placeholder="Giảm giá" data-items="8"/>
                                </div>
                                <div class="col-md-2 pull-left">
                                    <input autocomplete="off" class="form-control" id="qty1" name="qty1" type="text" placeholder="Số lượng" data-items="8"/>
                                </div>
                                <div class="col-md-2">
                                    <button id="b1" class="btn btn-primary add-more" type="button">+</button>
                                </div>
                            </div>
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
        var nameProducts =  <?php echo $all_name_products; ?> ;
        console.log ( nameProducts);
        $( "#field1" ).autocomplete({
            source: nameProducts,
            delay: 10,
            select: function(event, ui) {
            },
            change: function (event, ui) { 
                if (typeof(ui.item) != 'undefined' && ui.item != null) {
                    $('#pid1').val(ui.item.id);
                } else {
                    $('#pid1').val('');
                }
            }
        });
        
        
        var availableTags =  <?php echo $all_users; ?> ;
        
        $( "#name" ).autocomplete({
            source: availableTags,
            delay: 10,
            select: function(event, ui) {
            },
            change: function (event, ui) { 
                if (typeof(ui.item) != 'undefined' && ui.item != null) {
                    $('#user_id').val(ui.item.id);
                    $.ajax
                    ({ 
                        url: '<?php echo base_url('admin/sale/get_info_user_byId'); ?>' ,
                        data: {'user_id': ui.item.id},
                        type: 'post',
                        success: function(result) {
                            obj = jQuery.parseJSON(result);
                            if ( obj.msg == 'success') {
                                $('#email').val( obj.data.email );
                                $('#phone').val( obj.data.phone );
                                $('#address').val( obj.data.address );
                                $('#address_ship').val( obj.data.address_ship );
                                $( '#info-user' ).notify( "Load thành công thông tin người mua !", { position:"top", className: 'success', });
                            }else {
                                $( '#info-user' ).notify("Load không thành công thông tin người mua !", { position:"top", className: 'error', });
                            }
                        }
                    });
                } else {
                    $('#user_id').val('');
                    $('#email').val( '' );
                    $('#phone').val( '' );
                    $('#address').val( '' );
                    $('#address_ship').val( '' );
                    $( '#info-user' ).notify("Bạn đang nhập người mua mới chưa tồn tại trên hệ thống !", { position:"top", className: 'info', });
                }
            }
        });
        $( "#cancel" ).click(function() {
            window.location.href = '<?php echo base_url(); ?>admin/import/index';
            return false;
        });
        
        var total = 1; // Our default for how many contacts we have
        $(".add-more").click(function(e){
            var addBlockId = total = total + 1;

            var addBlock = '<div class="row" style="padding-top:5px;padding-bottom:5px" id="fields'+ addBlockId +'">' +
                            '<input autocomplete="off" class="form-control" id="pid'+ addBlockId +'" name="pid'+ addBlockId +'" type="hidden"/>' +
                            '<div class="col-md-6"><input autocomplete="off" class="form-control" id="field'+ addBlockId +'" name="field'+ addBlockId +'" type="text" placeholder="Tên sản phẩm" data-items="8"/></div>' +
                            '<div class="col-md-2 pull-left"><input autocomplete="off" class="form-control" id="price'+ addBlockId +'" name="price'+ addBlockId +'" type="text" placeholder="Giảm giá" data-items="8"/></div>' +                    
                            '<div class="col-md-2 pull-left"><input autocomplete="off" class="form-control" id="qty'+ addBlockId +'" name="qty'+ addBlockId +'" type="text" placeholder="Số lượng" data-items="8"/></div>' +
                            '<div class="col-md-2"><button value="' + (addBlockId) + '" id="remove' + (addBlockId - 1) + '" class="btn btn-danger remove-me" >-</button></div>' +
                            
                        '</div>';
            $(addBlock).appendTo($('#form-add-multi')).insertBefore( "#fields" );
            var field = '#field' + addBlockId;
            var pid = '#pid' + addBlockId;
            $( field ).autocomplete({
                source: nameProducts,
                delay: 10,
                select: function(event, ui) {
                },
                change: function (event, ui) { 
                    if (typeof(ui.item) != 'undefined' && ui.item != null) {
                        $( pid ).val(ui.item.id);
                    } else {
                        $( pid ).val('');
                    }
                }
            });
            $('#count').val(total);
            $('.remove-me').click(function(e){
                var removeId = $(this).val();
                e.preventDefault();
                var field = '#fields' + removeId;
                $(field).remove();
              
            });
        });

    })
</script>
