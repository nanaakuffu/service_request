<?php
  /* Script name: users_page */
  session_start();

  require_once "core/init.php";
  require_once "_functions_.php";

  if(!isset($_POST['_user_'])) {
    include_once "add_user.php";
    exit();
  } else {
    /* If the code gets here, it means the data is really clean */
    $db = new QueryDB();

    // This is an array that holds the keys of the wanted field names
    $field_names_array = $db->fetchFields("user_details");
    // $user_name = $_SESSION['user_name'];

    switch ($_POST['_user_']) {

      case "Add New User":
        $full_name = $_POST['first_name']." ".$_POST['middle_name']." ".$_POST['last_name'];
        $_POST['user_password'] = password_hash($_POST['userpassword'], PASSWORD_DEFAULT);

        /* Removes unwanted field names that came from the form */
        $_POST = filter_array($_POST, $field_names_array);

        // Actually save the data
        $_POST = secure_data_array($_POST);
        $save_data = $db->saveData($_POST, "user_details");

        if ($save_data) {

          // CLosing the database
          $db->destroy();

          // If saving was possible try to set the access level
          $_SESSION['new_user'] = $_POST['user_name'];
          include_once 'add_user.php';
        } else {
          // $_SESSION['message'] = "<li><i class='fa-li fa fa-check-square'></i> ".SAVE_ERROR."</li>"; // Saving was not possible
          include_once "add_user.php";
        }

        break;

      case 'Update Details':
        // Encyprt the password being sent to the databse
        $_SESSION['full_name'] = $_POST['last_name'].", ".$_POST['first_name']." ".$_POST['middle_name'];

        /* Removes unwanted field names that came from the form */
        $_POST = filter_array($_POST, $field_names_array);

        // Secure data
        $_POST = secure_data_array($_POST);

        // Leave password as it is in the database
        unset($_POST['user_password']);

        // Update the data
        $save_data = $db->updateData($_POST, "user_details", "user_name", $_POST['user_name']);
        if ($save_data) {
          // CLosing the database
          $db->destroy();

          header("Location: index.php");
        }

        break;

      default:
        $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $password_array = array('user_password' => $new_password);

        if ($db->updateData($password_array, 'user_details', 'user_name', $_POST['user_name'])) {
          $db->destroy();
          header("Location: index.php");
        }
        break;
    }
  }

?>
