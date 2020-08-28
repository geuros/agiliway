<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleStructure extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'agway_article', function ( Blueprint $table ) {
            $table->id( 'i_id' );
            $table->string( 's_title' )->index();
            $table->text( 's_text' );
        } );

        Schema::create( 'agway_category', function ( Blueprint $table ) {
            $table->id( 'i_id' );
            $table->string( 's_name' );
        } );

        Schema::create( 'agway_tag', function ( Blueprint $table ) {
            $table->id( 'i_id' );
            $table->string( 's_name' );
        } );

        Schema::create( 'agway_article_category', function ( Blueprint $table ) {
            $table->id( 'i_id' );
            $table->integer( 'i_article_id' )->index();
            $table->integer( 'i_category_id' )->index();
        } );

        Schema::create( 'agway_article_tag', function ( Blueprint $table ) {
            $table->id( 'i_id' );
            $table->integer( 'i_article_id' )->index();
            $table->integer( 'i_tag_id' )->index();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'agway_article' );

        Schema::dropIfExists( 'agway_category' );

        Schema::dropIfExists( 'agway_tag' );

        Schema::dropIfExists( 'agway_article_category' );

        Schema::dropIfExists( 'agway_article_tag' );
    }
}
