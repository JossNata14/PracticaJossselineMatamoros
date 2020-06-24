
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <style>
            ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
                overflow: hidden;
                background-color: #333;
            }

            li {
                float: left;
            }

            li a {
                display: block;
                color: white;
                text-align: center;
                padding: 14px 16px;
                text-decoration: none;
            }

            li a:hover {
                background-color: #111;
            }
        </style>
        <title>Control servicios</title>
    </head>
    <body>
        <ul>
            <li><a  href="adminView.php">Vista principal</a></li>
            <li><a href="expiredServicesView.php">Servicios vencidos </a></li>
            <li><a href="viewUpcomingServicesExpire.php">Servicios proximos a vencer</a></li>
            <li><a href="sendEmail.php">Enviar email  de servicios  proximos a vencer</a></li>
            <li><a href="index.php">Salir</a></li>
        </ul>

    </body>
</html>
<?php
	require 'PHPMailer/PHPMailerAutoload.php';
	include ("dataBaseConnection.php");

        
        
          
    $request = "SELECT user.mail as mail, user.name as name FROM user,userrole where role=userrole.id_Role";

 // obtiene el resultado de la consulta 
$data = mysqli_query($conexion, $request);

     
       $rowB = mysqli_fetch_array($data);
          if($rowB>0){
             $mail = new PHPMailer();
	
        
	$mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 587;
	
	$mail->Username = 'pruebajosselinematamoros@gmail.com'; //Correo de donde enviaremos los correos
	$mail->Password = 'prueba.123'; // Password de la cuenta de envío
	
	$mail->setFrom('pruebajosselinematamoros@gmail.com', 'Enviado por Control de servicios');
	$mail->addAddress($rowB['mail'], 'Receptor'.$rowB['name']); //Correo receptor
	
           $mensaje="";
                //consulta  para extraer los servicios con fecha mayor a la actual
                $query = "SELECT s.id_services as id , s.description as description, s.dateTime as date , t.service_type_name as services, c.name_company as company FROM services s,type_services t,company c WHERE c.id_company = s.idCompany and t.id_services_type=s.type and dateTime > CURRENT_DATE ORDER BY dateTime ASC";
                // ejecuto consulta en la base
                $result = mysqli_query($conexion, $query); 
                //extraigo el resultado de la base
                while ($row = mysqli_fetch_array($result)) {
                   $mensaje= $row["id"]."  Tipo de servicio ". $row["services"]. " Descripcion: ".
                    $row["description"] . " Fecha  ".
                    $row["date"] . " Compañia  ".
                    $row["company"]. PHP_EOL;
                }



              
	
	$mail->Subject = 'Servicios proximos a vencer en funcion a su fecha.';
	$mail->Body    = $mensaje;
	
	if($mail->send()) {
		echo 'Correo Enviado';
		} else {
		echo 'Error al enviar correo';
	}
            }else{
                echo "Error";
             
            }
                
          mysqli_close($conexion);        
        
	
?>