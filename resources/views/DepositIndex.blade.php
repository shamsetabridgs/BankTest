<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Index</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
        }

        tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <!-- Table to display deposit information -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Amount</th>
                <th>Deposit Option</th>
                <th>Status</th>
                <th>Current Amount</th>
                <th>Available Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach($deposits as $deposit)
            <tr>
                <td>{{ $deposit->id }}</td>
                <td>{{ $deposit->amount }}</td>
                <td>{{ $deposit->depositOption->name }}</td>
                <td>{{ $deposit->status ? 'Approved' : 'Pending' }}</td>
                <td>{{ $deposit->current_amount }}</td>
                <td>{{ $deposit->available_amount }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Add your JavaScript code here -->
    <script>
        // No JavaScript code required for now
    </script>
</body>

</html>
