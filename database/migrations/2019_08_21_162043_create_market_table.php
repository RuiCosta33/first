<?php

use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name',100);
            $table->text('descricao');
            $table->decimal('preco');
            $table->timestamps();
        });
        $this->createProd();
    }
    public function createProd(){
        User::create([
            'name' => 'Nome',
            'descricao' => 'Descricao',
            'preco' => '4.20'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('market');
    }
}
