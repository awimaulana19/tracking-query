<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('assets/style.css') }}">
</head>

<body>
    <div class="top-header py-2 d-none d-md-block border-bottom d-print-none">
        <div class="container">
            <div class="d-flex">
                <div class="small text-dark me-auto"><i
                        class="bi bi-envelope-fill me-2 text-success"></i>admin@digitaldesa.id</div>
                <div class="small text-dark text-end">
                    <i class="bi bi-calendar-check me-2 text-success"></i>
                    <span id="date"></span>
                    <i class="bi bi-clock ms-5 me-2 text-success"></i>Pukul : <span id="clock"></span>
                </div>
            </div>
        </div>

        <script>
            function updateTime() {
                const date = new Date();
                const day = date.toLocaleString('id-ID', {
                    weekday: 'long',
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                });
                const time = date.toLocaleString('id-ID', {
                    hour: 'numeric',
                    minute: 'numeric',
                    second: 'numeric'
                });
                document.getElementById("date").innerHTML = day;
                document.getElementById("clock").innerHTML = time;
            }

            updateTime();
            setInterval(updateTime, 1000);
        </script>

    </div>
    <main id="content" role="main" class="my-3 my-lg-4 pb-5 pb-lg-0">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="h2">Kode Wilayah<br><span class="h3 text-uppercase fw-normal">by</span><span
                        class="h3 text-capitalize fw-normal"> <a href="/" style="text-decoration: none"
                            class="text-success">DIGIDES</a></span></h1>
                <div>
                    <a href="/sesibaru" class="btn btn-success btn-sm me-2"><span>Download SQL Dan Buka Sesi
                            Baru</span></a>
                    <a href="/wilayah" class="btn btn-success btn-sm">
                        Tambah Wilayah
                    </a>
                </div>
            </div>
            @if (session('error'))
                <p class="alert alert-danger">{{ session('error') }}</p>
            @endif
            <div class="row mb-5">
                @yield('content')
            </div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
