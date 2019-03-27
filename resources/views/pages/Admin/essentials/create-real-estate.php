<?php
if (isset($_SESSION['logged_in'])) {

    if (isset($_POST['create'])) {
        require_once(REALESTATE);
        RealEstate::upload($_POST['city'], $_POST['country'], $_POST['street'], $_POST['number'], $_POST['price'], $_POST['description'], $_FILES['image']);
    }
    ?>

<div class="justify-content-center">
    <div class="card mt-3">
        <div class="card-header">Add new real estate</div>
        <div class="card-body">
            <form action="" method="POST" class="md-form" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?php echo $_SESSION['_csrf']; ?>">
                <div class="form-group row">
                    <label for="city" class="col-md-4 col-form-label text-md-right">City</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="city" id="city" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="country" class="col-md-4 col-form-label text-md-right">Country</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="country" id="country" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="street" class="col-md-4 col-form-label text-md-right">Street</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="street" id="street" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="number" class="col-md-4 col-form-label text-md-right">Number</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="number" id="number" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="price" class="col-md-4 col-form-label text-md-right">Price</label>
                    <div class="col-md-4">
                        <input type="text" class="form-control" name="price" id="price" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col-md-4">
                        <textarea type="text" class="form-control" name="description" id="description" required></textarea>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="image" class="col-md-4 col-form-label text-md-right">Upload image</label>
                    <div class="col-md-4">
                        <input type="file" name="image" id="image">
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary" name="create" id="create">Create</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <?php

} else {
    header('Location:' . ROOT . '?url=login');
}
