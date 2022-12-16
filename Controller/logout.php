<?php

if (isset($_SESSION['user_id'])) {
    //unset($_SESSION['user_id']); //vacia _SESSION['user_id']
    session_unset();
}

header('Location: index.php?action=Log-In'); //redireccionar
exit;
