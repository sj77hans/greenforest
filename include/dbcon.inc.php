<?php
    $dbHost = 'localhost';		/* DB HOST 명 */
    $dbUser = 'gf_admin';		/*  DB 사용자 */
    $dbPwd = '@mha2770014#';		/*  DB 비밀번호 */
    $dbName = 'greenforest';				/*  DB 명 */
    $conn=mysqli_connect($dbHost, $dbUser, $dbPwd, $dbName);

    // Check connection
    if (mysqli_connect_errno()) {
        echo "DB연결에 실패했습니다." . mysqli_connect_error();
    }
?>