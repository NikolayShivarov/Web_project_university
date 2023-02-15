<?php
    if (isset($_SESSION)) {
        $_SESSION['username'] = null;
        session_unset();

        session_destroy();
    }


    if (isset($_COOKIE['remember'])) {
        setcookie('remember', '', 0, '/');
    }

    echo json_encode(['success' => true]);
?>