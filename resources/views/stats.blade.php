<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stats</title>

    <table>
        <thead>
            <tr>
                <th style='width: 40%'>URL</th>
                <th style='width: 30%'>IP</th>
                <th style='width: 30%'>Visitas</th>
            </tr>
        </thead>
        <tbody>
        @foreach($visits as $row)
            <tr>
                <td>{{ $row->url }}</td>
                <td>{{ $row->ip }}</td>
                <td>{{ $row->count }}</td>
            </tr>
        @endforeach
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</head>
<body>

</body>
</html>
