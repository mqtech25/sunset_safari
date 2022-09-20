@extends('site.app')
@section('title', $page->page_meta_title)
@section('meta_description',  $page->page_meta_description)
@section('meta_keyword',  $page->page_meta_keyword )
@section('content')

<div class="container px-0">
    <div class="row">
        <div class="col jumbotron mb-0 py-2">
            <h1 class="">{!! $page->page_title !!}</h1>
            <p>{!! $page->page_subtitle !!}</p>
        </div>
    </div>
    <div class="row">
        <div class="">
            {!! $page->page_content !!}
        </div>
    </div>
</div>

@endsection