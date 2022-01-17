<?php
        include '../include/dbcon.inc.php';
        if(!isset($_POST['is_ajax'])) exit;
        if(!isset($_POST['category1_name'])) exit;

        $is_ajax = $_POST['is_ajax'];
        $vaCate1Name = strtolower(trim($_POST['category1_name']));

        $strQuery="select count(idx) as code from category1 where cate1name='$vaCate1Name' limit 1";
        $results=mysqli_query($conn, $strQuery);
        $row_num=mysqli_fetch_array($results);
        $rowCount=$row_num[code];

        if (!$rowCount) {	 /* 동일한 이름이 없을 경우 */
            
            $strQuery="SELECT MAX(position) FROM category1";
            $results=mysqli_query($conn, $strQuery);
            $row=mysqli_fetch_row($results);
            @mysqli_free_result($results);
            
            if ($row[0]) {
                $positionNum = $row[0] + 1;
            } else {
                $positionNum = 1;
            }

            //category1 테이블에 삽입
            $strQuery="INSERT INTO category1 (position, cate1name) VALUES ($positionNum, '$vaCate1Name')";
            
            if (!mysqli_query($conn, $strQuery)) {
                die('Error: ' . mysqli_error($conn));
            }

            mysqli_close($conn);

            echo "success";	
        } else {
            exit;
        }
?>