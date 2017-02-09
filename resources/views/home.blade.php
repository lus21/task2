<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel = "stylesheet" href = "{{asset('css/app.css')}}" />
	<link rel = "stylesheet" href = "{{asset('css/style.css')}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>STDev Task1</title>
    </head>
    <body>        
        <div class="container">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                        <div class="panel panel-warning">
                            <div class="panel-heading"> {{ $error }}</div>
                        </div>     
                @endforeach
            @endif
            <h2>Register</h2>
            <p>All fields must be filled,not empty:</p>
            {!! Form::open(['action' => 'HomeController@addUser','method'=>'post','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('f_name','First Name')}}
                    {{Form::text('f_name',null,['id'=>'f_name','class'=>'form-control','placeholder'=> 'Enter first name','required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('email','Email')}}
                    {{Form::email('email',null,['id'=>'mail','class'=>'form-control','placeholder'=> 'Enter Email','required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('l_name','Last Name')}}
                    {{Form::text('l_name',null,['id'=>'l_name','class'=>'form-control','placeholder'=> 'Enter last name','required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('keywords','Keywords')}}
                    {{Form::text('keywords',null,['id'=>'keywords','class'=>'form-control','placeholder'=> 'Enter keywords:keyword1, keyword2','required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('password','Password')}}
                    {{Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=> 'Enter password','required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::label('conf_pass','Confirm Password')}}
                    {{Form::password('conf_pass',['id'=>'conf_pass','class'=>'form-control','placeholder'=> 'Enter password','required'=>'required'])}}
                </div>
                <div class="form-group">
                    {{Form::file('fileToUpload',['id'=>'fileToUpload'])}}
                </div>
                {{Form::submit('submit',['class'=>'btn btn-success','name'=>'add'])}}
            {!! Form::close() !!}
            @if($msg=session('msg'))
                <div class="panel panel-warning add_status">
                    <div class="panel-heading">{{$msg}}</div>
                </div>
            @endif
        </div>
        <div class='container'>
            <h2>LogIn</h2>
            {!! Form::open(['action' => 'HomeController@login','method'=>'post','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {{Form::label('email','Email')}}
                    {{Form::email('email',null,['id'=>'mail','class'=>'form-control','placeholder'=> 'Enter Email'])}}
                </div>
                <div class="form-group">
                    {{Form::label('password','Password')}}
                    {{Form::password('password',['id'=>'password','class'=>'form-control','placeholder'=> 'Enter password'])}}
                </div>
                {{Form::submit('login',['class'=>'btn btn-success','name'=>'login'])}}
            {!! Form::close() !!}
        </div>
    <script src = "{{asset('js/app.js')}}"></script>
    <script src = "{{asset('js/init.js')}}"></script>
    </body>
</html>
