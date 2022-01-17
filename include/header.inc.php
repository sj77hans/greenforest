<?php
    $SiteTitle = "그린포레스트 관리자";
    $Favicons = "/img/gf_favicon_s.png";
    
    $Bdiv = $_GET['Bdiv'];
    $Mdiv = $_GET['Mdiv'];

    $varIdx = $_GET['idx'];
    $varToday = date('Y-m-d');

    $thisPage = $_SERVER['REQUEST_URI'];
    $prePage = $_SERVER['HTTP_REFERER'] ;

    switch($Bdiv){
        case 1:
            $Btitle = "판매관리";
            switch($Mdiv){
                case 1:
                    $Mtitle = "매장판매";
                break;

                case 2:
                    $Mtitle = "온라인판매";
                break;
            
                case 3:
                    $Mtitle = "판매관리";
                break;
            }
        break;

        case 2:
            $Btitle = "상품관리";

            switch($Mdiv){
                case 1:
                    $Mtitle = "상품관리";
                break;

                case 2:
                    $Mtitle = "카테고리관리";
                break;
            }
        break;

        case 3:
            $Btitle = "통계";

            switch($Mdiv){
                case 1:
                    $Mtitle = "매출통계";
                break;

                case 2:
                    $Mtitle = "방문자통계";
                break;
            }
        break;

        case 4:
            $Btitle = "입출금";

            switch($Mdiv){
                case 1:
                    $Mtitle = "통장거래";
                break;

                case 2:
                    $Mtitle = "카드거래";
                break;

                case 3:
                    $Mtitle = "현금거래";
                break;
            }
        break;

        default:
            $Mtitle = "관리자메인";
        break;
    }
?>
