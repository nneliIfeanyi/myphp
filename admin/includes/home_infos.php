<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
            <div class="inner">
                <?php
                //select unread messages from the database

                $sql = "SELECT COUNT(name) FROM classes";
                $conn->query($sql);
                $result = $conn->fetchColumn();
                ?>
                <h3><?php echo $result; ?></h3>

                <p>Classes</p>
            </div>
            <div class="icon">
                <i class="fas fa-address-book"></i>
            </div>
            <a href="class" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <?php
                $sql = "SELECT COUNT(studentID) FROM student";
                $conn->query($sql);
                $all_students = $conn->fetchColumn();
                ?>
                <h3><?php echo $all_students; ?></h3>

                <p>Students</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
            <a href="student" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                 <?php
                $sql = "SELECT COUNT(id) FROM sections";
                $conn->query($sql);
                $all_sections = $conn->fetchColumn();
                ?>
                <h3><?php echo $all_sections; ?></h3>

                <p>Sections</p>
            </div>
            <div class="icon">
                <i class="fas fa-list-ol"></i>
            </div>
            <a href="section" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <?php
                //select unread messages from the database
                $sql = "SELECT COUNT(id) FROM subjects";
                $conn->query($sql);
                $subjects = $conn->fetchColumn();
                ?>
                <h3><?php echo $subjects; ?></h3>

                <p>Subjects</p>
            </div>
            <div class="icon">
                <i class="fas fa-table"></i>
            </div>
            <a href="subject" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-secondary">
            <div class="inner">
                <?php
                $on = 'on';
                $sql ="SELECT COUNT(id) from teachers WHERE status =:on";
                $conn->query($sql);
                $conn->bind(":on", $on);
                $teachers = $conn->fetchColumn();
                ?>
                <h3><?php echo $teachers; ?></h3>

                <p>All Teachers</p>
            </div>
            <div class="icon">
                <i class="fas fa-book"></i>
            </div>
            <a href="teacher" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

</div>