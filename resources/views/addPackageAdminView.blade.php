{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<body>
    <div class="container mt-5">
        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="text-center mb-4">Welcome, {{ session('first_name') }}</h2>

        <form method="POST" action="{{ route('package.store') }}" class="w-75 mx-auto" id="packageForm">
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
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="available" selected>Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="coach_id" class="form-label">Coach ID</label>
                <input type="number" class="form-control" name="coach_id" id="coach_id" value="{{ old('coach_id') }}">
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

            <button type="submit" class="btn btn-primary w-100">Add New Package</button>
        </form>
    </div>

    <script>
        document.getElementById('status').addEventListener('change', function () {
            const coachField = document.getElementById('coach_id');
            if (this.value === 'available') {
                coachField.setAttribute('required', 'required');
            } else {
                coachField.removeAttribute('required');
            }
        });

        // التحقق من حالة coach_id إذا كانت فارغة في حال كانت الحزمة متاحة
        document.getElementById('packageForm').addEventListener('submit', function (event) {
            const status = document.getElementById('status').value;
            const coachId = document.getElementById('coach_id').value;
            if (status === 'available' && !coachId) {
                alert("Coach ID is required when the package is available.");
                event.preventDefault(); // منع إرسال النموذج
            }
        });
    </script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<body>
    <div class="container mt-5">
        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="text-center mb-4">Welcome, {{ session('first_name') }}</h2>

        <form method="POST" action="{{ route('package.store') }}" class="w-75 mx-auto" id="packageForm">
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
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="available" selected>Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="coach_id" class="form-label">Coach</label>
                <select class="form-select" name="coach_id" id="coach_id">
                    <option value="">-- Select a Coach --</option>
                    @foreach($coaches as $coach)
                        <option value="{{ $coach->id }}" {{ old('coach_id') == $coach->id ? 'selected' : '' }}>
                            {{ $coach->id }} {{" "}} {{ $coach->user_name }}
                        </option>
                    @endforeach
                </select>
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

            <button type="submit" class="btn btn-primary w-100">Add New Package</button>
        </form>
    </div>

    <script>
        document.getElementById('status').addEventListener('change', function () {
            const coachField = document.getElementById('coach_id');
            if (this.value === 'available') {
                coachField.setAttribute('required', 'required');
            } else {
                coachField.removeAttribute('required');
            }
        });

        document.getElementById('packageForm').addEventListener('submit', function (event) {
            const status = document.getElementById('status').value;
            const coachId = document.getElementById('coach_id').value;
            if (status === 'available' && !coachId) {
                alert("Coach is required when the package is available.");
                event.preventDefault();
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Package Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<body>
    <div class="container mt-5">
        <!-- Success and Error Messages -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <h2 class="text-center mb-4">Welcome, {{ session('first_name') }}</h2>

        <form method="POST" action="{{ route('package.store') }}" class="w-75 mx-auto" id="packageForm">
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
                <label for="status" class="form-label">Status</label>
                <select class="form-select" name="status" id="status" required>
                    <option value="available" selected>Available</option>
                    <option value="unavailable">Unavailable</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="coach_id" class="form-label">Coach ID</label>
                <input type="number" class="form-control" name="coach_id" id="coach_id" value="{{ old('coach_id') }}">
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

            <button type="submit" class="btn btn-primary w-100">Add New Package</button>
        </form>
    </div>

    <script>
        document.getElementById('status').addEventListener('change', function () {
            const coachField = document.getElementById('coach_id');
            if (this.value === 'available') {
                coachField.setAttribute('required', 'required');
            } else {
                coachField.removeAttribute('required');
            }
        });

        // التحقق من حالة coach_id إذا كانت فارغة في حال كانت الحزمة متاحة
        document.getElementById('packageForm').addEventListener('submit', function (event) {
            const status = document.getElementById('status').value;
            const coachId = document.getElementById('coach_id').value;
            if (status === 'available' && !coachId) {
                alert("Coach ID is required when the package is available.");
                event.preventDefault(); // منع إرسال النموذج
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
