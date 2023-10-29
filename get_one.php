<?php 

include 'database.php';

if(isset($_GET['id']) &&  $_GET['id']!=null && $_GET['id']!='')
{
    $sql = "select * from blog where b_id=".$_GET['id']." and b_state=0";                 
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
}
else
{

    echo json_encode(array("msg"=>"The blog ID is required"));

}





          


?>