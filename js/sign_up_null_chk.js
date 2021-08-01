function validate() {
    var pw = document.getElementById('pw');
    var pw_chk = document.getElementById('pw_chk');

    if((pw.value) == "") {
        alert('비밀번호를 입력하세요.');
        return false;
    } else if((pw_chk.value) == "") {
        alert('비밀번호 확인을 입력하세요.');
        return false;
    }
}