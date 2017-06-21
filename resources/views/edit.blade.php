@extends('master')

@section('title') Edit Task @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h3>Edit Task</h3>
            <p>Use the following form to edit che chosen task.</p>

            <hr>

            <form action="{{ url('edit/' . $task->getId()) }}" method="post">
                {{ csrf_field() }}
                <?php
                $userId = !empty($task->getUser()) ? $task->getUser()->getId() : '';
                ?>

                <p><input autofocus type="text" placeholder="Name..." name="name" class="form-control" value="{{ $task->getName() }}" /></p>
                <p><input type="text" placeholder="Description..." name="description" class="form-control" value="{{ $task->getDescription() }}" /></p>
                <!--<p>
                    <select class="form-control" name="userId" id="userId">
                    @foreach($user as $user)
                        <option value="{{ $user->getId() }}" {{ $user->getId() == $userId ? 'selected' : '' }}>
                            {{ $user->getName() }}
                        </option>
                    @endforeach
                    </select>
                </p>-->
                <hr>

                <p><button class="form-control btn btn-success">Save Task</button></p>
                <p><a href="{{ url('/view-index') }}" class="form-control btn btn-warning"><i class="fa fa-reply"></i>Cancel</a></p>
            </form>
        </div>
    </div>
@endsection