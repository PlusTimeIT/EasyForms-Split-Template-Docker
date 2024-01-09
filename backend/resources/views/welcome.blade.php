<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel EasyForms</title>
</head>

<body>
    <div style="text-align:center;">
        <div><b>Laravel EasyForms </b> This is an API - Not for human consumption</div>
    </div>
    <div style="text-align:center;">
        <div><b>You are probably looking for: </b> <a href="http://localhost:3454">Frontend</a></div>
    </div>
    <div style="text-align:center;">
        Domains:
        {{ env('SANCTUM_STATEFUL_DOMAINS') }}

    </div>
</body>

</html>