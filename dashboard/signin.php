<!DOCTYPE html>
<html lang="en">
<?php
include(__DIR__ . '/../middlewares/index.php');
include(__DIR__.'/../env.php');

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ship Cars | Sigin</title>
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/signup.css">
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Signin</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="wrap">
                        <div class="login-wrap p-4 p-md-5">
                            <div class="d-flex">
                                <div class="w-100">
                                    <h3 class="mb-4">Sign In</h3>
                                </div>
                                <div class="w-100">
                                    <p class="social-media d-flex justify-content-end">
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-facebook"></span></a>
                                        <a href="#"
                                            class="social-icon d-flex align-items-center justify-content-center"><span
                                                class="fa fa-twitter"></span></a>
                                    </p>
                                </div>
                            </div>
                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger">
                                    <?php echo htmlspecialchars($_GET['error']); ?>
                                </div>
                            <?php endif; ?>
                            <form action="<?php echo $APP_URL ?>Api/login.php" method="post" class="signin-form">
                                <div class="form-group mt-3">
                                    <input type="email" name="email" class="form-control" value="" autocomplete="off"
                                        required="true">
                                    <label class="form-control-placeholder" for="email">Email</label>
                                </div>
                                <div class="form-group mt-3">
                                    <input id="password-field" name="password" type="password" value=""
                                        autocomplete="off" class="form-control" required="">
                                    <label class="form-control-placeholder" for="password">Password</label>
                                    <span toggle="#password-field" style="cursor: pointer"
                                        class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3">Sign In</button>
                                </div>
                                <div class="form-group d-md-flex">
                                    <div class="w-100 text-end">
                                        <a href="#">Forgot Password</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="../assets/js/jquery.js"></script>
<script>
    (function($) {

        "use strict";

        $(".toggle-password").click(function() {
            $(this).toggleClass("fa-eye fa-eye-slash");

            var input = $($(this).attr("toggle"));

            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });

    })(jQuery);
</script>

</html>