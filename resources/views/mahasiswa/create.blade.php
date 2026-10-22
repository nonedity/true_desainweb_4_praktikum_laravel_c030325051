@extends('layouts.app')
@section('title', 'Tambah Mahasiswa')
@section('content')
    <h3>Tambah Mahasiswa</h3>
    <form action="{{ route('mahasiswa.store') }}" method="POST">
        @csrf
        @include('mahasiswa._form', ['mahasiswa' => new \App\Models\Mahasiswa()])
    </form>
@endsection
