<?php
    require_once '_functions_.php';
    require_once 'core/init.php';

    _header('Request Form');

    error_reporting(E_ERROR);
    $db = new QueryDB();

    $component_array = $db->get_data_array('component_tbl', 'component_name', TRUE);
    $category_array = ['Computer', 'Email', 'Network', 'Mobile Phone', 'Other'];
    $brand_array = array_diff($db->get_data_array('request_tbl', 'request_brand', TRUE), $component_array);
?>

<div class='container-fluid'>
  <div class="row">
    <div class='col-md-3'>
      <br />
    </div>
    <div class="col-md-6">
      <div class='card shadow-lg mx-auto' style="margin-top: 50px;">
        <div class="card-header rounded-top">
          <b style='font-family: Raleway; font-weight: 400; font-size:20px'> IT Service Request Form </b>
        </div>
        <div class="card-body">
          <form action='__request__.php' method='POST' id="request_form">
            <div class="form-group">
              <input class="form-control" type="text" name="request_name" placeholder="Staff Full Name" required>
            </div>
            <div class="form-row">
              <div class="form-group col-md-9">
                <select class='form-control' name='request_component' id='request_component' placeholder="Staff Component Name" required>
                  <?php select_data($component_array, '', TRUE); ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="control-group col-md-9">
                <div class="controls">
                  <input type="email" class="form-control" name="request_email"
                    data-validation-regex-regex="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                    data-validation-regex-message="Must be of the form yourname@website.com"
                    placeholder="Staff eMail Address" required>
                  <p class="help-block text-danger mt-2"></p>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="control-group col-md-6">
                <div class="controls">
                  <input type="text" class="form-control" name="request_contact_number"
                    minlength="10" maxlength="10"
                    data-validation-regex-regex="^0[2|5][0-9]{8}$"
                    data-validation-regex-message="Must start with '02' or '05'."
                    data-validation-number-message="Must be a number, no letters or characters"
                    placeholder="Staff Contact Number" required>
                  <p class="help-block text-danger mt-2"></p>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-5">
                <select class='form-control' name='request_brand' id='request_brand' placeholder="Equipment Brand" required>
                  <?php select_data($brand_array, '', TRUE); ?>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <select class='form-control' name='request_category' id='request_category' placeholder="Problem Category" required>
                  <?php select_data($category_array, '', TRUE); ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <textarea class="form-control" type="text" name="request_description" rows="5" placeholder="Problem Description" required></textarea>
            </div>
            <div class="form-group">
              <input class='btn btn-primary float-right shadow' type='submit' name='make_request' value='Submit Request' />
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class='col-md-3'>
      <br />
    </div>
  </div>
</div>

<?php
  $db->destroy();
  _footer();
?>
