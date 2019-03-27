<?php
if (isset($_POST['login'])) {
    $uid = $_POST['uid'];
    $pwd = $_POST['pwd'];

    require_once(LOGIN);
    if (Login::auth($uid, $pwd) == true) {
        $_SESSION['logged_in'] = Login::setSession();
        header("Location: ".ROOT."?url=dashboard&login=success");
    }
}
?>
<div class="justify-content-center">
    <div class="card mt-3">
        <div class="card-header">Login</div>

        <div class="card-body">
            <form method="POST" action="">

                <div class="form-group row">
                    <label for="uid" class="col-md-4 col-form-label text-md-right">Username/ Email</label>
                    <div class="col-md-6">
                        <input id="uid" type="text" class="form-control" name="uid" value="" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="pwd" class="col-md-4 col-form-label text-md-right">Password</label>
                    <div class="col-md-6">
                        <input id="pwd" type="password" class="form-control" name="pwd" value="" required autofocus>
                        <span class="invalid-feedback" role="alert">
                            <strong><?php  ?></strong>
                        </span>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" name="login" id="login">Login</button>
                        <a href="?url=forgot-password">Forgot password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 