<?php
include 'database.php';
$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata))
{
	$request = json_decode($postdata,true);

    if(!isset($request['username'])){

        echo json_encode(array("msg"=>"Username is required"));
        return 0;
    }
    if(!isset($request['password'])){

        echo json_encode(array("msg"=>"Password is required"));
        return 0;
    }

    $username = mysqli_real_escape_string($db, trim($request['username']));
    $password = mysqli_real_escape_string($db, trim($request['password']));




													
$sql = "select * from users where u_name='".$username."'";

// echo $sql;
    $result = mysqli_query($db,$sql);
	if($result->num_rows > 0)
	{
        
        $password1 = md5($password);
		while($row = $result->fetch_assoc()) {
            // echo "password: ".$row["password"]."<br>";
            // echo "password: ".$password1;
            if($password1==$row["u_password"])
            {
                http_response_code(200);
                echo json_encode(array("msg"=>"Login Succefully","code"=>200,"auth_token"=>createToken($username)));
            }
            else
            {
                echo json_encode(array("msg"=>"Password is wrong","code"=>200));
            }
            
          }

		
	}
	else
	{
		http_response_code(200);
        echo json_encode(array("msg"=>"Username is not found"));
	}
}