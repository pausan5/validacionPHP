<?php
    if(isset($_POST['submit']))
    {
        $ID = $_POST['ID'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $email = $_POST['email'];

        $servername = "localhost";
        $username = "root";
        $password = ""; 
        $dbname = "practicabbdd2";

        $conn = new mysqli($servername, $username, $password, $dbname);
        
        if($conn->connect_error){
            die("Falló conexión: " . $conn->connect_error);
        }

        if(empty($ID) || empty($nombre) || empty($apellido) || empty($email)){
            header("Location: formulario.html?mensaje=Por%20favor,%20debe%20completar%20todos%20los%20campos");
            exit();
        }  
        elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            header("Location: formulario.html?mensaje=El%20correo%20electrónico%20ingresado%20no%20es%20correcto");
            exit();
        }
        else{
            $sql = "INSERT INTO usuario(ID, nombre, apellido, email)
                    VALUES ('$ID', '$nombre', '$apellido', '$email')";

            if ($conn->query($sql)===TRUE){
                echo "Se ha guardado correctamente la información";
            } else{
                echo "Error:" . $sql . "<br>" . $conn->error;
            }

            echo "<h1>Formulario enviado correctamente</h1>";
            echo "<p>ID: $ID</p>";
            echo "<p>Nombre: $nombre</p>";
            echo "<p>Apellido: $apellido</p>";
            echo "<p>Email: $email</p>";
        }

        $conn->close();
    }
?>

