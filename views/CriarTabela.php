<?php
require_once __DIR__ . "/../repositories/UsuarioDAO.php";
require_once __DIR__ . "/../models/Usuario.php";

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = new Usuario(
        $_POST['nome'],
        $_POST['sobrenome'],
        $_POST['senha'],
        $_POST['nascimento'],
        $_POST['contratacao'],
        $_POST['ativo'],
        $_POST['adm'],
        $_POST['matricula'],
        $_POST['cpf'],
        $_POST['telefone'] ?? '',
        $_POST['email'] ?? ''
    );

    $dao = new UsuarioDAO();
    $dao->criarUsuarioDAO($usuario);
    $mensagem = "<div class=''>Usuário criado com sucesso!</div>";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Criar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="botao">
<div class="titulo">
    <h1>Cadastrar Novo Usuário</h1>
    <a href="ListarTabela.php" class="btn btn-secondary mb-3">← Voltar</a>

    <?= $mensagem ?>

    <form method="POST">
        <div class="criar">
            <div class=""><input type="text" name="nome" class="form-control" placeholder="Nome" required></div>
            <div class=""><input type="text" name="sobrenome" class="form-control" placeholder="Sobrenome" required></div>
            <div class=""><input type="email" name="email" class="form-control" placeholder="E-mail"></div>
            <div class=""><input type="password" name="senha" class="form-control" placeholder="Senha" required></div>
            <div class=""><input type="date" name="nascimento" class="form-control" required></div>
            <div class=""><input type="date" name="contratacao" class="form-control" required></div>
            <div class=""><input type="text" name="matricula" class="form-control" placeholder="Matrícula" required></div>
            <div class=""><input type="text" name="cpf" class="form-control" placeholder="CPF" required></div>
            <div class=""><input type="text" name="telefone" class="form-control" placeholder="Telefone"></div>
        </div>

        <div class="criacao3">
            <label><input type="checkbox" name="ativo" checked> Ativo</label> &nbsp;
            <label><input type="checkbox" name="adm"> Administrador</label>
        </div>

        <button type="submit" class="btnlg">Cadastrar Usuário</button>



    </form>
</div>
</body>
<?php
?>


</html>