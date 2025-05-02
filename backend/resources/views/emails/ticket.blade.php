<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Votre Ticket</title>
</head>
<body>
    <h1>Bonjour {{ $participant->firstname }} {{ $participant->lastname }},</h1>
    <p>Merci de vous être inscrit à l'événement : {{ $participant->event->title }}</p>
    <p>Votre ticket unique : <strong>{{ $participant->ticket_uuid }}</strong></p>
    <p>Conservez ce ticket pour accéder à l'événement.</p>
</body>
</html>
