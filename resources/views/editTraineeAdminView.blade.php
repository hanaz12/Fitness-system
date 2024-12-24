
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Trainee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
        <h1 class="text-center mb-4">Manage Trainee</h1>



        <form method="POST" action="{{ route('trainee.update', $trainee->trainee_id) }}">
            @csrf


            <div>
                <label for="user_name" class="form-label">Username</label>
                <input type="text" class="form-control" name="user_name" value="{{ $trainee->user_name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control" name="first_name" value="{{ $trainee->first_name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control" name="last_name" value="{{ $trainee->last_name }}" readonly>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" value="{{ $trainee->phone }}" readonly>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text" class="form-control" name="email" value="{{ $trainee->email }}" readonly>
            </div>

            <div class="mb-3">
                <label for="medical_history" class="form-label">Medical History</label>
                <textarea class="form-control" name="medical_history" readonly>{{ $trainee->medical_history }}</textarea>
            </div>

            <div class="mb-3">
                <label for="goal" class="form-label">Goal</label>
                <input type="text" class="form-control" name="goal" value="{{ $trainee->goal }}" readonly>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <input type="text" class="form-control" name="gender" value="{{ $trainee->gender }}" readonly>
            </div>

            <div class="mb-3">
                <label for="height" class="form-label">Height</label>
                <input type="text" class="form-control" name="height" value="{{ $trainee->height }}" readonly>
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label">Weight</label>
                <input type="text" class="form-control" name="weight" value="{{ $trainee->weight }}" readonly>
            </div>

            <div class="mb-3">
                <label for="registration_date" class="form-label">Registration Date</label>
                <input type="text" class="form-control" name="registration_date" value="{{ $trainee->registration_date }}" readonly>
            </div>

            <div class="mb-3">
                <label for="package_name" class="form-label">Package</label>
                <select name="package_name" class="form-control">

                    <option value="" {{ empty($trainee->package_name) ? 'selected' : '' }}>-- No Package --</option>

                    <!-- عرض الباقات المتاحة -->
                    @foreach($packages as $package)
                        <option value="{{ $package->name }}" {{ $trainee->package_name == $package->name ? 'selected' : '' }}>
                            {{ $package->name }}
                        </option>
                    @endforeach
                </select>
            </div>





            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <input type="text" class="form-control" value="{{ $trainee->status }}" readonly>
            </div>

            <div class="d-flex justify-content-between">
                <form action="{{ route('trainee.update', $trainee->trainee_id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-success">Update Trainee</button>
                </form>

                @if($trainee->status == 'active')
                <form action="{{ route('trainee.block', $trainee->trainee_id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <button type="submit" class="btn btn-danger">Block Trainee</button>
                </form>

                @else
                    <form action="{{ route('trainee.unblock', $trainee->trainee_id) }}" method="POST">
                        @csrf
                        @method('POST')
                        <button type="submit" class="btn btn-success">Unblock Trainee</button>
                    </form>
                @endif
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
