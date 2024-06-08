<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Other meta tags and CSS links -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <br>
        <h1>Task Details</h1>
        <div class="card">
            <div class="card-header">
                Task Information
            </div>
            <div class="card-body">
                <h5 class="card-title">Title: {{ $task->title }}</h5>
                <p class="card-text">Description: {{ $task->description }}</p>
                <p class="card-text">User: {{ $task['user']->name }}</p>
                <p class="card-text">Type: {{ $task['type']->name }}</p>
                <p class="card-text">Priority: {{ $task->priority }}</p>
                <p class="card-text">Due Date: {{ $task->due_date }}</p>
           
            </div>
        </div>
        <br>
        <a href="{{ route('tasks.index') }}" class="btn btn-primary">Back to Task List</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
