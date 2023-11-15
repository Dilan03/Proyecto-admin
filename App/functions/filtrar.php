<?php
$filatrados = 0;
if (isset($_POST["filtrar"])) {

    $consulta_filtrada = "
    SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre, u.nombre as ubi,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
    FROM posts p
    INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
    INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
    INNER JOIN ubicacion u ON detalles.id_ubicacion = u.id WHERE
    ";

    $filatrados = 0;
    $condiciones = array();

    if(isset($_POST["Ropa"])) {
        $filatrados++;
        $Ropa = " clas.nombre = '".$_POST["Ropa"]."' ";
        array_push($condiciones, $Ropa);

    }

    if(isset($_POST["Electronicos"])) {
        $filatrados++;
        $Electronicos = " clas.nombre = '".$_POST["Electronicos"]."' ";
        array_push($condiciones, $Electronicos);
    } 

    if(isset($_POST["Otros"])) {
        $filatrados++;
        $Otros = " clas.nombre = '".$_POST["Otros"]."' ";
        array_push($condiciones, $Otros);
    }

    if(isset($_POST["F"])) {
        $filatrados++;
        $EdF = " u.nombre = '".$_POST["F"]."' ";
        array_push($condiciones, $EdF);
    } 

    if(isset($_POST["G"])) {
        $filatrados++;
        $EdG = " u.nombre = '".$_POST["G"]."' ";
        array_push($condiciones, $EdG);
    } 

    if(isset($_POST["D"])) {
        $filatrados++;
        $EdD = " u.nombre = '".$_POST["D"]."' ";
        array_push($condiciones, $EdD);
    } 

    if(isset($_POST["P"])) {
        $filatrados++;
        $EdP = " u.nombre = '".$_POST["P"]."' ";
        array_push($condiciones, $EdP);
    } 

    if(isset($_POST["E"])) {
        $filatrados++;
        $EdE = " u.nombre = '".$_POST["E"]."' ";
        array_push($condiciones, $EdE);
    } 

    if(isset($_POST["B"])) {
        $filatrados++;
        $EdB = " u.nombre = '".$_POST["B"]."' ";
        array_push($condiciones, $EdB);
    } 

    if(isset($_POST["C"])) {
        $filatrados++;
        $EdC = " u.nombre = '".$_POST["C"]."' ";
        array_push($condiciones, $EdC);
    } 

    if(isset($_POST["M"])) {
        $filatrados++;
        $EdM = " u.nombre = '".$_POST["M"]."' ";
        array_push($condiciones, $EdM);
    } 

    if(isset($_POST["T"])) {
        $filatrados++;
        $EdT = " u.nombre = '".$_POST["T"]."' ";
        array_push($condiciones, $EdT);
    } 

    if(isset($_POST["R"])) {
        $filatrados++;
        $EdR = " u.nombre = '".$_POST["R"]."' ";
        array_push($condiciones, $EdR);
    } 

    if(isset($_POST["Gimnasio"])) {
        $filatrados++;
        $EdGimnasio = " u.nombre = '".$_POST["Gimnasio"]."' ";
        array_push($condiciones, $EdGimnasio);
    } 

    if(isset($_POST["LabMetodos"])) {
        $filatrados++;
        $EdLabMetodos = " u.nombre = '".$_POST["LabMetodos"]."' ";
        array_push($condiciones, $EdLabMetodos);
    }

    if(isset($_POST["LabComputo"])) {
        $filatrados++;
        $EdLabComputo = " u.nombre = '".$_POST["LabComputo"]."' ";
        array_push($condiciones, $EdLabComputo);
    }

    if(isset($_POST["Cafeteria"])) {
        $filatrados++;
        $EdCafeteria = " u.nombre = '".$_POST["Cafeteria"]."' ";
        array_push($condiciones, $EdCafeteria);
    }

    if(isset($_POST["Explanada"])) {
        $filatrados++;
        $EdExplanada = " u.nombre = '".$_POST["Explanada"]."' ";
        array_push($condiciones, $EdExplanada);
    }

    if(isset($_POST["EdAdmin"])) {
        $filatrados++;
        $EdEdAdmin = " u.nombre = '".$_POST["EdAdmin"]."' ";
        array_push($condiciones, $EdEdAdmin);
    }

    if(isset($_POST["Biblioteca"])) {
        $filatrados++;
        $EdBiblioteca = " u.nombre = '".$_POST["Biblioteca"]."' ";
        array_push($condiciones, $EdBiblioteca);
    }

    $condicionesLenght = sizeof($condiciones);
    
    if($condicionesLenght > 1 ) {
        for ($i=0; $i < $condicionesLenght; $i++) {  
            if($i == $condicionesLenght-1) {
                $consulta_filtrada .= $condiciones[$i];
            } else {
                $consulta_filtrada .= $condiciones[$i]." OR";
            }
        }
    } elseif($condicionesLenght == 1 ) {
        $consulta_filtrada .= $condiciones[0];
    }

    $consulta_filtrada .= "ORDER BY detalles.fecha_publicacion;";
}

if($filatrados > 0) {
    $consulta_posts = $consulta_filtrada;

} else {
    $consulta_posts = "
    SELECT p.id, p.imagen, detalles.nombre_objeto, detalles.fecha_publicacion, clas.nombre, u.nombre as ubi,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'ancient' AND etiquetas.id_post = p.id) as ancient,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'lost' AND etiquetas.id_post = p.id) as lost,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'found' AND etiquetas.id_post = p.id) as found,
    (SELECT nombre FROM etiquetas WHERE etiquetas.nombre = 'gathered' AND etiquetas.id_post = p.id) as gathered
    FROM posts p
    INNER JOIN detallesposts detalles ON p.id_detallesPosts = detalles.id
    INNER JOIN clasificacion clas ON detalles.id_clasificacion = clas.id
    INNER JOIN ubicacion u ON detalles.id_ubicacion = u.id
    ORDER BY detalles.fecha_publicacion desc;
    ";
}

$result_posts = mysqli_query($conn, $consulta_posts);