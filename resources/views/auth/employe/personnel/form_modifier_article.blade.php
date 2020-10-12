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
    plugins: 'autolink lists media table',
    toolbar: 'a11ycheck addcomment showcomments casechange checklist lists bullist numlist code formatpainter pageembed permanentpen table',
    toolbar_mode: 'floating',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
  });
</script>
<script>
    $('.custom-file-input').on('change',function(){
        var fileName = document.getElementById("customFile").files[0].name;
        $(this).next('.form-control-file').addClass("selected").html(fileName);
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

    .custom-file-label{
        max-width: 250px;
        margin-left: 15px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Modifier un article') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('personnels.modifier_article', ['id' => $article->id]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type d\'article ') }}</label>

                            <div class="col-md-12 col-lg-8">
                                <!--<input id="sexe" type="text" class="form-control @error('sexe') is-invalid @enderror" name="sexe" value="{{ old('sexe') }}" required placeholder="Sexe" autofocus>-->
                                <select id="type" name="type" class="form-control @error('type') is-invalid @enderror">
                                    <option>...</option>
                                    <option value="actualité" @if($article->type == 'actualité') selected @endif>Actualité</option>
                                    <option value="activité" @if($article->type == 'activité') selected @endif>Activité</option>
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
                                <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ $article->titre }}" required autofocus>

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
                                <input id="objet" type="text" class="form-control @error('objet') is-invalid @enderror" name="objet" value="{{ $article->objet }}" required autofocus>

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
                                <input type="file" class="custom-file-input" name="image" id="customFile">
                                <label class="form-control d-inline-block custom-file-label form-control-file" for="customFile">{{ $article->image }}</label>
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
                                    {!! $article->texte !!}
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
                                    {{ __('Modifier article') }}
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
