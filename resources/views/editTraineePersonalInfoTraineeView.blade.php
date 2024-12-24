<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Personal Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    @if (session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger mt-3">
        {{ session('error') }}
    </div>
@endif
    <div class="container mt-5">
        <h2 class="mb-4">Trainee Profile</h2>

        <!-- Trainee Information Form -->
        <form method="POST" action="{{ route('trainee.upadateInfo', $trainee->id) }}">
            @csrf
            @method('POST')

            <div class="row mb-3">
                <!-- ID (Non-Editable) -->
                <div class="col-md-6">
                    <label for="id" class="form-label">Trainee ID</label>
                    <input type="text" id="id" class="form-control" value="{{ $trainee->id }}" disabled>
                </div>

                <!-- User Name (Non-Editable) -->
                <div class="col-md-6">
                    <label for="user_name" class="form-label">User Name</label>
                    <input type="text" id="user_name" class="form-control" value="{{ $trainee->user_name }}" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <!-- First Name -->
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name</label>
                    <input type="text" id="first_name" name="first_name" class="form-control" value="{{ $trainee->first_name }}">
                </div>

                <!-- Last Name -->
                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last Name</label>
                    <input type="text" id="last_name" name="last_name" class="form-control" value="{{ $trainee->last_name }}">
                </div>
            </div>

            <div class="row mb-3">
                <!-- Email -->
                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $trainee->email }}" required>
                </div>

                <!-- Phone Number -->
                <div class="col-md-6">
                    <label for="phone" class="form-label">Phone Number</label>
                    <input type="text" id="phone" name="phone" class="form-control" value="{{ $trainee->phone }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <!-- Address -->
                <div class="col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ $trainee->address }}">
                </div>

                <!-- Age -->
                <div class="col-md-6">
                    <label for="age" class="form-label">Age</label>
                    <input type="number" id="age" name="age" class="form-control" value="{{ $trainee->age }}">
                </div>
            </div>

            <div class="row mb-3">
                <!-- Height -->
                <div class="col-md-6">
                    <label for="height" class="form-label">Height (cm)</label>
                    <input type="number" id="height" name="height" class="form-control" value="{{ $trainee->height }}">
                </div>

                <!-- Weight -->
                <div class="col-md-6">
                    <label for="weight" class="form-label">Weight (kg)</label>
                    <input type="number" id="weight" name="weight" class="form-control" value="{{ $trainee->weight }}">
                </div>
            </div>

            <div class="row mb-3">
                <!-- Gender -->
                <div class="col-md-6">
                    <label for="gender" class="form-label">Gender</label>
                    <select id="gender" name="gender" class="form-control">
                        <option value="male" {{ $trainee->gender == 'male' ? 'selected' : '' }}>Male</option>
                        <option value="female" {{ $trainee->gender == 'female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <!-- Package Name (Non-Editable) -->
                <div class="col-md-6">
                    <label for="package_name" class="form-label">Package Name</label>
                    <input type="text" id="package_name" class="form-control" value="{{ $packageName  }}" disabled>
                </div>

                <div class="row mb-3">
                    <!-- Coach Name (Non-Editable) -->
                    <div class="col-md-6">
                        <label for="coach_name" class="form-label">Coach Name</label>
                        <input type="text" id="coach_name" class="form-control" value="{{ $coachName }}" disabled>
                    </div>
                </div>


            <!-- Medical History -->
            <div class="mb-3">
                <label for="medical_history" class="form-label">Medical History</label>
                <textarea id="medical_history" name="medical_history" class="form-control">{{ $trainee->medical_history }}</textarea>
            </div>

            <!-- Goal -->
            <div class="mb-3">
                <label for="goal" class="form-label">Goal</label>
                <textarea id="goal" name="goal" class="form-control">{{ $trainee->goal }}</textarea>
            </div>

            <!-- Save Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>

        <hr class="my-5">

        <!-- Password Update Section -->
        <h3 class="mb-4">Update Password</h3>
        <form method="POST" action="{{ route('trainee.updatePassword', $trainee->id) }}">
            @csrf
            @method('POST')

            <div class="row mb-3">
                <!-- New Password -->
                <div class="col-md-6">
                    <label for="password" class="form-label">New Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Enter new password"
                        required
                    >
                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="col-md-6">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control @error('password_confirmation') is-invalid @enderror"
                        placeholder="Confirm new password"
                        required
                    >
                    @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <!-- Save Password Button -->
            <div class="text-end">
                <button type="submit" class="btn btn-warning">Update Password</button>
            </div>
        </form>



    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
