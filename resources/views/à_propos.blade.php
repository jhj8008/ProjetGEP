@extends('layouts.app')

@section('page_title')
{{ __('À propos') }}
@endsection

@section('styles')
<style>
    .text{
        font-family: 'Raleway', sans-serif;
    }
    .titre > i{
        font-size: 30px;
    }
    .titre{
        font-family: 'Poppins', sans-serif;
        font-weight: bold;
    }
    .content-text{
        margin-bottom: 2cm;
    }
    .gras{
        font-weight: bold;
    }

    #last-part{
        margin-left: 10px;
    }

    .sous-titre > i{
        font-size: 22px;
    }

    .sous-paragraph{
        margin-top: -15px;
        margin-left: 20px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <!-- site originale: https://ecolebranchee.com/a-propos/ -->
    <div class="row col-md-12">
        <h1 class="titre"><i class="fa fa-info-circle fa-4x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;À propos</h1>
        <div class="justify-content-center">
            <div class="content-text">
                <p class="text">
                    L’éducation améliore la vie de chaque être humain. Elle influence positivement santé, bonheur et engagement citoyen, favorisant la prospérité des sociétés. 
                    Elle doit donc bénéficier des avancées actuelles pour répondre aux besoins de plus en plus diversifiés des apprenants. Tout en rappelant que les défis de 
                    l’enseignement à l’ère du numérique sont d’abord humains, c’est en ce sens que l’École branchée œuvre à informer, former et outiller le milieu scolaire et son écosystème.
                </p>
                <p class="text">
                    C’est la référence incontournable pour tous les acteurs du milieu scolaire (enseignants, conseillers pédagogiques, directions d’établissement et autres professionnels) 
                    soucieux de maximiser l’impact positif de l’innovation dans l’enseignement et l’apprentissage.
                </p>
                <p class="text">
                    <i class="fa fa-hand-o-right" aria-hidden="true"></i>
                    &nbsp;&nbsp;Nos activités sont de trois ordres : <span class="gras">Information</span> | <span class="gras">Formation</span> | <span class="gras">Développement d’outils pédagogiques</span>
                </p>

                <p class="text">
                    <i class="fa fa-bullseye" aria-hidden="true"></i>
                    &nbsp;&nbsp;Elles s’orientent autour de 3 axes :  <span class="gras">Développement professionnel</span> | <span class="gras">Compétence numérique</span> | <span class="gras">Éducation aux médias</span>
                </p>
            </div>
        </div>

        <h1 class="titre"><i class="fa fa-heart-o fa-4x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Notre mission</h1>
        <div class="justify-content-center">
            <div class="content-text">
                <p class="text">
                    L'École branchée est un OSBL dont les activités contribuent, depuis 1996, à l’avancement de l’éducation en l'aidant à relever les défis de l’ère du numérique pour 
                    favoriser la réussite des élèves en tirant profit des outils et approches pédagogiques actuels.
                </p>
                <p class="text">
                    Il existe de nombreuses façons de travailler avec nous afin de soutenir notre grande mission tout en bénéficiant de notre réseau.
                </p>
            </div>
        </div>

        <h1 class="titre"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Notre vision</h1>
        <div class="justify-content-center">
            <div class="content-text">
                    <ul class="list-unstyled">
                        <li>Développer et entretenir un réseau de communication permettant aux initiatives de tout l’écosystème éducatif de se rencontrer afin de :
                            <ul>
                                <li>Favoriser le développement et l’appropriation des pratiques pédagogiques et éducatives actuelles;</li>
                                <li>Valoriser l’éducation, l’école et son personnel auprès des familles, de la communauté et du grand public.</li>
                            </ul>
                        </li>
                    </ul>
            </div>
        </div>

        <h1 class="titre"><i class="fa fa-users fa-4x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Notre impact</h1>
        <div class="justify-content-center">
            <div class="content-text">
                <p class="text">
                    Seulement au Québec, ils sont environ 100 000 enseignants à préparer près d’un million d’élèves pour le futur. 
                    Notre équipe croit fermement qu’accompagner un enseignant entraîne des retombées sur des dizaines d’élèves chaque année pendant toute sa carrière. 
                    Imaginons qu’on puisse le faire avec des milliers... Voilà une promesse d’impact des plus stimulantes, surtout que les actions de l’École branchée 
                    inspirent aussi au-delà des frontières en rayonnant sur toute la francophonie!
                </p>
            </div>
        </div>

        <h1 class="titre"><i class="fa fa-hashtag fa-4x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Notre valeur</h1>
        <div class="justify-content-center" id="last-part">
            <div class="content-text">
                <h3 class="sous-titre"><i class="fa fa-paper-plane-o" aria-hidden="true"></i>&nbsp;&nbsp;Le leadership</h3>
                <p class="text sous-paragraph">
                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>&nbsp;&nbsp;
                    Celui qui permet de croire en son plein potentiel humain, celui qui pousse à s’entreprendre en cohérence avec ses valeurs, à sortir des sentiers 
                    battus et à oser se réaliser.
                </p>

                <h3 class="sous-titre"><i class="fa fa-puzzle-piece" aria-hidden="true"></i>&nbsp;&nbsp;La créativité</h3>
                <p class="text sous-paragraph">
                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>&nbsp;&nbsp;
                    Celle qui permet de penser, de rêver, d’arrêter le temps pour goûter à cette idée qui, à première vue, semble farfelue, et que pourtant rien ni 
                    personne ne peut arrêter. 
                </p>
                        
                <h3 class="sous-titre"><i class="fa fa-spinner" aria-hidden="true"></i>&nbsp;&nbsp;L'innovation</h3>
                <p class="text sous-paragraph">
                    <i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i>&nbsp;&nbsp;
                    Celle qui pousse à essayer, à se tromper, à s’ajuster, à recommencer, mais à toujours avancer; à faire ces premiers pas, uniques et au bon moment.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
