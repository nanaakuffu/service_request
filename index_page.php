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
