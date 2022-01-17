$(document).ready(function () {

    $("#category1_name").keyup(function () {
        if ($("#category1_name").val() != '') {
            $("#category1_writeform .error_msg").css("display", "none");
            $("#category1_name").removeClass("input_error");
            $("#category1_writeform").removeClass("user-was-validated");
            return false;
        }
    });

    $("#category1_writeform").submit(function (e) {

        if ($("#category1_name").val() == '') {
            $("#category1_writeform .error_msg").css("display", "block");
            $("#category1_writeform .error_msg").html('카테고리 이름을 입력하세요.');
            $("#category1_name").focus();
            return false;
        }

        e.preventDefault();

        var action = $("#category1_writeform").attr('action');
        var form_data = {
            category1_name: $("#category1_name").val(),
            is_ajax: 1
        };
        $.ajax({
            type: "POST",
            url: action,
            data: form_data,
            success: function (response) {
                if (response == 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: '등록되었습니다.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    $("#category1_writeform .error_msg").css("display", "block");
                    $("#category1_writeform .error_msg").html('동일한 이름이 존재합니다.');
                    $("#category1_name").addClass("input_error");
                }
            }
        });
        return false;
    });

    var forms = $('#category1_writeform');

    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('user-was-validated');
        }, false);
    });
}, false);

// 삭제 ///

$('#DeleteCate1').on('show.bs.modal', function (event) { // DeleteCate1 윈도우가 오픈할때 아래의 옵션을 적용
    var button = $(event.relatedTarget) // 모달 윈도우를 오픈하는 버튼
    var varIDX = button.data('idx') // 버튼에서 data-idx 값을 varIDX 변수에 저장
    var varCate1Name = button.data('cate1name')
    var modal = $(this)

    modal.find('.modal_cate1name').text(varCate1Name) // 모달위도우에서 .modal_cate1name-title을 찾아 varCate1Name 값을 치환

    $("#btnCate1Del").on("click", function (e) {

        e.preventDefault();

        var form_data = {
            idx: varIDX,
            is_ajax: 1
        };
        $.ajax({
            type: "POST",
            url: "category1_delok.php",
            data: form_data,
            success: function (response) {
                if (response == 'success') {
                    $('#DeleteCate1').modal("hide");
                    Swal.fire({
                        icon: 'warning',
                        title: '삭제 되었습니다.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    $('#DeleteCate1').modal("hide");
                    Swal.fire({
                        icon: 'error',
                        title: '오류가 발생하였습니다.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                }
            }
        });
    })
});

// 수정 ///
$('#UpdateCate1').on('show.bs.modal', function (event) { // UpdateCate1 윈도우가 오픈할때 아래의 옵션을 적용
    var button = $(event.relatedTarget) // 모달 윈도우를 오픈하는 버튼
    var varIDX = button.data('idx') // 버튼에서 data-idx 값을 varIDX 변수에 저장
    var varCate1Name = button.data('cate1name')
    var modal = $(this)

    modal.find('#category1_name_edit').val(varCate1Name) // 모달위도우에서 .category1_name_edit을 찾아 varCate1Name 값을 치환
    modal.find('#category1_idx_edit').val(varIDX) // 모달위도우에서 .category1_idx_edit을 찾아 varIDX 값을 치환

    $("#category1_name_edit").keyup(function () {
        if ($("#category1_name_edit").val() != '') {
            $("#category1_editform .error_msg").css("display", "none");
            $("#category1_name_edit").removeClass("input_error");
            $("#category1_editform").removeClass("user-was-validated");
            return false;
        }
    });

    $("#category1_editform").submit(function (e) {

        if ($("#category1_name_edit").val() == '') {
            $("#category1_editform .error_msg").css("display", "block");
            $("#category1_editform .error_msg").html('카테고리 이름을 입력하세요.');
            $("#category1_name_edit").focus();
            return false;
        }

        e.preventDefault();

        var action = $("#category1_editform").attr('action');
        var form_data = {
            category1_name_edit: $("#category1_name_edit").val(),
            category1_idx_edit: $("#category1_idx_edit").val(),
            is_ajax: 1
        };
        $.ajax({
            type: "POST",
            url: action,
            data: form_data,
            success: function (response) {
                if (response == 'success') {
                    $('#UpdateCate1').modal("hide");
                    Swal.fire({
                        icon: 'success',
                        title: '수정되었습니다.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    setTimeout(function () {
                        window.location.reload();
                    }, 1000);
                } else {
                    $("#category1_editform .error_msg").css("display", "block");
                    $("#category1_editform .error_msg").html('동일한 이름이 존재합니다.');
                    $("#category1_name_edit").addClass("input_error");
                }
            }
        });
        return false;
    })

    var forms = $('#category1_editform');

    var validation = Array.prototype.filter.call(forms, function (form) {
        form.addEventListener('submit', function (event) {
            if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('user-was-validated');
        }, false);
    });
});

