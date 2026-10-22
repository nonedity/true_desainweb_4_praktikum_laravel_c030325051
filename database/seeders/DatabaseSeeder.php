<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $now = now();

        $prodi = ['Teknik Informatika', 'Sistem Informasi', 'Manajemen Informatika'];
        $semester = [1, 3, 5, 4, 2, 6, 7, 8, 3, 4, 5, 6];
        $nama = [
            'Ahmad Fauzi',
            'Budi Santoso',
            'Citra Lestari',
            'Dewi Anggraini',
            'Eko Prasetyo',
            'Fitri Handayani',
            'Gilang Ramadhan',
            'Hana Pertiwi',
            'Indra Wijaya',
            'Joko Susilo',
            'Kartika Sari',
            'Lukman Hakim',
        ];

        $mahasiswa = [];
        foreach ($nama as $i => $n) {
            $no = $i + 1;
            $mahasiswa[] = [
                'nim' => sprintf('2024010%03d', $no),
                'nama' => $n,
                'email' => $no % 4 === 0 ? null : strtolower(str_replace(' ', '.', $n)) . '@example.com',
                'prodi' => $prodi[$i % 3],
                'semester' => $semester[$i],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        DB::table('mahasiswas')->insert($mahasiswa);

        $mk = [
            ['IF101', 'Pemrograman Web', 3, 3],
            ['IF102', 'Basis Data', 3, 3],
            ['IF103', 'Algoritma dan Pemrograman', 4, 1],
            ['IF104', 'Jaringan Komputer', 3, 4],
            ['IF105', 'Struktur Data', 3, 2],
            ['IF106', 'Rekayasa Perangkat Lunak', 3, 5],
        ];
        DB::table('matakuliahs')->insert(array_map(fn($r) => [
            'kode_mk' => $r[0],
            'nama_mk' => $r[1],
            'sks' => $r[2],
            'semester' => $r[3],
            'created_at' => $now,
            'updated_at' => $now,
        ], $mk));

        $nilai = [];
        for ($m = 1; $m <= 12; $m++) {
            foreach ([0, 1, 2] as $k) {
                $nilai[] = [
                    'mahasiswa_id' => $m,
                    'matakuliah_id' => (($m + $k * 2) % 6) + 1,
                    'nilai' => 60 + (($m * 7 + $k * 13) % 40),
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            }
        }
        DB::table('nilai_matakuliahs')->insert($nilai);
    }
}
