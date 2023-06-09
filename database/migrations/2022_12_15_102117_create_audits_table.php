<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection(config('audit.drivers.database.connection', config('database.default')))->create('audits', function (Blueprint $table) {
        
            $morphPrefix = Config::get('audit.user.morph_prefix', 'user');
            
            $table->bigIncrements('id');
            $table->string($morphPrefix . '_type')->nullable();
            $table->text($morphPrefix . '_id')->nullable();
//            $table->uuid('auditable_id');
//            $table->string('auditable_type');
            $table->index([
                'auditable_id',
                'auditable_type',
            ]);

            $table->string('event');
            $table->morphs('auditable');
            $table->text('old_values')->nullable();
            $table->text('new_values')->nullable();
            $table->text('url')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent', 1023)->nullable();
            $table->string('tags')->nullable();
            $table->timestamps();

//            $table->index([$morphPrefix . '_id', $morphPrefix . '_type']);
        });

        Schema::table('audits', function ($table){
            $table->uuid('auditable_id')->change();

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection(config('audit.drivers.database.connection', config('database.default')))->drop('audits');
    }
}
