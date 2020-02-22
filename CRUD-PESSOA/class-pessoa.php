<?php
Class Pessoa{
    private $pdo;
    //terá 6 funções
    //conexão com o BD orientado a obj, passaremos como parametro para o construtor
    public function __construct($dbname,$host,$user,$senha)
    {
        try{
            $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$senha);
        }catch(PDOException $e){
            echo "Erro com banco de dados:".$e->getMessage();
            exit();
        }catch(Exception $e){
            echo "Erro generico:" . $e->getMessage();
            exit();
        }

    }
    //metodo que vai buscar todos os dados do BD e mostrar no lado direito da tela
    public function buscarDados(){
        $res=array();
        $cmd = $this->pdo ->query("SELECT * FROM pessoa ORDER BY nome"); // utilizamos a query por não precisarmos susbtituir valores, estamos agindo diretamente como se fosse no BD
        $res = $cmd ->fetchAll(PDO::FETCH_ASSOC);
        return $res;
    }
    //metodo para cadastrar pessoas ao banco de dados e mostrar no lado direito da tela, caso feito com sucesso
    public function cadastrarPessoa($nome,$telefone,$email){
        //antes de cadastrar é preciso verificar se já existe no BD
        $cmd = $this ->pdo->prepare("SELECT id FROM pessoa WHERE email=:email");
        $cmd->bindValue(":email",$email); //substituindo o que tem no bd pelo que ta em $email
        $cmd->execute();

        if($cmd ->rowCount() > 0) { // o email já existe no BD
            return false;
        } else{ //email nao existe no BD e então irá cadastrar a partir do codigo abaixo.
            $cmd = $this ->pdo->prepare("INSERT INTO pessoa(nome,telefone,email)VALUES(:nome,:tel,:email)");
            $cmd->bindValue(":nome",$nome);
            $cmd->bindValue(":tel",$telefone);
            $cmd->bindValue(":email",$email);
            $cmd->execute();
            return true;
        }
    }
}
?>