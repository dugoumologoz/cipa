<?php
require_once __DIR__ . "/../repositories/UsuarioDAO.php";
require_once __DIR__ . "/../models/Usuario.php";
$dao = new UsuarioDAO();
$usuario = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && ($_POST['id'])) {
    $id = $_POST['id'];
    $dados = $dao->getUsuarioPorId($id); 
    if ($dados) $usuario = $dados;
}

if (!$usuario) {
    return("Usuário não encontrado.");
}

if (isset($_POST['salvar'])) {
    $u = new Usuario(
        $_POST['nome'], $_POST['sobrenome'], $_POST['senha'] ?? '',
        $_POST['nascimento'], $_POST['contratacao'],
        isset($_POST['ativo']), isset($_POST['adm']),
        $_POST['matricula'], $_POST['cpf'],
        $_POST['telefone'] ?? '', $_POST['email'] ?? ''
    );
    $u->setIdUsuario($_POST['id']);
    $dao->atualizar($u);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="">
    <h1>Editar Usuário</h1>
    <a href="ListarTabela.php" class="btn btn-secondary mb-3">← Voltar</a>

    <form method="POST">
        <input type="hidden" name="id" value="<?= $usuario['id_usuario'] ?>">

        <div class="">
            <div class=""><input type="text" name="nome" class="form-control" value="<?= $usuario['nome_usuario'] ?>" required></div>
            <div class=""><input type="text" name="sobrenome" class="form-control" value="<?= $usuario['sobrenome_usuario'] ?>" required></div>
            <div class=""><input type="email" name="email" class="form-control" value="<?= $usuario['email_usuario'] ?? '' ?>"></div>
            <div class=""><input type="password" name="senha" class="form-control" placeholder='Nova senha '></div>
            <div class=""><input type="date" name="nascimento" class="form-control" value="<?= $usuario['data_nascimento_usuario'] ?>" required></div>
            <div class=""><input type="date" name="contratacao" class="form-control" value="<?= $usuario['data_contratacao_usuario'] ?>" required></div>
            <div class=""><input type="text" name="matricula" class="form-control" value="<?= $usuario['matricula_usuario'] ?>" required></div>
            <div class=""><input type="text" name="cpf" class="form-control" value="<?= $usuario['cpf_usuario'] ?>" required></div>
            <div class=""><input type="text" name="telefone" class="form-control" value="<?= $usuario['telefone_usuario'] ?? '' ?>"></div>
        </div>

        <div class="mt-3">
            <label><input type="checkbox" name="ativo" <?= $usuario['ativo_usuario'] ? 'checked' : '' ?>> Ativo</label>
            <label><input type="checkbox" name="adm"   <?= $usuario['adm_usuario'] ? 'checked' : '' ?>> Administrador</label>
        </div>

        <button type="submit" name="salvar" class="btn-lg">Salvar Alterações</button>
    </form>
</div>
</body>
</html>