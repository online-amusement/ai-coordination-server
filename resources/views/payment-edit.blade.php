@extends('layouts.app')

@section('content')
    @if($payments)
        <payment-edit-component v-bind:payments="{{ ($payments) }}" :old="{{ json_encode(Session::getOldInput()) }}" :errors= "{{ $errors }}"></payment-edit-component>
    @else
        <payment-edit-component :old="{{ json_encode(Session::getOldInput()) }}" :errors= "{{ $errors }}"></payment-edit-component>
    @endif
@endsection