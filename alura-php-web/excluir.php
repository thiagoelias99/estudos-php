<?php
require_once 'src/connection-db.php';
require_once 'src/model/Produto.php';
require_once 'src/repository/ProdutoRepositorio.php';

$produtoRepositorio = new ProdutoRepositorio($pdo);
$produtoRepositorio->deletarProduto($_POST['id']);

header('Location: admin.php');