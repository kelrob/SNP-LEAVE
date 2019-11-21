<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Leave</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{ url('fonts/material-icon/css/material-design-iconic-font.min.css') }}">


    <!-- Main css -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css') }}" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="{{ url('https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css') }}" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp crossorigin="anonymous">


</head>
<body>

<div class="main">

    @yield('main-content')

</div>

<!-- JS -->
<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="{{ url('js/main.js') }}"></script>
<script src="{{ url('//code.jquery.com/jquery-1.10.2.js') }}"></script>
<script src="{{ url('//code.jquery.com/ui/1.11.2/jquery-ui.js') }}"></script>

</body>
</html>