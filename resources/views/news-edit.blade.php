@extends('layouts.app')

@section('content')
    @if($news)
        <news-edit-component v-bind:news="{{ ($news) }}" :old="{{ json_encode(Session::getOldInput()) }}" :errors= "{{ $errors }}"></news-edit-component>
    @else
        <news-edit-component :old="{{ json_encode(Session::getOldInput()) }}" :errors= "{{ $errors }}"></news-edit-component>
    @endif
@endsection