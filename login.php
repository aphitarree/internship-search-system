<?php
session_start();
include 'config.php';

// ############################  auto login  ###########################################
// if (empty($_SESSION['id']) && !empty($_COOKIE['remember_token'])) {

//     $token = mysqli_real_escape_string($conn, $_COOKIE['remember_token']);
//     // $query = mysqli_query($conn, "SELECT * FROM user WHERE remember_token='{$token}'");
//     $stmt = $conn->prepare("SELECT * FROM user WHERE remember_token= ?");
//     $stmt->bind_param("s", $token);
//     $stmt->execute();
//     $result = $stmt->get_result();

//     if (mysqli_num_rows($result) === 1) {
//         $user = mysqli_fetch_assoc($result);

//         $_SESSION['id'] = $user['id'];
//         $_SESSION['email'] = $user['email'];
//         $_SESSION['username'] = $user['username'];
//         $_SESSION['role'] = $user['role'];

//         if ($user['role'] === 'admin') {
//             header("Location: {$base_url}/admin-page.php");
//         } else {
//             header("Location: {$base_url}/index.php");
//         }
//         exit;
//     }
// }
// ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php if (!empty($_SESSION['message'])): ?>
        <div class="alert alert-warning alert-dismissible fade show my-4" role="alert">
            <?php echo $_SESSION['message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <?php unset($_SESSION['message']); ?>
        </div>
        <?php endif; ?>

        <div class="row d-flex align-items-center justify-content-center min-vh-100">
            <div class="col-md-5 col-lg-4">
                <div class="login-card">
                    <h1 class="login-title text-center mb-4">Sign In</h1>

                    <form action="<?php echo $base_url.'/login-form.php'; ?>" method="post">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   placeholder="Enter your email"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   placeholder="Enter your password"
                                   required>
                        </div>
                        <!-- ################ remember me ################################### -->
                        <!-- <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">
                                Remember me
                            </label>
                        </div> -->

                        <button type="submit" name="submit" class="btn btn-primary w-100">
                            Sign In
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
