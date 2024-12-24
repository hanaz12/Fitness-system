<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Trainee Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <h2> Welcome, {{session('first_name')}} </h2>
       <br>
        <div class="row">
            <!-- Table Section -->
            <div class="col-md-12 table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>User Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Age</th>
                            <th>Height</th>
                            <th>Weight</th>
                            <th>Medical History</th>
                            <th>Gender</th>
                            <th>Package</th> <!-- Adding Package -->
                            <th>Plan</th> <!-- Adding Plan -->
                            <th>Admin</th> <!-- Adding Admin -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trainees as $trainee)
                            <tr>
                                <td>{{ $trainee->id }}</td>
                                <td>{{ $trainee->first_name }}</td>
                                <td>{{ $trainee->last_name }}</td>
                                <td>{{ $trainee->user_name }}</td>
                                <td>{{ $trainee->email }}</td>
                                <td>{{ $trainee->phone }}</td>
                                <td>{{ $trainee->address }}</td>
                                <td>{{ $trainee->age }}</td>
                                <td>{{ $trainee->height }}</td>
                                <td>{{ $trainee->weight }}</td>
                                <td>{{ $trainee->medical_history }}</td>
                                <td>{{ $trainee->gender }}</td>
                                <td>{{ $trainee->package_id }}</td> <!-- Display Package -->
                                <td>{{ $trainee->plan_id }}</td> <!-- Display Plan -->
                                <td>{{ $trainee->admin_id }}</td> <!-- Display Admin -->
                                <td>
                                    <form action="{{ route('trainee.edit', $trainee->id) }}" method="GET" style="display: inline;">
                                        @csrf

                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </form>

                                    <!-- Delete Button with Form -->
                                    <form action="{{ route('trainee.delete', $trainee->id) }}" method="GET" style="display: inline;">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this trainee?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
