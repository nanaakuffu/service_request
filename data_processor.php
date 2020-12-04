<?php
  require './../includes/include.inc';
  require_once '_functions_.php';
  require_once "core/init.php";

  $db = new QueryDB();
  $edit_data = [];

  // $field_names = $db->fetchFields("recipients");

  $id = (isset($_GET['choice'])) ? $_GET['choice'] : '__file_save';

  $flag = (isset($_POST['flag'])) ? $_POST['flag'] : $_GET['flag'] ;

  switch ($flag) {
    case 'addData':
      // Clean the data from form
      $_POST = filter_array($_POST, $field_names);
      $_POST['recipient_id'] = random_string("rept_ID_");

      // secure the data
      $_POST = secure_data_array($_POST);
      $result = $db->SaveData($_POST, "recipients");
      break;

    case 'getUser':
      if ($db->dataExists('user_details', 'user_name', $id)) {
        $getData = array('status' => 'taken');
      } else {
        $getData = array('status' => 'not taken');
      }
      break;

    case 'getPassword':
      $sql = "SELECT user_password FROM user_details WHERE user_name='$id'";
      $pass_array = $db->fetchData($sql);
      if (password_verify($_GET['password'], $pass_array[0]['user_password'])) {
        $getData = array('status' => 'match');
      } else {
        $getData = array('status' => 'unmatch');
      }
      break;

    case 'getAnalytics':
      switch (trim($_POST['analytics_type'])) {
        case 'Brand':
          $sql = "SELECT request_brand AS label, COUNT(*) AS value FROM request_tbl GROUP BY request_brand";
          break;

        case 'Category':
          $sql = "SELECT request_category AS label, COUNT(*) AS value FROM request_tbl GROUP BY request_category";
          break;

        case 'Status':
          $sql = "SELECT request_status AS label, COUNT(*) AS value FROM request_tbl GROUP BY request_status";
          break;

        default:
          $sql = "SELECT request_component AS label, COUNT(*) AS value FROM request_tbl GROUP BY request_component";
          break;
      }

      $getData = $db->fetchData($sql);

      break;

    case 'delete':
      // Deleting a recipient
      $result = $db->DeleteData('recipients', "recipient_id", $id);
      break;

    case 'save_file':
      $file_handle = fopen("static/help/help_file.ini", 'w');
      $output = $_POST['_file_content'];
      fwrite($file_handle, $output);
      fclose($file_handle);
      $last_changed = 'Last saved on'.date("F d Y H:i:s.", filectime('static/help/help_file.ini'));
      break;
  }

  // if ($flag != "update") {
  //   if ($flag == 'getUser') {
  //     echo json_encode($getUser);
  //   } elseif ($flag == 'getPassword') {
  //     echo json_encode($getPassword);
  //   } else {
  //     echo json_encode(array('flag' => $flag));
  //   }
  // } else {
  //   header("Location: recipients.php");
  // }

  $db->destroy();

  echo json_encode($getData);

?>
