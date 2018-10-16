<div class="row">
    <div class="col-md-6">
        <div class="home-block">
            <span>Produtos com 3 ou menos volumes no estoque</span>
            <table id="produtos" class="table table-sm table-hover">
                <thead>
                    <th>#</th> 
                    <th>Nome</th> 
                    <th>Quantidade</th>
                    <th>Preço</th>
                </thead>
                <tbody>
                    <?php
                    if (count($rows_last_three)) {
                        foreach ($rows_last_three as $key => $row) {
                    ?>
                    <tr>
                        <td><?php echo $row->id;?></td>
                        <td><?php echo $row->nome;?></td>
                        <td><?php echo $row->quantidade;?></td>
                        <td><?php echo number_format($row->valor, 2, ',', '.');?></td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="4" class='td_centered'>Não existem produtos cadastrados</td>
                    </tr>
                    <?php    
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="home-block">
            <span>5 últimos produtos movimentados em estoque</span>
            <table id="produtos" class="table table-sm table-hover">
                <thead>
                    <th>#</th> 
                    <th>Nome</th> 
                    <th>Quantidade</th>
                    <th>Preço</th>
                </thead>
                <tbody>
                    <?php
                    if (count($rows_last_updated)) {
                        foreach ($rows_last_updated as $key => $row) {
                    ?>
                    <tr>
                        <td><?php echo $row->id;?></td>
                        <td><?php echo $row->nome;?></td>
                        <td><?php echo $row->quantidade;?></td>
                        <td><?php echo number_format($row->valor, 2, ',', '.');?></td>
                    </tr>
                    <?php
                        }
                    } else {
                    ?>
                    <tr>
                        <td colspan="4" class='td_centered'>Não existem produtos cadastrados</td>
                    </tr>
                    <?php    
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
