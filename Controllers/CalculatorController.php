<?php
include "../Models/CalculatorModel.php";
$formula = null;

//get a calculator
get_calculator();

//button down
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['CLR'])){
        clear_formula();
    }else if(isset($_SESSION['has_sign']) && $_SESSION['has_sign'] == true){
        for($i = 0; $i<=9; $i++){
            if(isset($_POST[strval($i)])){
                add_number_to_formula_with_sign($i);
            }          
        }if(isset($_POST['='])){
            calculate();
        }
    }else{
        for($i = 0; $i<=9; $i++){
            if(isset($_POST[strval($i)])){
                add_number_to_formula($i);
            }          
        }
        switch (true):
            case (isset($_POST["+"])):
                add_sign_to_formula("+");
                break;
            case (isset($_POST["-"])):
                add_sign_to_formula("-");
                break;
            case (isset($_POST["*"])):
                add_sign_to_formula("*");
                break;
            case (isset($_POST["/"])):
                add_sign_to_formula("/");
                break;
            default:
                break;
        endswitch;
    }
}

//evaluate string from database
function calculate(){
    global $formula;
    $formula = get_calculator_formula();
    $formula_array = preg_split('/[\/\+\-*]/', $formula);
    switch (true):
        case strpos(get_calculator_formula(),"+"):
            $formula = $formula_array[0]+$formula_array[1];
            break;
        case strpos(get_calculator_formula(),"-"):
            $formula = $formula_array[0]-$formula_array[1];
            break;
        case strpos(get_calculator_formula(),"*"):
            $formula = $formula_array[0]*$formula_array[1];
            break;
        case strpos(get_calculator_formula(),"/"):
            $formula = $formula_array[0]/$formula_array[1];
            break;
    endswitch;
    clear_formula();
    add_number_to_formula($formula);
}
?>