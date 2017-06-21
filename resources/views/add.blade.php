@extends('master')

@section('title') Add a Task @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Add Task</h3>
            <p>Use the following form to add a new task to the system.</p>

            <hr>

            <form action="{{ url('add') }}" method="post">
                {{ csrf_field() }}

                <p><input autofocus type="text" placeholder="Name..." name="name" class="form-control" value="{{ count($errors) > 0 ? old('name') : '' }}"/></p>
                @if($errors->has('name'))
                    <span class="help-block">{{ $errors->first('name') }}</span>
                @endif
                <p><input type="text" placeholder="Description..." name="description" class="form-control" value="{{ count($errors) > 0 ? old('description') : '' }}"/></p>
                @if($errors->has('description'))
                    <span class="help-block">{{ $errors->first('description') }}</span>
                @endif
                <p>
                    <select class="form-control" name="userId" id="userId">
                    @foreach($user as $user)
                        <option value="{{ $user->getId() }}">
                            {{ $user->getName() }}
                        </option>
                    @endforeach
                    </select>
                </p>

                <hr>

                <p><button class="form-control btn btn-success">Add Task</button></p>
                <p><a href="{{ url('/view-index') }}" class="form-control btn btn-warning"><i class="fa fa-reply"></i>Cancel</a></p>
            </form>
        </div>
    </div>
@endsection