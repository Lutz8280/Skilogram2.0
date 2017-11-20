<?php
if (!empty($_SESSION['user'])) {
    echo 'Hello,' . $_SESSION['user'];
} else {
    echo 'Please login!';
}
