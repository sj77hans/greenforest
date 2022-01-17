<?php 
    include('../include/dbcon.inc.php'); 
    include('../include/header.inc.php'); 
    include('../include/session.inc.php');

    // 1차 카테고리 수
    $strQuery="select count(idx) as code from products";
    $results=mysqli_query($conn, $strQuery);
    $row=mysqli_fetch_array($results);
	$producs_record=$row[code];

    $goodscode=time();
    $goodscode="880".$goodscode;
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
    <link href="../lib/summernote/8.18/css/summernote-bs4.min.css" rel="stylesheet">
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
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <span class="align-self-center"><i class="fas fa-seedling mr-1"></i>상품목록</span>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AddItem">상품등록</button>
                            </div>
                        </div>
                        <div class="card-body">
                        <?php
                            if (!$producs_record) { //등록된 카테고리가 없을경우
                                echo "<p class='card-text text-primary small'>등록된 상품이 없습니다.</p>";
                            }
                            else {
                        ?>
                            <table id="dataTable" class="table table-bordered table-hover">
                                <thead>
                                    <th class="col-1 col-md-1 text-center">순번</th>
                                    <th class="col-2 col-md-2 text-center">구분</th>
                                    <th class="col-6 col-md-5 text-center">상품명</th>
                                    <th class="col-md-2 text-center col-display">판매가</th>
                                    <th class="col-md-1 text-center col-display">재고</th>
                                    <th class="col-2 col-md-1 text-center">관리</th>
                                </thead>
                                <tbody>
                        <?php
                                $strQuery="select A.idx, A.cate1, A.goodsname_kr, A.sellprice, A.stock, A.signdate, B.cate1name from products AS A JOIN category1 AS B WHERE A.cate1=B.idx order by signdate desc";
                                $results=mysqli_query($conn, $strQuery);

                                $rs_number = 1;

                                while ($row=mysqli_fetch_array($results)) {
                                    $rs_idx=$row[0];
                                    $rs_cate1=$row[1];
                                    $rs_goodsname_kr=$row[2];
                                    $rs_sellprice=NUMBER_FORMAT($row[3]);
                                    $rs_stock=$row[4];
                                    $rs_signdate=date("Y-m-d", strtotime($row[5]));
                                    $rs_cate1name=$row[6];  
                        ?>

                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center"><?= $rs_cate1name ?></td>
                                        <td><?= $rs_goodsname_kr; ?><?php if($rs_signdate == $varToday) echo "<span class='badge badge-pill badge-xl badge-warning ml-1'>new</span>"; ?></td>
                                        <td class="text-center col-display"><?= $rs_sellprice; ?></td>
                                        <td class="text-center col-display"><?= $rs_stock; ?></td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <button id="btnGroupDrop1-<?= $rs_idx; ?>" type="button" class="btn btn-info btn-xs dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user fa-edit mr-1"></i><span class="editToggle">EDIT</span></button>
                                                <ul class="dropdown-menu dropdown-menu-lg-right dropdown-menu-samll" aria-labelledby="btnGroupDrop1-<?= $rs_idx; ?>">
                                                    <li><a class="dropdown-item small" href="#" data-toggle="modal" data-target="#UpdateCate1" data-cate1name="<?= $rs_cate1name; ?>" data-idx="<?php echo $rs_idx ?>"><i class="fa fa-pencil-alt mr-1"></i>수정</a></li>
                                                    <li><a class="dropdown-item small" href="#" data-toggle="modal" data-target="#DeleteCate1" data-cate1name="<?= $rs_cate1name; ?>" data-idx="<?php echo $rs_idx ?>"><i class="fa fa-trash-alt mr-1"></i>삭제</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $rs_number ++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        <?php
                            }
                        ?>
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
    <!-- 상품등록 -->
    <div class="modal fade" id="AddItem" tabindex="-1" role="dialog" aria-labelledby="AddItemLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <form name="goodsWriteForm" id="goodsWriteForm" class="needs-validation" method="post" action="products_writeok.php" novalidate>
                    <div class="modal-header bg-primary text-white">
                        <h6 class="modal-title" id="AddItemLabel"><i class="fas fa-plus-square mr-1"></i>상품등록</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fas fa-times-circle"></i></span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="goodscode" class="col-4 col-md-2 col-form-label">상품코드</label>
                            <div class="col-8 col-md-10">
                                <input type="text" class="form-control" name="goodscode" id="goodscode" value="<?= $goodscode ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category1" class="col-4 col-md-2 col-form-label">카테고리 <span class="text-danger strong">*</span></label>
                            <div class="col-8 col-md-10">
                                <select class="form-control" name="category1" id="category1">
                                    <option value="">카테고리 선택</option>
                                <?php
                                    $strQuery3="select idx, cate1name from category1";
                                    $results3=mysqli_query($conn, $strQuery3);

                                    while ($row3=mysqli_fetch_array($results3)) {
                                        $cate1_idx=$row3[0];
                                        $cate1_name=$row3[1];
                                ?>

                                        <option value="<?= $cate1_idx ?>"><?= $cate1_name ?></option>
                                <?php
                                    }
                                    mysqli_close($conn);
                                ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="goodsnameKR" class="col-4 col-md-2 col-form-label">상품명(한) <span class="text-danger strong">*</span></label>
                            <div class="col-8 col-md-10">
                                <input type="text" class="form-control" name="goodsnameKR" id="goodsnameKR" placeholder="한글 상품명 입력">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="goodsnameEN" class="col-4 col-md-2 col-form-label">상품명(영)</label>
                            <div class="col-8 col-md-10">
                                <input type="text" class="form-control" name="goodsnameEN" id="goodsnameEN" placeholder="영문 상품명 입력">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="goodsImage" class="col-4 col-md-2 col-form-label">이미지 <span class="text-danger strong">*</span></label>
                            <div class="col-8 col-md-10">
                                <input type="file" name="goodsImage[]" id="goodsImage" multiple required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="contents" class="col-md-2 col-form-label">상품설명 <span class="text-danger strong">*</span></label>
                            <div class="col-md-10">
                                <textarea class="form-control summernote" name="contents" id="contents" rows="10" placeholder="상품설명 입력"></textarea></textarea>
                                <div for="contents" class="is-invalid invalid-feedback">상품설명을 입력해주세요.</div>                              
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="buyprice" class="col-4 col-md-4 col-form-label">매입가 <span class="text-danger strong">*</span></label>
                                    <div class="col-8 col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text priceInput" id="buyprice-addon">\</span>
                                            </div>
                                            <input type="text" class="form-control input_price" name="buyprice" id="buyprice" placeholder="매입가 입력" maxlength="10" aria-describedby="buyprice-addon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="sellprice" class="col-4 col-md-4 col-form-label">판매가 <span class="text-danger strong">*</span></label>
                                    <div class="col-8 col-md-6">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text priceInput" id="sellprice-addon">\</span>
                                            </div>
                                            <input type="text" class="form-control input_price" name="sellprice" id="sellprice" placeholder="판매가 입력" maxlength="10" aria-describedby="sellprice-addon">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="stock" class="col-4 col-md-4 col-form-label">재고 <span class="text-danger strong">*</span></label>
                                    <div class="col-8 col-md-6">
                                        <input type="number" class="form-control" name="stock" id="stock" placeholder="수량 입력">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="state" class="col-4 col-md-4 col-form-label">판매상태 <span class="text-danger strong">*</span></label>
                                    <div class="col-8 col-md-6">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label for="stateY" class="btn btn-outline-primary btn-sm">
                                                <input type="radio" name="state" id="stateY" value="Y"> 판매
                                            </label>
                                            <label for="stateN" class="btn btn-outline-primary btn-sm">
                                                <input type="radio" name="state" id="stateN" value="N"> 비매
                                            </label>
                                        </div>
                                        <div for="state" class="is-invalid invalid-feedback">판매상태를 선택하세요.</div>                              
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="tax" class="col-4 col-md-4 col-form-label">과세여부 <span class="text-danger strong">*</span></label>
                                    <div class="col-8 col-md-6">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label for="taxY" class="btn btn-outline-primary btn-sm">
                                                <input type="radio" name="tax" id="taxY" value="Y"> 과세
                                            </label>
                                            <label for="taxN" class="btn btn-outline-primary btn-sm">
                                                <input type="radio" name="tax" id="taxN" value="N"> 비과세
                                            </label>
                                        </div>
                                        <div for="tax" class="is-invalid invalid-feedback">과세여부를 선택하세요.</div> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label for="delivery" class="col-4 col-md- col-form-label">택배여부 <span class="text-danger strong">*</span></label>
                                    <div class="col-8 col-md-6">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label for="deliveryY" class="btn btn-outline-primary btn-sm">
                                                <input type="radio" name="delivery" id="deliveryY" value="Y"> 가능
                                            </label>
                                            <label for="deliveryN" class="btn btn-outline-primary btn-sm">
                                                <input type="radio" name="delivery" id="deliveryN" value="N"> 불가
                                            </label>
                                        </div>
                                        <div for="delivery" class="is-invalid invalid-feedback">택배여부를 선택하세요.</div> 
                                    </div>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="modal-footer justify-content-between">
                            <div class="item">                                
                                <button type="button" id="formReset" class="btn btn-warning btn-sm">글초기화</button>
                            </div>
                            <div class="item">                                
                                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">취소</button>
                                <button type="submit" id="btnAddItem" class="btn btn-primary btn-sm">등록</button>
                            </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 카테고리 Delete -->
    <div class="modal fade" id="DeleteCate1" tabindex="-1" role="dialog" aria-labelledby="DeleteCate1Label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="DeleteCate1Label"><i class="fas fa-trash-alt mr-1"></i>카테고리 삭제</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
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
                    <div class="modal-header">
                        <h6 class="modal-title" id="UpdateCate1Label"><i class="fas fa-edit mr-1"></i>카테고리 수정</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <input type="text" class="form-control" name="category1_name_edit" id="category1_name_edit" size="30" maxlength="15" value="" placeholder="카테고리 이름">
                        <input type="hidden" name="category1_idx_edit" id="category1_idx_edit" value="">
                        <div id="modal_error_wrap">
                            <span class="modal_error_msg"></span>
                        </div>
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
    <script src="../lib/bootstrap/4.5.3/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../lib/jquery/validate/1.10.0/js/jquery.validate.min.js" crossorigin="anonymous"></script>
    <script src="../lib/datatable/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="../lib/datatable/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
    <script src="../lib/fontawesome/5.15.3/js/all.min.js"  crossorigin="anonymous"></script>
    <script src="../lib/summernote/8.18/js/summernote-bs4.min.js"></script>
    <script src="../lib/summernote/8.18/js/lang/summernote-ko-KR.js"></script>
    <script src="products_list.js" crossorigin="anonymous"></script>
    <!-- <script src="category_modal.js" crossorigin="anonymous"></script> -->
    <script src="products-datatables-call.js" crossorigin="anonymous"></script>
    <script src="../js/script.js" crossorigin="anonymous"></script>
</body>
</html>