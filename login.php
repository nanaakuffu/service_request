<?php
    session_start();

    require_once("core/init.php");
    require_once("_functions_.php");

    if (isset($_POST['login'])) {
      // Connect to database and get user access levels as he/she logs in
      $db = new QueryDB();

      $user_sql = "SELECT user_name, user_password, first_name, middle_name, last_name
                   FROM user_details
                   WHERE user_name = '".$_POST['user_name']."'";

      $full_rows = $db->fetchData($user_sql);

      if (is_null($full_rows)) {   // user name was not found
        // Check the user password
        $db->destroy();
        $message = "<i class='fa fa-fw fa-close'></i> Password does not match your user name!";
        $_SESSION['message'] = $message;
        include_once 'login_page.php';
        exit();
      } else {
        $hash_password = trim($full_rows[0]['user_password']);

        if ( password_verify($_POST['user_pass_word'], $hash_password) ) { // Password did match
            // $_SESSION = $user_array;
            $_SESSION['user_name'] = $_POST['user_name'];
            $_SESSION['full_name'] = $full_rows[0]['last_name'].", ".$full_rows[0]['first_name']." ".$full_rows[0]['middle_name'];;
            $_SESSION['auth'] = 'yes';
            // $_SESSION['is_admin'] = 1;

            $_SESSION['login_time'] = time();

            // Create an array with the variables available
            $log_array = array('login_id'=>random_string("logID_", 15), 'user_name'=>$_POST['user_name'], 'login_date_time'=>time());
            $log_array = secure_data_array($log_array);

            $_SESSION['log_id'] = $log_array['login_id'];

            // Update login Details
            if ($db->SaveData($log_array, 'login_details')) {
              $db->destroy();
              header("Location: index.php");
            }

        } else {
          $db->destroy();
          $message = "<i class='fa fa-fw fa-close'></i> Password does not match your user name!";
          $_SESSION['message'] = $message;
          include_once 'login_page.php';
          exit();
        }
      }
    } else {
      include 'login_page.php';
      exit();
    }

?>
