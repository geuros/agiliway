@extends('layouts.app')

@section('title', 'Home')

@section('content')
	<form action="{{route('home')}}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-3 mb-3">
                <input type="text" class="form-control" id="search" placeholder="Search" name="s_search" value="{{$o_request->get('s_search')}}">
            </div>
            <div class="col-md-3 mb-3">
                <select multiple class="selectpicker d-block w-100" id="category" name="a_category[]">
                    @foreach($a_categories as $o_category)
                        <option @if(in_array($o_category->i_id, $a_selected_categories)) selected @endif value="{{$o_category->i_id}}">{{$o_category->s_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <select multiple class="selectpicker d-block w-100" id="tag" name="a_tag[]">
                    @foreach($a_tags as $o_tag)
                        <option @if(in_array($o_tag->i_id, $a_selected_tags)) selected @endif value="{{$o_tag->i_id}}">{{$o_tag->s_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
    @foreach($a_articles as $o_article)
        <div class="col-md-12">
            <h2>{{$o_article->s_title}}</h2>
            <p>{{$o_article->s_text}}</p>
            <div><strong>Category:</strong> {{$o_article->s_name}}</div>
            <div><strong>Tags:</strong> {{$o_article->a_tags}}</div>
            <hr>
        </div>
    @endforeach
@endsection
