<?php
echo " Conectando a la base de datos <br>";
$conex = new mysqli("192.168.1.39", "root", "root", "Empresa"); // Abre una conexión
if ($conex->connect_errno) {
    // Comprueba conexión
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}
$query = "SELECT EMP_NO,APELLIDO, SALARIO FROM EMPLEADOS";
if ($result = $conex->query( $query)) {
    
    // Array Asociativo por nombre de campo
    echo "<table border=1><th>Nº</th><th>Apellido</th><th>Salario</tr>";
    while ( $fila = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>$fila[EMP_NO]</td>";
        echo "<td>$fila[APELLIDO]</td>";
        echo "<td>$fila[SALARIO]</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Array Asociativo por posición del campo
    echo "<hr>";
    $result->data_seek(0); // Voy a al inico 
    echo "<table border=1><th>Nº</th><th>Apellido</th><th>Salario</tr>";
    while ( $fila = $result->fetch_array() ) {
        echo "<tr>";
        echo "<td>$fila[0]</td>";
        echo "<td>$fila[1]</td>";
        echo "<td>$fila[2]</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Un objeto con con atributos con el valor del campo
    echo "<hr>";
    $result->data_seek(0); // Voy a al inico
    echo "<table border=1><th>Nº</th><th>Apellido</th><th>Salario</tr>";
    while ( $obj = $result->fetch_object() ) {
        echo "<tr>";
        echo "<td>$obj->EMP_NO</td>";
        echo "<td>$obj->APELLIDO</td>";
        echo "<td>$obj->SALARIO</td>";
        echo "</tr>";
    }
    echo "</table>";
    
    // Un tabla con todos los resultados
    echo "<hr>";
    $result->data_seek(0);
    $todos = $result->fetch_all();
    echo "<table border=1><th>Nº</th><th>Apellido</th><th>Salario</tr>";
    foreach ($todos as $fila){
        echo "<tr>";
        foreach ($fila as $valor){
            echo "<td>$valor</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
   
    
    $result->close(); // libera recursos de la consulta
}
$conex->close(); // cierra conexión
?>