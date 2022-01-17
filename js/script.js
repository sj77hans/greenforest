function printAccount()  {
    const accountNum = document.getElementById('account').value;
    const accountImsi = accountNum*10000;
    var accountSum = accountImsi.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
    document.getElementById("accountNum").innerText = accountNum;
    document.getElementById("accountSum").innerText = accountSum;
}


$(document).ready(function(){

    // 숫자만 입력허용 & 3자리 콤마 <input type="text" class="price">
    $('.input_price').on( 'keyup', function( event ) {
        // 1.
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {
            return;
        }
    
        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
            return;
        }
    
        var $this = $( this );
        var input = $this.val();
        var input = input.replace(/[\D\s\._\-]+/g, '');

        input = input ? parseInt( input, 10 ) : 0;
    
        $this.val( function() {
            return ( input === 0 ) ? '' : input.toLocaleString( 'en-US' );
        });    
    } );
});

// MaxLength 에 맞줘 자르기 input number일때
function numberMaxLength(e){
    if(e.value.length > e.maxLength){
        e.value = e.value.slice(0, e.maxLength);
    }
}

// 앞자리 0제거
function ClearZero(e){
    e.value = e.value.replace(/(^0+)/, ""); 
}

// 앞자리 0붙이기
function AddZero(e){
    if(e.value < 10) return e.value = "0"+ e.value;
}

//뒤로이동
function goBack() {
    window.history.back();
}

//클릭시 복사 
function copyWrite(id){ 
    var obj = document.getElementById(id).cloneNode(true);

    var copyText = document.getElementById(id);
        copyText.select();
        document.execCommand("Copy");
}

// 공백제거 onkeyup="trim(this)"
function trim(obj) {
    var str_space = /\s/;  // 공백체크
    if(str_space.exec(obj.value)) { //공백 체크
        obj.value = obj.value.replace(' ',''); // 공백제거
        return false;
    }
}

