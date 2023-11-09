<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SMS Portal With Twilio</title>
    <!-- Styles -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS"
        crossorigin="anonymous">
</head>
<body>
        <h2>List of Sent Messages</h2>
        <table class="table table-striped table-dark">
            <thead>
                <tr>
                <th scope="col">Sender No</th>
                <th scope="col">Reciever No</th>
                <th scope="col">Message</th>
                <th scope="col">Date-Time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($messages as $msg)
                <tr>
                    <th>{{$msg->from}}</th>
                    <td>{{$msg->to}}</td>
                    <td>{{$msg->body}}</td>
                    <td>{{htmlspecialchars($msg->dateCreated->format('Y-m-d H:i:s'))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
