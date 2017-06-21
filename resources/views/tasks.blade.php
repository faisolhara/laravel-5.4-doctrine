@extends('master')

@section('title') Tasks List @endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
        <a href="{{ url('/view-add') }}" class="btn btn-sm btn-primary text-right"><i class="fa fa-plus-circle"></i>Add New</a>
        <a href="{{ url('/logout') }}" class="btn btn-sm btn-danger text-right"><i class="fa fa-sign-out"></i>Logout</a>
            <h3>Tasks List</h3>

            <table class="table table-striped">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>User</th>
                    <th>Status</th>
                    <th>Operations</th>
                </tr>

                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->getId() }}</td>
                        <td>{{ $task->getName() }}</td>
                        <td>{{ $task->getDescription() }}</td>
                        <td>{{ !empty($task->getUser()) ? $task->getUser()->getName() : '' }}</td>
                        <td>
                            @if($task->isDone())
                                Done
                            @else
                                Not Done
                            @endif
                           - <a href="{{ url('toggle/' . $task->getId()) }}">Change</a>
                        </td>
                        <td>
                            <a href="{{ url('view-edit/' . $task->getId()) }}">Edit</a> |
                            <a href="{{ url('delete/' . $task->getId()) }}">Delete</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No tasks in the list... for now!</td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@endsection