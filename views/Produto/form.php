<form id="form_produto" method="POST">
    <div class="form-group">
        <label for="nome">Nome do Produto</label>
        <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do produto" value="<?=$nome;?>" required>
    </div>
    <div class="form-group">
        <label for="descricao">Descrição do Produto</label>
        <input type="text" class="form-control" name="descricao" id="descricao" placeholder="Digite uma descrição para o produto" value="<?=$descricao;?>">
    </div>
    <div class="form-group">
        <label for="quantidade">Quantidade disponível</label>
        <input type="text" class="form-control" name="quantidade" id="quantidade" placeholder="Digite a quantidade disponível em estoque" value="<?=$quantidade;?>" required>
    </div>
    <div class="form-group">
        <label for="valor">Preço do Produto</label>
        <input type="text" class="form-control" name="valor" id="valor" placeholder="Digite o valor do produto" value="<?=$valor;?>">
    </div>
    <input type="hidden" name="id" id="id" value="<?=$id?>">
  <button type="submit" class="btn btn-primary">Salvar</button>
</form>