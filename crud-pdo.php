<?php
//-------------------------CONEXÃO----------------------------------
try {
    $pdo = new PDO("mysql:dbname=CRUDPDO;host:localhost", "root", "");
} catch (PDOException $e) {
    echo "Erro com o banco de dados:" . $e->getMessage();
} catch (PDOException $e) {
    echo "Erro generico:" . $e->getMessage();
}
//----------------------INSERT--------------------------------------------
//1º FORMA DE INSERIR
// atribuindo $pdo a uma variavel nova e preparando os campos da tabela como :nome,:tel :email 
//      $res = $pdo->prepare("INSERT INTO pessoa(nome, telefone, email)VALUES (:nome,:tel,:email)");
//subtituindo os valores :nome,:tel e :email :
//      $res->bindValue(":nome", "Carla");
//      $res->bindValue(":tel", "33551133");
//      $res->bindValue(":email", "teste@gmail.com");
// executando a inserção de dados
//      $res->execute();

//2º FORMA DE INSERIR
//Aqui não precisamos preparar e executar,pois a query ja faz tudo diretamente. 
//      $pdo->query("INSERT INTO pessoa(nome, telefone, email)VALUES ('Paulo','00000000','paulo@gmail.com')");

//--------------------------DELETE E UPDATE------------------------------------
//variavel comando vai receber a variavel PDO q está acessando o prepare para deletar da tabela pessoa onde o id está sendo chamado de :id
//      $comando = $pdo ->prepare("DELETE FROM pessoa WHERE id=:id"); 
//atribuimos qual o id que vamos deletar
//      $id = 3;
//agora esta substituindo o id chamado pela variavel id que foi definida como sendo o id 3
//      $comando ->bindValue(":id",$id);
// aqui executamos o comando.
//      $comando->execute();

//variavel comando vai receber a variavel PDO que irá acessar o preparo de atualização do campo email da tabela pessoa a partir do id chamado.
//      $comando = $pdo->prepare("UPDATE pessoa SET email=:email WHERE id=:id");
//      $comando->bindValue(":email", "carla@gmail.com");
//      $comando->bindValue(":id", 1);
//      $comando->execute();

//--------------------------------SELECT----------------------------------------------
//Iremos selecionar um registro da tabela pessoa a partir do ID dela e mostrar na tela
    //$comando = $pdo->prepare("SELECT * FROM pessoa WHERE id =:id");
    //$comando ->bindValue(":id",4);
    //$comando -> execute();
//Trazendo as informações em formato de array associativo, se não colocarmos o ASSOC irá repetir o nome do indice e sua posição, ous eja, a info irá repetir 2x.
    //$resultado = $comando -> fetch(PDO::FETCH_ASSOC);
//print_r servirá apenas como teste, não deve ser usado para visualização do usuário, assim como o var_dump.
    //echo "<pre>";
    //print_r($resultado);
    //echo"</pre>";
//Agora iremos, através de um foreach, exibir para o usuário o registro selecionado
    //foreach( $resultado as $key => $value ){
        //echo $key.": ".$value."<br>";
    //}
    
?>