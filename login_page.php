<?php
    require_once '_functions_.php';
    require_once 'core/init.php';

    _header('Login Form');

    error_reporting(E_ERROR);

    $db = new QueryDB();
?>

<div class='container-fluid'>
  <div class="row">
    <div class='col-md-4'>
      <br />
    </div>
    <div class='col-md-4 login-center login-font'>

      <div class='card center-shadow mx-auto'>
        <div class='card-header rounded-top card-color'>
          <b style='font-size:20px'> Please Login Here! </b>
        </div>
        <div class='card-body'>
          <form action='login.php' id='login' method='POST'>
              <div class='form-group'>
                <input type='text' class='form-control' id='user_name' name='user_name' placeholder='Enter username' required>
              </div>
              <div class='form-group'>
                <input type='password' class='form-control' id='user_pass_word' name='user_pass_word' placeholder='Enter password' required>
              </div>
              <div class="form-group">
                <?php
                  if (isset($_POST['login']) AND $db->DataExists('user_details', 'user_name', $_POST['user_name'])) {
                    // $user = encrypt_data($_POST['user_name']);
                    echo "<a class='float-left' href='forgotten_pass.php'><i class='fa fa-unlock'></i> Forgotten password? </a>";
                  }
                ?>
                <button class='btn btn-primary float-right shadow' type='submit' name='login' form='login'>Login <i class='fas fa-sign-in-alt' style="font-size: 20px"></i></button>
              </div>
          </form>
        </div>
      </div>

<?php
  if (isset($_SESSION['message'])) {
    echo "<div class='alert alert-danger'>
            ", $_SESSION['message'],
         "</div>";
    unset($_SESSION['message']);
  }
?>
    </div>
    <div class='col-md-4'>
      <br />
    </div>
  </div>
</div>
<hr>

<?php
  // add_footer();
  _footer();
?>
