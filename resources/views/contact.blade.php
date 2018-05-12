@extends('layouts.app')
@section('content')

<main class="container-fluid">
    <div class="container-fluid">
        <div class="jumbotron">
            <h1>Contact Us</h1>
        </div>
        <div class="col-sm-8 col-sm-offset-2 center" style="margin: 0 auto;">
          {{ Form::open(['method' => 'POST', 'action' => 'MailController@send']) }}

            @include('partials.error-message')

              <div class="form-group">
                {{ Form::label("name", "Name") }}
                {{ Form::text("name", null, ['class' => 'form-control', 'placeholder' => 'Your Name']) }}
              </div>
              <div class="form-group">
                {{ Form::label("email", "Email") }}
                {{ Form::email("email", null, ['class' => 'form-control', 'placeholder' => 'Your Email']) }}
              </div>
              <div class="form-group">
                {{ Form::label("subject", "Subject") }}
                {{ Form::text("subject", null, ['class' => 'form-control', 'placeholder' => 'Subject']) }}
              </div>
              <div class="form-group">
                {{ Form::label("mail_message", "Message") }}
                {{ Form::textarea("mail_message", null, ['class' => 'form-control', 'placeholder' => 'Message']) }}
              </div>
                {!! Form::submit("Submit", ['class' => 'btn btn-primary col-sm-12'])!!}
          {{ Form::close() }}
        </div>
    </div>
</main>
@endsection
