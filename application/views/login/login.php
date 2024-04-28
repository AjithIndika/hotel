
 <body class="login">
     <div class="container ">
    <div class="card card-login mx-auto text-center bg-dark">
        <div class="card-header mx-auto bg-dark">
            <span> <img src="<?php echo base_url('images/icon/logo.png')?>" class="w-5" alt="Logo" style="width: 20%" > </span><br/>
            <span class="text-success">Hotel Manage V-1.1</span><br/>
            
                        <span class="logo_title mt-5"> Login Dashboard </span>
                                  <?php if(!empty($error)){echo $error;}?>

        </div>
        <div class="card-body">
            <form action="" method="post">
                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-user"></i></span>
                    </div>
                    <input type="text" name="uname" class="form-control" placeholder="Username">
                     <?php echo form_error('uname', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
                </div>

                <div class="input-group form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="password" name="upassword" class="form-control" placeholder="Password">
                     <?php echo form_error('upassword', '<div class="alert alert-danger" style="width:450px"><strong>* </strong>', '</div> '); ?>
                </div>

                <div class="form-group">
                    <input type="submit"  value="Login" class="btn btn-outline-success float-right login_btn"  name="login">
                </div>

            </form>
        </div>
    </div>
</div>

