<?php 
session_start();

// database와 연동 파라미터는 순서대로 ip, 사용자 이름, 비밀번호, 데이터베이스 이름
$db = mysqli_connect('127.0.0.1', 'webtest', 'web1234', 'multi_login');

// 사용할 변수 초기화
$username = "";
$email    = "";
$errors   = array(); 

// 회원가입 버튼을 눌러 POST 요청을 받았는지 확인하고, 참이면 register() 실행.
if (isset($_POST['register_btn'])) {
        register();
}

// REGISTER USER
function register(){
        // call these variables with the global keyword to make them available in function
        global $db, $errors, $username, $email;

        // receive all input values from the form. Call the e() function
    // POST로 받은 내용을 변수에 저장. e함수를 통해 XSS 공격 방지. <XSS는 입력칸에 SQL문을 입력하여 공격하는 방법 중 하나로 예시로 SELECT * FROM WHERE 1 = 1; 과 같이 공격할 수 있다.
        $username    =  e($_POST['username']);
        $email       =  e($_POST['email']);
        $password_1  =  e($_POST['password_1']);
        $password_2  =  e($_POST['password_2']);

        // 각 요소가 입력됐는지와 비밀번호 중복 검사
        if (empty($username)) { 
                array_push($errors, "Username is required"); 
        }
        if (empty($email)) { 
                array_push($errors, "Email is required"); 
        }
        if (empty($password_1)) { 
                array_push($errors, "Password is required"); 
        }
        if ($password_1 != $password_2) {
                array_push($errors, "The two passwords do not match");
        }

        //
        if (count($errors) == 0) {      // 위의 검사에서 오류없이 통과했는지 확인
                $password = md5($password_1);   // md5 해싱법으로 비밀번호를 암호화함. < 비밀번호는 암호화해서 데이터베이스에 저장해야한다. >

                if (isset($_POST['user_type'])) {               // user_type 값을 받았는지 확인.
                        $user_type = e($_POST['user_type']);     // escape로 xss 공격 회피
                        $query = "INSERT INTO users (username, email, user_type, password)              
                                          VALUES('$username', '$email', '$user_type', '$password')";            // sql문을 통해 입력받은 username, email, user_type, password를 데이터 베이스에 삽입. 
                        mysqli_query($db, $query);
                        $_SESSION['success']  = "New user successfully created!!";                              
                        header('location: home.php');                                   // home.php로 이동한다.
                }else{                          // user_type 값을 받지 않은 경우
                        $query = "INSERT INTO users (username, email, user_type, password) 
                                          VALUES('$username', '$email', 'user', '$password')";                  // user_type은 user로 하고 나머지는 전과 같이 삽입한다.
                        mysqli_query($db, $query);

                        // get id of the created user
                        $logged_in_user_id = mysqli_insert_id($db);             // 데이터베이스에 가장 최근에 삽입된 행에서 Auto increase로 설정된 값을 반환하여 저장

                        $_SESSION['user'] = getUserById($logged_in_user_id); // 반환받은 값을 user 세션에 저장
                        $_SESSION['success']  = "You are now logged in";                        // success 세션에 다음 문자열 저장
                        header('location: index.php');                                          // index.php로 이동
                }
        }
}

// 파라미터로 받은 id 값의 유저이름을 반환한다.
function getUserById($id){
        global $db;
        $query = "SELECT * FROM users WHERE id=" . $id;
        $result = mysqli_query($db, $query);

        $user = mysqli_fetch_assoc($result);
        return $user;
}

// XSS 공격 escape로 회피
function e($val){
        global $db;
        return mysqli_real_escape_string($db, trim($val));
}

// 에러가 발생한 경우 에러를 출력
function display_error() {
        global $errors;

        if (count($errors) > 0){
                echo '<div class="error">';
                        foreach ($errors as $error){
                                echo $error .'<br>';
                        }
                echo '</div>';
        }
}       

// 로그인에 성공하여 user 세션에 값이 생겼다면 true를 반환
function isLoggedIn()
{
        if (isset($_SESSION['user'])) {
                return true;
        }else{
                return false;
        }
}

// GET 로그아웃 요청이 들어왔다면, 세션을 삭제하고 login.php로 이동한다.
if (isset($_GET['logout'])) {
        session_destroy();
        unset($_SESSION['user']);
        header("location: login.php");
}

// 로그인 버튼을 클릭하여 POST 요청이 들어옴.
if (isset($_POST['login_btn'])) {
        login();
}

// 로그인
function login(){
        global $db, $username, $errors;

        // 요청으로 받은 값들을 저장 escape로 XSS 공격회피
        $username = e($_POST['username']);                    
        $password = e($_POST['password']);

        // 값이 정상적으로 들어왔는지 확인.
        if (empty($username)) {
                array_push($errors, "Username is required");
        }
        if (empty($password)) {
                array_push($errors, "Password is required");
        }

        // 에러가 발생하였는지 확인.
        if (count($errors) == 0) {
                $password = md5($password);             // db에 패스워드는 암호화하여 저장했으므로 검색을 위해서 패스워드를 암호화

                $query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";                     // 입력받은 username과 password로 db에서 검색
                $results = mysqli_query($db, $query);

                if (mysqli_num_rows($results) == 1) { // 입력받은 값으로 유저를 찾았다면,
                        // 일반 유저인지 어드민인지 검사
                        $logged_in_user = mysqli_fetch_assoc($results);                 // db에서 가져온 값을 연관 배열로 저장
                        if ($logged_in_user['user_type'] == 'admin') {                  // 어드민이라면

                                $_SESSION['user'] = $logged_in_user;                            // user 세션에 가져온 값을 저장.
                                $_SESSION['success']  = "You are now logged in";                // success 세션에 다음 문자열 저장
                                header('location: admin/home.php');                                     // home.php로 이동
                        }else{                  // 일반 유저라면,
                                $_SESSION['user'] = $logged_in_user;                                           // user 세션에 가져온 값 저장
                                $_SESSION['success']  = "You are now logged in";                                // success 세션에 다음 문자열 저장

                                header('location: index.php');                          // index.php로 이동
                        }
                }else {                 // 유저를 찾지 못한 경우
                        array_push($errors, "Wrong username/password combination");                             // 에러 문구를 에러 배열에 삽입
                }
        }
}

// 어드민인지 확인
function isAdmin()
{
        if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {                   // user 세션에 값이 있고, user 세션의 user_type이 admin이라면 true를 반환
                return true;
        }else{
                return false;
        }
}