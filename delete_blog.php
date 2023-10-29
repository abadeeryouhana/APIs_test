<?php
include 'database.php';


$postdata = file_get_contents("php://input");


if(isset(apache_request_headers()['auth_token']) && isset(apache_request_headers()['username']))
{
    if(isset($postdata) && !empty($postdata))
    {
        $request = json_decode($postdata,true);

        $auth_token=apache_request_headers()['auth_token'];
        $username=apache_request_headers()['username'];
      
               if($auth_token==createToken($username)['token'])  
               {

                    $id=$request['id'];


                    $query="update blog set b_state=1 where b_id=".$id."";

                    if($db->query($query))
                    {
                        http_response_code(200);
                        echo json_encode(array("msg"=>"Data deleted successfully"));
                    }
                    else{
                        http_response_code(200);
                        echo json_encode(array("msg"=>$db->error));
                    }
                }
                else
                {
                 echo json_encode(array("msg"=>"The user is not authorized"));
                }
    }
}
else
{
        echo json_encode(array("msg"=>"The request is not authenticated"));

}

?>

