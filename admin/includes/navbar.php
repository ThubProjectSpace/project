     <!-- Navigation -->
        <nav class="top1 navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="home.php" class="navbar-brand logo" ><b><img src="images/log.png" class="img-responsive" width="50" style="margin-top: -13px;"></b></a>
                <a class="navbar-brand" href="home.php">Staff Attendance</a>

            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-nav navbar-right">
                <li style="margin-top: 13px;">
                    <strong style="font-size: 18px;"><?php echo ucfirst($_SESSION['username']); ?></strong>
                </li>
			    <li class="dropdown">
                    <?php
                        $query = "select * from `staff` where id='".$_SESSION['id']."' ";
                        $res = mysqli_query($con, $query);
                        $row = mysqli_fetch_array($res);

                        $filename = 'images/users/'.$row['profile'];
                        if($row['profile']=="") {
                            $row['profile'] = 'user.png';
                        }
                        if (!file_exists($filename)) {
                            $row['profile'] = 'user.png';
                        }
                    ?>
	        		<a href="#" class="dropdown-toggle avatar" data-toggle="dropdown"><img src="images/users/<?php echo $row['profile']; ?>"></a>
	        		<ul class="dropdown-menu">
						<li class="dropdown-menu-header text-center">
							<strong>Settings</strong>
						</li>
						<li class="m_2"><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
                        <?php
                         if ($_SESSION['user_type']=='admin') {
                            
                        ?><li class="m_2"><a href="notify.php"><i class="fa fa-bell-o"></i>Notifications</a></li>
                        <?php
                         }
                        ?>
						<li class="m_2"><a href="settings.php"><i class="fa fa-wrench"></i> Settings</a></li>
						<li class="m_2"><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>	
	        		</ul>
	      		</li>
			</ul>

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="home.php"><i class="fa fa-dashboard fa-fw nav_icon"></i>Dashboard</a>
                        </li>
                        <li>
                            <a href="reports.php"><i class="fa fa-files-o nav_icon"></i>Reports</a>
                        </li>
                        <?php
                         if ($_SESSION['user_type']=='admin') {
                            
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-users nav_icon"></i>Staff<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="staff_view.php">View</a></li>
                                <li><a href="staff_add.php">Add</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw nav_icon"></i>Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="users.php">All Users</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

                        <li>
                            <a href="#"><i class="fa fa-edit nav_icon"></i>Attendance<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="manual_insert.php">Manual Insert</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="mailings.php"><i class="fa fa-envelope fa-fw nav_icon"></i>Mailings</a>
                        </li>
                         <li>
                            <a href="sms.php"><i class="fa fa-comments-o"></i> SMS </a>
                        </li>
                         <li>
                            <a href="approval.php"><i class="fa fa-check-square-o fa-fw nav_icon"></i>Leave Approval</a>
                        </li>
                        <?php
                          }
                          ?>
                          <li>
                            <a href="leave.php"><i class="fa fa-edit fa-fw nav_icon"></i>Leave Application</a>
                        </li>
                        <li>
                            <a href="profile.php"><i class="fa fa-user fa-fw nav_icon"></i>Profile</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>