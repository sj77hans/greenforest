<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <div class="nav">
            <div class="sb-sidenav-menu-heading"></div>
            <a class="nav-link" href="/main.php">
                <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                관리자홈
            </a>
            <a class="nav-link <?php if($Bdiv !== '1') echo "collapsed" ?>" href="#" data-toggle="collapse" data-target="#sales" aria-expanded="<?php if($Bdiv !== '1') echo "false"; else echo "ture" ?>" aria-controls="sales">
                <div class="sb-nav-link-icon"><i class="fas fa-cart-arrow-down"></i></div>
                판매관리
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($Bdiv === '1') echo "show" ?>" id="sales" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '1' && $Mdiv === '1') echo "active"; ?>" href="/sales/offline_writeform.php?Bdiv=1&Mdiv=1">매장판매</a>
                        <?php if($Bdiv === '1' && $Mdiv === '1') echo "<div class='triangle'></div>"; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '1' && $Mdiv === '2') echo "active"; ?>" href="/sales/online_writeform.php?Bdiv=1&Mdiv=2">온라인판매</a>
                        <?php if($Bdiv === '1' && $Mdiv === '2') echo "<div class='triangle'></div>"; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '1' && $Mdiv === '3') echo "active"; ?>" href="/sales/sales_list.php?Bdiv=1&Mdiv=3">판매관리</a>
                        <?php if($Bdiv === '1' && $Mdiv === '3') echo "<div class='triangle'></div>"; ?>
                    </div>
                </nav>
            </div>
            <a class="nav-link <?php if($Bdiv !== '2') echo "collapsed" ?>" href="#" data-toggle="collapse" data-target="#products" aria-expanded="<?php if($Bdiv !== '2') echo "false"; else echo "ture" ?>" aria-controls="products">
                <div class="sb-nav-link-icon"><i class="fas fa-seedling"></i></div>
                상품관리
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($Bdiv === '2') echo "show" ?>" id="products" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '2' && $Mdiv === '1') echo "active"; ?>" href="/products/products_list.php?Bdiv=2&Mdiv=1">상품관리</a>
                        <?php if($Bdiv === '2' && $Mdiv === '1') echo "<div class='triangle'></div>"; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '2' && $Mdiv === '2') echo "active"; ?>" href="/products/category_list.php?Bdiv=2&Mdiv=2">카테고리관리</a>
                        <?php if($Bdiv === '2' && $Mdiv === '2') echo "<div class='triangle'></div>"; ?>
                    </div>
                </nav>
            </div>
            <a class="nav-link <?php if($Bdiv !== '3') echo "collapsed" ?>" href="#" data-toggle="collapse" data-target="#statistics" aria-expanded="<?php if($Bdiv !== '3') echo "false"; else echo "ture" ?>" aria-controls="statistics">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                통계
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($Bdiv === '3') echo "show" ?>" id="statistics" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '3' && $Mdiv === '1') echo "active"; ?>" href="/statistics/sales_list.php?Bdiv=3&Mdiv=1">매출통계</a>
                        <?php if($Bdiv === '3' && $Mdiv === '1') echo "<div class='triangle'></div>"; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '3' && $Mdiv === '2') echo "active"; ?>" href="/statistics/visit_list.php?Bdiv=3&Mdiv=2">방문자통계</a>
                        <?php if($Bdiv === '3' && $Mdiv === '2') echo "<div class='triangle'></div>"; ?>
                    </div>
                </nav>
            </div>
            <a class="nav-link <?php if($Bdiv !== '4') echo "collapsed" ?>" href="#" data-toggle="collapse" data-target="#account" aria-expanded="<?php if($Bdiv !== '4') echo "false"; else echo "ture" ?>" aria-controls="account">
                <div class="sb-nav-link-icon"><i class="fas fa-won-sign"></i></div>
                입출금
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($Bdiv === '4') echo "show" ?>" id="account" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '4' && $Mdiv === '1') echo "active"; ?>" href="/statistics/bank_list.php?Bdiv=4&Mdiv=1">통장거래</a>
                        <?php if($Bdiv === '4' && $Mdiv === '1') echo "<div class='triangle'></div>"; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '4' && $Mdiv === '2') echo "active"; ?>" href="/statistics/card_list.php?Bdiv=4&Mdiv=2">카드거래</a>
                        <?php if($Bdiv === '4' && $Mdiv === '2') echo "<div class='triangle'></div>"; ?>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <a class="nav-link <?php if($Bdiv === '4' && $Mdiv === '3') echo "active"; ?>" href="/statistics/cash_list.php?Bdiv=4&Mdiv=3">현금거래</a>
                        <?php if($Bdiv === '4' && $Mdiv === '3') echo "<div class='triangle'></div>"; ?>
                    </div>
                </nav>
            </div>


            <!-- <a class="nav-link <?php if($Bdiv !== '2') echo "collapsed" ?>" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="<?php if($Bdiv !== '2') echo "false"; else echo "ture" ?>" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-file-signature"></i></div>
                서명운동관리
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse <?php if($Bdiv === '2') echo "show" ?>" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="/members/member_list.php">서명운동 현황</a>
                    <a class="nav-link" href="/members/member_joinlist.php">서명추가</a>
                </nav>
            </div>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                Pages
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                        Authentication
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="login.html">Login</a>
                            <a class="nav-link" href="register.html">Register</a>
                            <a class="nav-link" href="password.html">Forgot Password</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                        Error
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="401.html">401 Page</a>
                            <a class="nav-link" href="404.html">404 Page</a>
                            <a class="nav-link" href="500.html">500 Page</a>
                        </nav>
                    </div>
                </nav> 
            </div>
            <div class="sb-sidenav-menu-heading">Products</div>
            <a class="nav-link" href="/board/notice_list.php">
                <div class="sb-nav-link-icon"><i class="fas fa-bullhorn"></i></div>
                공지사항
            </a>
            <a class="nav-link" href="/news_list.php">
                <div class="sb-nav-link-icon"><i class="fas fa-podcast"></i></div>
                언론보도
            </a>
            <div class="sb-sidenav-menu-heading">Statistics</div>
            <a class="nav-link" href="/board/notice_list.php">
                <div class="sb-nav-link-icon"><i class="fas fa-chart-line"></i></div>
                접속통계
            </a>-->
        </div>
    </div>
    <!-- <div class="sb-sidenav-footer">
        <div></div>
    </div> -->
</nav>