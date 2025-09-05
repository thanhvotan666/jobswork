<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
</head>

<body>
    @include('layouts.include.alert')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h3>{{__('reset password')}}</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('fp_employer.update', request('token')) }}" method="POST"
                        class="d-flex flex-column gap-3"
                        >
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="token" value="{{ request('token') }}">
                            <div class="form-group">
                                <label for="new_password">{{__('new password')}}</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">{{__('confirm password')}}</label>
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
