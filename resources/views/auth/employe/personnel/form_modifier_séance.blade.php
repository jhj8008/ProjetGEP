@extends('layouts.admin')

@section('page_title')
 {{ __('Modifier une séance') }}
@endsection

@section('scripts')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script>

$(document).ready(function(){
    var v = @json($séance);
    var employe_id = v['employe_id'];
    //alert(employe_id);
    fetchMatières(employe_id);
    $("#employe").on('change', function(){
        var val = $(this).val();    
        if(val != "..."){
            $('#matières').empty();
            fetchMatières(val);
            //alert(val);
        }
    });
    /*$("#matières").on('change', function(){
        var val = $(this).val();    
        if(val != "..."){
            //fetchMatières(val);
            alert(val);
        }else {
            alert("You may want to choose an option pls!!!");
        }
    });*/
});

function fetchMatières(employe_id){
    //alert(employe_id);
    $.ajax({
        url: "{{ route('personnels.get_matières') }}",
        type: 'POST',
        dataType: 'json',
        data: {
            employe_id: employe_id,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response) {
                //alert('success'); //testing purposes
                var len = response.length;
                var s = @json($séance);
                //alert(s['matière_id']);
                for(var i = 0 ; i<len ; i++){
                    if(response[i]['id'] == s['matière_id']){
                        $('#matières').append("<option value='"  + response[i]['id'] + "' selected>" + response[i]['nom'] + "</option>")
                    }else {
                        $('#matières').append("<option value='"  + response[i]['id'] + "'>" + response[i]['nom'] + "</option>")
                    }
                }
            } else {
                alert('fail'); //testing purposes
            }
        },
        error:function(e){
            alert("something wrong! " + e); // this will alert an error
        }
    });
}
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier une séance') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('personnels.modifier_séance', ['edt_id' => $emploi_id, 'jour' => $jour, 'id' => $séance->id]) }}">
                        @csrf
                        <input type="hidden" value="{{ $jour }}" name="old_jour">
                        <input type="hidden" value="{{ $emploi_id }}" name="emploi_id">
                        <div class="form-group row">
                            <label for="jour" class="col-md-4 col-form-label text-md-right">{{ __('Jour') }}</label>

                            <div class="col-md-6">
                                <select id="jour" name="jour" class="form-control @error('jour') is-invalid @enderror">
                                    <option>...</option>
                                    <option value="Lundi" @if($séance->jour == 'Lundi') selected @endif>Lundi</option>
                                    <option value="Mardi" @if($séance->jour == 'Mardi') selected @endif>Mardi</option>
                                    <option value="Mercredi" @if($séance->jour == 'Mercredi') selected @endif>Mercredi</option>
                                    <option value="Jeudi" @if($séance->jour == 'Jeudi') selected @endif>Jeudi</option>
                                    <option value="Vendredi" @if($séance->jour == 'Vendredi') selected @endif>Vendredi</option>
                                </select>
                                @error('jour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="heure_début" class="col-md-4 col-form-label text-md-right">{{ __('Début') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('heure_début') is-invalid @enderror" type="time" name="heure_début" value="{{ $séance->heure_début }}">
                                @error('heure_début')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="heure_fin" class="col-md-4 col-form-label text-md-right">{{ __('Fin') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('heure_fin') is-invalid @enderror" type="time" name="heure_fin" value="{{ $séance->heure_fin }}">
                                @error('heure_fin')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" value="{{ $séance->description }}" name="description" required>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="employe_id" class="col-md-4 col-form-label text-md-right">{{ __('Enseignant') }}</label>
                            <div class="col-md-6">
                                <select id="employe" name="employe_id" class="form-control @error('employe_id') is-invalid @enderror">
                                    <option>...</option>
                                    @foreach($employes as $emp)
                                        <option value="{{ $emp->id }}" @if($emp->id == $séance->employe_id) selected @endif>{{ $emp->nom }} {{ $emp->prénom }}</option>
                                    @endforeach
                                </select>
                                @error('employe_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="matière_id" class="col-md-4 col-form-label text-md-right">{{ __('Matière') }}</label>
                            <div class="col-md-6">
                                <select id="matières" name="matière_id" class="form-control @error('matière_id') is-invalid @enderror">
                                </select>
                                @error('matière_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier') }}
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
