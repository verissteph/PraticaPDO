<?php
try {
    $pdo = new PDO("mysql:dbname=CRUDPDO;host:127.0.0.1", "root", "");
} catch (PDOException $e) {
    echo "Erro com o banco de dados:" . $e->getMessage();
} catch (PDOException $e) {
    echo "Erro generico:" . $e->getMessage();
}
