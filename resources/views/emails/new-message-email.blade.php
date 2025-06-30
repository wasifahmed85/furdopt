<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FurDopt</title>
</head>
<body bgcolor="#0f3462" style="margin-top:20px;margin-bottom:20px">
  <h2>Hello {{ $user->name }},</h2>
<p>You have {{ $messages->count() }} unread message(s):</p>

<ul>
@foreach($messages as $msg)
    <li>From: {{ $msg->sender_id }} | "{{ $msg->message }}"</li>
@endforeach
</ul>

<p>Please log in to your account to view them.</p>

  <!-- / Main table -->
</body>

</html>
