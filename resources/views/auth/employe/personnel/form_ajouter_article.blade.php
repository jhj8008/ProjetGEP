@extends('layouts.app')

@section('scripts')
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://cdn.tiny.cloud/1/0nru1pz10o1pcl1fezowtmb5qawvlmsxp4odj1nn89xb5go1/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: '#texte',
    menubar: true,
    plugins: 'a11ychecker advcode casechange formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist lists bullist numlist code formatpainter pageembed permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
@endsection

@section('styles')
<style>
    #upload_btn {
        position: relative;
        /*overflow: hidden;*/
    }

    #image {
        position: absolute;
        /*font-size: 50px;*/
        opacity: 0;
        right: 0;
        top: 0;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="title">
            <h1>Nouveau article</h1>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ajouter un nouveau article') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('personnels.créer_article') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type d\'article ') }}</label>

                            <div class="col-md-12 col-lg-8">
                                <!--<input id="sexe" type="text" class="form-control @error('sexe') is-invalid @enderror" name="sexe" value="{{ old('sexe') }}" required placeholder="Sexe" autofocus>-->
                                <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option>...</option>
                                    <option value="actualité">Actualité</option>
                                    <option value="activité">Activité</option>
                                </select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="titre" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

                            <div class="col-md-12 col-lg-8">
                                <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre') }}" required autofocus>

                                @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="objet" class="col-md-4 col-form-label text-md-right">{{ __('Objet') }}</label>

                            <div class="col-md-12 col-lg-8">
                                <input id="objet" type="text" class="form-control @error('objet') is-invalid @enderror" name="objet" value="{{ old('objet') }}" required autofocus>

                                @error('objet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>

                            <div class="col-md-12 col-lg-8">
                                <div id="upload_btn" class="file btn btn-lg btn-outline-secondary">
                                    {{ __('Ouvrir image') }}
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                                </div>

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="texte" class="col-md-4 col-form-label text-md-right">{{ __('Texte') }}</label>

                            <div class="col-md-12 col-lg-8">
                                <textarea id="texte" class="form-control @error('texte') is-invalid @enderror" name="texte">
                                    {!! old('texte') !!}
                                </textarea>

                                @error('texte')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Créer article') }}
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
