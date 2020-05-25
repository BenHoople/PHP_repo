<?php
include 'Connection.php';
//begin session or continue it
if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true){
    header("Location: Calculator.php");
}else{
    session_start();
}
//variable
$message = null;
//read
if(isset($_POST["login"])){
    //if email text bos is empty
    if(empty($_POST["email"])){
        $message = "Please enter a name!";
        echo $message;
    }//if its not empty
    else{
        //get user account and begin sessions
        get_email();
    }
}
//create 
if(isset($_POST["createAccount"])){
    //if email text bos is empty
    if(empty($_POST["email"])){
        $message = "This cant be empty!";
    }else{
        $query = "INSERT INTO users (`email`) VALUES (:email)";
        //prep&execute
        //prep
        $statement = $conn->prepare($query);
        //execute
        $statement->execute(
            array(
                'email' => $_POST["email"]
            )
        );
        //get user account and begin sessions   
        get_email();
    }
}
//end
if(isset($_POST["logOut"])){
    session_destroy();
    header("Location: index.php");
}
//read
function get_email(){
    global $conn;
    $session_id = null;
    //GET THE USER FROM THE DATABASE
    $query = "SELECT * FROM users WHERE email = :email";
    //prep&execute
    //prep
    $statement = $conn->prepare($query);
    //execute
    $statement->execute(
        array(
            'email' => $_POST["email"]
        )
    );
    $session_id = $statement->fetchAll();
    print_r($session_id);
    //make sure it resulted in something
    $count = $statement->rowCount();
    echo $count;
    if($count > 0){
        $_SESSION["logged_in"] = true;
        $_SESSION["id"] = $session_id[0]["id"];
        $_SESSION["email"] = $_POST["email"];
        echo  $_POST["email"];
        header("location:../Views/LandingPage.php");

    }else{
        $message = "That didn't work for some reason... Try again!";
    }
}
?> 