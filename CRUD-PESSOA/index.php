<?php
//Aqui iremos embutir o php com html e css
//primeiro chamamos com require_onde o arquivo onde criamos a função
require_once 'class-pessoa.php';
//segundo vamos instanciar a class Pessoa por meio da criação de uma nova variável
$p = new Pessoa("crudpdo", "localhost", "root", "");
//terceiro vamos acessar o metodo que criamos, abrindo o php lá abaixo da section direito
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo.css">
    <title>Cadastro Pessoa</title>
</head>

<body>
    <div class="sessoes">
        <section id="esquerdo">
            <?php
            //colher todas as infos que foram colocadas nos inputs (caixinhas)
                if(isset($_POST['nome'])){ //se existir algo no campo nome
                    $nome = addslashes($_POST['nome']); // addslasches serve para manter a info mais segura, ela introduz caract especiais 
                    $telefone = addslashes($_POST['telefone']);
                    $email = addslashes($_POST['email']);
                 //evitar erros antes de enviar para ser cadastrada
                    if(!empty($nome) && !empty($telefone) && !empty($email)){ //se todos os campos estiverem preenchidos
                        //verificando se existe o cadastro e cadastrando 
                        if(!$p->cadastrarPessoa($nome,$telefone,$email)){ //se o retorno da função for FALSE, nós saberemos que já existe o email cadastrado
                            echo "Email ja cadastrado";
                        } else {
                        echo "Preencha todos os campos!";
                        }
                        }
                    }
                
            ?>
            <form action="" method="post">
                <h2>Cadastrar Pessoa</h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone">
                <label for="email">Email</label>
                <input type="email" name="email" id="email">
                <input type="submit" value="Cadastrar">
            </form>
        </section>
        <section id="direito">
            <table>
                <tr id="titulo">
                    <td>NOME</td>
                    <td>TELEFONE</td>
                    <td colspan="2">E-MAIL</td>
                </tr>
                <?php
                $dados = $p->buscarDados(); //atribuindo o array de dados a uma variavel. Array de array.
                //var_dump($dados); estava verificando como a variavel $dados estava se comportava, pois estava dando erro, nada era preenchido. O erro é que estava usando prepare ao inves de query na function buscarDados.
                $tamanho_dados = count($dados); //criando variavel para contar o tamanho do array de dados
                if ($tamanho_dados > 0) { //se o array não estiver vazio,ou seja, tem pessoas no BD
                    for ($i = 0; $i < $tamanho_dados; $i++) { //executa o for para repetir o primeiro array que é a posição de cada pessoa
                        echo "<tr>"; //abre antes do foreach por que o for vai criar linha na posição 0 e mostrar todos os dados da pessoa dessa posição e assim por diante até a ultima pessoa (lembre que o foreach vai dar loop nos dados de cada pessoa)
                        foreach ($dados[$i] as $k => $v) { //executa o foreach para repetir as info do segundo array que tem os dados de cada pessoa
                            if ($k != "id") { // a coluna id nao aparece na nossa tabela, logo só irá rodar caso a coluna em questão não seja a coluna que contem o id
                                echo "<td>" . $v . "</td>"; //vai exibir as informações de nome,telefone e email 
                            }
                        }
                        ?>
                        <td>
                            <a href="">Editar</a><a href="">Excluir</a>
                        </td>
                        <?php
                        echo "</tr>";
                        //faz o td dentro do FOR porque precisa repetir os botoes a cada linha repetida 
                    }
                } else{ //senao se o array está vazio
                    echo "Ainda não há pessoas cadastradas";
                }
                ?>
            </table>
        </section>
    </div>
</body>

</html>