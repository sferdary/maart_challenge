<?php
if (isset($_SESSION['logged_in'])) {
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $firstName = $_POST['first_name'];
        $lastName = $_POST['last_name'];
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];
        $pwdRepeat = $_POST['pwd_repeat'];
        require_once(REGISTER);
        Register::auth($username, $firstName, $lastName, $email, $pwd, $pwdRepeat);
        if (Register::auth($username, $firstName, $lastName, $email, $pwd, $pwdRepeat) == true) {
            if (Register::mail() == true) {
                if (Register::storeUser() == true) {
                    header('Location:' . ROOT . '?url=login&register=true');
                }
            } else {
                header('Location:' . ROOT . '?url=register&success=false');
            }
        }
    }
}else {
    header('Location:' . ROOT . '?url=login');
}
?>
<div class="justify-content-center">
    <div class="card mt-3">
        <div class="card-header">Register</div>
        <input type="hidden" name="_token" value="<?php echo $_SESSION['_csrf']; ?>">
        <div class="card-body">
            <form method="POST" action="">

                <div class="form-group row">
                    <label for="username" class="col-md-4 col-form-label text-md-right">Username</label>
                    <div class="col-md-6">
                        <input id="username" type="text" class="form-control" name="username" value="" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="first_name" class="col-md-4 col-form-label text-md-right">First name</label>
                    <div class="col-md-6">
                        <input id="first_name" type="text" class="form-control" name="first_name" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="last_name" class="col-md-4 col-form-label text-md-right">Last name</label>
                    <div class="col-md-6">
                        <input id="last_name" type="text" class="form-control" name="last_name" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="pwd" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                        <input id="pwd" type="password" class="form-control" name="pwd" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="pwd_repeat" class="col-md-4 col-form-label text-md-right">Repeat password</label>
                    <div class="col-md-6">
                        <input id="pwd_repeat" type="password" class="form-control" name="pwd_repeat" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" name="register">Register</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 