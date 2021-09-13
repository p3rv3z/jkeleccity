@extends('layouts.frontend')

@section('title', 'Search')

@section('content')

@livewire('frontend.product-search', ['search' => $search,])

@endsection