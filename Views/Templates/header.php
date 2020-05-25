<!DOCTYPE html>
<html>
    <head>
        <title>Ben Hoople</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel = "stylesheet" type = "text/css" href = "../Styles/styles.css" />
    </head>
    <body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="../index.php">PhpProjects</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Gallery<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Upload</a>
            </li>
            <li>
            <!-- Drop down button -->
            <div class="dropdown">
                <a class="dropdown-toggle btn" data-toggle="dropdown" href="#" >Dropdown trigger</a>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                    <li>Item One</li>
                    <li>Item Two</li>
                    </ul>
            </div>

            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            </ul>
            <form class="form-inline my-2 my-lg-1" method = "post">
                

                <?php 
                include 'login.php';
                $logout = '<button name="logOut" class="btn btn-outline-success ml-sm-2" type="submit">Log-Out</button>';
                $login ='<input class="form-control mr-sm-2" type="search" name="email" placeholder="'.$message.'" aria-label="Search">';
                $email ='<button name="login" class="btn btn-outline-success" type="submit">Login</button>';
                $createAccount ='<button name="createAccount" class="btn btn-outline-success  mr-sm-2 ml-sm-2" type="submit">Create Account</button>';
                if(isset($_SESSION["logged_in"])){
                    echo $logout;
                }else{
                    echo $login;
                    echo $email;
                    echo $createAccount;
                }
                ?>

            </form>

        </div>
    </nav>