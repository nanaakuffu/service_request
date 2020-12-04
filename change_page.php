<?php
  session_start();

  require_once '_functions_.php';

  login_check();

  _header('Change Password');
  _nav_panel();
?>
<div class="container pad-top">
  <div class='w3-panel w3-leftbar w3-rightbar w3-pale-green'>
      <h3> Change User Password </h3>
  </div>
  <form action='__users__.php' method='POST' id="change_p">
    <div class="row">
      <div class="col-sm-5">
        <div class='form-group'>
            <label> User Name: </label>
            <input class='form-control' type='text' name='user_name' value='Admin'
                     id='uname' placeholder='User Name' readonly>
        </div>
        <div class='control-group'>
            <label class="control-label"> Old Password: </label>
            <div class="controls">
              <input class='form-control' type='password' name='old_password' value=''
                       id='opass' placeholder='Old Password' required>
              <p class="help-block text-danger" id="oldpass"></p>
            </div>
        </div>
      </div>
      <div class="col-sm-5">
        <div class='control-group'>
            <label class="control-label"> New Password: </label>
            <div class="controls">
              <input class='form-control' type='password' name='new_password' value=''
                       minlength='8' id='npass' placeholder='New Password'
                       data-validation-regex-regex="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$"
                       data-validation-regex-message="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                       required>
              <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class='control-group' style="margin-top:15px">
            <label class="control-label"> Confirm New Password: </label>
            <div class="controls">
              <input class='form-control' type='password' name='confirm_password' value=''
                  data-validation-match-match="new_password"
                  id='cpass' placeholder='New Password'
                  data-validation-match-match='new_password'
                  data-validation-match-message='Passwords do not match!'>
              <p class="help-block text-danger"></p>
            </div>
        </div>
      </div>
      <div class="col-sm-2">
        <div class='form-group'>
          <label class='bitterlabel'> Control </label><br />
          <button class='btn btn-primary btn-block' type='submit' name='_user_'
             id='_user_'  form='change_p' value='Change Password'> Change Password </button>
        </div>
      </div>
    </div>
  </form>
</div>

<?php
  logout_modal();
  _footer();
?>
