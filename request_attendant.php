<?php
  session_start();
  require_once '_functions_.php';
  require_once 'core/init.php';

  login_check();
  _header('Request Attendant');
  _nav_panel();

  $db = new QueryDB();
  $id = $_GET['id'];

  $sql = "SELECT * FROM request_tbl WHERE request_ID='$id'";
  $data_array = $db->fetchData($sql);
?>
<br />
<div class="container pad-top">
  <div class='card mb-3'>
    <div class="card-header">
      <i class="fas fa-table"></i> Request Attendant for <?php echo $id; ?>
    </div>
    <div class="card-body">
      <form action='__request__.php' method='POST'>
        <div class="form-row">
          <input type="hidden" name="request_ID" value="<?php echo $id; ?>">
          <div class="form-group col-md-4">
            <input type="text" class="form-control" value="<?php echo $data_array[0]['request_name']; ?>" readonly>
          </div>
          <div class="form-group col-md-8">
            <input class="form-control" type="text" value="<?php echo $data_array[0]['request_component']; ?>" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <input type="text" class="form-control" value="<?php echo $data_array[0]['request_email']; ?>" readonly>
          </div>
          <div class="form-group col-md-6">
            <input type="text" class="form-control" value="<?php echo $data_array[0]['request_contact_number']; ?>" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-4">
            <input class="form-control" type="text" value="<?php echo $data_array[0]['request_brand']; ?>" readonly>
          </div>
          <div class="form-group col-md-6">
            <input class="form-control" type="text" value="<?php echo $data_array[0]['request_category']; ?>" readonly>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <textarea class="form-control" type="text" rows="5" readonly><?php echo $data_array[0]['request_description']; ?></textarea>
          </div>
          <div class="form-group col-md-6">
            <textarea class="form-control" type="text" name="attending_report" rows="5" placeholder="Atteding Report" required></textarea>
          </div>
        </div>

        <input class='btn btn-primary float-right shadow' type='submit' name='make_request' value='Issue Pending' />
        <input class='btn btn-primary float-right shadow mr-2' type='submit' name='make_request' value='Issue Addressed' />

      </form>
    </div>
  </div>

</div>

<?php
    _footer();
?>
