<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer("user_id")->unsigned();
            $table->integer("category_id")->unsigned();
            $table->string("sku");
            $table->string("name");
            $table->text("description");
            $table->float("price",8,2);
            $table->float("sale",8,2);
            $table->string("image");
            $table->integer("rate")->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
        DB::table('products')->insert(
            array(
                'user_id' => 0,
                'category_id' => 0,
                'sku' => 'empty',
                'name' => 'Default product',
                'description' => 'default',
                'price' => 15,
                'sale' => 3,
                'image' => " ",
                'rate' => 0
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
