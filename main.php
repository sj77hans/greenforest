<?php 
    include('include/header.inc.php'); 
    include('include/session.inc.php');
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="nofollow">
    <title><?= $SiteTitle ?></title>
    <!-- Favicons -->
    <link href="<?= $Favicons ?>" rel="icon">
    <!-- Vendor CSS/JS Files -->
	<script src="https://code.jquery.com/jquery-latest.min.js" crossorigin="anonymous"></script>
    <script src="lib/bootstrap/4.5.3/js/bootstrap.min.js" crossorigin="anonymous"></script>
	<script src="lib/fontawesome/5.15.3/js/all.min.js"  crossorigin="anonymous"></script>
    <link href="lib/bootstrap/4.5.3/css/bootstrap.min.css" rel="stylesheet">
	<!-- Default CSS/JS Files -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
    <header>
        <?php include './section/header.php'; ?>
    </header>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <sidemenu>
                <?php include './section/sidemenu.php'; ?>
            </sidemenu>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h3 class="mt-4"><?= $Mtitle ?></h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><i class="fa fa-home"></i></li>
                    </ol>
            </main>
            <footer>
                <?php include './section/footer.php'; ?>
            </footer>
        </div>
    </div>
    <script src="js/sidebarToggle.js" crossorigin="anonymous"></script>
</body>
</html>