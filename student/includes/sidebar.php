<?php
$change_style = "font-size: 13px; color: #17a2b8; padding: 4px;";

?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo $main_url; ?>/student/index" class="brand-link">
        <img src="<?php echo $main_url; ?>/admin/upload/<?php echo $logo; ?>" alt="<?php echo $logo; ?>" class="brand-image img-circles elevation-4" style="opacity: .8">
        <span class="brand-text font-weight-light" style="visibility: hidden;">Student</span>
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
                    <a href="<?php echo $conn->student_url();  ?>" <?php
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
                    <a href="<?php echo $conn->student_url();  ?>check-result" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'check-result.php'
                       || basename($_SERVER['SCRIPT_NAME']) == 'view-result.php' ){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?>>
                        <i class="nav-icon fa fa-bookmark"></i>
                        <p>
                          Check Result
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="javascript:void();" <?php
                    if(basename($_SERVER['SCRIPT_NAME']) == 'contact.php'){
                        //APPLY THE ACTIVE CLASS
                        echo 'class = "nav-link active"';
                    }else{
                        echo 'class = "nav-link"';
                    }
                    ?> data-toggle="modal" data-target="#contact-admin">
                        <i class="nav-icon fas fa-phone"></i>
                        <p>
                            Contact Admin
                        </p>
                    </a>
                </li>

                <!--                start homepage settings menu -->
                <li <?php
                if(basename($_SERVER['SCRIPT_NAME']) == 'settings.php'){
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
                            <a href="<?php echo $conn->student_url(); ?>settings"
                                <?php   if(basename($_SERVER['SCRIPT_NAME']) == 'settings.php'){
                                    //APPLY THE ACTIVE CLASS
                                    echo 'class = "nav-link active"';
                                }else{
                                    echo 'class = "nav-link"';
                                }
                                ?>>
                                <i class="fas fa-hammer nav-icon" style="<?php echo $change_style; ?>"></i>
                                <p> Change Password </p>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--               end  homepage settings menu-->





                <li class="nav-item">
                    <a href="<?php echo $conn->student_url();?>logout" <?php
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

<div id="contact-admin" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-warning">We are always ready to help</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p> Have a query, feedback or just want to say hi?</p>
                <p> Call/Whatsapp School Admin on the phone number below</p>

                <a href="javascript:void" style="color: #0c515c; "> <i class="fab fa-whatsapp"></i> +2348122321931 </a> &nbsp; &nbsp;
                <a href="javascript:void" style="color: #0c515c"> <i class="fa fa-phone"></i>  +2348076602896</a>

            </div>
        </div>
    </div>
</div>
