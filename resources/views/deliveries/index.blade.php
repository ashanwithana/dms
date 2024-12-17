<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deliveries</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Delivery Management System</h1>
            <a href="{{ route('deliveries.create') }}" class="btn btn-primary">Create New Delivery</a>
        </div>

        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Pickup Address</th>
            <th>Pickup Name</th>
            <th>Provider</th>
            <th>Priority</th>
            <th>Delivery Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($deliveries as $delivery)
        <tr>
            <td>{{ $delivery->id }}</td>
            <td>{{ $delivery->pickup_address }}</td>
            <td>{{ $delivery->pickup_name }}</td>
            <td>{{ $delivery->delivery_provider }}</td>
            <td>{{ $delivery->priority }}</td>
            <td>{{ $delivery->delivery_status }}</td>
            <td>
                <a href="{{ route('deliveries.edit', $delivery->id) }}" class="btn btn-sm btn-warning">Edit</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $deliveries->links('pagination::bootstrap-5') }}
</div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>