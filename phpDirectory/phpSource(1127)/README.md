# 11/27 로그인 구현

## 로그인 화면

<img src="../images/로그인.png">

> Username과 password를 입력하고 Login 버튼을 누르면, function.php에서 유효한지 검사를 거친 후, 유저가 있다면 로그인 처리를 수행합니다.
> 아래는 로그인이 완료 된 경우입니다.

<img src="../images/로그인완료.png">

## 회원가입

> 회원가입 또한 로그인과 같이 값이 입력되고 Register 버튼을 누르면, 값들이 다 유효한지 function.php에서 검사한 후, 데이터베이스에 값을 삽입하고 로그인 화면으로 돌아갑니다.

## 회원가입 확인

> 회원가입이 정상적으로 확인됐는지 체크하기 위한 데이터베이스 사진입니다.

<img src="../images/데이터베이스 확인.png">

> id값은 primary key로 unique key입니다. Auto increasement로 회원가입 될 때마다 1씩 증가합니다.
> username과 email은 입력받은대로 삽입되고, user_type은 기본적으로 user 로 저장되지만, 임의로 admin으로 바꾸어 admin 처리를 수행할 수 있습니다.
> password는 md5 해쉬로 암호화되어 저장된것을 확인할 수 있습니다.