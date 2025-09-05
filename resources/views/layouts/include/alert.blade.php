<style>
    .alert-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
        width: auto;
        max-width: 400px;
    }
</style>

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible show alert-custom" id="error-alert-all" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ __($error) }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger alert-dismissible show alert-custom" id="error-alert" role="alert">
        {{ __(session('error')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session('success'))
    <div class="alert alert-success alert-dismissible show alert-custom" id="success-alert" role="alert">
        {{ __(session('success')) }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tự động tắt thông báo sau 5 giây
        setTimeout(function() {
            const errorAlertAll = document.getElementById('error-alert-all');
            const errorAlert = document.getElementById('error-alert');
            const successAlert = document.getElementById('success-alert');
            if (errorAlertAll) {
                errorAlertAll.classList.remove('show'); // Ẩn hiệu ứng "show"
                errorAlertAll.classList.add('visually-hidden'); // Kích hoạt hiệu ứng "hidden"
            }
            if (errorAlert) {
                errorAlert.classList.remove('show'); // Ẩn hiệu ứng "show"
                errorAlert.classList.add('visually-hidden'); // Kích hoạt hiệu ứng "hidden"
            }
            if (successAlert) {
                successAlert.classList.remove('show');
                successAlert.classList.add('visually-hidden');
            }
        }, 5000); // 5 giây
    });
</script>
