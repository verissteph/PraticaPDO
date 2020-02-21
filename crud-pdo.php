<?php
//-------------------------CONEXÃO----------------------------------
try {
    $pdo = new PDO("mysql:dbname=CRUDPDO;host:127.0.0.1", "root", "");
} catch (PDOException $e) {
    echo "Erro com o banco de dados:" . $e->getMessage();
} catch (PDOException $e) {
    echo "Erro generico:" . $e->getMessage();
}
//----------------------INSERT--------------------------------------------
//1º FORMA DE INSERIR
// atribuindo $pdo a uma variavel nova e preparando os campos da tabela como :nome,:tel :email 
$res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email)VALUES (:nome,:tel,:email)");
//subtituindo os valores :nome,:tel e :email :
$res->bindValue(":nome", "Carla");
$res->bindValue(":tel", "33551133");
$res->bindValue(":email", "teste@gmail.com");
// executando a inserção de dados
$res->execute();

//2º FORMA DE INSERIR
//Aqui não precisamos preparar e executar,pois a query ja faz tudo diretamente. 
//$pdo->query("INSERT INTO pessoa(nome, telefone, email)VALUES ('Roberta','22887711','roberta@gmail.com')");
