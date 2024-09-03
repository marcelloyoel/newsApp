<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    {{-- <meta name="csrf-token" content="IitqznmVlvlDyFmyaGAua6zebYyPzPBd99kbYLSh"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }}</title>

    <!-- Custom fonts for this template-->
    <link href="/template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="/template/css/sb-admin-2.css" rel="stylesheet">
    <link href="/css/sidebarNew.css" rel="stylesheet">
    <!-- Include CSS styles for DataTables -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.css">
    {{-- openai --}}
    {{-- <link rel="stylesheet" href="/vendor/snapappointments/bootstrap-select/dist/css/bootstrap-select.min.css"> --}}
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css">
    <script>
        // Set Bootstrap version manually
        $.fn.selectpicker.Constructor.BootstrapVersion = '4.5.2';
    </script>
</head>

@yield('body')
<!-- Bootstrap core JavaScript-->
<script src="/template/vendor/jquery/jquery.min.js"></script>
<script src="/template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/template/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/template/js/sb-admin-2.min.js"></script>

{{-- custom javascript
<script src="/js/profile.js"></script> --}}

</body>

</html>
