<?php
try{
    $pdo = new PDO("mysql:dbname=crudpdo;host:localhost","root"," ");

} catch(PDOException $e){
    echo "Erro com o banco de dados:". $e ->getMessage();
} catch (PDOException $e) {
    echo "Erro generico:". $e ->getMessage();
}
?>