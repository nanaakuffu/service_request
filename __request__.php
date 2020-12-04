<?php
  /* Script name: __request__.php */
  session_start();

  require_once 'core/init.php';
  require_once "_functions_.php";

  $is_json_data = (isset($_POST['dType'])) ? TRUE : FALSE;

  if (!isset($_POST['make_request'])) {
    include_once "request_form.php";
    exit();
  } else {
    // echo "<pre>", var_dump($_POST), "</pre>";
    $db = new QueryDB;

    switch ($_POST['make_request']) {
      // Actually save the data from the form.
      case 'Submit Request':
        // This is an array that holds the keys of the wanted field names
        $field_names_array = $db->fetchFields("request_tbl");

        // save the request_ID data for session transactions
        $_SESSION['request_ID'] = $_POST['request_ID'] = request_ID(12);
        $_POST['request_date_time'] = time();

        /* Remove unwanted field names that came from the form */
        $_POST = filter_array($_POST, $field_names_array);

        $_POST = secure_data_array($_POST);

        $save_data = $db->saveData($_POST, "request_tbl");

        if ($save_data) {
          // Closing the database
          $db->destroy();
          // redirect to the notification page
          header("Location: sent_page.php");
        }
        break;

      case 'Issue Pending':
        // This is an array that holds the keys of the wanted field names
        $field_names_array = $db->fetchFields("pending_issues");
        $_POST['pending_ID'] = random_string('penID_', 20);
        $_POST['report_date'] = time();

        /* Removes unwanted field names that came from the form */
        $_POST = filter_array($_POST, $field_names_array);

        $_POST = secure_data_array($_POST);
        $save_data = $db->saveData($_POST, "pending_issues");

        $pending_array = array('request_status' => 1 );

        // Update the data
        $update_data = $db->updateData($pending_array, "request_tbl", "request_ID", $_POST['request_ID']);

        if ($save_data and $update_data) {
          // Closing the database
          $db->destroy();

          // redirect to the notification page
          if ($is_json_data) {
            $is_json_data = FALSE;
            echo json_encode(['success'=>'Report was submitted successfully.', 'status'=>'pending', 'id'=>$_POST['request_ID']]);
          } else {
            header("Location: reported_issues.php");
          }
        }
        break;

      default:
        // This is for completing a particular request.
        $field_names_array = $db->fetchFields("pending_issues");
        $_POST['pending_ID'] = random_string('penID_', 20);
        $_POST['report_date'] = time();

        /* Removes unwanted field names that came from the form */
        $_POST = filter_array($_POST, $field_names_array);

        $_POST = secure_data_array($_POST);
        $save_data = $db->saveData($_POST, "pending_issues");

        $address_array = array('request_status' => 2, 'date_addressed' => time() );

        // Update the data
        $update_data = $db->updateData($address_array, "request_tbl", "request_ID", $_POST['request_ID']);

        if ($save_data and $update_data) {
          // Closing the database
          $db->destroy();

          if ($is_json_data) {
            $is_json_data = FALSE;
            echo json_encode(['success'=>'Report was submitted successfully.', 'status'=>'complete']);
          } else {
            header("Location: reported_issues.php");
          }
        }
        break;
    }
  }

?>
