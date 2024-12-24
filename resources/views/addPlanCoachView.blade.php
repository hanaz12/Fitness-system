<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan dashboard</title>
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
            <!-- Form Section (Create Plan Moderator) -->
            <div class="col-md-4 form-container">
                <form method="POST" action="{{ route('Plan.store' ,$trainee->id) }}">
                    @csrf



                    <div class="mb-3">
                        <label for="name" class="form-label">Trainee ID</label>
                        <input type="text" class="form-control" name="trainee_id" id="trainee_id" value="{{ $trainee->id }}" required>
                        @error('trainee_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Plan Name</label>
                        <input type="text" class="form-control" name="plan_name" id="plan_name" value="{{ old('plan_name') }}" required>
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>







                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description" rows="8" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="user_id" class="form-label">Coach ID</label>
                        <input type="number" class="form-control" name="coach_id" id="coach_id"
                               value="{{ session('user_id') }}" readonly>
                        @error('coach_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>



                    <button type="submit" class="btn btn-primary">Add plan</button>
                </form>
            </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
