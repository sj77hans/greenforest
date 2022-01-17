<?php
        include './include/dbcon.inc.php';
        if(!isset($_POST['is_ajax'])) exit;
        if(!isset($_POST['user_id'])) exit;
        if(!isset($_POST['user_pw'])) exit;

        $is_ajax = $_POST['is_ajax'];
        $vadminID = strtolower(trim($_POST['user_id']));
        $vadminPasswd = strtolower(trim($_POST['user_pw']));

        $strQuery="select count(idx) as code from administrator where adminid='$vadminID' and passwd=password('$vadminPasswd') limit 1";
        $results=mysqli_query($conn, $strQuery);
        $row_num=mysqli_fetch_array($results);
        $rowCount=$row_num[code];

        if ($rowCount) {	 /* 동일한 정보가 있을 경우 */
                $strQuery="select idx, name, adminid from administrator where adminid='$vadminID' and passwd=password('$vadminPasswd') limit 1";
                $results=mysqli_query($conn, $strQuery);
                $row=mysqli_fetch_array($results);

                session_start();

                $_SESSION['adminSIDX'] = $row[0];                       /* 관리자 고유번호 */
                $_SESSION['adminSNAME'] = $row[1];                      /* 관리자명 */
                $_SESSION['adminSID'] = $row[2];                        /* 관리자 아이디 */
                $_SESSION['adminSIP'] = $_SERVER['REMOTE_ADDR'];	/* 사용자 IP */

                echo "success";	
        } else {
                exit;
        }
?>