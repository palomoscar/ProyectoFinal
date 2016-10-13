<?php


	//conexion remota

	//$mysqli = mysqli_connect("mysql.hostinger.es","u204349316_root","gabriel3", "u204349316_users" ) or die(mysql_error());
	
	//conexion local
	
	//$mysqli = mysqli_connect("localhost", "root","","usuario") or die (mysql_error());
	
	//conexion remota
	
	$mysqli = mysqli_connect("mysql.hostinger.es","u204349316_root","gabriel3","u204349316_users") or die( mysql_error() );
		


		if (!$mysqli) {
	 
			echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;

		}

	$usuarios = mysqli_query($mysqli, "select * from usuario" ) or die( mysql_error() );

		echo '<table border=1> <tr> 
		<th> Nombre </th>
		<th> Apellidos </th>
		<th> Nickname </th>
		<th> Password </th>
		<th> Email </th>		
		<th> Telefono </th>
		<th> Sexo </th>
		<th> Especialidad </th>
		</tr>';

			
		while( $row = mysqli_fetch_array($usuarios) ){
			echo '<tr>
					  <td>'.$row['Nombre'].'</td>
					  <td>'.$row['Apellidos'].'</td>
					  <td>'.$row['Nickname'].'</td>
					  <td>'.$row['Clave'].'</td>
					  <td>'.$row['Email'].'</td>
					  <td>'.$row['Telefono'].'</td>
					  <td>'.$row['Sexo'].'</td>
					  <td>'.$row['Especialidad'].'</td>
				 </tr>';
			
		}
		echo '</table>';
		
		//$usuarios->close();
		
		mysqli_close( $mysqli );
	
?>