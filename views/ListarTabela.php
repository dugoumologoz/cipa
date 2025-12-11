<?php
require_once __DIR__ . "/../repositories/UsuarioDAO.php";
$dao = new UsuarioDAO();
$usuarios = $dao->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="">
<div class=" ">
    <h1>Lista de Usuários</h1>
    <a href="CriarTabela.php" class="">+ Novo Usuário</a>

    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nome Completo</th>
                <th>E-mail</th>
                <th>Nascimento</th>
                <th>Contratação</th>
                <th>Matrícula</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $u): ?>
            <tr>
                <td><?= htmlspecialchars($u['nome_usuario'] . ' ' . $u['sobrenome_usuario']) ?></td>
                <td><?= htmlspecialchars($u['email_usuario'] ?? '-') ?></td>
                <td><?= date('d/m/Y', strtotime($u['data_nascimento_usuario'])) ?></td>
                <td><?= date('d/m/Y', strtotime($u['data_contratacao_usuario'])) ?></td>
                <td><?= htmlspecialchars($u['matricula_usuario']) ?></td>
                <td><?= htmlspecialchars($u['telefone_usuario'] ?? '-') ?></td>
                <td>
                    <form method="POST" action="EditarTabela.php" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $u['id_usuario'] ?>">
                        <button type="submit" class="btn btn-primary btn-sm">Editar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php

    ?>
</div>
</body>
</html>