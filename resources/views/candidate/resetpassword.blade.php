<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            @include('layouts.include.alert')
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>Reset Password</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('fp_user.update', request('token')) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="token" value="{{ request('token') }}">
                            <div class="form-group">
                                <label for="new_password">New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Reset Password</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
