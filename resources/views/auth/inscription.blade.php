@extends('layouts.app')

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    window.addEventListener('load', function(){

        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');
        const clientSecret = cardButton.dataset.secret;

        cardButton.addEventListener('click', async(e) => {
            const { setupIntent, error } = await stripe.handleCardSetup(
                clientSecret, cardElement, {
                    payment_method_data : {
                        billing_details: {name: cardHolderName.value }
                    }
                }
            );

            if(error){
                // afficher des messages d'erreurs
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
                errorElement.className = "alert alert-danger";
                document.getElementById('card-button').disabled = true;
                //window.historyback();
            }else {
                console.log('handling success', setupIntent.payment_method);
                //document.getElementById('payment_method').setAttribute('value',setupIntent.payment_method);
                /*axios.post('espace_élève/inscription', {
                    payment_method: setupIntent.payment_method,
                }).then((res) => console.log('handling',res.data)).catch((err) => console.log('handling',err));*/
            }
        });
    })
</script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {

        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: '1996:2030',
            minDate: new Date(1996, 1 - 1, 1),
        });

        $("select.niveau_scolaire").change(function(){
            var niveau = $(this).children("option:selected").val();
            var montant;
            switch(niveau){
                case "CP1":
                    montant = 500;
                    break;
                case "CP2":
                    montant = 600;
                    break;
                case "CE1":
                    montant = 700;
                    break;
                case "CE2":
                    montant = 800;
                    break;
                case "CM1":
                    montant = 900;
                    break;
                case "CM2":
                    montant = 1000;
                    break;
            }
            $(".montant").prop('value', montant.toString());
        });
    });
</script>
<style>
    .subform-title{
        font-family: 'Quicksand', sans-serif;
        font-weight: bold;
        text-align: center;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h1>Page d'inscription des nouveaux élèves</h1>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Inscription en ligne') }}</div>
                    <div class="card-body">
                            @error('duplicate_error')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        <form method="POST" action="{{ route('inscription') }}" id="payment-form">
                            @csrf
                            <div class="form-group">

                                <div class="subform-title h4">
                                    <label>Informations de l'élève</label>
                                </div>
                            
                                <div class="form-group row">
                                    <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom ') }}</label>

                                    <div class="col-md-6">
                                        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" placeholder="Nom" autofocus>

                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="prénom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                                    <div class="col-md-6">
                                        <input id="prénom" type="text" class="form-control @error('prénom') is-invalid @enderror" name="prénom" value="{{ old('prénom') }}" required placeholder="Prénom" autocomplete="prénom" autofocus>

                                        @error('prénom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sexe" class="col-md-4 col-form-label text-md-right">{{ __('Sexe') }}</label>

                                    <div class="col-md-6">
                                        <!--<input id="sexe" type="text" class="form-control @error('sexe') is-invalid @enderror" name="sexe" value="{{ old('sexe') }}" required placeholder="Sexe" autofocus>-->
                                        <select id="sexe" name="sexe" class="form-control @error('sexe') is-invalid @enderror">
                                            <option>...</option>
                                            <option value="M">Male</option>
                                            <option value="F">Femelle</option>
                                        </select>
                                        @error('fonction_père')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_de_naissance" class="col-md-4 col-form-label text-md-right">{{ __('Date de naissance') }}</label>

                                    <div class="col-md-6">
                                        <input id="date_de_naissance" autocomplete="off" class="datepicker form-control @error('date_de_naissance') is-invalid @enderror" date-date-format="yy-mm-dd" name="date_de_naissance" type="text" required placeholder="Cliquez ici pour choisir la date">
                                        @error('date_de_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="niveau_scolaire" class="col-md-4 col-form-label text-md-right">{{ __('Niveau scolaire') }}</label>

                                    <div class="col-md-6">
                                        <!--<input id="niveau_scolaire" type="text" class="form-control @error('niveau_scolaire') is-invalid @enderror" name="niveau_scolaire" value="{{ old('niveau_scolaire') }}" required autocomplete="tel">-->

                                        <select id="niveau_scolaire" name="niveau_scolaire" class="form-control niveau_scolaire @error('niveau_scolaire') is-invalid @enderror">
                                            <option>Niveau</option>
                                            <option value="CP1">CP1</option>
                                            <option value="CP2">CP2</option>
                                            <option value="CE1">CE1</option>
                                            <option value="CE2">CE2</option>
                                            <option value="CM1">CM1</option>
                                            <option value="CM2">CM2</option>
                                        </select>
                                        @error('niveau_scolaire')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        <div class="form-group">
                            <div class="subform-title h4">
                                <label>Informations du paiement</label>
                            </div>
                            <div class="form-group row"> 
                                <label for="card-holder-name" class="col-md-4 col-form-label text-md-right">{{ __('Porteur de carte crédit') }}</label>
                                <div class="col-md-6">
                                    <input type="text" id="card-holder-name" class="form-control" value="{{ Auth::user()->nom_père }}" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="card_num" class="col-md-4 col-form-label text-md-right">{{ __('Infos de carte') }}</label> 
                                <div class="col-md-6">
                                    <div id="card-element" class="form-control"></div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="montant" class="col-md-4 col-form-label text-md-right">{{ __('Montant (DH)') }}</label> 
                                <div class="col-md-6">
                                    <input id="montant" type="text" class="form-control montant" name="montant" placeholder="Montant en DH" readonly>
                                </div>
                            </div>
                            <div id="card-errors" role="alert"></div>
                            
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" id="card-button" data-secret="{{ $intent->client_secret }}">
                                    {{ __('Valider') }}
                                </button>
                            </div>
                        </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
