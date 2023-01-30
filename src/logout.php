<?php
    if (isset($_SESSION)) {
        session_unset();

        session_destroy();
    }


    if (isset($_COOKIE['remember'])) {
        setcookie('remember', '', 0, '/');
    }

    echo json_encode(['success' => true]);
?>