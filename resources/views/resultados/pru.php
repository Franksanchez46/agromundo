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
<br><br><br>
<?php
function rangoSalarial($Salario){
    if ($Salario >= 1000000){
        if($Salario >= 3000000){
            return "Salario Alto";
        }else{
            return "Salario medio";
        }
    }else{
        return "Salario Bajo";
    }
}

echo rangoSalarial(2000000);
echo "<br>";
echo rangoSalarial(20000000);
echo "<br>";
echo rangoSalarial(100000);
echo "<br>";
?>
<br><br><br>
<?php
function calcularSalarioNto($salarioBruto){
  function calcularDeducciones($salario){
    function descuentoSalud($salario){
      return $salario * 0.04;
    }
    function descuentoPension($salario){
      return $salario * 0.04;
    }
    return descuentoSalud($salario) + descuentoPension($salario);
  }
  $deducciones = calcularDeducciones($salarioBruto);
  $salarioNeto = $salarioBruto - $deducciones;

  echo "Salario Bruto: " . $salarioBruto . "<br>";
  echo "Deducciones: " . $salarioNeto . "<br>";
  echo "Salario Neto: " . $salarioNeto. "<br>";
}
calcularSalarioNto(1623500);
?>
<br><br><br>
<?php
function calcularPrecioFinal($precioBase){
  function calcularIVA($precio){
    return $precio + ($precio * 0.19);
  }
  function aplicarDescuento($precio){
    return $precio - ($precio * 0.10);
  }
  $precioConIVA = calcularIVA($precioBase);
  $precioFinal = aplicarDescuento($precioConIVA);
  echo "Precio Base: " . $precioBase . "<br>";
  echo "Precio con IVA: " . $precioConIVA . "<br>"; 
  echo "Precio Final: " . $precioFinal . "<br>";
}
calcularPrecioFinal(150000);
?>
<br><br><br>
<?php
// Your code here!
function calcularSalarioNeto($salarioBase){
    function bonificacion($salario){
        return $salario + ($salario * 0.15);
    }
    function deducciones($salario){
        return $salario - ($salario * 0.08);
    }
    $salarioConBonificacion = bonificacion($salarioBase);
    $deduccion = $salarioConBonificacion * 0.08;
    $salarioNeto = deducciones($salarioConBonificacion);
    
    echo "Salario base: ".$salarioBase."<br>";
    echo "Salario con bonificacion: ".$salarioConBonificacion."<br>";
    echo "Deduccion: ".$deduccion."<br>";
    echo "Salario neto: ".$salarioNeto."<br>";
}
calcularSalarioNeto(2000000);
?>
<br><br><br>
<?php
function evaluarCliente($edad, $tipo){
    if ($edad >= 60){
        if ($tipo == "frecuente"){
            return "Descuento del 25% por ser adulto mayor frecuente.";
            
        }elseif ($tipo == "vip"){
                return "Descuento del 40% por ser cliente VIP adulto mayor.";
            }else{
                return "Descuento del 20% por edad.";
            }
    }elseif($edad >= 30){
        if($tipo == "vip"){
            return "Descuento del 20% por fidelidad.";
        }elseif($tipo == "frecuente"){
            return "Descuento del 10% por antiguedad.";
        }else{
            return "Sin descuento especial.";
        }
    }else{
        if ($tipo == "nuevo"){
            return "Bienvenido, tienes un cupon del 5% de descuento.";
        }else{
            return "No aplica ningun beneficio";
        }
    }
    
}

echo evaluarCliente(65,"vip");
echo "<br>";
echo evaluarCliente(45, "frecuente");
echo "<br>";
echo evaluarCliente(25, "nuevo");
echo "<br>";
echo evaluarCliente(28, "vip");
?>
<br><br><br>