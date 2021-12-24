<?php
include '../config/constants.php';

if (isset($_POST["submit"])) {
    // die(var_dump($_SESSION));
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = 'user';
    $rawpassword = $_POST['password'];

    $sql = "SELECT CONCAT(first_name, ' ', last_name) as 'name', email, user_id, password FROM users WHERE (email= :email) and (user_type= :user_type)";
    $query = $pdo->prepare($sql);
    $query->execute(['email' => $email, 'user_type' => $user_type]);
    $results = $query->fetch();

    // var_dump($results);
    // echo $password;

    if ($query->rowCount() > 0) {
        if (password_verify($rawpassword, $results->password)) {
            $_SESSION['user_id'] = $results->user_id;
            $_SESSION['name'] = $results->name;
            $_SESSION["email"] = $_POST["email"];
            $_SESSION['user_type'] = $user_type;

            if(isset($_SESSION['redirect_page'])){
                // die(var_dump($_SESSION));
                $redirect_page = $_SESSION['redirect_page'];
                unset($_SESSION['redirect_page']);

                // die($redirect_page);

                header("Location: {$redirect_page}");
            }else{
                $redirect_page = '../?module=pages&page=userdash';
            }

            header("Location: {$redirect_page}");
        } else {
            // die("wrong pwd");

            $_SESSION['error-login'] = '
            <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    Incorrect Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>';
            header("Location: ../auth/login.php");
        }
    } else {
        // die("no user");
        $_SESSION['error-login'] = '
        <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    Invalid Details.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>';
        header("Location: ../auth/login.php");
    }
}
?>