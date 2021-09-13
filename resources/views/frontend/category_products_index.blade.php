@extends('layouts.frontend')

@section('title', ucfirst($category->name))

@section('content')

@livewire('frontend.product-index', ['selectedCategory' => $category, 'selectedProductType' => $productTypeId,], key($categoryName))

@endsection