<?php
  if (isset($_GET['action'])) {
    session_start();
  }

  require_once '_functions_.php';
  require_once 'core/init.php';

  login_check();

  _header('Create User');
  _nav_panel();

  if (isset($_GET['user'])) {
    $db = new QueryDB();
    $user = $_GET['user'];
    $sql = "SELECT * FROM user_details WHERE user_name='$user'";
    $_POST = $db->fetchData($sql);
    // echo "<pre>", var_dump($_POST), "</pre>";
    $_POST['_user_'] = 'Update User Details';
    $db->destroy();
    // echo "<pre>", var_dump($_POST), "</pre>";
  }

  // Get default values
  $user_name = (isset($_GET['action'])) ? $_POST[0]['user_name'] : '' ;
  $user_password = (isset($_GET['action'])) ? $_POST[0]['user_password'] : '' ;
  $eMail = (isset($_GET['action'])) ? $_POST[0]['user_email'] : '' ;
  $first_name = (isset($_GET['action'])) ? $_POST[0]['first_name'] : '' ;
  $middle_name = (isset($_GET['action'])) ? $_POST[0]['middle_name'] : '' ;
  $last_name = (isset($_GET['action'])) ? $_POST[0]['last_name'] : '' ;

  $button = (isset($_GET['action'])) ? "Update Details" : "Add New User" ;
  $buttton_ctr = (isset($_GET['action'])) ? "readonly" : "required" ;

?>
<div class="container pad-top">
  <div class="w3-panel w3-leftbar w3-rightbar w3-pale-green">
    <h3> User Details </h3>
  </div>
  <form action='__users__.php' method='POST'>
    <div class='row'>
      <div class='col-sm-5'>
        <div class='form-group'>

            <?php if (isset($_GET['action'])): ?>
              <label> User Name: </label>
              <input class='form-control' type='text' name='user_name' value='<?php echo $user_name; ?>'
                      placeholder='User Name' readonly >
            <?php else: ?>
              <div class="control-group">
                <label class="control-label"> User Name: </label>
                <div class="controls">
                  <input class='form-control' type='text' name='user_name' value=''
                           id='user_name' placeholder='User Name'
                           minlength='5' autofocus required>
                  <p class="help-block text-danger" id='status'></p>
                </div>
              </div>
            <?php endif; ?>
        </div>
        <div class='control-group'>
            <label class="control-label"> User Password: </label>
            <div class="controls">
              <input class='form-control' type='password' name='userpassword' value='<?php echo $user_password; ?>'
                       id='password' placeholder='User Password'
                       minlength='8'
                       data-validation-regex-regex="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$"
                       data-validation-regex-message="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"
                       <?php echo $buttton_ctr; ?>>
              <p class="help-block text-danger"></p>
            </div>
        </div>
        <div class='control-group'>
            <label class="control-label"> User eMail: </label>
            <div class="controls">
              <input class='form-control' type='text' name='user_email' value='<?php echo $eMail; ?>'
                     id='email' placeholder='User email'
                     data-validation-regex-regex="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                     data-validation-regex-message="Must be of the form yourname@website.com" required>
              <p class="help-block text-danger"></p>
            </div>
        </div>
      </div>
      <div class='col-sm-5'>
        <div class='form-group'>
            <label> First Name: </label>
            <input class='form-control' type='text' name='first_name' value='<?php echo $first_name; ?>'
                     id='fname' placeholder='User first name' required>
        </div>
        <div class='form-group'>
            <label> Middle Name: </label>
            <input class='form-control' type='text' name='middle_name' value='<?php echo $middle_name; ?>'
                     id='mname' placeholder='User middle name if any'>
        </div>
        <div class='form-group'>
            <label> Last Name: </label>
            <input class='form-control' type='text' name='last_name' value='<?php echo $last_name; ?>'
                     id='lname' placeholder='User last name' required>
        </div>
      </div>
      <div class="col-sm-2">
        <div class='form-group'>
          <label> Control </label>
          <input class='btn btn-primary btn-block center-shadow' type='submit' name='_user_' id="_user_"
                value='<?php echo $button; ?>'>
        </div>
      </div>
    </div>
  </form>
</div>

<?php
  logout_modal();
  _footer();
?>
