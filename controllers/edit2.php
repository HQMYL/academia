<?php
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */
	require_once 'conn.php';
	$response = "";
$response = array(
    'status' => 0,
    'message' => "El envío ha fallado,inténtalo nuevamente"
);
	#if(isset($_POST['edit'])){
$id = "";
if (isset($_POST['id'])) 
{
	$id = $_POST['id'];
}
		
		$image_name = $_FILES['photo']['name'];
		$image_temp = $_FILES['photo']['tmp_name'];
		#$firstname = $_POST['firstname'];
		#$lastname = $_POST['lastname'];
		$previous = 'dist/img/logo/'.$_POST['previous'];
		#var_dump($previous);
		$exp = explode(".", $image_name);
		$end = end($exp);
		#var_dump($end);
		$name = time().".".$end;
		$path = "dist/img/logo/".$name;
		$path2 = $name;
		$allowed_ext = array("gif", "jpg", "jpeg", "png","jfif");
		if(in_array($end, $allowed_ext)){
			#if(unlink($previous)){
				if(move_uploaded_file($image_temp, $path)){
					mysqli_query($conn, "UPDATE `logotipo` set `img` = '$path2' WHERE `id` = '$id'");
					$response['status'] = 1;
            $response['message'] = "Picture successfully updated";
            echo  json_encode($response);
            #unlink("assets/img/logo/".$_POST['previous']);
				}
			#}		
		}else{
			$response['status'] = 0;
    $response['message'] = "There was an error,try it again";
    echo  json_encode($response);
		}
	#}
?>