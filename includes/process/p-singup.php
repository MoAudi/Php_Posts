<?php

    $h = new Helper();
    $msg = '';
    $username = '';

    if (isset($_POST['submit'])) {

        $username = $_POST['username'];

        if ($h->isEmpty(array($username, $_POST['password']), $_POST['confirm_password'])) {

            $msg = 'All fields are required';
            
        }
        elseif (!$h->isValidLength($username, 6, 100)) {
            $msg = 'Username must be between 6 and 100 characters';
        } 
        elseif (!$h->isValidLength($_POST['password'])) {
            $msg = 'Password must be between 8 and 20 characters';
        }
        elseif (!$h->isSecure($_POST['password'])) {
            $msg = 'Password must contain at least one lower case character, one upper case character, and one digit';
        }
        elseif (!$h->passwordsMatch($_POST['passwotd'], $_POST['confirm_password'])) {
            $msg = 'Passwords do not match';
        } else {
            $member = new BlogMember($username);

            if ($member->isDuplicateID()) {
                $msg = 'Username already in use';
            } else {
                $member->insertIntoMemberDB($_POST['password']);
                header('Location: index.php?new=1');
            }
        }
    }