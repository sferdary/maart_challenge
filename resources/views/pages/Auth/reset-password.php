<?php 
if (isset($_GET['validate']) && isset($_GET['token'])) {
    require_once(RESETPWD);
    if (ResetPassword::expired($_GET['validate']) === false) {
        if (ResetPassword::verify($_GET['validate'], $_GET['token']) === true) { 
            if (isset($_POST['reset-password'])) {
                require_once(RESETPWD);
                print_r(ResetPassword::validate($_POST['selector'], $_POST['token'], $_POST['pwd'], $_POST['pwd_repeat']));
            } ?>
            

            <div class="justify-content-center">
                <div class="card mt-3">
                    <div class="card-header">Reset password</div>
                    <div class="card-body">
                        <form method="POST" action="">
                        <input type="hidden" name="_token" value="<?php echo $_SESSION['_csrf']; ?>">
                            <input type="hidden" name="selector" id="selector" value="<?php echo $_GET['validate']; ?>" required>
                            <input type="hidden" name="token" id="token" value="<?php echo $_GET['token']; ?>" required>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                <input type="password" name="pwd" id="pwd" placeholder="password" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="Repeat password" class="col-md-4 col-form-label text-md-right">Password</label>

                                <div class="col-md-6">
                                <input type="password" name="pwd_repeat" id="pwd_repeat" placeholder="password" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" name="reset-password" id="reset-password">submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 


        <?php 
        }
    } else {
        header('Location: '.ROOT.'?url=forgot-password&error=tokenExpired');
    }
}else {
    header('Location: '.ROOT.'?url=login');
}
