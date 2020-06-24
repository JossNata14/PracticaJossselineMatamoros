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
        <style>
            #customers {
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            #customers td, #customers th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            #customers tr:nth-child(even){background-color: #f2f2f2;}

            #customers tr:hover {background-color: #ddd;}

            #customers th {
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #4CAF50;
                color: white;
            }
        </style>
        <title>Control servicios</title>
    </head>
    <body>
        <ul>
            <li><a  href="adminView.php">Vista principal</a></li>
            <li><a href="expiredServicesView.php">Servicios vencidos </a></li>
            <li><a href="viewUpcomingServicesExpire.php">Servicios proximos a vencer</a></li>
            <li><a href="index.php">Salir</a></li>
        </ul>

        <br>
        <div>

            <table id="customers">
                <tr>
                    <th>Numero servicio</th>
                    <th>Tipo servicio</th>
                    <th>Descripcion</th>
                    <th>Fecha</th>
                    <th>Compañia cliente</th>
                </tr>

                <?php
//incluyo el archivo con la información de la base
                include 'dataBaseConnection.php';
                //consulta  para extraer los servicios con fecha menor a la actual

                $query = "SELECT s.id_services as id , s.description as description,  s.dateTime as date , t.service_type_name as services, c.name_company as company FROM services s,type_services t,company c WHERE c.id_company = s.idCompany and t.id_services_type=s.type and `dateTime` < CURDATE() ";
                // ejecuto consulta en la base
                $result = mysqli_query($conexion, $query);
                //extraigo el resultado de la base
                while ($row = mysqli_fetch_array($result)) {
                    echo "<tr><td width=\"10%\"><font face=\"verdana\">" . $row["id"] . "</font></td>";
                    echo "<td width=\"25%\"><font face=\"verdana\">" .
                    $row["services"] . "</font></td>";
                    echo "<td width=\"25%\"><font face=\"verdana\">" .
                    $row["description"] . "</font></td>";
                    echo "<td width=\"25%\"><font face=\"verdana\">" .
                    $row["date"] . "</font></td>";
                    echo "<td width=\"25%\"><font face=\"verdana\">" .
                    $row["company"] . "</font></td></tr>";
                }



                mysqli_close($conexion);
                ?>
            </table>
        </div>

    </body>
</html>
