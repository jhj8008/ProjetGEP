@extends('layouts.admin')

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#nbr_choix').on('change', function(){
            //alert("The current value: " + $(this).val());
            $('#liste_choix').empty();
            var num_choices = $(this).val();
            var element = "";
            for(var x = 0 ; x<num_choices ; x++){
                var n = x+1;
                element += "<div class='col-md-8'><input id='choix" + n + "' placeholder='Choix n° " + n + "' type='text' value='{{ old('c" + n + "') }}' class='form-control' name='choix" + n + "' required><br></div>";
            }
            $('#liste_choix').append(element);
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter un sondage') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employés.ajouter_sondage') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="desc" class="col-md-4 col-form-label text-md-right">{{ __('Description / Question') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" required>

                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('date') is-invalid @enderror" type="date" name="date">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="heure" class="col-md-4 col-form-label text-md-right">{{ __('Heure') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('heure') is-invalid @enderror" type="time" name="heure">
                                @error('heure')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nbr_choix" class="col-md-4 col-form-label text-md-right">{{ __('Nombre de choix') }}</label>

                            <div class="col-md-6">
                                <input id="nbr_choix" type="number" min="2" placeholder="Minimum 2"  class="form-control" name="nbr_choix" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="choix" class="col-md-4 col-form-label text-md-right">{{ __('Vos Choix') }}</label>

                            <div class="col-md-8 justify-content-center" id="liste_choix">
                                
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter') }}
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
