<?php

    session_start();
    $_SESSION['username'] = 'alanvsouza';

    header('Location:index.php');