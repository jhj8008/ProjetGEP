@section('scripts')
<link href="https://fonts.googleapis.com/css?family=Nunito|Monoton|Quicksand|Raleway|Roboto|Montserrat|Oswald|Poppins|Lato|Bitner|Exo" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@section('content')
<div class="row justify-content-center">
    <div class="card shadow-none mt-3 border border-light">
            <div class="card-body">
                <div class="media mb-3">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-3 mail-img shadow" alt="media image"  width="100" height="100">
                        <div class="media-body">
                            <span class="media-meta float-right">{{ $email_detail['created_at'] }}</span>
                            <h4 class="text-primary m-0">{{ $email_detail['nom'] }}</h4>
                            <small class="text-muted">From : {{ $email_detail['email'] }}</small>
                        </div>

                    </div> 
                    <div class="email-object">Message: </div>
                    <div class="container email-body">
                        {{ $email_detail['message'] }}
                    </div>
                    <hr>
                </div>
            </div> 
        </div> 
</div>
@endsection
