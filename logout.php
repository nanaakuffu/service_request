<?php
    session_start();

    // Get the unique log id. Important for recording logout date and time
    $log_id = $_SESSION['log_id'];

    // Get some files ready for reading
    require_once 'core/init.php';

    // Initialize the database class
    $db = new QueryDB();

    // $today_time = date('h:i:s');
    $_data = array('logout_date_time' => time());

    // Actually save the data in the database
    if ($db->updateData($_data, 'login_details', 'login_id', $log_id)) {
        session_unset();
        session_destroy();
        $db->destroy();
        header("Location: login.php");
        exit();
    }
?>
