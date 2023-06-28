@extends('layouts.navBarHead')

<!DOCTYPE html>
<html>
<head>
    <title>Home | DreamCar</title>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js">
    </script>
    <script src=
"https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js">
    </script>
</head>
<body>
    <center>
        <h1 class="text-success">DreamCar</h1>
        <div id="myCarousel" class="carousel slide"
                data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel"
                    data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel"
                    data-slide-to="1"></li>
                <li data-target="#myCarousel"
                    data-slide-to="2"></li>
            </ol>
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="{{ asset('/images/dreamcar1.png') }}">
                </div>
                <div class="item">
                <img src="{{ asset('/images/dreamcar2.png') }}">
                </div>
                <div class="item">
                <img src="{{ asset('/images/dreamcar3.png') }}">
                </div>
            </div>
            <!-- Left and right controls -->
            <a class="left carousel-control"
                    href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control"
                    href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </center>
</body>
</html>