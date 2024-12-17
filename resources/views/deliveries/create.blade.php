<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Delivery</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h1 class="mb-4">Create Delivery</h1>

        <form action="{{ route('deliveries.store') }}" method="POST">
            @csrf

            <h3>Pickup Information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="pickup_address" class="form-label">Pickup address</label>
                    <input type="text" class="form-control" name="pickup_address" required>
                </div>
                <div class="col-md-6">
                    <label for="pickup_name" class="form-label">Pickup name</label>
                    <input type="text" class="form-control" name="pickup_name" required>
                </div>
                <div class="col-md-6">
                    <label for="pickup_contact_no" class="form-label">Pickup contact no</label>
                    <input type="text" class="form-control" name="pickup_contact_no" required>
                </div>
                <div class="col-md-6">
                    <label for="pickup_email" class="form-label">Pickup email</label>
                    <input type="email" class="form-control" name="pickup_email">
                </div>
            </div>
            <h3>Delivery Information</h3>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="delivery_address" class="form-label">Delivery address</label>
                    <input type="text" class="form-control" name="delivery_address" required>
                </div>
                <div class="col-md-6">
                    <label for="delivery_name" class="form-label">Delivery name</label>
                    <input type="text" class="form-control" name="delivery_name" required>
                </div>
                <div class="col-md-6">
                    <label for="delivery_contact_no" class="form-label">Delivery contact no</label>
                    <input type="text" class="form-control" name="delivery_contact_no" required>
                </div>
                <div class="col-md-6">
                    <label for="delivery_email" class="form-label">Delivery email</label>
                    <input type="email" class="form-control" name="delivery_email">
                </div>
                <div class="col-md-4">
                    <label for="type_of_good" class="form-label">Type of good</label>
                    <select name="type_of_good" class="form-select" required>
                        <option value="" disabled selected>Select the Good Type</option>
                        <option value="Document">Document</option>
                        <option value="Parcel">Parcel</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="delivery_provider" class="form-label">Delivery provider</label>
                    <select name="delivery_provider" class="form-select" required>
                        <option value="" disabled selected>Select the Delivery Provider</option>
                        <option value="DHL">DHL</option>
                        <option value="STARTRACK">STARTRACK</option>
                        <option value="ZOOM2U">ZOOM2U</option>
                        <option value="TGE">TGE</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="priority" class="form-label">Priority</label>
                    <select name="priority" class="form-select" required>
                        <option value="" disabled selected>Select the Priority</option>
                        <option value="Standard">Standard</option>
                        <option value="Express">Express</option>
                        <option value="Immediate">Immediate</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="shipment_pickup_date" class="form-label">Shipment pickup date</label>
                    <input type="date" class="form-control" name="shipment_pickup_date" required>
                </div>
                <div class="col-md-6">
                    <label for="shipment_pickup_time" class="form-label">Shipment pickup time</label>
                    <input type="time" class="form-control" name="shipment_pickup_time" required>
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

            <h3>Package Information</h3>
            <div id="packages">
                <div class="row mb-3 border p-3 rounded package-block">
                    <div class="col-md-6">
                        <label class="form-label">Package Description</label>
                        <input type="text" class="form-control" name="packages[0][package_description]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Length</label>
                        <input type="number" class="form-control" name="packages[0][length]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Height</label>
                        <input type="number" class="form-control" name="packages[0][height]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Width</label>
                        <input type="number" class="form-control" name="packages[0][width]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Weight</label>
                        <input type="number" class="form-control" name="packages[0][weight]" required>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

                <button type="button" class="btn btn-info" onclick="addPackage()">Add Another Package</button>
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>

    <script>
        let packageIndex = 1;

        function addPackage() {
            const container = document.getElementById('packages');
            const newPackage = `
                <div class="row mb-3 border p-3 rounded package-block">
                    <div class="col-md-6">
                        <label class="form-label">Package Description</label>
                        <input type="text" class="form-control" name="packages[${packageIndex}][package_description]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Length</label>
                        <input type="number" class="form-control" name="packages[${packageIndex}][length]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Height</label>
                        <input type="number" class="form-control" name="packages[${packageIndex}][height]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Width</label>
                        <input type="number" class="form-control" name="packages[${packageIndex}][width]" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Weight</label>
                        <input type="number" class="form-control" name="packages[${packageIndex}][weight]" required>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', newPackage);
            packageIndex++;
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>