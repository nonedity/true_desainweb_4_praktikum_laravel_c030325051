@extends('layouts.app')
@section('title', 'Tambah Mata Kuliah')
@section('content')
    <h3>Tambah Mata Kuliah</h3>
    <form action="{{ route('matakuliah.store') }}" method="POST">
        @csrf
        @include('matakuliah._form', ['matakuliah' => new \App\Models\Matakuliah()])
    </form>
@endsection
