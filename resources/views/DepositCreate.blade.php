<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Deposit</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* Add your custom CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            transition: border-color 0.3s ease-in-out;
        }

        .form-control:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .btn-primary {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        .btn-primary:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Create Deposit</h2>
        <form method="POST" action="{{ route('deposits.store') }}">
            @csrf
            <div class="form-group">
                <label class="form-label" for="amount">Amount:</label>
                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" value="{{ old('amount') }}" required autocomplete="amount" autofocus>
                @error('amount')
                <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="deposit_option_id">Deposit Option:</label>
                <select id="deposit_option_id" class="form-control" name="deposit_option_id" required>
                    <option value="" disabled selected>Select deposit option</option>
                    @foreach ($depositOptions as $depositOption)
                    <option value="{{ $depositOption->id }}">{{ $depositOption->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Create Deposit') }}</button>
            </div>
        </form>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Add your custom JavaScript code here -->
</body>

</html>