<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GEP</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito|Monoton|Raleway|Quicksand:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Styles -->
        <style>
            html, body {
                scroll-behavior: smooth;
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-family: 'Monoton', sans-serif;
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            #footerText{
                margin-top: 20px;
                font-family: 'Raleway', sans-serif;
                font-size: 14px;
                font-weight: bold;
            }

            .my_footer{
                text-align: center;
                background-color: #EEEEEE;
                padding-bottom: 5%;
                padding-top: 5%;
                clear: both;
            }

            .fa {
                padding: 20px;
                font-size: 15px;
                width: 25px;
                text-align: center;
                text-decoration: none;
                border-radius: 50%;
            }

            .fa:hover {
                opacity: 0.7;
            }

            .links > span{
                font-family: 'Quicksand', sans-serif;
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 400;
                letter-spacing: .1rem;
                text-decoration: none;
            }
            #footerContact{
                margin-top: 30px;
                margin-bottom: 30px;
            }
            #footerContact > span > strong {
                color: #2e2e29;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" title="Gestion d'une école primaire">
                    GEP
                </div>

                <div class="links">
                    <a href="{{ route('forum') }}">Forum</a>
                    <a href="{{ route('espace_élève') }}">Espace élève</a>
                    <a href="{{ route('actualités') }}">Actualités</a>
                    <a href="{{ route('absences_retards') }}">Absences & Retards</a>
                    <a href="{{ route('notes') }}">Notes</a>
                    <a href="{{ route('activités') }}">Activités</a>
                    <a href="{{ route('notifications') }}">Notifications</a>
                    <a href="{{ route('espace_personnel') }}">Espace personnel</a>
                    <a href="{{ route('à_propos') }}">À propos</a>
                    <a href="{{ route('contact') }}">Contact</a>
                </div>
                <div class="d-flex justify-content-center" style="width:80%;margin-top:5%;margin-left:10%;margin-right:10%">
                    <h3 class="display-4">Mot du directeur</h3>
                    <blockquote class="blockquote text-center">
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                        Urna condimentum mattis pellentesque id nibh tortor id aliquet. Euismod in pellentesque massa placerat. 
                        Ante in nibh mauris cursus. Ac turpis egestas maecenas pharetra convallis. Placerat in egestas erat imperdiet sed euismod. 
                        Non curabitur gravida arcu ac tortor dignissim convallis. Nunc vel risus commodo viverra. At tellus at urna condimentum mattis pellentesque id. 
                        Tempor commodo ullamcorper a lacus vestibulum. Nibh tortor id aliquet lectus proin nibh. Tortor at auctor urna nunc id cursus metus aliquam eleifend.</p>
                        <footer class="blockquote-footer">Directeur de GEP <cite title="Source Title">Moustapha Alami</cite></footer>
                    </blockquote>
                </div>
            </div>
        </div>
        <footer class="my_footer">
            <div>
                <div class="links">
                    <a href="#" class="fa fa-facebook"></a>
                    <a href="#" class="fa fa-twitter"></a>
                    <a href="#" class="fa fa-google-plus"></a>
                    <a href="#" class="fa fa-linkedin"></a>
                    <a href="#" class="fa fa-github"></a>
                </div>
                <div id="footerContact" class="links">
                    <span class="contactLinks"><strong>Tel:</strong> &nbsp;&nbsp; +212-06 69 16 13 24</span>
                    <span class="contactLinks"><strong>E-mail:</strong> &nbsp;&nbsp; gep.administration@gmail.com</span>
                    <span class="contactLinks"><strong>Adresse:</strong> &nbsp;&nbsp; Massira 3, B, 559 Marrakech</span>
                </div>
                <div id="footerText" class="container text-center">
                    Copyright &copy; GEP 2020
                </div>
            </div>
        </footer>
    </body>
</html>
