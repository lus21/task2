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
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">WebSiteName</a>
                </div>
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#">Page 1</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> LogOut</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <h2>Search</h2>
            <p>Search by first name,last name,or keywords:</p>
            {!! Form::open(['action' => 'HomeController@search','method'=>'get']) !!}
                <div class="form-group">
                    {{Form::label('search_fname','First Name')}}
                    {{Form::text('search_fname',null,['id'=>'search_fname','class'=>'form-control','placeholder'=> 'Enter First Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('search_lname','Last Name')}}
                    {{Form::text('search_lname',null,['id'=>'search_fname','class'=>'form-control','placeholder'=> 'Enter Last Name'])}}
                </div>
                <div class="form-group">
                    {{Form::label('search_keywords','Keywords')}}
                    {{Form::text('search_keywords',null,['id'=>'search_keywords','class'=>'form-control','placeholder'=> 'Enter Keywords:Keyword1, keyword2'])}}
                </div>
                {{Form::submit('Search',['class'=>'btn btn-success','name'=>'search'])}}
            {!! Form::close() !!}   
            <div class="panel panel-info search no_results">
                <div class="panel-heading">Sorry,no results</div>
            </div>
        </div>
        <div class="container">
            <h2>Users</h2>          
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Keywords</th>
                        <th>Resume</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)  
                    <tr>
                        <td>{{ $user['f_name'] }}</td>
                        <td>{{ $user['l_name'] }}</td>
                        <td>{{ $user['email'] }}</td>
                        <td>{{ $user['keywords'] }}</td>
                        <td>{{ $user['resume'] }}</td>
                        <td><a href="/download?file_name={{$user['resume']}}" class="glyphicon glyphicon-download" data-id='{{ $user['id'] }}'></a></td>
                        <td>@if($user['id']!=$users->id)<span class="glyphicon glyphicon-remove" data-id='{{ $user['id'] }}'></span>@endif</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <?php echo $users->render(); ?>
        </div>  
    <script src = "{{asset('js/app.js')}}"></script>
    <script src = "{{asset('js/init.js')}}"></script>
    </body>
</html>
