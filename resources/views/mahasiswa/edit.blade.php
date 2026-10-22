@extends('layouts.app')
@section('title', 'Edit Mahasiswa')
@section('content')
    <h3>Edit Mahasiswa</h3>
    <form action="{{ route('mahasiswa.update', $mahasiswa) }}" method="POST">
        @csrf
        @method('PUT')
        @include('mahasiswa._form')
    </form>
@endsection
