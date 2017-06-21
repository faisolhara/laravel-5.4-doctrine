@extends('master')

@section('title') Login @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Login</h3>
            <p>Use the following form to login into the system.</p>

            <hr>

            <form action="{{ url('login') }}" method="post">
                {{ csrf_field() }}

                <p><input type="text" name="email" placeholder="Email..." class="form-control" /></p>
                <p><input type="password" name="password" placeholder="Password..." class="form-control" /></p>

                <hr>

                <p><button class="form-control btn btn-success">Login</button></p>
            </form>
        </div>
    </div>
@endsection