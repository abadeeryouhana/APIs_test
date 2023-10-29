<?php 

include 'database.php';

$sql = "select * from blog where b_state=0";
        
                     
if($result = mysqli_query($db,$sql))
{
        $rows = array();
        while($row = mysqli_fetch_assoc($result))
               {
                                        
                $rows[] = $row;
                }
        
                http_response_code(200);
        
                echo json_encode(array("data"=>$rows));
                        
}
else
{
        http_response_code(422);
        echo json_encode(array("msg"=>"Error in database action"));
}




          


?>