@extends('layouts.app')

@section('content')
    <summary-component v-bind:summaries="{{ ($summaries) }}"></summary-component>
@endsection