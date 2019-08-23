<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="IE=edge" http-equiv="X-UA-Compatible">
        <meta content="width=device-width, initial-scale=1" name="viewport">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimal-ui">

        <title>Performative Mapping</title>

        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link href="/css/mapping.css" rel="stylesheet">
@yield('extracss')
    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" id="navbar">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/">Invisible makers</a>
                </div>
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <!-- <li>
                            <a href="/tracks">Tracks Map</a>
                        </li>
                        <li>
                            <a href="/archive">Pictures</a>
                        </li> -->
                        <li>
                            <a href="/uploads">Uploads Map</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        @yield('extramenu')
                        @if (Auth::check())
                        @if (Auth::user()->admin)
                        <li>
                            <a href="/projects">Projects</a>
                        </li>
                        @endif
                        <li class="active">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="btn-link btn btn-block" type="submit">({{{ Auth::user()->name }}}) Logout</button>
                            </form>
                        </li>
                        @else
                        <li class="active">
                            <a href="/login">Login</a>
                        </li>
                        @endif
                    </ul>
                </div><!--/.nav-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
@yield('content')

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
@yield('extrajs')
    </body>
</html>