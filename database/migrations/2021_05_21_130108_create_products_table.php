<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->bigInteger('company_id');
            $table->string('name');
            $table->string('tag');
            $table->longText('tag_description');
            $table->string('terms_condition');
            $table->bigInteger('created_by')->comment('UserId');
            $table->softDeletes();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
        $product = [
            ['company_id' => 1,'name' => 'Everyday Rewards','tag' => 'Basic Plan Information','created_by' => 2],
            ['company_id' => 1,'name' => 'Reamped Advance','tag' => 'Basic Plan Information','created_by' => 2],
            ['company_id' => 1,'name' => 'Everyday Rewards','tag' => 'Basic Plan Information','created_by' => 2],
            ['company_id' => 2,'name' => 'Everyday Rewards','tag' => 'Basic Plan Information','created_by' => 2],
            ['company_id' => 2,'name' => 'Reamped Advance','tag' => 'Basic Plan Information','created_by' => 2],
            ['company_id' => 2,'name' => 'Everyday Rewards','tag' => 'Basic Plan Information','created_by' => 2],
            ['company_id' => 3,'name' => 'Everyday Rewards','tag' => 'Basic Plan Information','created_by' => 2],
            ['company_id' => 3,'name' => 'Reamped Advance','tag' => 'Basic Plan Information','created_by' => 2],
        ];
        DB::table('products')->insert($product);
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
