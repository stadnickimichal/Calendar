<?php
require_once ("databases.php");
class calendar extends DatabaseCom
{
    protected  $days= array("mond" ,"tues", "weds", "thur", "frid");
    function __construct(){
        $this->Coniection();
        $this->changeDatabase();
    }
    function createDays(){
    for ($j=0 ; $j<5 ; $j++){
        echo ($j==0)?'<div class="col-sm-2 col-sm-12 day col-sm-offset-1">':'<div class="col-sm-2 col-sm-12 day">';
            echo '<table id=' . $this->days[$j] . '>';
                echo '<th class="table__header">' . $this->days[$j] . '</th>';
                for($i=0 ; $i<64 ; $i++){
                    $min= 15+ 15*($i%4);
                    $h=(int)(6+$i/4);
                    $i=$this->addingRows($this->days[$j], $min, $h, $i);
                }
            echo '</table>';
        echo '</div>';
    }
    }
    function addingRows ($day, $min, $h, $index){
        $prev_index=$index;
        $event="";
        $a=$index+1;
        echo '<tr class="table__row">';
        echo "<td id='$day-$a' ";
        echo ($index%4==0)?'class="table__date table__HourTd':'class="table__date ';
        for ($k=0 ; $k<$this->result->num_rows ; $k++){
            $this->result->data_seek($k);
            $row= $this->result->fetch_array(MYSQLI_ASSOC);
            if(($day==$row['dat'])&&($min==$row['beginingMinutes'])&&($h==$row['beginingH'])){
                $length=($row['endingH'] - $row['beginingH'])*4 + $row['endingMinutes']/15 - $row['beginingMinutes']/15+1;
                $event=$row['beginingH'].":".$row['beginingMinutes']." - ".$row['endingH'].":".$row['endingMinutes']."<br>". $row['title'];
                echo ' event" style="height:' . $length*16 . 'px">';
                $this->removingButton($k);
                $index=$index-1+$length;
            }
        }
        echo ($event=="")?'">':"<p>".$event."</p>";
        if(($prev_index==$index)&&($index%4==0)) echo "<strong>" . $h . ":00</strong>";
        echo '</td></tr>';
        return $index;
    }
    function removingButton($index){
        echo "<form action='index.php' method='post' class='deleteBtn'>";
        echo    "<input type='hidden' name='execute" . $index . $_SESSION['count'] . "' value='true'>";
        echo    "<input type='submit' value='X'>";
        echo "</form>";
    }
}
?>