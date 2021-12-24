<?php
include '../config/constants.php';

if (isset($_SESSION['user_id'])) {
    $USER_ID = $_SESSION['user_id'];
}else{
    $USER_ID = '';
}

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $image = $_POST['img-data'];

    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];

        if ($image_name != '') {
            $ext = end(explode('.', $image_name));

            $image_name = 'user' . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];

            $destination_path = "../cryptolearnadmin/images/users/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload'] = '
                <div class="m-2 alert alert-warning alert-dismissible fade show" role="alert">
                    image failed to upload.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        
                    </button>
                </div>
                ';
                header('location: ../?module=pages&page=settings');
            }
        } else {
            $image_name = $image;
        }
    } else {
        $image_name = $image;
    }

    $Query2 = "UPDATE users SET first_name=:fname, last_name=:lname, phone=:phone, email=:email, image=:image WHERE user_id=:id";
    $stmt2 = $pdo->prepare($Query2);
    $status = $stmt2->execute(['fname' => $fname, 'lname' => $lname, 'phone' => $phone, 'email' => $email, 'image' => $image_name, 'id' => $USER_ID ]);
    // $result = $stmt->fetch();
    if ($status) {
        $_SESSION['image'] = '
            <div class="m-2 alert alert-success alert-dismissible fade show" role="alert">
                Account updated successfully,
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    
                </button>
            </div>
        ';
        header('location: ../?module=pages&page=settings');
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $Query3 = "DELETE FROM users WHERE user_id=?";
    $stmt3 = $pdo->prepare($Query3);
    $status2 = $stmt3->execute([$id]);

    if ($status2) {
        $_SESSION['delete'] = '
            <div class="m-2 alert alert-danger alert-dismissible fade show" role="alert">
                User deleted.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    
                </button>
            </div>
        ';
        header('location: ?module=manage_users&page=users');
    }
}
?>