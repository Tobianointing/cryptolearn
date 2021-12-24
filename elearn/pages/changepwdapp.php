<?php
include '../config/constants.php';

if (isset($_POST['submit'])) {
    $currpwd = $_POST['currpassword'];
    $pwd = $_POST['password'];
    $cpwd = $_POST['cpassword'];
    $id = $_SESSION['user_id'];

    $Query = "SELECT password FROM users WHERE user_id=?";
    $stmt = $pdo->prepare($Query);
    $stmt->execute([$id]);
    $result = $stmt->fetch();

    $pwd_db = $result->password;
    // die($pwd_db);

    if (password_verify($currpwd, $pwd_db)) {
        if ($pwd == $cpwd) {
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $Query2 = "UPDATE users SET password=:password WHERE user_id=:id";
            $stmt2 = $pdo->prepare($Query2);
            $status = $stmt2->execute(['password' => $pwd, 'id' => $id]);
            // $result = $stmt->fetch();
            if ($status) {
                $_SESSION['pwd'] = '
                <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                    Password changed successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>
        ';
                header('location: ../?module=pages&page=settings');
            }
        } else {
            $_SESSION['pwd'] = '
                <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    Incorrect Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">  
                    </button>
                </div>';

            header('location: ../?module=pages&page=settings');
        }
    } else {
        $_SESSION['pwd'] = '
                <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    Invalid Password.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">  
                    </button>
                </div>';

        header('location: ../?module=pages&page=settings');
    }
}
