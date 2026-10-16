<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$namaAplikasi}}</title>
</head>
<body>
    <h1>{{$namaAplikasi}}</h1>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr><th align="left">Laravel</th><td>{{$versiLaravel}}</td></tr>
        <tr><th align="left">PHP</th><td>{{$versiPhp}}</td></tr>
        <tr><th align="left">MySQL</th><td>{{$versiMysql}}</td></tr>
        <tr><th align="left">Database</th><td>{{$namaDatabase}}</td></tr>
        <tr><th align="left">Waktu</th><td>{{$waktu}}</td></tr>
        <tr><th align="left">Variable</th><td>{{$variable}}</td></tr>
    </table>
</body>
</html>