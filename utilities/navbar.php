<?php
    if(!session_start()) {
        header("Location: ../index.php?result=badSession");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>GCC: Gift Card Collector</title>

        <!-- Boostrap 4.0 CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Lobster|Raleway:300" rel="stylesheet">
        <link rel="stylesheet" href="utilities/navbar.css">

        <!-- jQuery, Popper.js, Boostrap 4.0 JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand lobster" href="index.php">GCC - Gift Card Collector</a>
                </div>
                <ul class="nav navbar-nav mr-auto">
                    <?php
                        $login = empty($_SESSION['userID']) ? false : true;

                        if ($login) {
                            echo '<li class="nav-item raleway" id="login"><button class="btn btn-outline-info navbar-btn" type="button" onclick="location.href=\'library.php?result=loggedIn&user=' . $_SESSION['user'] . '\'">Wallet</button></li>';
                            echo '<li class="nav-item raleway" id="login"><button class="btn btn-outline-secondary navbar-btn" type="button" onclick="location.href=\'newcard.php\'">Add Card</button></li>';
                            echo '<li class="nav-item raleway" id="login"><button class="btn btn-outline-danger navbar-btn" type="button" onclick="location.href=\'utilities/logout.php\'">Log Out</button></li>';
                        }
                        else {
                            echo '<li class="nav-item raleway" id="login"><button class="btn btn-outline-info navbar-btn" data-toggle="modal" data-target="#signupModal" type="button">Sign Up</button></li>';
                            echo '<li class="nav-item raleway" id="login"><button class="btn btn-outline-success navbar-btn" data-toggle="modal" data-target="#loginModal" type="button">Log In</button></li>';
                        }
                    ?>
                </ul>
            </div>
        </nav>

        <!--
            Modal Fade login
        -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title lobster" id="lineModalLabel">GCC - Login</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body raleway">	
                        <form action="utilities/login.php" method="POST">
                            <div class="form-group">
                                <label for="exampleUsername">User ID</label>
                                <input name="username" type="text" class="form-control" id="Username" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="examplePassword">Password</label>
                                <input name="password" type="password" class="form-control" id="Password" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--
            Modal Fade signup
        -->
        <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title lobster" id="lineModalLabel">GCC - Sign Up</h3>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    </div>
                    <div class="modal-body raleway">	
                        <form action="utilities/signup.php" method="POST">
                            <div class="form-group">
                                <label for="exampleUsername">User ID</label>
                                <input name="username" type="text" class="form-control" id="newUsername" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <label for="examplePassword">Password</label>
                                <input name="password" type="password" class="form-control" id="newPassword" placeholder="Password">
                            </div>
                            <button type="submit" class="btn btn-info">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>