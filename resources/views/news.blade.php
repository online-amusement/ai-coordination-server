@extends('layouts.app')

@section('content')
    <news-component v-bind:news="{{ ($news) }}"></news-component>
@endsection