<?php
//SUJIT DAS
class EnrollVehicleMGR
{
    public $con;  
      public function __construct()  
      {  
           $this->con = mysqli_connect("166.62.27.181", "nestio_admin","nestio_admin@22","ZEROwaste");  
           
           if(!$this->con)  
           {  
                echo 'Database Connection Error ' . mysqli_connect_error($this->con);  
           }  
           else{
            //    echo "Successfully Connected!";
           }
      }
public function getVehicleDetails($table_name,$key,$value){
     $array = array();  
                 $query = "SELECT municipality_id,driver_name,driver_email,driver_ph_no,vehicle_type,capacity  FROM ".$table_name." WHERE ".$key." = '".$value."' ";  
              //    echo '<h1>'.$query.'</h1>';
                 $result = mysqli_query($this->con, $query);  
                 while($row = mysqli_fetch_assoc($result))  
                 {  
                      array_push($array,$row['driver_email']); 
                 }  
                 return $array; 
}  
public function checksVehicleInfo($drid,$drm,$drph,$vt,$cap,$mid ){

    $sql = "INSERT INTO  `vehicle` (municipality_id,driver_name,driver_email,driver_ph_no,vehicle_type,capacity)values ('$mid','$drid','$drm','$drph','$vt','$cap');";
    mysqli_multi_query($this->con, $sql);

    /*$ar = array("SujitMUNICIPALITY2021","SujitDas","Sujit@mail.com","1234578963","Truck-Yo","100");
    return $ar;*/
  
}
}
class EnrollVehicleMGRTest extends \PHPUnit\Framework\TestCase{
     public function test(){
          $enroll = new EnrollVehicleMGR;
          $drid="SujitDas";
          $drm="Sujit@mail.com";
          $drph=1234578963;
          $vt="Truck-Yo"; 
          $cap=100;
          $mid ="SujitMUNICIPALITY20";
          $enroll->checksVehicleInfo($drid,$drm,$drph,$vt,$cap,$mid);
          $result = $enroll->getVehicleDetails('vehicle','municipality_id','SujitMUNICIPALITY20');
          //$temp=array("SujitMUNICIPALITY20","SujitDas","Sujit@mail.com","1234578963","Truck-Yo","100");
          $temp = array("Sujit@mail.com");
          $this->assertEquals($temp,$result);
     }
}