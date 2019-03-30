<!DOCTYPE html>
<html style="height:100%;">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('/css/vendor/file-manager.css') }}">
</head>
<body style="height:100%;">
<div id="fm"></div>
<script src="{{ asset('/js/vendor/file-manager.js') }}"></script>
</body>
</html>