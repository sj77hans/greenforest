<?php include('include/header.inc.php'); ?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="robots" content="nofollow">
    <title><?= $SiteTitle ?></title>
    <link href="<?= $Favicons ?>" rel="icon">
	<!-- Vendor CSS Files -->
	<link href="lib/bootstrap/4.5.3/css/bootstrap.min.css" rel="stylesheet">
	<!-- Default CSS/JS Files -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body class="bg-login">
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
                        <div>
                            <img src="img/gf_logo.svg" class="brand_logo" alt="Logo">
                            <h3 class="text-center font-weight-light">관리자로그인</h3>
                        </div>
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form id="loginform" class="needs-validation" method="post" action="loginchk.php" novalidate>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="userid" id="userid" class="form-control input_user" value="" placeholder="userid" onkeyup="trim(this);" required>
						</div>
						<div class="input-group">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" id="password" class="form-control input_pass" value="" placeholder="password" onkeyup="trim(this);" required><br>
						</div>
						<div id="error_wrap" class="text-center">
							<span class="error_msg"></span>
						</div>
						<div class="text-center">
                            <button type="submit" class="btn login_btn">Login</button>
                        </div>
					</form>
					<!-- Vendor CSS Files -->
					<script src="https://code.jquery.com/jquery-latest.min.js" crossorigin="anonymous"></script>
					<script src="lib/fontawesome/5.15.3/js/all.min.js"  crossorigin="anonymous"></script>
					<script src="js/login.js" crossorigin="anonymous"></script>
					<script src="js/script.js" crossorigin="anonymous"></script>
				</div>
				<div class="mt-4">
					<div class="d-flex justify-content-center">
                        <div class="user-card-footer text-center">
                            <div class="small">Copyright &copy; www.greenforest_kr.com 2021</div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
</html>
테스트