<div id="contact-page" class="container">
    <div class="bg">
        <div class="row">    		
            <div class="col-sm-12">    			   			
                <h2 class="title text-center">Liên <strong>Hệ</strong></h2>    			    				    				
                <div id="map_google" class="contact-map">
                </div>
            </div>			 		
            </div>    	
        <div class="row">  	
            <div class="col-sm-8">
                <div class="contact-form">
                    <h2 class="title text-center">GỬI EMAIL CHO CHÚNG TÔI !</h2>
                    <div class="status alert alert-success" style="display: none"></div>
                    <form id="main-contact-form" class="contact-form row" name="contact-form" action="<?php echo base_url('contact/register_contact'); ?>" method="post">
                        <div class="form-group col-md-6">
                            <input type="text" name="name" class="form-control" required="required" placeholder="Họ tên">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="tel" name="phone"  maxlength = "11" min = "10" class="form-control" required="required" placeholder="Số điện thoại ( 10 hoặc 11 số )">
                        </div>
                        <div class="form-group col-md-12">
                            <input type="email" name="email" class="form-control" required="required" placeholder="Địa chỉ email">
                        </div>
                        
                        <div class="form-group col-md-12">
                            <input type="text" name="subject" class="form-control" required="required" placeholder="Tiêu đề">
                        </div>
                        <div class="form-group col-md-12">
                            <textarea name="message" id="message" required="required" class="form-control" rows="8" placeholder="Nội dung tin nhắn"></textarea>
                        </div>                        
                        <div class="form-group col-md-12">
                            <input type="submit" name="submit" class="btn btn-primary pull-right" value="Gửi đi">
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="contact-info">
                    <h2 class="title text-center">THÔNG TIN LIÊN HỆ</h2>
                    <address>
                        <p>Sirodrugstore Inc.</p>
                        <p>Đội 9 - Điễn Xá Nam Trực</p>
                        <p>Nam Định Việt Nam</p>
                        <p>Mobile: +841255282228</p>
                        <p>Mobile 2: +841279933888</p>
                        <p>Email: sirodrugstore.com</p>
                    </address>
                    <div class="social-networks">
                        <h2 class="title text-center">Liên hết mạng xã hội</h2>
                        <ul>
                            <li><a href="https://www.facebook.com/SIROdrugstore/?ref=aymt_homepage_panel"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/sirodrugstore/?hl=vi"><i class="fa fa-instagram" aria-hidden="true"></i></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>    			
        </div>  
    </div>	
</div><!--/#contact-page-->


<script>
    
    $(function () {
        $('#main-contact-form').submit(function(event){
            event.preventDefault();
            var r = confirm("Bạn chắc chắn muốn gửi tin nhắn !");
            if (r == true) {
                var form = $('#main-contact-form');
                $.ajax
                ({ 
                    type : "POST",
                    url  :   form.attr("action"),
                    data : form.serialize(),
                    success: function(result) {
                        obj = jQuery.parseJSON(result);
                        if ( obj.msg == 'success') {
                            $(".btn-primary").notify( "Gửi tin nhắn thành công !",  { position:"left", className: 'success', });
                            $('#main-contact-form')[0].reset();
                        }else {
                             $(".btn-primary").notify( "Gửi tin nhắn không thành công !",  { position:"left", className: 'error', });
                        }
                    }
                });
            } else {
                
            }
            return false;
        });
    })
    
    function initMap() {
      var uluru = {lat: 20.399958, lng: 106.226360};
      var map = new google.maps.Map(document.getElementById('map_google'), {
        zoom: 12,
        center: uluru
      });
      var marker = new google.maps.Marker({
        position: uluru,
        map: map
      });
    }
</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCPp1mxssik-ZQhonHwqUV-iEWgVUtyD8o&callback=initMap"></script>

