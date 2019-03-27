<?php
if (isset($_SESSION['logged_in'])) {
    ?>

<div class="row justify-content-center">
    <div class="col-md-3 mt-3">
        <div class="card">
            <div class="card-header bg-dark text-white">Create real estate</div>
            <div class="card-body text-center">
                <a href="?url=create-real-estate"><img src="assets/img/layouts/house.png" style="width:100%; height: auto;" alt=""></a>
            </div>
        </div>
    </div>

    <div class="col-md-3 mt-3">
        <div class="card">
            <div class="card-header bg-dark text-white">Create new account</div>
            <div class="card-body text-center">
            <a href="?url=register"><img src="assets/img/layouts/human_resources.png" style="width:100%; height: auto;" alt=""></a>
            </div>
        </div>
    </div>

</div>

<?php 
} else {
    header('Location:' . ROOT . '?url=login');
}
