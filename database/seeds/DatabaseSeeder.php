<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        for ( $i = 1; $i <= 5; $i++ ) {
            DB::table( 'agway_article' )->insert( [
                's_title' => 'Article ' . $i,
                's_text' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque doloribus facere maxime quisquam. Aliquam
    consectetur eum facilis iusto labore nesciunt quaerat quo vel voluptas. Aut dignissimos excepturi tempora? Pariatur,
    praesentium!'
            ] );

            DB::table( 'agway_category' )->insert( [
                's_name' => 'Category ' . $i
            ] );

            DB::table( 'agway_tag' )->insert( [
                's_name' => 'Tag ' . $i
            ] );

            DB::table( 'agway_article_category' )->insert( [
                'i_article_id' => $i,
                'i_category_id' => rand( 1, 5 ),
            ] );

            $a_used_rand = [];
            for ( $j = 1; $j <= 3; $j++ ) {
                do {
                    $i_rand = rand( 1, 5 );
                } while ( in_array( $i_rand, $a_used_rand ) );

                DB::table( 'agway_article_tag' )->insert( [
                    'i_article_id' => $i,
                    'i_tag_id' => $i_rand,
                ] );

                $a_used_rand[] = $i_rand;
            }
        }
    }
}
