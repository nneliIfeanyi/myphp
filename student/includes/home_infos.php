<?php

$sql = "SELECT * FROM student WHERE username = :username";
$conn->query($sql);
$conn->bind(":username", $_SESSION['student']);
$query = $conn->rowCount();
if ($query) {
    $result = $conn->fetchSingle();
    $name = $result->name;
}

?>

<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <?php
                //fetch total number of cards used by student
                $sql = "SELECT COUNT(pin_code) FROM pins WHERE used_by =:student AND card_availability =:close";
                $conn->query($sql);
                $conn->bind(":student", $name);
                $conn->bind(":close", 'close');
                $result = $conn->fetchColumn()
                ?>
                <h3><?php echo $result;?></h3>
                <p>Total used card(s)</p>
            </div>

            <div class="icon">
                <i class="fas fa-address-book"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <?php
                //fetch total number of cards used by student
                $sql = "SELECT COUNT(pin_code) FROM pins WHERE used_by =:student AND card_availability =:open";
                $conn->query($sql);
                $conn->bind(":student", $name);
                $conn->bind(":open", 'open');
                $result = $conn->fetchColumn()
                ?>
                <h3><?php echo $result;?></h3>
                <p>Active Cards</p>
            </div>

            <div class="icon">
                <i class="fa fa-list"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <?php
                //fetch total number of cards used by student
                $sql = "SELECT expire_date FROM card_expire_date";
                $conn->query($sql);
                $expiration = $conn->fetchColumn()
                ?>
                <h3><?php echo $expiration;?></h3>
                <p>Cards Expiration</p>
            </div>

            <div class="icon">
                <i class="fas fa-list-ol"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <?php
                //fetch total number of cards used by student
                $sql = "SELECT card_limit FROM card_usage_limit";
                $conn->query($sql);
                $card_limit= $conn->fetchColumn()
                ?>
                <h3><?php echo $card_limit;?></h3>
                <p>Current Card Usage Limit</p>
            </div>

            <div class="icon">
                <i class="fas fa-list-ol"></i>
            </div>
        </div>
    </div>
</div>
