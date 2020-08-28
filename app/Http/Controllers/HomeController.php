<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Tag;

class HomeController extends Controller {
    public function init( Request $request ) {
        $o_article_model = DB::table( 'agway_article' );

        $o_article_model->select( 'agway_article.i_id', 'agway_article.s_title', 'agway_article.s_text', 'agway_category.s_name' );
        $o_article_model->selectRaw( 'GROUP_CONCAT( DISTINCT `agway_tag`.`s_name` ) AS `a_tags`' );

        $o_article_model->leftJoin( 'agway_article_category', 'agway_article.i_id', '=', 'agway_article_category.i_article_id' );
        $o_article_model->leftJoin( 'agway_category', 'agway_article_category.i_category_id', '=', 'agway_category.i_id' );

        $o_article_model->leftJoin( 'agway_article_tag AS search_tags', 'agway_article.i_id', '=', 'search_tags.i_article_id' );
        $o_article_model->leftJoin( 'agway_article_tag', 'agway_article.i_id', '=', 'agway_article_tag.i_article_id' );
        $o_article_model->leftJoin( 'agway_tag', 'agway_article_tag.i_tag_id', '=', 'agway_tag.i_id' );

        $s_search = $request->input( 's_search', '' );
        if ( empty( $s_search ) == false ) {
            $o_article_model->where( 'agway_article.s_title', 'LIKE', '%' . $s_search . '%' );
        }

        $a_filter_categories = $request->get( 'a_category', [] );
        if ( empty( $a_filter_categories ) == false ) {
            $o_article_model->whereIn( 'agway_article_category.i_category_id', $a_filter_categories );
        }

        $a_filter_tags = $request->get( 'a_tag', [] );
        if ( empty( $a_filter_tags ) == false ) {
            $o_article_model->whereIn( 'search_tags.i_tag_id', $a_filter_tags );
        }

        $o_article_model->groupBy( 'agway_article.i_id', 'agway_article.s_title', 'agway_article.s_text', 'agway_category.s_name' );

        $a_articles = $o_article_model->get();

        $o_category_model = new Category;
        $a_categories = $o_category_model->all();

        $o_tag_model = new Tag;
        $a_tags = $o_tag_model->all();

        $a_data = [
            'o_request' => $request,
            'a_articles' => $a_articles,
            'a_categories' => $a_categories,
            'a_selected_categories' => $a_filter_categories,
            'a_tags' => $a_tags,
            'a_selected_tags' => $a_filter_tags
        ];

        return view( 'home', $a_data );
    }
}
