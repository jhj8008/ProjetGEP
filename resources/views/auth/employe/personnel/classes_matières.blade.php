@extends('layouts.admin')

@section('scripts')
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
@endsection

@section('styles')
<style>
    span{
        font-size:15px;
    }

    .box-part > i{
        font-size: 30px;
    }

    .title{
        font-family: 'Poppins', sans-serif;
    }

    .box-part > a{
    text-decoration:none; 
    color: #0062cc;
    /*border-bottom:2px solid #0062cc;*/
    }
    .box{
        padding:60px 0px;
    }

    .box-part{
        background:#FFF;
        border-radius:0;
        padding:60px 10px;
        margin:30px 0px;
    }
    .text{
        font-family: 'Raleway', serif;
        margin:20px 0px;
    }

    .menu_box {
        background-color: #d3def0;
    }
</style>
@endsection

@section('content')
<div class="box">
    <div class="container">
     	<div class="row justify-content-center">	
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
                <div class="box-part text-center menu_box shadow p-3">
                    
                    <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                    
                    <div class="title display-4">
                        <h4>Gestion des classes</h4>
                    </div>
                    
                    <div class="text">
                        <span>Gérer les classes de l'école.</span>
                    </div>
                    <a href="{{ route('personnels.gestion_classes') }}" class="btn btn-outline-info" style="text-decoration:none">Continuer</a>
                </div>
            </div>	 
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
            
                <div class="box-part text-center menu_box shadow p-3">
                    
                    <i class="fa fa-users fa-3x" aria-hidden="true"></i>
                    
                    <div class="title display-4">
                        <h4>Gestion des matières</h4>
                    </div>
                    
                    <div class="text">
                        <span>Gérer les matières du parcours scolaire.</span>
                    </div>
                    <a href="{{ route('personnels.gestion_matières') }}" class="btn btn-outline-info" style="text-decoration:none">Continuer</a>
                </div>
            </div>	 
		</div>		
    </div>
</div>

@endsection
