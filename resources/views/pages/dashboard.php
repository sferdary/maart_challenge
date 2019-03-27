<?php
if (isset($_SESSION['logged_in'])) {
?>

het werkt
<?php
} else{
    header('Location:' . ROOT . '?url=login');
}