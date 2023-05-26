@extends('layouts.app')

@section('content') 
    @if($members)
        <member-edit-component v-bind:members="{{ ($members) }}" :old="{{ json_encode(Session::getOldInput()) }}" :errors= "{{ $errors }}"></member-edit-component>
    @else
        <member-edit-component :old="{{ json_encode(Session::getOldInput()) }}" :errors= "{{ $errors }}"></member-edit-component>
    @endif
@endsection