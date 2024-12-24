<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="mb-4">Notifications</h2>


        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

      
        @if ($notifications->isEmpty())
            <div class="alert alert-info">No notifications available.</div>
        @else
            <ul class="list-group">
                @foreach ($notifications as $notification)
                    <li class="list-group-item d-flex justify-content-between align-items-center
                    {{ $notification->status == 'unread' ? 'bg-light border-primary' : '' }}">
                        <!-- Notification Message -->
                        <div>
                            <span class="{{ $notification->status == 'unread' ? 'fw-bold text-dark' : 'text-muted' }}">
                                {{ $notification->message }}
                            </span>

                            <!-- Label for unread notifications -->
                            @if ($notification->status == 'unread')
                                <span class="badge bg-primary ms-2">New</span>
                            @endif
                        </div>

                        <!-- Button to clear notification -->
                        <button class="btn btn-danger btn-sm"
                                onclick="clearNotification({{ $notification->id }})">
                            Clear
                        </button>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Adding Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // JavaScript function to handle the clearing of notifications
        function clearNotification(notificationId) {
            // Send AJAX request to clear the notification
            if (confirm('Are you sure you want to clear this notification?')) {
                fetch(`/notifications/clear/${notificationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Notification cleared successfully.');
                        location.reload(); // Reload the page to reflect the changes
                    } else {
                        alert('Failed to clear the notification.');
                    }
                })
                .catch(error => {
                    alert('Error: ' + error);
                });
            }
        }
    </script>
</body>
</html>
