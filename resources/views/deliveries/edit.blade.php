<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Delivery</h1>
        <form action="{{ route('deliveries.update', $delivery->id) }}" method="POST">
            @csrf
            @method('PUT')
            <h3>Pickup information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="pickup_address" class="form-label">Pickup address</label>
                    <input type="text" class="form-control" name="pickup_address" value="{{$delivery->pickup_address}}" required>
                </div>
                <div class="col-md-6">
                    <label for="pickup_name" class="form-label">Pickup name</label>
                    <input type="text" class="form-control" name="pickup_name" value="{{$delivery->pickup_name}}" required>
                </div>
                <div class="col-md-6">
                    <label for="pickup_contact_no" class="form-label">Pickup contact no</label>
                    <input type="text" class="form-control" name="pickup_contact_no" value="{{$delivery->pickup_contact_no}}" required>
                </div>
                <div class="col-md-6">
                    <label for="pickup_email" class="form-label">Pickup email</label>
                    <input type="email" class="form-control" value="{{$delivery->pickup_email}}" name="pickup_email">
                </div>
            </div>
            <h3>Delivery Information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="delivery_address" class="form-label">Delivery address</label>
                    <input type="text" class="form-control" value="{{$delivery->delivery_address}}" name="delivery_address" required>
                </div>
                <div class="col-md-6">
                    <label for="delivery_name" class="form-label">Delivery name</label>
                    <input type="text" class="form-control" name="delivery_name" value="{{$delivery->delivery_name}}" required>
                </div>
                <div class="col-md-6">
                    <label for="delivery_contact_no" class="form-label">Delivery contact no</label>
                    <input type="text" class="form-control" value="{{$delivery->delivery_contact_no}}" name="delivery_contact_no" required>
                </div>
                <div class="col-md-6">
                    <label for="delivery_email" class="form-label">Delivery email</label>
                    <input type="email" class="form-control" value="{{$delivery->delivery_email}}" name="delivery_email">
                </div>
                <div class="col-md-4">
                    <label for="type_of_good" class="form-label">Type of good</label>
                    <select name="type_of_good" class="form-select" required>
                        <option value="" disabled>Select the Good Type</option>
                        <option value="Document" {{ $delivery->type_of_good == 'Document' ? 'selected' : '' }}>Document</option>
                        <option value="Parcel" {{ $delivery->type_of_good == 'Parcel' ? 'selected' : '' }}>Parcel</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="delivery_provider" class="form-label">Delivery provider</label>
                    <select name="delivery_provider" class="form-select" required>
                        <option value="" disabled>Select the Delivery Provider</option>
                        <option value="DHL" {{ $delivery->delivery_provider == 'DHL' ? 'selected' : '' }}>DHL</option>
                        <option value="STARTRACK" {{ $delivery->delivery_provider == 'STARTRACK' ? 'selected' : '' }}>STARTRACK</option>
                        <option value="ZOOM2U" {{ $delivery->delivery_provider == 'ZOOM2U' ? 'selected' : '' }}>ZOOM2U</option>
                        <option value="TGE" {{ $delivery->delivery_provider == 'TGE' ? 'selected' : '' }}>TGE</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="priority" class="form-label">Priority</label>
                    <select name="priority" class="form-select" required>
                        <option value="" disabled>Select the Priority</option>
                        <option value="Standard" {{ $delivery->priority == 'Standard' ? 'selected' : '' }}>Standard</option>
                        <option value="Express" {{ $delivery->priority == 'Express' ? 'selected' : '' }}>Express</option>
                        <option value="Immediate" {{ $delivery->priority == 'Immediate' ? 'selected' : '' }}>Immediate</option>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="shipment_pickup_date" class="form-label">Shipment pickup date</label>
                    <input type="date" class="form-control" value="{{$delivery->shipment_pickup_date}}" name="shipment_pickup_date" required>
                </div>
                <div class="col-md-6">
                    <label for="shipment_pickup_time" class="form-label">Shipment pickup time</label>
                    <input type="time" class="form-control" value="{{$delivery->shipment_pickup_time}}" name="shipment_pickup_time" required>
                </div>
            </div>
            <div class="col-md-4">
                <label for="delivery_status" class="form-label">Delivery Status</label>
                <select name="delivery_status" class="form-select" required>
                    <option value="Pending" {{ isset($delivery) && $delivery->delivery_status == 'Pending' ? 'selected' : '' }}>Pending</option>
                    <option value="Processed" {{ isset($delivery) && $delivery->delivery_status == 'Processed' ? 'selected' : '' }}>Processed</option>
                    <option value="Delivered" {{ isset($delivery) && $delivery->delivery_status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="Cancelled" {{ isset($delivery) && $delivery->delivery_status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
            </div>
            <h3>Package Infomation</h3>
            <div id="packages">
                @foreach($delivery->packages as $index => $package)
                <div>
                    <label>Package Dscription: <input type="text" name="packages[{{ $index }}][package_description]" value="{{ $package->package_description }}" class="form-control" required></label>
                    <label>Length: <input type="number" name="packages[{{ $index }}][length]" value="{{ $package->length }}" class="form-control" required></label>
                    <label>Height: <input type="number" name="packages[{{ $index }}][height]" value="{{ $package->height }}" class="form-control" required></label>
                    <label>Width: <input type="number" name="packages[{{ $index }}][width]" value="{{ $package->width }}" class="form-control" required></label>
                    <label>Weight: <input type="number" name="packages[{{ $index }}][weight]" value="{{ $package->weight }}" class="form-control" required></label>
                </div>
                <hr>
                @endforeach
            </div>

            <button type="submit" class="btn btn-success">Update Delivery</button>
        </form>
        <a href="{{ route('deliveries.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>