<?php
if (isset($_POST['reset_request'])) { 
$email = $_POST['email'];
require_once(FORGOTPWD);
print_r(ForgotPassword::request($email));
}

// if ($_GET['success'] == 'true') {
//     # code...
// }else if ($_GET['error']){
    
// }
?>

<div class="justify-content-center">
    <div class="card">
        <div class="card-header">Forgot password</div>

        <div class="card-body">
            <form method="POST" action="">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_csrf']; ?>">
                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">Email address</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" name="reset_request" id="reset_request">Send reset link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div> 