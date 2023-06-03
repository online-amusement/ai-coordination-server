@extends('layouts.app')

@section('content')
        <summary-show-component v-bind:summary="{{ ($summary) }}" :date="{{ ($date) }}"></summary-show-component>
@endsection