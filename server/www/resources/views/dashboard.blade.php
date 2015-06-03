<html>
<head>
    <title>API route list</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }
        .content {
            width: 900px;
            margin: 0 auto;
        }
        .center {
            text-align: center;
        }
        table {
            border: 1px solid #ddd;
            border-collapse: collapse;
            border-spacing: 0;
            margin: 0 0 1.5em;
            vertical-align: middle;
            width: 100%;
            font-family: inherit;
            font-size: 100%;
            font-style: inherit;
            font-weight: inherit;
            padding: 0;
            color: #222;
            line-height: 1.6;
        }
        tbody, tfoot, thead, tr {
            border: 0 none;
            font-family: inherit;
            font-size: 100%;
            font-style: inherit;
            font-weight: inherit;
            margin: 0;
            padding: 0;
            vertical-align: baseline;
        }
        table thead th, table th {
            border: 1px solid #4d90fe;
        }
        table th, table td {
            padding: 6px 10px;
        }
        tr th {
            background-color: #6199df;
            color: #fff;
        }
        th {
            font-weight: bold;
        }
        th, td, caption {
            float: none !important;
            font-weight: normal;
            text-align: left;
            vertical-align: middle;
        }
        table td {
            border: 1px solid #ddd;
            vertical-align: top;
            color: #696969;
            font
        }
        table code {
            color: #007000;
        }
        table code.blue {
            color: #4285f4;
        }
        h3:after {
            background: none repeat scroll 0 0 #ddd;
            border: 0 none;
            content: "";
            display: block;
            height: 1px;
            margin: 6px 0 0;
            overflow: auto;
        }
    </style>
</head>
<body>
<div class="content">
    @foreach($routesData as $route)
        <h3 class="center">{{$route->action}}</h3>
        <table width="100%">
            <thead>
            <tr>
                <th>Method</th>
                <th>Url</th>
                <th>Description</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><code>{{$route->method}}</code></td>
                <td><code>{{$route->url}}</code></td>
                <td>{{$route->docComment}}</td>
            </tr>
            </tbody>
        </table>

        @if($route->verificationRules)
            <table width="100%">
                <thead>
                <tr>
                    <th>Method parameters</th>
                    <th>Validation rules</th>
                </tr>
                </thead>
                <tbody>
                @foreach($route->verificationRules as $property => $rules)
                    <tr>
                        <td><code>{{$property}}</code></td>
                        <td><code class="blue">{{$rules}}</code></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    @endforeach
</div>
</body>
</html>