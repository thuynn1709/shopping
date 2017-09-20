<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập tài khoản</h2>
                    <div><span class="text-danger"><?php if(isset($b_Check) && $b_Check == false){echo "Tài khoản không đúng. Xin vui lòng đăng nhập lại !";}?></span></div>
                    <form class="form-signin" role="form" name="login" method="post" enctype="multipart/form-data" action="<?php echo base_url('account/login_process') ; ?>">
                        <input type="hidden" name="act" value="login"/>
                        <input type="email" required="required" name="email" placeholder="Địa chỉ email" />
                        <input type="password" name="password" required="required" placeholder="Mật khẩu đăng nhập" />
                        <span>
                            <input type="checkbox" name="remember_me" class="checkbox"> 
                            Duy trì đăng nhập
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">OR</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                <h2>Đăng kí thành viên mới !</h2>
                <form class="form-signin" role="form" name="register" method="post" enctype="multipart/form-data" action="<?php echo base_url('account/register_process') ; ?>">
                    <input type="hidden" name="act" value="register"/>
                    <input type="text" name="username" placeholder="Họ tên"/>
                    <input type="email" name="email" required="required" placeholder="Địa chỉ email"/>
                    <input type="password" name="password" required="required" placeholder="Mật khẩu đăng nhập"/>
                    <button type="submit" class="btn btn-default">Đăng kí</button>
                </form>
            </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->