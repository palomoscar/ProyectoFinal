				
				var error = 0;
				
				function vervalores(){ 
				var sAux="";
				var frm = document.getElementById("registro");
					for (i=0;i<frm.elements.length;i++)
					{ sAux += "NOMBRE: " + frm.elements[i].name + " ";
					sAux += "VALOR: " + frm.elements[i].value + "\n" ;
					} 
				
				alert(sAux);


				}
		
			
			function checkname(){
				
				var elem = document.getElementById('nombre');
				
				var aviso = "Por favor, introduce tu nombre";
				
				if(elem.value == '' ){
					
					alert(aviso);
					
					error = 1;
					
				}
				
			}
			function checksurname(){
			
				var elem = document.getElementById('apellidos');
				var aviso = "Por favor, ingresa tus dos apellidos";
				
				if( elem.value == '' ){
					
					alert(aviso);
					
					error=1;
			
				}
		
			}
			
			function checkmail(){
				
				var elem = document.getElementById('mail');
				var aviso = "Por favor, introduce un email de la UPV";
				var direccion = new RegExp("[a-zA-Z]+[0-9]{3}@ikasle.ehu.(es|eus)");
				
				if( !direccion.test(elem.value) ){
					
					alert(aviso);
					
					error=1;
					
					
				}
				
			}
			function checkpass(){
				
				var elem = document.getElementById('pass');
				var elem2 = document.getElementById('pass2');
				var aviso = "Por favor, introduce una contraseña más larga";
				var aviso2 = "Las contraseñas no coinciden";
				
				if( elem.value == "" || elem.value.length < 6 ){
					
					alert(aviso);
					
					error=1;
					
				}
				if( elem.value != elem2.value ){
					
					alert(aviso2);
					
					error = 1;
		
				}
				
			}
			function checktelf(){
				
				var elem = document.getElementById('telf');
				var aviso = "Introduce un número de teléfono válido";
			
				
				if(elem.value == '' || elem.value<600000000 || ( elem.value >699999999 && elem.value<900000000 ) ||  elem.value>999999999 ){
					
					alert(aviso);
					
					error = 1;
				}
				
			}
			function checkesp(){
				
				var elem = document.getElementById('esp');
				var aviso = "Selecciona tu especialidad ";
				
				if(elem.value == ""){
					
					alert(aviso);
					error = 1;
					
					
				}
				
			}
			
			
			function validar(){
				
				
				checkname();
				checksurname();
				checkmail();
				checkpass();
				checktelf();
				checkesp();
				
				if( error == 1){
					return false;
				}

				return true;
			}