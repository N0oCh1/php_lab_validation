<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = test_input($_POST['userName']);
    $email = test_input($_POST["email"]);
    $number = test_input($_POST["cel"]);
    
    
    $nameErr = "";
    $emailErr = "";
    $numberErr="";

    
    if (!preg_match("/^[a-zA-Z]*$/",$name)) {
        $nameErr = "Solo letras sin digitos";
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "El formato esta incorrecto";
    }

    if (!preg_match("/\d{3}\-\d{3}\-\d{4}/", $number)) {
        $numberErr = "formato incorrecto del telefono";
    }
    // ... Additional validation checks ...

if ($nameErr !== "" || $emailErr !== "" || $numberErr!=="") {
    echo json_encode([
        "error" => [
            "nameErr" => $nameErr,
            "emailErr" => $emailErr,
            "numberErr" => $numberErr
        ]
    ]);
    exit;
     } 
     else 
     {
    // Proc ess the form data
    echo json_encode([
        "message" => "Formulario enviado"
    ]);
    exit;
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>