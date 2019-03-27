<?php

if (isset($_GET['validate'])) {
    require_once(VALIDATE);
    Validate::verify($_GET['validate']);
}else {
    header("Location:" . ROOT);
}
?>