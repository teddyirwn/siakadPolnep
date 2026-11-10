<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <div class="header">
        <h2>Laporan Data Mata Kuliah SIAKAD</h2>
        <p>Politeknik Negeri Pontianak</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Mata Kuliah</th>
                <th>Nama Mata Kuliah</th>
                <th>SKS</th>
                
            </tr>
           
        </thead>
        <tbody>
            @foreach ($matakuliah as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->kode_mk }}</td>
                    <td>{{ $item->nama_mk }}</td>
                    <td>{{ $item->sks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
