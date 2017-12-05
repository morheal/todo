@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">My tasks</div>

                <div class="panel-body">
                    {{Form::open(array('url' => '/add_task', 'method' => 'post', 'class' => 'add_task'))}}
                        {{ Form::text('title', null, array('id'=>'title')) }}
                        {{ Form::text('description', null, array(
                            'id'      => 'description',
                        )) }}
                        {{ Form::date('deadline', null, array('id' => 'deadline')) }}
                        {{ Form::submit('Add task') }}
                    {{Form::close()}}
                </div>

                <div class="add_users">
                  <select class="panel-body add_users_select">

                  </select>
                  <input type="hidden" name="task_id" id="users_add_task_id" value="">
                  <button class='add_user_task_button'>Add</button>
                </div>

                <div class="panel-body tasks">
                    @foreach($tasks as $task)
                        <div class="task">
                            <h3>{{$task->title}}</h3>
                            <p>{{$task->description}}</p>
                            <h4>{{$task->deadline}}</h4>
                            <a href="#" class="delete_task">Delete task</a>
                            <input type="hidden" name="task_id" value="{{$task->id}}" class="task_id">
                            @if($task->creator == Auth::user()->id)
                              <button type="button" name="add_task_user" class="add_task_user">Add user</button>
                            @endif
                              @foreach($task->users as $user)
                                <p>{{$user->name}}</p>
                              @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    //ajax for adding task
    $(document).on("submit", ".add_task", function(e) {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        })
        $.ajax({
          type: "POST",
          url: "/add_task",
          dataType: 'json',
          data: { title: $(".add_task #title").val(), deadline: $(".add_task #deadline").val(), description: $(".add_task #description").val() },
          //adding new task block if ajax was success
          success: function(success) {
            $(".tasks").append("<div class='task'><h3>"+success.title+'</h3><p>'+success.description+"</p><h4>"+success.deadline+"</h4><a class='delete_task' href='#'>Delete task</a></div>");
          }
        });
    });
    //ajax for deleting task
    $(document).on("click", ".delete_task", function(e) {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          url: "/delete_task",
          dataType: 'json',
          data: { id: $(this).parent().find(".task_id").val() },
          success: function(success) {
            //removes task from page if ajax was success
              $(".tasks input[value='" + success + "']").parent().remove();
          }
        });
    });
    //ajax for showing users without this task
    $(document).on("click", ".add_task_user", function(e) {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        console.log($(this).parent().find(".task_id").val());
        $.ajax({
          type: "POST",
          url: "/get_users_without_task",
          dataType: 'json',
          data: { id: $(this).parent().find(".task_id").val() },
          success: function(success) {
            console.log(success);
              for (var i = 0; i < success.users.length; i++) {
                if(i == 0) $(".add_users_select").html('');
                $(".add_users_select").append("<option value=" + success.users[i].id + ">" +success.users[i].name + "</p>");
              }
              $("#users_add_task_id").val(success.id);
          }
        });
    });
    //ajax for adding task to user
    $(document).on("click", ".add_user_task_button", function(e) {
        e.preventDefault();
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          type: "POST",
          url: "/add_task_user",
          dataType: 'json',
          data: { task_id: $("#users_add_task_id").val(), user_id: $(".add_users_select").val() },
          success: function(success) {
              $(".task input[value="+success.task_id+"]").parent().append("<p>"+success.username+"</p>");
          }
        });
    });
</script>

@endsection
