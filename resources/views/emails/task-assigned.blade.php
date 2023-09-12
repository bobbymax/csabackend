<x-mail::message>
# Task Assigned

You have been assigned a {{$task->activity}} task.

Description: {{ $task->description }}

Please sign in to your dashboard to fulfill this request.

<x-mail::button :url="'http://localhost:3000/tasks'">
View Task
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
