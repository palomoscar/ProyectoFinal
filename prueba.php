<?php

include("./conexionbd.php");

$mejores = mysqli_query($mysqli, "Select TOP 5 Puntos FROM mejores ORDER BY Puntos DESC" ) or die('Error al mostrar los Top Scores');
			
			echo '<table border=1>
				<caption>Mejores Jugadores</caption>
				<tr> 
				<th> Puntos </th>
				<th> Nick </th>
				</tr>';
		
			$cont = 0;
			
			while( $row = mysqli_fetch_array($mejores) ){
				
				echo '<tr>
					  <td>'.$row['Puntos'].'</td>
					  <td>'.$row['Nick'].'</td>
					</tr>';
					
				$cont++;
				
				if($cont == 5){
					
					die('');
					
				}
			
			}
		
			echo '</table></center>';
			
?>