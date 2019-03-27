<?php
if (isset($_POST['search'])) {
    RealEstate::search($_POST['criteria']);
}

?>

<form action="" method="POST" class="mt-4">
    <select name="criteria" class="form-control-sm" >
        <option value="price_asc">Price low - high</option>
        <option value="price_desc">Price high - low</option>
        <option value="country_asc">Country a-z</option>
        <option value="country_desc">Country z-a</option>
    </select>
    <button type="submit" class="btn btn-sm btn-primary" name="search">Search</button>
</form>

<?php foreach (RealEstate::show() as $row) { ?>
<br>
<div class="jumbotron mt-3">
    <h1><?php echo $row['city'] . ' - ' . $row['country']; ?></h1>
    <h3><?php echo $row['street'] . ' ' . $row['number']; ?></h3>
    <h4>$ <?php echo $row['price']; ?></h4><br>
    <div class="row">
        <div class="col-md-6">
            <img src="<?php echo UPLOADS . $row['image']; ?>" style="width:100%; height: auto;" alt="">
        </div>
        <div class="col-md-6">
            <h3> About <?php echo $row['city']; ?></h3>
            <p><?php echo $row['description']; ?></p>
            <a class="btn btn-primary btn-lg" href="?url=property<?php echo '&address='.$row['street'] . $row['number'] . '&city='.$row['city'] . '&country='. $row['country']; ?>" role="button">
                Read more about <?php echo $row['city']; ?></a>
        </div>
    </div>
</div>

<?php 
} ?> 