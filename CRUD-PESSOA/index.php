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
            <form action="">
                <h2>Cadastrar Pessoa</h2>
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome">
                <label for="telefone">Telefone</label>
                <input type="text" name="telefone" id="telefone">
                <label for="email">Email</label>
                <input type="text" name="email" id="email">
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
                <tr>
                    <td>Maria</td>
                    <td>0000000</td>
                    <td>maria@gmail.com</td>
                    <td>
                        <a href="#">Editar</a>
                        <a href="#">Excluir</a>
                    </td>
                </tr>
            </table>
        </section>
</div>
</body>

</html>