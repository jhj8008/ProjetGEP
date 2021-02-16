<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>GEP</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito|Monoton|Raleway|Quicksand:200,600|Poppins|Lato|Rosario|Marvel" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <link rel="stylesheet" href="{{ URL::asset('css/new_style.css') }}" />
        <!-- Styles -->
        <link rel="icon" href="{{ URL::asset('imgs/school.png') }}" type="image/x-icon"/>
        <style>
            html, body {
                scroll-behavior: smooth;
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                /*height: 100vh;*/
                margin: 0;
            }

               /* width */
            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                background: #f1f1f1; 
            }
            
            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #888; 
                border-radius:5px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555; 
            }

            .full-height {
                /*height: 100vh;*/
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                /*position: relative;*/
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                /*text-align: center;*/
            }

            .title {
                font-family: 'Monoton', sans-serif;
                /*text-align: center;*/
                /*font-size: 84px;*/
                margin-top: 14%;
                margin-bottom: 9%;
            }

            .links{
                text-align: center;
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
                display: grid;
                place-items: center;
                flex: 1;
                flex-shrink: 0;
                bottom: 0;
                left: 0;
                right: 0;
                width: 100%;
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

            .soustitre{
                font-family: 'Poppins';
                font-weight: bold;
                font-size: 30px;
            }

            .subsoustitre {
                font-family: 'Lato';
                font-weight: bold;
            }

            .text-area {
                margin-bottom: 80px;
            }

            .direct{
                font-weight: bold;
            }

            .my_link{
                color: #636b6f;
                transition: all .5s;
            }

            .my_link:hover {
                color: red;
                transition: all .5s;
            }

            .mot-directeur {
                font-family: 'Marvel';/*'Rosario';*/
                font-size: 17px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if(Auth::guard('employe')->check() or Auth::check())
                        <a class="my_link" href="{{ url('/home') }}">Home</a>
                    @else
                        <a  class="my_link"href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a class="my_link" href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md" title="Gestion d'une école primaire">
                    <section class="p7">
                        <a href="#">
                            GEP
                        </a>
                    </section>
                </div>
                <div class="links">
                    <a class="my_link" href="{{ route('parents.forum') }}">Forum</a>
                    <a class="my_link" href="{{ route('parents.espace_élève') }}">Espace élève</a>
                    <a class="my_link" href="{{ route('clients.actualités') }}">Actualités</a>
                    <a class="my_link" href="{{ route('parents.absences_retards') }}">Absences & Retards</a>
                    <a class="my_link" href="{{ route('parents.notes') }}">Notes</a>
                    <a class="my_link" href="{{ route('clients.activités') }}">Activités</a>
                    <a class="my_link" href="{{ route('employés.espace_employe') }}">Espace employé</a>
                    <a class="my_link" href="{{ route('clients.à_propos') }}">À propos</a>
                    <a class="my_link" href="{{ route('clients.contact') }}">Contact</a>
                </div>
                <div class="d-flex justify-content-center" style="width:70%;margin-top:5%;margin-left:13%;margin-right:10%">
                    <h3 class="display-4">Mot du directeur</h3>
                    <blockquote class="blockquote text-center">
                        <p class="mb-0 mot-directeur">
                        Depuis plus de 40ans d’existence, le Groupe Scolaire GEP, poursuit sa mission d’éducation en formant des élèves de la maternelle au baccalauréat selon 
                        les programmes et méthodes du ministère de l’éducation nationale combinés aux meilleurs manuels et outils de la mission française. Ainsi, les élèves sont 
                        préparés au préalable aux exigences des grandes écoles à l’échelle internationale.
                        Le GEP se donne comme objectif d’apporter à chaque élève les outils de sa réussite scolaire, et de former des individus responsables et autonomes. Il a pour 
                        ambition de développer l’ouverture de ses élèves sur le monde et de les accompagner dans leur développement culturel et sportif, et ce, à tous les niveaux de 
                        leur scolarité.
                        Depuis 1972, le Groupe Scolaire GEP a fourni des générations d’élèves « fiers d’être de GEP ». Être élève de GEP, c’est faire partie d’une communauté scolaire 
                        dont on partage les valeurs de respect, de solidarité, d’ouverture, de responsabilité, de goût de l’effort et du travail bien fait.
                        Un engagement réciproque fondé sur la confiance entre le Groupe et les familles, basé en priorité sur l’épanouissement personnel et la réussite scolaire de nos élèves.</p>
                        <br>
                        <footer class="blockquote-footer">Directeur de GEP <cite title="Source Title" class="direct">TAZI MOHAMMED</cite></footer>
                    </blockquote>
                </div>
                <div class="d-flex justify-content-right text-area" style="width:70%;margin-top:5%;margin-left:13%;margin-right:10%">
                    <h3 class="display-4 soustitre">Les objectifs de la formation à l'école élémentaire</h3>
                    <div class="text-sm-left">
                        <p>La formation dispensée dans les écoles élémentaires assure l'acquisition des fondamentaux : lire, écrire, compter, respecter autrui.</p><p>De plus,</p>
                        <ul>
                            <li>elle suscite le développement de l'intelligence, de la sensibilité artistique, des aptitudes manuelles, physiques et sportives ;</li>
                            <li>elle dispense les éléments d'une culture historique, géographique, scientifique et technique ;</li>
                            <li>elle offre une éducation aux arts visuels et aux arts musicaux ;</li>
                            <li>elle assure l'enseignement d'une langue vivante étrangère et peut comporter une initiation à la diversité linguistique ;</li>
                            <li>elle contribue également à la compréhension et à un usage autonome et responsable des médias, notamment numériques ;</li>
                            <li>elle assure l'acquisition et la compréhension de l'exigence du respect de la personne, de ses origines et de ses différences ;</li>
                            <li>elle transmet également l'exigence du respect des droits de l'enfant et de l'égalité entre les femmes et les hommes.</li>
                        </ul>
                        <p class="mb-0">
                        Elle assure conjointement avec la famille l'enseignement moral et civique qui comprend, pour permettre l'exercice de la citoyenneté, l'acquisitions, le partage 
                        des valeurs et symboles de la monarchie, notamment de l'hymne national et de son histoire.
                        </p>
                    </div>

                    <h3 class="display-4 soustitre">Des dispositifs au service de la réussite des élèves</h3>
                    <div class="text-sm-left">
                        <p class="mb-0">Priorité est donnée à l'école primaire qui permet de construire les apprentissages fondamentaux.</p>
                        <p class="mb-0">
                            L'objectif premier est de rendre l'école plus juste et plus efficace, de réduire les inégalités en apportant une aide renforcée aux populations scolaires les plus fragiles.
                        </p>
                        
                        <h4 class="display-3 subsoustitre">
                        100% de réussite en CP : garantir pour chaque élève, l'acquisition des savoirs fondamentaux
                        </h4>
                        <p class="mb-0">
                        L'objectif d'une maîtrise par tous les élèves des savoirs fondamentaux à la fin de l'école primaire est la condition d'une scolarité réussie et de la formation 
                        d'un citoyen libre et responsable. Il est accessible en donnant la priorité à la maîtrise de la lecture et de l'écriture, 
                        des mathématiques, à la base de tous les apprentissages, par un enseignement rigoureux, explicite et progressif dès le cours préparatoire.
                        </p>

                        <h4 class="display-3 subsoustitre">
                        Le dédoublement des classes de CP et de CE1
                        </h4>
                        <p class="mb-0">
                        Pour combattre la difficulté scolaire dès les premières années des apprentissages fondamentaux et soutenir les élèves les plus fragiles, les classes de CP des REP+ sont dédoublées 
                        depuis la rentrée 2017. Les classes de CP en REP et de CE1 en REP+ le sont aussi depuis la rentrée 2018. L'objectif global dans lequel s'inscrit cette mesure est  d'assurer l'acquisition 
                        des savoirs fondamentaux par un encadrement plus favorable des élèves et la mise en œuvre d'une pédagogie fondée sur les acquis de la recherche.
                        </p>

                        <h4 class="display-3 subsoustitre">
                        Les évaluations en CP et CE1
                        </h4>
                        <p class="mb-0">
                        La maîtrise des savoirs fondamentaux par tous les élèves de l'école primaire est une priorité absolue. Dès le mois de septembre 2018, pour aider les professeurs à faire progresser leurs 
                        élèves, tous les enfants scolarisés en CP, CE1 et 6e bénéficient d'évaluations. Celles-ci fournissent aux professeurs des points de repère efficaces pour identifier les difficultés des 
                        élèves dès le début de l'année, les aider à les surmonter et les accompagner vers la réussite. Pour chaque compétence testée, les professeurs disposent de ressources pédagogiques pour 
                        répondre aux difficultés rencontrées par leurs élèves.
                        </p>

                        <h4 class="display-3 subsoustitre">
                        Activités pédagogiques complémentaires
                        </h4>
                        <p class="mb-0">
                        Les activités pédagogiques complémentaires (APC) proposées aux élèves de l'école maternelle et l'école élémentaire, avec l'accord des responsables légaux, en sus des vingt-quatre 
                        heures hebdomadaires d'enseignement, sont pleinement investies pour soutenir les apprentissages fondamentaux des élèves, notamment les plus fragiles, et assurer la maîtrise de la langue 
                        française par tous.
                        </p>
                        <p class="mb-0">
                        Ainsi, l'heure hebdomadaire que les enseignants consacrent aux APC est spécifiquement dédiée à des activités de maîtrise du langage et de la lecture.
                        </p>
                    </div>
                    <h3 class="display-4 soustitre">Les cycles d'enseignement</h3>
                    <div class="text-center">
                        <p class="mb-0">L'organisation par cycles d'enseignement permet de prendre en compte la progressivité des apprentissages et les besoins des élèves pour les accompagner dans l'acquisition des compétences</p>
                        <p class="mb-0">L'école maternelle constitue un cycle à part entière. Le cycle associant les deux dernières classes de l'école élémentaire et la classe de sixième vise à favoriser une meilleure continuité 
                        pédagogique entre l'école et le collège.</p>
                        <ul>
                            <li>le <strong>cycle 2</strong>, cycle des apprentissages fondamentaux, correspond aux trois premières années de l'école élémentaire appelées respectivement : cours préparatoire, cours élémentaire 
                            première année et cours élémentaire deuxième année ;</li>
                            <li>le <strong>cycle 3</strong>, cycle de consolidation, correspond aux deux années de l'école élémentaire suivant le cycle des apprentissages fondamentaux et à la première année du collège appelées respectivement : 
                            cours moyen première année, cours moyen deuxième année  et classe de sixième</li>
                        </ul>
                        <p class="mb-0">
                        Elle assure conjointement avec la famille l'enseignement moral et civique qui comprend, pour permettre l'exercice de la citoyenneté, l'acquisitions, le partage 
                        des valeurs et symboles de la monarchie, notamment de l'hymne national et de son histoire.
                        </p>
                    </div>
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
