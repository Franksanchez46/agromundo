<body>
<?php
function puedeconducir ($edad, $pais){
if($edad >= 18){
  if($pais == "Colombia"){
  return "puede conducir";
}else{
  return "No puede conducir";
}
}else{
  return "no puede conducir";
}
}
echo puedeconducir (17, "Colombia");
?>
</body>

<br><br>

<body>

 <?php 
 function evaluarEstudiante ($nota){
   if($nota >= 60){
     if ($nota >= 90){
     return "Excelente";
}else{
     return "Aprobado";
}
}else{
     return "Reprobado";
}
}

echo evaluarEstudiante(50);
echo "<br>";
echo evaluarEstudiante(70);
echo "<br>";
echo evaluarEstudiante(90);
 ?>

</body>
<br><br>
<body>

<?php
function clasificarEdad($edad){

  if($edad >= 13){
     if($edad >= 20){
        if($edad >=65){
          return "Adulto Mayor";
      }else{
          return "adulto";
            }
    
    }else{
          return "Adolescente";
         }

  }else{
          return "Niño";
}

}

echo clasificarEdad(68);
echo "<br>";
echo clasificarEdad(50);
echo "<br>";
echo clasificarEdad(15);
echo "<br>";
echo clasificarEdad(12);
?>

</body>
<br><br>
<body>

<?php

  function evaluarSalario($salario){
    if($salario >= 1000000){
      if($salario >= 3000000){
    return "Salario Alto";
}else{
    return "Salario Medio";
}
}else{
    return "Salario Bajo";
}

}

echo evaluarSalario(5000000);
echo "<br>";
echo evaluarSalario(130000);
echo "<br>";
echo evaluarSalario(500000);
?>
</body>
<br><br>
<?php
// Your code here!
function evaluarSueldo($sueldo){
    if($sueldo >= 1000000){
        if($sueldo >= 3000000){
            return "Sueldo Alto";
        }else{
            return "Sueldo Medio";
        }
    }else{
        return "Sueldo Bajo";
    }
}

echo evaluarSueldo(300000);
echo "<br>";
echo evaluarSueldo(100000);
echo "<br>";
echo evaluarSueldo(5000000);
?>