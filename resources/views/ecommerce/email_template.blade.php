<!DOCTYPE html>
<html>
<head>
    <title>Appointment Request</title>
</head>
<body>
    <h2>Appointment Request</h2>
    <p><strong>Name:</strong> {{ htmlspecialchars($name) }}</p>
    <p><strong>Email:</strong> {{ htmlspecialchars($email) }}</p>
    <p><strong>Phone:</strong> {{ htmlspecialchars($phone) }}</p>
    {{-- <p><strong>Message:</strong> {{ htmlspecialchars($message) }}</p> --}}
</body>
</html>