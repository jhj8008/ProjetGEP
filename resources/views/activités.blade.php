@extends('layouts.app')

@section('scripts')
<script>
    $('.carousel').carousel({
        interval: 2000
    })
</script>
@endsection

@section('styles')
<style>
    .carousel-inner > .carousel-item {
        height: 800px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="title">
            <h1>Activités</h1>
        </div>
    </div>
    <div class="col-md-12">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="{{ asset('imgs/neutral_grey.jpg') }}" alt="First slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Activité 1</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('imgs/neutral_grey.jpg') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Activité 2</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('imgs/neutral_grey.jpg') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Activité 3</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('imgs/neutral_grey.jpg') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Activité 4</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('imgs/neutral_grey.jpg') }}" alt="Second slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Activité 5</h5>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="{{ asset('imgs/neutral_grey.jpg') }}" alt="Third slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Activité 6</h5>
                        <p>
                           But if you have a div navigation header on top (with a certain px height), using 100vh will extend your carousel’s image/photo height past the bottom of the screen/browser.
                           So really, if you want the carousel occupying the whole screen, plus show your navigation header on top, you’ll need to get the screen height minus the navigation header height, 
                           and resulting answer should be the set height for your carousel .item
                        </p>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>
@endsection
