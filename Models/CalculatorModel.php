<?php
include "Connection.php";

//object
class Calculator{
    public function __constructor($array){
        $_SESSION["calculatorID"] = $array[0];
        $_SESSION["formula"] = $array[1];
        $_SESSION["incommingString"] = $array[2];
        $this->$calculatorID = $array[0];
        $this->$formula = $array[1];
        $this->$incommingString = $array[2];
        echo "we can instantiate a calculator".$calculatorID.$formula.$incommingString;
    }
    public function get_calculatorID (){
        return $this->$calculatorID;
    }
    public function get_formula (){
        return $this->$formula;
    }
    public function get_incommingString (){
        return $this->$incommingString;
    }
}


//create - new calculator 
//could have used foreign keys an set up an alert to make a calculator automatically with an account... but i didn't
function create_calculator(){
    global $conn;
    //GET calculator from the id where the id is the same as the users id
    $query = "INSERT INTO calculators VALUES ((SELECT id FROM users WHERE email = '".$_SESSION[`email`]."'), '0' ,'');";
    //prep&execute
    //prep
    $statement = $conn->prepare($query);
    $Calculator = new Calculator($statement->execute(array(0)));
    if(isset($Calculator)){
        $calculator = new Calculator();
    }
}
//read methods 1 - get calcultor if exists else create_calculator 2- get calculator formula
//1.
//this uses a more complex MySQL query
function get_calculator(){
    global $conn;
    //GET calculator from the id where the id is the same as the users id
    $query = "SELECT id FROM calculators WHERE id = (SELECT id FROM users WHERE email = '".$_SESSION["email"]."');";
    //echo $query;
    //prep&execute
    //prep
    $statement = $conn->prepare($query);
    $Calculator = new Calculator($statement->execute(array(0)));
    if($statement->rowCount() == 0){
        create_calculator();
    }
}
//2.
function get_calculator_formula(){
    $formula;
    global $conn;
    //GET calculator from the id where the id is the same as the users id
    $query = "SELECT CONCAT(`string`,`incommingString`) as `formula` FROM calculators WHERE id = ".$_SESSION['id'].";";
    //prep&execute
    //prep
    $statement = $conn->prepare($query);
    $statement->execute();
    $formula = $statement->fetchAll();
    return $formula[0]['formula'];
    
}
//update - 1- add numbers 2- add signs 3- delete numbers
//uses a more simplistic MySQL query 
function add_number_to_formula($number){
    global $conn;
    //GET calculator from the id where the id is the same as the users id
    $query = "UPDATE `calculators` SET `string`= `string` * 10 + ".$number." WHERE id = ".$_SESSION['id'].";";
    //prep&execute
    //prep
    $statement = $conn->prepare($query);
    $statement->execute();
}
function add_number_to_formula_with_sign($number){
    global $conn;
    //GET calculator from the id where the id is the same as the users id
    $query = "UPDATE `calculators` SET `incommingString` = IF(incommingString = '',  0, incommingString) * 10 + ".$number." WHERE id = ".$_SESSION['id'].";";
    //prep&execute
    //prep
    $statement = $conn->prepare($query);
    $statement->execute();
}

//this is a ridiculous query, but i love it.
function add_sign_to_formula($sign){
    global $conn;
    //i think this is faster than calling get_calculator_formula(); and concatinating, its all done on the database even though its two statements. 
    $query = "set @formula = (SELECT `string` from calculators where id = ".$_SESSION['id'].");
    set @formula_with_variable = Concat(@formula,'".$sign."');
    UPDATE `calculators` SET `string`= @formula_with_variable WHERE id = ".$_SESSION['id'].";";
    //prep&execute
    //prep
    $statement = $conn->prepare($query);
    $statement->execute();
    $_SESSION['has_sign'] = true;
}
//delete 1 - delete the string value on clear
function clear_formula(){
    global $conn;
    //GETreset formula to 0
    $query = "UPDATE `calculators` SET `string`=0,`incommingString`='' WHERE id = ".$_SESSION['id']."";
    $statement = $conn->prepare($query);
    $statement->execute();
    $_SESSION['has_sign'] = false;
}
?>