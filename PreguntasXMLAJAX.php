


<?php 		
			
	echo "<h3>Preguntas XML</h3>";
	
	echo "<br></br>"; 
	$preguntas = simplexml_load_file("preguntas.xml");

	echo '<table border=1> <tr> 
		<th> Tematica </th>
		<th> Enunciado </th>
		<th> Complejidad </th>
		</tr>';
	foreach($preguntas as $pregunta){
      echo '<tr>
		<th>'. $pregunta['subject'] . '</th>
		<th>' . $pregunta->itemBody->p . '</th>
		<th>' . $pregunta['complexity'] . '</th>
		</tr>';
	}
   
	?>