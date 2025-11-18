<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jawaban Kuis</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Jawaban Kuis - {{ $judulKuis }}</h2>
    <p>Nama: {{ $namaUser }}</p>
    <p>Total Nilai: {{ $totalNilai }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Pertanyaan</th>
                <th>Jawaban Siswa</th>
                <th>Jawaban Benar</th>
                <th>Benar/Salah</th>
                <th>Poin</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($jawabanDetail as $i => $jawaban)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $jawaban['pertanyaan'] }}</td>
                <td>{{ $jawaban['jawaban_siswa'] }}</td>
                <td>{{ $jawaban['jawaban_benar'] }}</td>
                <td>{{ $jawaban['benar'] }}</td>
                <td>{{ $jawaban['point'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
