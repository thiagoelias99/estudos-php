<?php

class ProdutoRepositorio
{
  public function __construct(private PDO $pdo)
  {
  }

  public function opcoesCafe(): array
  {
    $sql = "SELECT * FROM produtos WHERE tipo = 'Café' ORDER BY preco";
    $statement = $this->pdo->query($sql);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return array_map(function ($product) {
      return new Produto(
        $product['id'],
        $product['tipo'],
        $product['nome'],
        $product['descricao'],
        $product['preco'],
        $product['imagem']
      );
    }, $result);
  }

  public function opcoesAlmoco(): array
  {
    $sql = "SELECT * FROM produtos WHERE tipo = 'Almoço' ORDER BY preco";
    $statement = $this->pdo->query($sql);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return array_map(function ($product) {
      return new Produto(
        $product['id'],
        $product['tipo'],
        $product['nome'],
        $product['descricao'],
        $product['preco'],
        $product['imagem']
      );
    }, $result);
  }

  function buscarTodos(): array
  {
    $sql = "SELECT * FROM produtos ORDER BY tipo, preco";
    $statement = $this->pdo->query($sql);
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

    return array_map(function ($product) {
      return new Produto(
        $product['id'],
        $product['tipo'],
        $product['nome'],
        $product['descricao'],
        $product['preco'],
        $product['imagem']
      );
    }, $result);
  }

  function deletarProduto(int $id): void
  {
    $sql = "DELETE FROM produtos WHERE id = ?";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
  }

  function cadastrarProduto(Produto $produto): void
  {
    $sql = "INSERT INTO produtos (tipo, nome, descricao, preco, imagem) VALUES (?, ?, ?, ?, ?)";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $produto->getTipo(), PDO::PARAM_STR);
    $statement->bindValue(2, $produto->getNome(), PDO::PARAM_STR);
    $statement->bindValue(3, $produto->getDescricao(), PDO::PARAM_STR);
    $statement->bindValue(4, $produto->getPreco(), PDO::PARAM_STR);
    $statement->bindValue(5, $produto->getImagem(), PDO::PARAM_STR);
    $statement->execute();
  }

  function buscarPorId(int $id): Produto
  {
    $sql = "SELECT * FROM produtos WHERE id = ?";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $id, PDO::PARAM_INT);
    $statement->execute();
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    return new Produto(
      $result['id'],
      $result['tipo'],
      $result['nome'],
      $result['descricao'],
      $result['preco'],
      $result['imagem']
    );
  }

  function atualizarProduto(Produto $produto): void
  {
    $sql = "UPDATE produtos SET tipo = ?, nome = ?, descricao = ?, preco = ?, imagem = ? WHERE id = ?";
    $statement = $this->pdo->prepare($sql);
    $statement->bindValue(1, $produto->getTipo(), PDO::PARAM_STR);
    $statement->bindValue(2, $produto->getNome(), PDO::PARAM_STR);
    $statement->bindValue(3, $produto->getDescricao(), PDO::PARAM_STR);
    $statement->bindValue(4, $produto->getPreco(), PDO::PARAM_STR);
    $statement->bindValue(5, $produto->getImagem(), PDO::PARAM_STR);
    $statement->bindValue(6, $produto->getId(), PDO::PARAM_INT);
    $statement->execute();
  }
}