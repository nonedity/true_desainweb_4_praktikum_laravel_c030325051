@extends('layouts.app')
@section('title', 'Perbandingan Query Log')
@section('content')
    <h3 class="mb-3">10 Mahasiswa + Relasi Nilai: Perbandingan Query</h3>
    <div class="row">
        @foreach ([['Tanpa with() (N+1)', $logLazy], ['Dengan with(\'nilai\')', $logEager]] as [$judul, $log])
            <div class="col-md-6">
                <h5>{{ $judul }}: <strong>{{ count($log) }} query</strong></h5>
                <ul class="list-group small mb-4">
                    @foreach ($log as $item)
                        <li class="list-group-item">
                            <code>{{ $item['query'] }}</code><br>
                            <span class="text-muted">bindings: {{ json_encode($item['bindings']) }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
@endsection
