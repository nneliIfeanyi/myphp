<?php
$change_style = "font-size: 13px; color: #17a2b8; padding: 4px;";

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $base_url; ?>" class="brand-link">
        <img src="<?php echo $conn->base_url(); ?>upload/<?php echo $logo; ?>" alt="<?php echo $logo; ?>" class="brand-image img-circles elevation-4" style="opacity: .8">
        <span class="brand-text font-weight-light" style="visibility: hidden;">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="<?php echo $conn->base_url();  ?>" <?php
                      if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){
                          //APPLY THE ACTIVE CLASS
                          echo 'class = "nav-link active"';
                      }else{
                          echo 'class = "nav-link"';
                      }
                    ?>>
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo $conn->base_url();?>student" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'student.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'add-student.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'edit-student.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'view-student.php'){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fas fa-graduation-cap"></i>
                        <p>
                            Student
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="<?php echo $conn->base_url();?>teacher" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'teacher.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'add-teacher.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'view-teacher.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'edit-teacher.php'){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                          Teacher
                        </p>
                    </a>
                </li>

                <!--    start academics sidebar-->
                <li <?php
                   if(basename($_SERVER['SCRIPT_NAME']) == 'class.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'section.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'add-section.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'edit-section.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'subject.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'add-class.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'edit-class.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'edit-subject.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'add-subject.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'promotion.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-university"></i>
                        <p>
                            Academic
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $base_url; ?>class"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'class.php'
                                    || basename($_SERVER['SCRIPT_NAME']) == 'add-class.php'
                                    || basename($_SERVER['SCRIPT_NAME']) == 'edit-class.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-sitemap nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p>Class</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $base_url; ?>section"
                            <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'section.php'
                                || basename($_SERVER['SCRIPT_NAME']) == 'add-section.php'
                                || basename($_SERVER['SCRIPT_NAME']) == 'edit-section.php'){
                                //APPLY THE ACTIVE CLASS
                                echo 'class = "nav-link active"';
                            }else{
                                echo 'class = "nav-link"';
                            }
                            ?>>
                                <i class="fas fa-star nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p>Section</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $base_url; ?>subject"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'subject.php'
                                    || basename($_SERVER['SCRIPT_NAME']) == 'add-subject.php'
                                    || basename($_SERVER['SCRIPT_NAME']) == 'edit-subject.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-book nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p>Subject</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url().'promotion'; ?>"<?php
                            if(basename($_SERVER['SCRIPT_NAME']) == 'promotion.php'){
                                echo 'class = "nav-link active"';
                            }else{
                                echo 'class = "nav-link"';
                            }
                            ?>>
                                <i class="fas fa-graduation-cap nav-icon" style="<?php echo $change_style;?>"></i>
                                <p>Promotion</p>
                            </a>
                        </li>

                    </ul>
                </li>

<!--                end academics sidebar-->


                <!-- start administrator -->
                <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'resetpassword.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'systemadmin.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Administrator
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>resetpassword"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'resetpassword.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-lock nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Reset Password </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>systemadmin"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'systemadmin.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-user nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> System Admin </p>
                            </a>
                        </li>

                    </ul>
                </li>

                <!-- end system administrator -->

                <!-- start exam and grading -->

                <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'exam.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'add-exam.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'edit-exam.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'add-grade.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'edit-grade.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'grade.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-edit"></i>
                        <p>
                            Exam
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>exam"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'exam.php'
                                           || basename($_SERVER['SCRIPT_NAME']) == 'add-exam.php'
                                           || basename($_SERVER['SCRIPT_NAME']) == 'edit-exam.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-university nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Exam </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>grade"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'grade.php'
                                           || basename($_SERVER['SCRIPT_NAME']) == 'add-grade.php'
                                           || basename($_SERVER['SCRIPT_NAME']) == 'edit-grade.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-signal nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Grade </p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- end exam and grading -->

                    <!-- start mark sidebar content -->

                    <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'mark.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'view-mark.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'add-mark.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>
                            Mark
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>mark"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'mark.php'
                                           || basename($_SERVER['SCRIPT_NAME']) == 'add-mark.php'
                                           || basename($_SERVER['SCRIPT_NAME']) == 'view-mark.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-flask nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Mark </p>
                            </a>
                        </li>
                    </ul>
                </li>
               <!-- end mark sidebar content -->

<!--                start homepage settings menu -->
                <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'settings.php'
                   || basename($_SERVER['SCRIPT_NAME']) == 'show-position.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cog"></i>
                        <p>
                            Settings
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>settings"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'settings.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-hammer nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> General Settings </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url().'show-position'; ?>"  <?php
                            if(basename($_SERVER['SCRIPT_NAME']) == 'show-position.php'){
                                echo 'class = "nav-link active"';
                            }else{
                                echo 'class = "nav-link"';
                            }
                            ?>>
                                <i class="fas fa-chalkboard-teacher nav-icon" style="<?php echo $change_style;?>"></i>
                                <p>Positions Setting</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!--               end  homepage settings menu-->


                <!--                start pin management  menu -->
                <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'view-pins-requests.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'generate-pins.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'set-card-usage-limit.php'
                  || basename($_SERVER['SCRIPT_NAME']) == 'set-card-expire-date.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-map-marker"></i>
                        <p>
                            Pin Management
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>generate-pins"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'generate-pins.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-map-pin nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Generate Pins</p>
                            </a>
                        </li> -->

                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>view-pins-requests"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'view-pins-requests.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-search nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> View Pins Requests </p>
                            </a>
                        </li>


                        <!-- <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>set-card-usage-limit"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'set-card-usage-limit.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-id-card nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Set Card Usage Limit </p>
                            </a>
                        </li> -->

                        <!-- <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>set-card-expire-date"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'set-card-expire-date.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-calendar-alt nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Set Card Expire Date </p>
                            </a>
                        </li>
 -->
                    </ul>
                </li>
                <!--               end pin management menu -->

                <!-- start Terminal Report sidebar content -->

                <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'terminal-report.php'){
                    //APPLY THE ACTIVE CLASS
                    echo 'class = "nav-item menu-open"';
                }else{
                    echo 'class = "nav-item"';
                }
                ?>>
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-bullhorn"></i>
                        <p>
                            Reports
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>

                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo $conn->base_url(); ?>terminal-report"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'terminal-report.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-flask nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Terminal Report </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end terminal report sidebar content -->


                <!--              Report card comments -->
                <li class="nav-item">
                    <a href="<?php echo $conn->base_url();?>report-comments" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'report-comments.php'
                       ||basename($_SERVER['SCRIPT_NAME']) == 'add-comment.php' ){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fas fa-comment"></i>
                        <p>Report Card Comments
                        </p>
                    </a>
                </li>
                <!--              Report card comments end -->

                <!--            Student Attendance -->
                <li class="nav-item">
                    <a href="<?php echo $conn->base_url();?>attendance" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'attendance.php'
                        ||basename($_SERVER['SCRIPT_NAME']) == 'add-attendance.php' ){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fas fa-calendar"></i>
                        <p>Manage Attendance
                        </p>
                    </a>
                </li>
                <!--              Student Attendance end -->



                <li class="nav-item">
                    <a href="<?php echo $conn->base_url();?>logout" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'logout.php'){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fas fa-lock"></i>
                        <p>Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>