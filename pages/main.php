<?php 
    require '../assets/nav.php';
    require '../includes/db.php';
?>

<div class="container">
    <div class="main">
        <div class="left block">
            <div class="info">left</div>
            <div class="info">left</div>
        </div>

        <div class="center ">
            <div class="post">
                <h5>Wellcome, <?php echo $_SESSION['user']->login ?></h5>
            </div>
            <div class="post">center</div>
        </div>

        <div class="right block">
            <div class="info">right</div>
        </div>    
    </div>

</div>
<?php require '../assets/footer.php' ?>
