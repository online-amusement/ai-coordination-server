@extends('layouts.app')

@section('content')
    <payment-component v-bind:payments="{{ ($payments) }}"></payment-component>
@endsection