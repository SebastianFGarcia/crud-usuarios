<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <style>
        * {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        
        h1 {
            text-align: center;
            margin: 20px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #ccc;
        }
        table thead tr th {
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #ccc;
        }
        table tbody tr td {
            border: 1px solid #ccc;
            border-right: none;
            border-left: none;
            padding: 10px;
            text-align: center
        }
        

    </style>
</head>
<body>
    <div class="container">
        <h1>Reporte de usuarios por país</h1>
        <table>
            <thead>
                <tr>
                    <th>País</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($usersByCountry as $userByCountry )
                    <tr>
                        <td>{{ $userByCountry->country }}</td>
                        <td>{{ $userByCountry->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>