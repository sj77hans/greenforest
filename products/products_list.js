$('#AddItem').on('show.bs.modal', function (event) { // AddItem 윈도우가 오픈할때 아래의 옵션을 적용


    /// 글초기화
  $('#formReset').on('click', function(){  
    $('#goodsWriteForm')[0].reset();
    $('#contents').summernote('reset');
    $('#goodsWriteForm').validate().resetForm();
    $('label').removeClass('active');
  });

  //폼 검증
  var goodsWriteForm = $('#goodsWriteForm');
  var summernoteElement = $('#contents');

  var summernoteValidator = goodsWriteForm.validate({
    errorElement: 'div',
    errorClass: 'is-invalid',
    validClass: 'is-valid',
    ignore: ':hidden:not(.summernote),.note-editable.card-block',
    errorPlacement: function (error, element) {
      // Add the `help-block` class to the error element
      error.addClass('invalid-feedback');
      console.log(element);
      if (element.prop('type') === 'radio') {
          error.insertAfter(element.siblings('div'));
      } else if (element.hasClass('summernote')) {
          error.insertAfter(element.siblings('.note-editor'));
      } else {
          error.insertAfter(element);
      }
    },
    rules: {
      category1 : {
        required : true
      },
      goodsnameKR : {
        required : true,
        krOnly : true
      },
      goodsnameEN : {
        required : false,
        EnOnly : true
      },
      contents : {
        required : true
      },
      buyprice : {
        required : true
      },
      sellprice : {
        required : true
      },
      stock : {
        required : true
      },
      state : {
        required : true
      },
      tax : {
        required : true
      },
      delivery : {
        required : true
      }
    },
    messages : {
      category1 : {
        required : "카테고리를 선택하세요."
      },
      goodsnameKR : {
        required : "상품명(한글)을 입력하세요.",
        krOnly : "한글,숫자,()[]괄호만 입력가능합니다."
      },
      goodsnameEN : {
        EnOnly : "영어,숫자,()[]괄호만 입력가능합니다."
      },
      contents : {
        required : "상품설명을 입력하세요."
      },
      buyprice : {
        required : "매입가를 입력하세요."
      },
      sellprice : {
        required : "판매가를 입력하세요."
      },
      stock : {
        required : "재고수량을 입력하세요."
      },
      state : {
        required : "판매상태를 선택하세요."
      },
      tax : {
        required : "과세여부를 선택하세요."
      },
      delivery : {
        required : "택배여부를 선택하세요."
      }
    },
  });

  jQuery.extend(jQuery.validator.messages, {
    number: "숫자만 입력하세요.",
    digits: "숫자(digits)만 입력하세요.",
    maxlength: jQuery.validator.format("{0}글자 이상은 입력할 수 없습니다."),
  });

  // 한글만 숫자 띄어쓰기 일부 특수문자 허용
  $.validator.addMethod("krOnly",  function( value, element ) {
    return this.optional(element) ||  /^[가-힣0-9\s()\[\]]+$/.test(value);
  });

  // 영어 숫자 띄어쓰기 일부 특수문자 허용
  $.validator.addMethod("EnOnly",  function( value, element ) {
    return this.optional(element) ||  /^[a-zA-Z0-9\s()\[\]]+$/.test(value);
  });


  summernoteElement.summernote({
    placeholder : '상품설명(필수)',
    height: 200,                 // set editor height
    minHeight: null,             // set minimum height of editor
    maxHeight: null,             // set maximum height of editor
    lang: 'ko-KR',
    toolbar: [
      ['font', ['bold', 'underline', 'clear']],
      ['color', ['color']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['view', ['codeview']]
    ],
    callbacks: {
      onChange: function (contents, $editable) {
          // Note that at this point, the value of the `textarea` is not the same as the one
          // you entered into the summernote editor, so you have to set it yourself to make
          // the validation consistent and in sync with the value.
          summernoteElement.val(summernoteElement.summernote('isEmpty') ? "" : contents);

          // You should re-validate your element after change, because the plugin will have
          // no way to know that the value of your `textarea` has been changed if the change
          // was done programmatically.
          summernoteValidator.element(summernoteElement);
      }
    }
  });
});