<?php

    $h = new Helper();
    $msg = '';
    $username = '';

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];

        if ($h->isEmpty(array($username, $_POST['password'])))
        {
            $msg = 'All fields are required';
        } else {
            $admin = new Admin($username);

            if (!$admin->isValidLogin($_POST['password']))
            {
                $msg = 'Invalid Username or Password';
            } else {
                $_SESSION['username'] = $username;
                $_SESSION['is_admin'] = true;
                header('Location: write.php');
            }
        }
    }