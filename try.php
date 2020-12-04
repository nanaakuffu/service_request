<?php
  $hash = password_hash('password', PASSWORD_DEFAULT);
  echo $hash;
  if (password_verify('password', $hash)){
    echo "Come right in";
  }

  echo "<br>";
  echo password_hash('password', PASSWORD_DEFAULT);
?>

<script src='static/js/moment.js'></script>

<?php
    require_once '_functions_.php';
    require_once 'core/init.php';

    _header('Home Page');
    _nav_panel();

    error_reporting(E_ERROR);
?>

<div class='container-fluid'>
  <div class="row">
    <div class='col-md-2' >
    </div>
    <div class='col-md-8 center-any'>
      <div class="menu-container">
    		<a href="reported_issues.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
    					  		<i class="fas fa-user-cog"></i>
    						</div>
    						<p>View Reported Issues</p>
    					</div>

    				</div>
    			</div>
    		</a>
    		<a href="addressed_issues.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
    					  		<i class="far fa-calendar-check"></i>
    						</div>
    						<p>View Addressed Issues</p>
    					</div>
    				</div>
    			</div>
    		</a>
    		<a href="pending_issues.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
    					  		<i class="far fa-calendar-times"></i>
    						</div>
    						<p>View Pending Issues</p>
    					</div>
    				</div>
    			</div>
    		</a>
    		<a href="analytics.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
    					  		<i class="fas fa-chart-pie"></i>
    						</div>
    						<p>Analytics</p>
    					</div>
    				</div>
    			</div>
    		</a>
        <a href="report.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
                  <i class="fas fa-chart-area"></i>
    						</div>
    						<p>Generate Report</p>
    					</div>
    				</div>
    			</div>
    		</a>
    		<a href="__users__.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
    					  		<i class="fas fa-user-plus"></i>
    						</div>
    						<p>Add New User</p>
    					</div>
    				</div>
    			</div>
    		</a>
    		<a href="view_edit_user.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
    					  		<i class="fas fa-users"></i>
    						</div>
    						<p>View and Edit Users</p>
    					</div>
    				</div>
    			</div>
    		</a>
    		<a href="change_password.php">
    			<div class="cat-border" >
    				<div class="item">
    					<div class="item">
    					<div class="icon-wrapper">
    						<div class="resize-icon">
    					  		<i class="fas fa-key"></i>
    						</div>
    						<p>Change Password</p>
    					</div>
    				</div>
    				</div>
    			</div>
    		</a>
    	</div>
    </div>
    <div class='col-md-2'>
      <br />
    </div>
  </div>
</div>
<hr>

<?php
  // add_footer();
  _footer();
?>


$('#EditModal').on('show.bs.modal', function (e) {
  var reqID= $(e.relatedTarget).data('id');
  // alert(reqID);
  $.ajax({
    type: "GET",
    url: "data_processor.php",
    data: "flag=getData&choice="+reqID,
    success:function(data) {
      var myjson = data;
      var myobj = JSON.parse(myjson);
      var _name = myobj.request_name;
      var _component = myobj.request_component
      var _email = myobj.request_email;
      var _number = myobj.request_contact_number;
      var _brand = myobj.request_brand;
      var _category = myobj.request_category;
      var _description = myobj.request_description;

      $('#request_name').val(_name);
      $('#request_component_').val(_component);
      $('#request_email').val(_email);
      $('#request_contact_number').val(_number);
      $('#request_brand_').val(_brand);
      $('#request_category_').val(_category);
      $('#request_description').val(_description);
    }
  })
});

<!-- Beginning of Edit Modal -->
<div class="modal hide fade" id="EditModal" tabindex="-1" data-focus-on="input:first" aria-hidden='true'>
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="EditModalLabel"> Request Details </h3>
      </div>

      <div class="modal-body">
        <div class="box-body pad">
          <form id="editForm" action='edit_processor.php' method='POST' enctype="multipart/form-data">
            <?php
              foreach ($form_array as $key => $value) {
                if ($value != 'request_ID') {
                  if ($value != 'request_description') {
                    echo "<div class='form-group'>
                            <input type='text' class='form-control' id='$value' readonly>
                          </div>";
                  } else {
                    echo "<div class='form-group'>
                            <textarea class='form-control' rows='5' type='text' id='$value' readonly></textarea>
                          </div>";
                  }
                } else {
                  echo "<input name='$value' type='hidden' value=''>";
                }
              }
            ?>
          </form>
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close"> Close </button>
      </div>

    </div>
  </div>
</div>
<!-- End of Edit Modal -->

$form_array = array('request_ID',
                    'request_name',
                    'request_component_',
                    'request_email',
                    'request_contact_number',
                    'request_brand_',
                    'request_category_',
                    'request_description');

                    $query = 'SELECT  request_tbl.request_ID,
                                      request_tbl.request_name,
                                      request_tbl.request_description,
                                      request_tbl.request_brand,
                                      pending_issues.pending_ID,
                                      pending_issues.attending_report,
                                      pending_issues.report_date
                              FROM    request_tbl
                              INNER JOIN pending_issues
                              ON request_tbl.request_ID = pending_issues.request_ID
                              WHERE   request_status = 1
                              ORDER BY request_date_time ASC'

                              <div>
                                <input class='btn btn-primary float-right shadow' type='submit' name='make_request' value='Mark as Pending' />
                                <input class='btn btn-primary float-right shadow mr-2' type='submit' name='make_request' value='Mark as Done' />
                              </div>
