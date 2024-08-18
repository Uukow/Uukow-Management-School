<?php include_once('head.php'); ?>

<style>
  .form-control-feedback {
    pointer-events: auto;
  }

  .msk-set-color-tooltip + .tooltip > .tooltip-inner { 
    min-width: 180px;
    background-color: red;
  }

   body {
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    margin: 0;
  } 
  
  .modal-dialog {
    margin-top: 130px;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: calc(100% - 260px);
    /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); */
  }
  .modal{
	background-color: #fff;
	
  }
  
  .modal-content {
    background-color: #fff;
	box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
  }
  .brand-logo
{
  text-align: center;
  max-width: 100%;
  max-height: 100%;
}
.btn-info{
    background-color: #337ab7;
    border-color: #2e6da4;
    color: #fff;
    padding: 8px 20px;
    font-size: 16px;
    border-radius: 3px;
    cursor: pointer;
	display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
  }
  
  .btn-info:hover {
    background-color: #286090;
    border-color: #204d74;
  }
  .show-password-icon {
    margin-right: 5px;
  }

</style>

<body onLoad="login()">
  <!--Success! - Insert-->
  <div class="modal" id="loginFrom" tabindex="-1" role="dialog" aria-labelledby="loginFrom" aria-hidden="true">
    <div class="modal-dialog">   
	<div class="modal-content">    
                <div class="brand-logo" >
                  <img src="logoep.png" alt="School Logo">
                  <h4>Uukow Management school </h4>
                </div>
        <div class="modal-body bgColorWhite">
          <form role="form" action="../index.php" method="post">                    
            <div class="box-body">
              <div class="form-group" id="divEmail">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                  <input type="text" class="form-control" id="email" placeholder="Enter your email" name="email" autocomplete="off">
                </div>
              </div>
              <div class="form-group" id="divPassword">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                  <input type="password" class="form-control" id="password" placeholder="Enter your password" name="password" autocomplete="off">
                  <span class="input-group-addon show-password-icon" id="showPasswordToggle">
                  <i class="fa fa-eye" aria-hidden="true"></i>
                </span>
                </div>
              </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
              <input type="hidden" name="do" value="user_login" />
              <button type="submit" class="btn btn-info" id="btnSubmit">Login</button>
            </div>
          </form>
        </div>
      </div>      
    </div>
  </div><!--/.Modal--> 

  <script>
    function login() {
      $('#loginFrom').modal({
        backdrop: 'static',
        keyboard: false
      });
      $('#loginFrom').modal('show');
    }

    $("form").submit(function (e) {
      var uname = $('#email').val();
      var password = $('#password').val();
      
      if (uname == '') {
        $("#btnSubmit").attr("disabled", true);
        $('#divEmail').addClass('has-error has-feedback');  
        $('#divEmail').append('<span id="spanEmail" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip" title="The user name is required"></span>');  
  
        $("#email").keydown(function() {
          $("#btnSubmit").attr("disabled", false);  
          $('#divEmail').removeClass('has-error has-feedback');
          $('#spanEmail').remove();
        });  
      }
      
      if (password == '') {
        $("#btnSubmit").attr("disabled", true);
        $('#divPassword').addClass('has-error has-feedback');  
        $('#divPassword').append('<span id="spanPassword" class="glyphicon glyphicon-remove form-control-feedback msk-set-color-tooltip" data-toggle="tooltip" title="The password is required"></span>');  
  
        $("#password").keydown(function() {
          $("#btnSubmit").attr("disabled", false);  
          $('#divPassword').removeClass('has-error has-feedback');
          $('#spanPassword').remove();
        });  
      }
      
      if (uname == '' || password == '') {
        $("#btnSubmit").attr("disabled", true);
        e.preventDefault();
        return false;
      } else {
        $("#btnSubmit").attr("disabled", false);
      }
    });

    // Show/hide password functionality
	$(document).on('click', '#showPasswordToggle', function() {
    var passwordInput = $('#password');
    var passwordFieldType = passwordInput.attr('type');
    if (passwordFieldType === 'password') {
      passwordInput.attr('type', 'text');
      $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
    } else {
      passwordInput.attr('type', 'password');
      $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
    }
  });
  </script>

  <!--Warnning! - Email or Password is Incorrect-->
  <div class="modal" id="login_error" tabindex="-1" role="dialog" aria-labelledby="insert_alert1" aria-hidden="true">
    <div class="modal-dialog">    
      <div class="modal-content">
        <div class="modal-header bg-red-active">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
          <h4>Information...!</h4>
        </div>
        <div class="modal-body bgColorWhite">
          <strong style="color:red; font-size:14px">Warning!</strong> Email or Password is Incorrect.
        </div>
      </div>
    </div>
  </div><!--/.Modal-->

  <?php
  if (isset($_GET["do"]) && ($_GET["do"] == "login_error")) {
    $msg = $_GET['msg'];
    ?>
    <script>
      $(document).ready(function() {
        $('#login_error').modal('show');
        setTimeout(function() {
          $('#login_error').modal('hide');
        }, 3000);
      });
    </script>
    <?php
  }
  ?>
</body>