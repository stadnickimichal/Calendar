<?php
require_once ("calendar.php");
class form extends calendar
{
    function __construct(){}
    function eventForm(){
        echo '<form action="index.php" method="post" class="eventForm">';
            echo '<i class="fa fa-calendar-plus-o" aria-hidden="true"></i>';
            echo '<label for="Name">Name:</label>';
            echo '<input type="text" name="Name" class="eventName">';
            echo '<label for="day">Day:</label>';
            $this->select('day');
            echo "<label>Begining:</label>";
            echo "<input type='number' name='begH' min='6' max='21' placeholder='-' class='numb'>:";
            $this->select('begMin');
            echo "<label>Ending:</label>";
            echo "<input type='number' name='endH' min='6' max='21' placeholder='-' class='numb'>:";
            $this->select('endMin');
            echo "<input type='submit' value='+' class='subnitBtn'>";
        echo "</form>";
    }
    function select($name){
        echo "<select name='" . $name . "' class='numb'>";
            echo "<option value='' disabled selected>-</option>";
        if ($name=='day'){
            for($i=0 ; $i<5 ; $i++){
                echo '<option value='.$this->days[$i].'>'.$this->days[$i].'</option>';
            }
        }
        else {
            for($i=0 ; $i<4 ; $i++){
                $minutes=15*$i;
                echo '<option>' . $minutes . '</option>';
            }
        }
        echo "</select>";
    }
}
?>