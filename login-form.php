<?php
session_start();
include 'config.php';

$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

if (!empty($email) && !empty($password)) {
    $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if (mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result);

        if (password_verify($password, $user['password'])) {
     
            $_SESSION['checklogin'] = true;
            $_SESSION['email'] = $user['email'];
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];

            $token = bin2hex(random_bytes(16));
            setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
            // mysqli_query($conn, "UPDATE user SET remember_token='{$token}' WHERE id='{$user['id']}'");
            $stmt = $conn->prepare("UPDATE user SET remember_token='{$token}' WHERE id= ?");
            $stmt->bind_param("i", $user['id']);
            $stmt->execute();
            
                
                if (!empty($_COOKIE['remember_token'])) {
                    setcookie('remember_token', '', time() - 3600, '/');
                }
            

            // ################ remember me ###################################
            // if (!empty($_POST['remember'])) {
            //     $token = bin2hex(random_bytes(16));
            //     setcookie('remember_token', $token, time() + (30 * 24 * 60 * 60), '/', '', false, true);
            //     // mysqli_query($conn, "UPDATE user SET remember_token='{$token}' WHERE id='{$user['id']}'");
            //     $stmt = $conn->prepare("UPDATE user SET remember_token='{$token}' WHERE id= ?");
            //     $stmt->bind_param("i", $user['id']);
            //     $stmt->execute();
            // } else {
                
            //     if (!empty($_COOKIE['remember_token'])) {
            //         setcookie('remember_token', '', time() - 3600, '/');
            //     }
            // }

       
            if ($user['role'] === 'admin') {
                header("Location: {$base_url}/admin-page.php");
            } else {
                header("Location: {$base_url}/index.php");
            }
            exit;

        } else {
            $_SESSION['message'] = 'User or password invalid';
            header("Location: {$base_url}/login.php");
            exit;
        }

    } else {
        $_SESSION['message'] = 'Username not found';
        header("Location: {$base_url}/login.php");
        exit;
    }

} else {
    $_SESSION['message'] = 'User or password required';
    header("Location: {$base_url}/login.php");
    exit;
}
