<?php
        include '../include/dbcon.inc.php';
        if(!isset($_POST['is_ajax'])) exit;
        if(!isset($_POST['category1_name_edit'])) exit;
        if(!isset($_POST['category1_idx_edit'])) exit;

        $is_ajax = $_POST['is_ajax'];
        $vaCate1Name = strtolower(trim($_POST['category1_name_edit']));
        $vaCate1Idx = trim($_POST['category1_idx_edit']);

        $strQuery="select count(idx) as code from category1 where cate1name='$vaCate1Name' limit 1";
        $results=mysqli_query($conn, $strQuery);
        $row_num=mysqli_fetch_array($results);
        $rowCount=$row_num[code];

        if (!$rowCount) {	 /* 동일한 이름이 없을 경우 */
            
            //category1 테이블에 수정
            $strQuery="UPDATE category1 SET cate1name='$vaCate1Name' WHERE idx=$vaCate1Idx";
            
            if (!mysqli_query($conn, $strQuery)) {
                die('Error: ' . mysqli_error($conn));
            }

            mysqli_close($conn);

            echo "success";	
        } else {
            exit;
        }
?>