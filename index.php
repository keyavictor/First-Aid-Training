<?php
include 'server.php';
?>

<!doctype html>
<html lang="en">

<head>
    <?php
   include './components/head.php';
   ?>
    <title>Maseno | First Aid</title>
</head>

<body style="background-color:#d2d6de">
    <div class="container">

        <div class="row mt-5 ml-1 mr-1">
            <div class="col-md-3"></div>
            <div class="col-md-6 mt-5 text-center text-light" style="background-color:#00a7d0">
                <img src="./static/images/logo.png" class="img-fluid" height="120" width="120" />
                <h2 class="text-center">Login</h2>
            </div>
            <div class="col-md-3"></div>
        </div>

        <!--Login form -->
        <div class="row ml-1 mr-1 mb-4">
            <div class="col-md-3"></div>
            <div class="col-md-6 p-3" style="background-color:#fff">
                <form method="POST" action="server.php">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input type="text" name="email" class="form-control" id="email"
                            aria-describedby="emailHelp" placeholder="Username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label><br>
                        <input type="password" name="password" class="form-control" id="password"
                            placeholder="Password" required>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" value="checked" id="togglePasswordCheckBox">
                        <label class="form-check-label" for="showPass">
                            Show password
                        </label>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" name="login_btn" class="btn btn-info btn-block">Sign In</button>
                        </div>
                        <div class="col-md-6">
                        <a href="#" class="text-success m-2 btn-block" 
                            onclick="showForgotPasswordPopup()">Forgot Password?</a>
                        </div>
                        <div class="col-md-6">
                            <a href="register.php" class="text-success m-2 btn-block" >Register Account</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>

        </div>
    </div> 
    <?php
include "./components/script.php";
?>
<script>
        function showForgotPasswordPopup() {
            var modal = document.createElement('div');
            modal.classList.add('modal', 'fade');
            modal.setAttribute('id', 'customModal');
            modal.setAttribute('tabindex', '-1');
            modal.setAttribute('role', 'dialog');
            modal.innerHTML = `
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Forgot Password?</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Please contact the system administrator for password reset assistance.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);

            // Show the modal
            $('#customModal').modal('show');

            // Remove the modal from the DOM after it's closed
            $('#customModal').on('hidden.bs.modal', function (e) {
                $(this).remove();
            });
        }
    </script>
</body>

</html>