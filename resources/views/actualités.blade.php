@extends(Auth::user() ? 'layouts.app' : 'layouts.admin')

@section('page_title')
    {{ __('Actuvalités') }}
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script>
    var type = "actualité";
    var SITEURL = "/actualités/" + type;//"{{ route('clients.liste_actualités', ['type' => 'actualité']) }}";
    var page = 1; //track user scroll as page number, right now page number is 1
    load_more(page); //initial content load
    $(window).scroll(function() { //detect page scroll
        if($(window).scrollTop() + $(window).height() >= $(document).height()) { //if user scrolled from top to bottom of the page
            var max_page = {{ $max_pages }};
            if(page <= max_page){
                page++; //page number increment
                load_more(page); //load content   
            }else {
                $('.loading-text').html("Aucun articles!");
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
                    $('.ajax-loading').html("Aucun articles!");
                    return;
                }
                $('.ajax-loading').hide(); //hide loading animation once data is received
                
                $("#list_posts").append(data); //append data into #results element          
            }
        });
    }
</script>
@endsection

@section('styles')
<style>
    .page-title {
        font-family: 'Lato';
        margin-bottom: 30px;
    }

    .title {
        font-family: 'Poppins';
    }

    .author-name {
        font-weight: bold;
    }

    .ajax-loading{
        text-align: center;
        background-color: white;
        font-size: 16px;
        color: #BBB;
    }

    .my_footer {
        /*max-height: 150px;*/
        /*position: absolute;*/
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="page-title">
            <h1>Actualités</h1>
        </div>
    </div>
    <div class="col-md-12" id="list_posts">
    </div>

    <div class="ajax-loading justify-content-center"><div class="row"><span class="loading-text"></span><img src="{{ asset('imgs/circle_loading.gif') }}" height="50" width="70" /></div></div>
</div>
@endsection
