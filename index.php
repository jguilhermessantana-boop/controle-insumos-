<?php
require "conexao.php";

$busca = $_GET['busca'] ?? '';

$sql = "SELECT i.*, c.nome AS categoria
        FROM insumo i
        JOIN categoria c ON c.id = i.id_categoria
        WHERE i.nome LIKE :busca
        ORDER BY i.nome";

$stmt = $pdo->prepare($sql);
$stmt->execute([':busca' => "%$busca%"]);
$insumos = $stmt->fetchAll();

include "topo.php";
?>

<h2>Insumos cadastrados</h2>

<?php if (isset($_GET['msg'])): ?>
    <div class="msg">Operação realizada com sucesso!</div>
<?php endif; ?>

<form method="get">
    <input type="text" name="busca"
        placeholder="Buscar por nome..."
        value="<?= htmlspecialchars($busca) ?>">
    <button type="submit">Buscar</button>
</form>

<br>

<table>
    <tr>
        <th>Nome</th>
        <th>Categoria</th>
        <th>Qtd.</th>
        <th>Preço (R$)</th>
        <th>Ações</th>
    </tr>

    <?php foreach ($insumos as $i): ?>
        <tr>
            <td><?= htmlspecialchars($i['nome']) ?></td>
            <td><?= htmlspecialchars($i['categoria']) ?></td>
            <td><?= $i['quantidade'] . ' ' . htmlspecialchars($i['unidade']) ?></td>
            <td><?= number_format($i['preco'], 2, ',', '.') ?></td>
            <td>
                <a href="form.php?id=<?= $i['id'] ?>">Editar</a>

                <form method="post" action="excluir.php"
                    style="display:inline"
                    onsubmit="return confirm('Excluir este insumo?');">
                    <input type="hidden" name="id" value="<?= $i['id'] ?>">
                    <button type="submit">Excluir</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include "rodape.php"; ?>