<!DOCTYPE html>
<html>
<head>
    <title>Lesson Reminder</title>
</head>
<body>
    <h1>Lesson Reminder</h1>
    <p>Hello {{ $lesson->student->name }},</p>
    <p>This is a reminder for your upcoming lesson.</p>
    <p><strong>Lesson Title:</strong> {{ $lesson->title }}</p>
    <p><strong>Date:</strong> {{ $lesson->date }}</p>
    <p><strong>Start Time:</strong> {{ $lesson->start_time }}</p>
    <p><strong>End Time:</strong> {{ $lesson->end_time }}</p>
    <p><strong>Instructor:</strong> {{ $lesson->moniteur->name }}</p>
    <p>Thank you!</p>
</body>
</html>
