<?php


use Phinx\Seed\AbstractSeed;

class ProdutoSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [];
        for($i=0 ; $i < 15; $i++) {
            $data[$i] = [
                'nome' => 'Produto '.($i+1),
                'descricao' => 'Produto de teste '.($i+1),
                'quantidade' => rand(0,15),
                'valor' => rand(0.1, 1000)
            ];
        }

        $produtos = $this->table('produtos');
        $produtos->insert($data)->save();
    }
}
