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
