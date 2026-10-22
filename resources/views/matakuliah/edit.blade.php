@extends('layouts.app')
@section('title', 'Edit Mata Kuliah')
@section('content')
    <h3>Edit Mata Kuliah</h3>
    <form action="{{ route('matakuliah.update', $matakuliah) }}" method="POST">
        @csrf
        @method('PUT')
        @include('matakuliah._form')
    </form>
@endsection
