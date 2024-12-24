<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>package dashboard</title>
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
            <!-- Form Section (Create package Moderator) -->
            <div class="col-md-4 form-container">
                <form method="POST" action="{{ route('package.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Package Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" required>
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="discount" class="form-label">Discount</label>
                        <input type="number" class="form-control" name="discount" id="discount" value="{{ old('discount') }}">
                        @error('discount')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="duration" class="form-label">Duration (in months)</label>
                        <input type="number" class="form-control" name="duration" id="duration" value="{{ old('duration') }}" required>
                        @error('duration')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="coach_id" class="form-label">Coach ID</label>
                        <input type="number" class="form-control" name="coach_id" id="coach_id" value="coach_id" required>
                        @error('coach_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="admin_id" class="form-label">Admin ID</label>
                        <input type="number" class="form-control" name="admin_id" id="admin_id" value="{{ session('user_id') }}" readonly>
                        @error('admin_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <button type="submit" class="btn btn-primary">Create</button>
                </form>
            </div>

            <!-- Table Section -->
            <div class="col-md-8 table-container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>name</th>
                            <th>price</th>
                            <th>discount</th>
                            <th>duration</th>
                            <th>description</th>
                            <th> Admin Id </th>

                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($packages as $package)
                            <tr>
                                <td>{{ $package->id }}</td>
                                <td>{{ $package->name }}</td>
                                <td>{{ $package->price }}</td>
                                <td>{{ $package->discount }}</td>
                                <td>{{ $package->duration }}</td>
                                <td>{{ $package->description }}</td>
                                <td>{{ $package->admin_id }}</td>
                                <td>
                                    <form action="{{ route('package.edit', $package->id) }}" method="GET" style="display: inline;">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-warning">Edit</button>
                                    </form>

                                    <!-- Delete Button with Form -->
                                    <form action="{{ route('package.delete', $package->id) }}" method="GET" style="display: inline;">
                                        @csrf
                                        @method('GET')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
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
