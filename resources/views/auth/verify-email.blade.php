<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            margin-top: 50px;
        }
        .verification-code-input {
            width: 40px;
            height: 40px;
            text-align: center;
            margin: 5px;
            font-size: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Email Verification</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form action="{{ route('handle-verification') }}" method="POST">
                            @csrf
                            <div class="form-row justify-content-center">
                                <input type="text" class="form-control verification-code-input" name="verification_code[]" maxlength="1" required>
                                <input type="text" class="form-control verification-code-input" name="verification_code[]" maxlength="1" required>
                                <input type="text" class="form-control verification-code-input" name="verification_code[]" maxlength="1" required>
                                <input type="text" class="form-control verification-code-input" name="verification_code[]" maxlength="1" required>
                                <input type="text" class="form-control verification-code-input" name="verification_code[]" maxlength="1" required>
                                <input type="text" class="form-control verification-code-input" name="verification_code[]" maxlength="1" required>
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Verify</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
