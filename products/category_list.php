<?php 
    include('../include/dbcon.inc.php'); 
    include('../include/header.inc.php'); 
    include('../include/session.inc.php');

    // 1차 카테고리 수
    $strQuery="select count(idx) as code from category1";
    $results=mysqli_query($conn, $strQuery);
    $row=mysqli_fetch_array($results);
	$category1_record=$row[code];
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
    <!-- Vendor CSS Files -->
    <link href="../lib/bootstrap/4.5.3/css/bootstrap.min.css" rel="stylesheet">
	<!-- Default CSS Files -->
    <link href="../css/style.css" rel="stylesheet">
</head>
<body class="sb-nav-fixed">
    <header>
        <?php include '../section/header.php'; ?>
    </header>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <sidemenu>
                <?php include '../section/sidemenu.php'; ?>
            </sidemenu>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h3 class="mt-4"><?= $Mtitle ?></h3>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item align-items-center"><i class="fa fa-home"></i></li>
                        <li class="breadcrumb-item"><?= $Btitle ?></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $Mtitle ?></li>
                    </ol>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-list mr-1"></i>카테고리 구성</div>
                                <div class="card-body">
                                <?php
                                    if (!$category1_record) { //등록된 카테고리가 없을경우
                                        echo "<p class='card-text text-primary small'>등록된 카테고리가 없습니다.</p>";
                                    }
                                    else {
                                ?>
                                    <p class="card-text text-primary small">※ 드래그하여 순서 지정</p>
                                    <table id="category_table" class="table table-stripped table-hover">
                                        <tbody>
                                        <?php
                                        $strQuery="select idx, position, cate1name from category1 order by position asc";
                                        $results=mysqli_query($conn, $strQuery);

                                        while ($row=mysqli_fetch_array($results)) {
                                            $rs_idx=$row[idx];
                                            $rs_position=$row[position];
                                            $rs_cate1name=$row[cate1name]; ?>

                                            <tr data-index="<?= $rs_idx ?>" data-position="<?= $rs_position ?>" class="d-flex pointer table-info">
                                                <td class="col-2"><i class="fas fa-bars mr-2"></i></td>
                                                <td class="col-7"><span class="badge badge-success mr-1"><?= $rs_position; ?></span><span class="text-left"><?= $rs_cate1name; ?></td>
                                                <td class="col-3">
                                                    <div class="btn-group">
                                                        <button id="btnGroupDrop1-<?= $rs_idx; ?>" type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-edit mr-1"></i><span class="editToggle">EDIT</span></button>
                                                        <ul class="dropdown-menu dropdown-menu-lg-right dropdown-menu-samll" aria-labelledby="btnGroupDrop1-<?= $rs_idx; ?>">
                                                            <li><a class="dropdown-item small" href="#" data-toggle="modal" data-target="#UpdateCate1" data-cate1name="<?= $rs_cate1name; ?>" data-idx="<?php echo $rs_idx ?>"><i class="fa fa-pencil-alt mr-1"></i>수정</a></li>
                                                            <div class="dropdown-divider"></div>
                                                            <li><a class="dropdown-item small" href="#" data-toggle="modal" data-target="#DeleteCate1" data-cate1name="<?= $rs_cate1name; ?>" data-idx="<?php echo $rs_idx ?>"><i class="fa fa-trash-alt mr-1"></i>삭제</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            }
                                            mysqli_close($conn);
                                        ?>
                                        </tbody>
                                    </table>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4">
                                <div class="card-header"><i class="fas fa-plus-square mr-1"></i>카테고리 만들기</div>
                                <div class="card-body">
                                    <form id="category1_writeform" class="needs-validation" method="post" action="category1_writeok.php" novalidate>
                                        <div class="form-inline">
                                            <div class="form-group mb-2 mr-2">
                                                <input type="text" class="form-control input_cate1name" name="category1_name" id="category1_name" maxlength="15" value="" placeholder="카테고리 이름" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary mb-2">확인</button>
                                        </div>
                                        <span class="error_msg"></span>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <footer>
                <?php include '../section/footer.php'; ?>
            </footer>
        </div>
    </div>
    <!-- Modal -->
    <!-- 카테고리 Delete -->
    <div class="modal fade" id="DeleteCate1" tabindex="-1" role="dialog" aria-labelledby="DeleteCate1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h6 class="modal-title" id="DeleteCate1Label"><i class="fas fa-trash-alt mr-1"></i>카테고리 삭제</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
                </div>
                <div class="modal-body">
                    <p>[<span class="modal_cate1name text-primary"></span>]을 삭제하시겠습니까?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">취소</button>
                    <button type="button" id="btnCate1Del" class="btn btn-primary btn-sm">삭제</button>
                </div>
            </div>
        </div>
    </div>
    <!-- 카테고리 수정 -->
    <div class="modal fade" id="UpdateCate1" tabindex="-1" role="dialog" aria-labelledby="UpdateCate1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <form name="category1_editform" id="category1_editform" class="needs-validation" method="post" action="category1_editok.php" novalidate>
                    <div class="modal-header bg-primary text-white">
                        <h6 class="modal-title" id="UpdateCate1Label"><i class="fas fa-edit mr-1"></i>카테고리 수정</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="category1_name_edit" id="category1_name_edit" size="30" maxlength="15" value="" placeholder="카테고리 이름" required>
                        <input type="hidden" name="category1_idx_edit" id="category1_idx_edit" value="">
                        <span class="error_msg mt-1"></span>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">취소</button>
                        <button type="submit" id="btnCate1Update" class="btn btn-primary btn-sm">확인</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
	<script src="https://code.jquery.com/jquery-latest.min.js" crossorigin="anonymous"></script>
	<script src="../lib/fontawesome/5.15.3/js/all.min.js"  crossorigin="anonymous"></script>
    <script src="../lib/bootstrap/4.5.3/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../lib/jquery/ui/1.12.1/js/jquery-ui.js" crossorigin="anonymous"></script>
    <script src="../lib/jquery/touch/0.2.3/js/jquery.ui.touch-punch.min.js" crossorigin="anonymous"></script>
    <script src="../lib/sweetalert2/11.0.18/js/sweetalert2.all.min.js" crossorigin="anonymous"></script>
    <script src="../js/sidebarToggle.js" crossorigin="anonymous"></script>
    <script src="../js/dragdrop.js" crossorigin="anonymous"></script>
    <script src="category_list.js" crossorigin="anonymous"></script>
</body>
</html>