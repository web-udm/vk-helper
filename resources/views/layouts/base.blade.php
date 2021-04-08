<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../../css/bootstrap.min.css"/>
    <link rel="stylesheet" href="../../css/style.css"/>
    <link rel="stylesheet" href="../../css/smash.css"/>
    <title>@yield('title')</title>
</head>
<body>

<header class="main-header">

    <section class="navbar-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg">
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarTwo">
                            <ul class="navbar-nav m-auto">
                                <li class="nav-item active"><a class="page-scroll" href="/">Посты</a></li>
                                <li class="nav-item"><a class="page-scroll" href="/liker">Лайкер</a></li>
                            </ul>
                        </div>
                    </nav> <!-- navbar -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>
</header>

@yield('content')

<footer class="main-footer"></footer>

<script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
