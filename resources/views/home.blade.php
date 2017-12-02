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

                <div class="panel-body tasks">
                    @foreach($tasks as $task)
                      <div class="task">
                        <h3>{{$task->title}}</h3>
                        <p>{{$task->description}}</p>
                        <h4>{{$task->deadline}}</h4>
                        <a href="#" class="delete_task">Delete task</a>
                        <input type="hidden" name="task_id" value="{{$task->id}}" class="task_id">
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
            //console.log(success);
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
        console.log($(this).parent().find(".task_id").val());
        $.ajax({
          type: "POST", //Метод отправки
          url: "/delete_task", //путь до php фаила отправителя
          dataType: 'json',
          data: { id: $(this).parent().find(".task_id").val() },
          success: function(success) {
            console.log(success);
            console.log(this);
              $(".tasks input[value='" + success + "']").parent().remove();
          }
        });
    });
</script>

@endsection
