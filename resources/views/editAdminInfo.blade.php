
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Moderator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Admin Info</h1>

        <!-- Display Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <!-- Form to Edit Admin Moderator -->
        <form method="POST" action="{{ route('admin.update', $admin->id) }}">
            @csrf
            @method('POST')

            <div class="mb-3">
                <label for="admin_moderator_id" class="form-label">Admin ID</label>
                <input type="text" class="form-control" name="id" value="{{ old('id', $admin->id) }}" readonly>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $admin->first_name) }}" readonly>
                @error('first_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $admin->last_name) }}" readonly>
                @error('last_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="{{ old('email', $admin->email) }}" readonly>
                @error('email')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="userName" class="form-label">Username</label>
                <input type="text" class="form-control" name="user_name" value="{{ old('user_name', $admin->user_name) }}" readonly>
                @error('user_name')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone', $admin->phone) }}" readonly>
                @error('phone')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" value="{{ old('address', $admin->address) }}" readonly>
                @error('address')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="salary" class="form-label">Salary</label>
                <input type="number" class="form-control" name="salary" value="{{ old('salary', $admin->salary) }}" required>
                @error('salary')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" value="{{ $admin->status }}" readonly>
            </div>

            <div class="mb-3">
                <label for="admin_moderator_id" class="form-label">Admin Moderator ID</label>
                <input type="text" class="form-control" name="admin_moderator_id" value="{{ old('admin_moderator_id', $admin->admin_moderator_id) }}" required>
                @error('admin_moderator_id')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <form action="{{ route('admin.update', $admin->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-success">Update Admin</button>
                </form>

                @if($admin->status === 'active')
                    <!-- Block button if the admin is active -->
                    <form action="{{ route('admin.block', $admin->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-danger">Block Admin</button>
                    </form>
                @else
                    <!-- Unblock button if the admin is blocked -->
                    <form action="{{ route('admin.unblock', $admin->id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success">Unblock Admin</button>
                    </form>
                @endif
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
