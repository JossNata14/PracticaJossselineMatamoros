<?php

/*
 * En esta clase se verifica que el usuario este ingresado con anterioridad en el sistema 
 */

include ("dataBaseConnection.php");

$username = $_POST['userName'];
$password = $_POST['psw'];
//Se llaman los datos de la base de datos mySQL haciendo la consulta 

if($conexion){
    
    $request = "SELECT userrole.name as roleName FROM user,userrole where userName='$username' and password= '$password' and role=id_Role";

 // obtiene el resultado de la consulta 
$data = mysqli_query($conexion, $request);

     
       $row = mysqli_fetch_array($data);
          if($row>0){
                header ("Location:adminView.php");
            }else{
                echo "Datos incorrectos intente de nuevo";
                header ("Location:index.php");
            }
                
                
        

}  else {
    echo "Error en conexión";
}


mysqli_close($conexion);
?>

