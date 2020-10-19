@extends('layouts.admin')

@section('page_title')
    {{ __('Forum employé') }}
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script>
    var SITEURL = "{{ route('employés.get_posts') }}";
    var page = 1; //track user scroll as page number, right now page number is 1
    load_more(page); //initial content load
    $(window).scroll(function() { //detect page scroll
        if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
            var max_page = {{ $max_pages }};
            if(page <= max_page){
                page++; //page number increment
                load_more(page); //load content   
            }else {
                $('.loading-text').html("No more records!");
                //alert(last_id);
            }
        }
    });     
    function load_more(page){
        last_id = $('#list_posts').children().last().attr('id');
        $.ajax({
            url: SITEURL,//"{{ route('employés.get_posts') }}",
            type: "GET",
            datatype: "HTML",
            data: 
                {
                    last_post: last_id
                },
            beforeSend: function(){
                $('.ajax-loading').show();
            }, 
            error: function(e){
                alert('No response from server -> ' + e);
            }, 
            success: function(data){
                if(data.length == 0){
                //console.log(data.length);
                //notify user if nothing to load
                    $('.ajax-loading').html("No more records!");
                    return;
                }
                $('.ajax-loading').hide(); //hide loading animation once data is received
                
                $("#list_posts").append(data); //append data into #results element          
                

            }
        });/*).done(function(data){
            if(data.length == 0){
                //console.log(data.length);
                //notify user if nothing to load
                $('.ajax-loading').html("No more records!");
                return;
            }
            $('.ajax-loading').hide(); //hide loading animation once data is received
            $("#list_posts").append(data); //append data into #results element          
            //console.log('data.length');
        })
        .fail(function(jqXHR, ajaxOptions, thrownError){
            alert('No response from server');
        });*/
    }
</script>
@endsection

@section('styles')
<style>
    .action-btns{
        /*position: absolute;*/
        margin-top: 10px;
        float:left;
    }

    .action-btns > .btn:hover {
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
        -o-transform: scale(1.1);
    }
    .action-btns > .btn {
        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        -o-transform: scale(0.8);
        -webkit-transition-duration: 0.5s;
        -moz-transition-duration: 0.5s;
        -o-transition-duration: 0.5s;
    }

    .mt-100 {
        margin-top: 100px
    }

    .card {
        box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
        border-width: 0;
        transition: all .2s
    }

    .card-header:first-child {
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
    }

    .card-header {
        display: flex;
        align-items: center;
        border-bottom-width: 1px;
        padding-top: 0;
        padding-bottom: 0;
        padding-right: .625rem;
        height: 3.5rem;
        text-transform: uppercase;
        background-color: #fff;
        border-bottom: 1px solid rgba(26, 54, 126, 0.125)
    }

    .btn-primary {
        color: #fff;
        background-color: #3f6ad8;
        border-color: #3f6ad8
    }

    .btn {
        font-size: 0.8rem;
        font-weight: 500;
        outline: none !important;
        position: relative;
        transition: color 0.15s, background-color 0.15s, border-color 0.15s, box-shadow 0.15s
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem
    }

    .card-body p {
        font-size: 13px
    }

    a {
        color: #E91E63;
        text-decoration: none !important;
        background-color: transparent
    }

    .media img {
        width: 40px;
        height: auto
    }

    .ajax-loading{
        text-align: center;
        background-color: white;
        font-size: 16px;
        color: #BBB;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center" id="list_posts">
        <div class="row float-left action-btns">
            <a href="#" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Ajouter un post</strong></span>            
            </a>
            <a href="{{ route('employés.liste_sondages') }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Liste des sondages</strong></span>            
            </a>
        </div>
    </div>
    <div class="ajax-loading justify-content-center"><div class="row"><span class="loading-text"></span><img src="{{ asset('imgs/circle_loading.gif') }}" height="50" width="70" /></div></div>
</div>
@endsection
