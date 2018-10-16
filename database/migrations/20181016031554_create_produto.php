<?php


use Phinx\Migration\AbstractMigration;

class CreateProduto extends AbstractMigration
{
    public function up()
    {
        $tab = $this->table('produtos');
        $tab->addColumn('nome', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('descricao', 'string', ['limit' => 255])
            ->addColumn('quantidade', 'integer')
            ->addColumn('valor', 'float')
            ->addTimestamps()
            ->save();
    }

    public function down()
    {
        $this->table('produtos')->drop()->save();
    }
}
