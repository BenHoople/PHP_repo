
<?php 
include "Templates/header.php";
include "../Controllers/CalculatorController.php";
?>
<form class= "container" method="post">
    <div class = "screen row justify-content-center">
        <h2 class = "navbar-brand col-1" style = "text-align = center"><?php if(isset($formula)){echo $formula;}else{echo get_calculator_formula();} ?></h2>
    </div>
    <div class = "row justify-content-center">
        <input id="1" class="btn btn-outline-success col-1" type="submit" name="1" value = "1"/>
        <input id="2" class="btn btn-outline-success col-1" type="submit" name="2" value = "2"/>
        <input id="3" class="btn btn-outline-success col-1" type="submit" name="3" value = "3"/>
        <input id="3" class="btn btn-outline-success col-1" type="submit" name="+" value = "+"/>
    </div>
    <div class = "row justify-content-center">
        <input id="4" class="btn btn-outline-success col-1" type="submit" name="4" value = "4"/>
        <input id="5" class="btn btn-outline-success col-1" type="submit" name="5" value = "5"/>
        <input id="6" class="btn btn-outline-success col-1" type="submit" name="6" value = "6"/>
        <input id="3" class="btn btn-outline-success col-1" type="submit" name="-" value = "-"/>
    </div>
    <div class = "row justify-content-center">
        <input id="7" class="btn btn-outline-success col-1" type="submit" name="7" value = "7"/>
        <input id="8" class="btn btn-outline-success col-1" type="submit" name="8" value = "8"/>
        <input id="9" class="btn btn-outline-success col-1" type="submit" name="9" value = "9"/>
        <input id="3" class="btn btn-outline-success col-1" type="submit" name="*" value = "*"/>
    </div>    
    <div class = "row justify-content-center">
        <input id="8" class="btn btn-outline-success col-1" type="submit" name="CLR" value = "CLR">
        <input id="8" class="btn btn-outline-success col-1" type="submit" name="0" value = "0"/>
        <input id="8" class="btn btn-outline-success col-1" type="submit" name="=" value = "=">
        <input id="3" class="btn btn-outline-success col-1" type="submit" name="/" value = "/"/>
    </div>  
    
</form>

</body>
</html>