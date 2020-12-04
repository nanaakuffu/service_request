<?php
  function _header($page_title = '')
  {
    echo "<!DOCTYPE html>
          <html lang='en-US'>
          <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
            <meta name='description' content=''>
            <meta name='author' content=''>

            <title>$page_title</title>

            <!-- Bootstrap core CSS-->
            <link href='static/css/bootstrap.min.css' rel='stylesheet'>

            <!-- Custom fonts for this template-->
            <link href='static/fontawesome/css/all.min.css' rel='stylesheet' type='text/css'>
            <link href='static/css/fonts.css' rel='stylesheet' type='text/css'>
            <link href='static/css/w3.css' rel='stylesheet' type='text/css'>

            <!-- Page level plugin CSS-->
            <link href='static/datatables/dataTables.bootstrap4.css' rel='stylesheet'>
            <link href='static/css/jquery-editable-select.min.css' rel='stylesheet' />

            <!-- Custom styles for this template-->
            <link href='static/css/giz_service.css' rel='stylesheet'>
          </head>
          <body class='d-flex flex-column' id='page-top'>";
  }

  function _index_nav_panel()
  {
    $user = $_SESSION['user_name'];
    echo "<nav class='navbar navbar-expand-sm navbar-dark bg-dark fixed-top shadow'>
            <div class='container'>
              <a class='navbar-brand' href='index.php'><i class='fas fa-home'></i> GIZ IT SERVICE </a>
              <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#collapsibleNavbar'>
                <span class='navbar-toggler-icon'></span>
              </button>

              <div class='collapse navbar-collapse justify-content-end' id='collapsibleNavbar'>
                <ul class='nav navbar-nav'>
                  <li class='nav-item'>
                    <a class='nav-link' href='add_user.php?user={$user}&action=1'><i class='fas fa-user'></i> ",$_SESSION['full_name'], "</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='#' data-toggle='modal' data-target='#logoutModal'><i class='fas fa-sign-out-alt'></i> Log Out</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>";
  }

  function _nav_panel()
  {
    $user = $_SESSION['user_name'];
    echo "<nav class='navbar navbar-expand-sm navbar-dark bg-dark fixed-top shadow'>
            <div class='container'>
              <a class='navbar-brand' href='index.php'><i class='fas fa-home'></i> GIZ IT SERVICE </a>
              <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#collapsibleNavbar'>
                <span class='navbar-toggler-icon'></span>
              </button>

              <div class='collapse navbar-collapse justify-content-end' id='collapsibleNavbar'>
                <ul class='nav navbar-nav'>
                  <li class='dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' data-toggle='dropdown'>
                      <i class='fas fa-tachometer-alt'></i> Issues
                    </a>
                    <ul class='dropdown-menu'>
                      <li><a class='dropdown-item' href='reported_issues.php'><i class='fas fa-user-cog'></i> View Reported Issues</a></li>
                      <li><a class='dropdown-item' href='addressed_issues.php'><i class='far fa-calendar-check' style='font-size:20px'></i> View Addressed Issues</a></li>
                      <li><a class='dropdown-item' href='pending_issues.php'><i class='far fa-calendar-times' style='font-size:20px'></i> View Pending Issues</a></li>
                    </ul>
                  </li>
                  <li class='nav-item no-arrow dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' data-toggle='dropdown'>
                      <i class='fas fa-layer-group'></i> Outputs
                    </a>
                    <div class='dropdown-menu'>
                      <a class='dropdown-item' href='analytics.php'><i class='fas fa-chart-pie'></i> Analytics </a>
                      <a class='dropdown-item' href='report.php'><i class='fas fa-chart-area'></i> Generate Report </a>
                    </div>
                  </li>
                  <li class='nav-item no-arrow dropdown'>
                    <a class='nav-link dropdown-toggle' href='#' id='pagesDropdown' data-toggle='dropdown'>
                      <i class='fas fa-tools'></i> Settings
                    </a>
                    <div class='dropdown-menu'>
                      <a class='dropdown-item' href='__users__.php'><i class='fas fa-user-plus'></i> Add New User </a>
                      <a class='dropdown-item' href='veiw_edit_user.php'><i class='fas fa-users'></i> View and Edit Users </a>
                      <a class='dropdown-item' href='change_page.php'><i class='fas fa-key' style='font-size:18px'></i> Change Password </a>
                    </div>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='add_user.php?user={$user}&action=1'><i class='fas fa-user'></i> ",$_SESSION['full_name'], "</a>
                  </li>
                  <li class='nav-item'>
                    <a class='nav-link' href='#' data-toggle='modal' data-target='#logoutModal'><i class='fas fa-sign-out-alt'></i> Log Out</a>
                  </li>
                </ul>
              </div>
            </div>
          </nav>";
  }

  function _footer()
  {
    echo "<!-- Bootstrap core JavaScript -->
          <script src='static/js/jquery.min.js'></script>
          <script src='static/js/bootstrap.min.js'></script>

          <!-- Page level plugin JavaScript -->
          <script src='static/datatables/jquery.dataTables.js'></script>
          <script src='static/datatables/dataTables.bootstrap4.js'></script>
          <script src='static/js/jquery-editable-select.min.js'></script>
          <script src='static/js/jqBootstrapValidation.js'></script>

          <script src='static/js/moment.js'></script>
          <script src='static/js/Chart.min.js'></script>

          <!-- Demo scripts for this page -->
          <script src='static/js/giz_service.js'></script>
          </body>
          </html>";
  }

  function footer($footer_text = 'Copyright &copy Your Website 2018')
  {
    echo "<footer class='py-4 bg-dark text-white-50'>
            <div class='container my-auto'>
              <div class='text-left my-auto'>
                <span>$footer_text</span>
              </div>
            </div>
          </footer>";
  }

  function back_to_top()
  {
    echo "<a class='scroll-to-top rounded-circle shadow' href='#page-top'>
            <i class='fas fa-angle-up'></i>
          </a>";
  }

  function logout_modal()
  {
    echo "<div class='modal fade' id='logoutModal' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
            <div class='modal-dialog modal-dialog-centered' role='document'>
              <div class='modal-content'>
                <div class='modal-header'>
                  <h5 class='modal-title' id='exampleModalLabel'>Ready to Leave?</h5>
                  <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                  </button>
                </div>
                <div class='modal-body'>Select 'Logout' below if you are ready to end your current session.</div>
                <div class='modal-footer'>
                  <button class='btn btn-secondary' type='button' data-dismiss='modal'>Cancel</button>
                  <a class='btn btn-primary' href='logout.php'>Logout</a>
                </div>
              </div>
            </div>
          </div>";
  }

  function filter_array($subject_array, $standard_array)
  {
    foreach ($subject_array as $key => $value) {
      if (!in_array($key, $standard_array)) {
        unset($subject_array[$key]);
      }
    }

    return $subject_array;
  }

  function filter_array_by_value($subject_array, $standard_array, $inclusive = TRUE)
  {
    foreach ($subject_array as $key => $value) {
      if ($inclusive) {
        if (!in_array($value, $standard_array)) {
          unset($subject_array[$key]);
        }
      } else {
        if (in_array($value, $standard_array)) {
          unset($subject_array[$key]);
        }
      }
    }

    return $subject_array;
  }

  function secure_data_value($data_value)
  {
    $data_value = trim($data_value);
    $data_value = stripslashes($data_value);
    $data_value = strip_tags($data_value);
    $secured_value = htmlspecialchars($data_value);

    return $secured_value;
  }

  function secure_data_array($data_array)
  {
    $secured_array = array();
    if (!is_array($data_array)) { // Data is not an array, hemce make it one.
      $secured_array[] = secure_data_value($data_array);
    } else { // Data is an array, hence valudate each element of the array.
      foreach ($data_array as $key => $value) {
        $secured_array[$key] = secure_data_value($value);
      }
    }
    return $secured_array;
  }

  function request_ID($stringlength)
  {
    $key = 'reqID_';
    $keys = array_merge(range(0, 9), range('A', 'Z'));

    $length = $stringlength - strlen($key);

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
  }

  function random_string($pre_text, $stringlength) {
    $key = $pre_text;
    $keys = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));

    $length = $stringlength - strlen($pre_text);

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }

    return $key;
  }

  function login_check(){
    // When the user is not logged in
    if (@$_SESSION['auth'] != "yes") {
      header("Location: login.php");
      exit();
    }

    // When the session expires
    if ( (time() - $_SESSION['login_time']) > 1440 ) {
      include_once 'logout.php';
      exit();
    }
  }

  function select_data($data_array, $select_value, $sorted = FALSE) {
    if ($sorted) {
      sort($data_array);
    }

    foreach ($data_array as $key => $value) {
      echo "<option value='{$value}'";
      if ($select_value == $value) {
        echo " selected";
      }
      echo "> $value </option>";
    }
  }

?>
