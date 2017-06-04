<?php
class DatabaseCom
{
    protected  $conn, $result;
    function Coniection(){
        $this->conn=new mysqli('localhost','root','','calendar');
        if($this->conn->connect_errno) die($this->conn->connect_errno);
    }
    function changeDatabase(){
        $this->loadEvents();
        $this->addToDatabase();
        $this->removeFromDatabase();
        $this->loadEvents();
    }
    function addToDatabase(){
        if(isset($_POST['Name'])&&(isset($_POST['day']))&&(isset($_POST['begH']))&&(isset($_POST['begMin']))
          &&(isset($_POST['endH']))&&(isset($_POST['endMin']))){
            if($this->double_form_send()){
                $values=array($this->mysql_fix_string($_POST['Name']), $this->mysql_fix_string($_POST['day']),$this->mysql_fix_string($_POST['begMin']), 
                    $this->mysql_fix_string($_POST['endMin']),$this->mysql_fix_string($_POST['begH']), $this->mysql_fix_string($_POST['endH']));
                $query="INSERT INTO `events`(`title`, `dat`, `beginingMinutes`, `endingMinutes`, `beginingH`, `endingH`)".
                    "VALUES ('$values[0]','$values[1]','$values[2]','$values[3]','$values[4]','$values[5]')";
                $this->conn->query($query);
                if(!$this->result) die($this->conn->error);
            }
        }
    }
    function removeFromDatabase(){
        if(is_object($this->result)) $numbRows=$this->result->num_rows;
        for($i=0 ; $i<$numbRows ; $i++){
            if (is_object($this->result)) {
                $this->result->data_seek($i);
                $row= $this->result->fetch_array(MYSQLI_ASSOC);
                if(isset($_POST["execute" . $i . ($_SESSION['count']-1)])){
                    $query="DELETE FROM `events` WHERE `dat`='".$row['dat']."' AND`beginingMinutes`='".$row['beginingMinutes']
                        ."' AND`beginingH`='".$row['beginingH']."';";
                    $this->result=$this->conn->query($query);
                    if(!$this->result) die($this->conn->error);
                }
            }
        }
    }
    function loadEvents(){
        $query="SELECT * FROM events";
        $this->result= $this->conn->query($query);
        if(!$this->result) die ($this->conn->error);
    }
    function double_form_send(){
        for ($i=0 ; $i<$this->result->num_rows ; $i++){
            $this->result->data_seek($i);
            $row2= $this->result->fetch_array(MYSQLI_ASSOC);
            if(($_POST['day']==$row2['dat'])&&($_POST['begMin']==$row2['beginingMinutes'])&&($_POST['begH']==$row2['beginingH']))
                return false;
            }
        return true;
    }
    function mysql_fix_string($string){
        if(get_magic_quotes_gpc()) $string=stripslashes($string);
        return $this->conn->real_escape_string($string);
    }
}
?>