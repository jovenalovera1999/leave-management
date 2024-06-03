@if (session()->has('success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it: -->
        <!-- - `.toast-container` for spacing between toasts -->
        <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
        <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
        <div class="toast-container top-0 end-0 p-3">
            <!-- Then put toasts within -->
            <div class="toast fade text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
                <div class="toast-body">
                    {{ session('success') }}
                </div>
            </div>
        </div>
    </div>
@endif

@if (session()->has('failed'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it: -->
        <!-- - `.toast-container` for spacing between toasts -->
        <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
        <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
        <div class="toast-container top-0 end-0 p-3">
            <!-- Then put toasts within -->
            <div class="toast fade text-white bg-danger" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
                <div class="toast-body">
                    {{ session('failed') }}
                </div>
            </div>
        </div>
    </div>
@endif

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toastElement = document.querySelector('.toast');
        const toast = new bootstrap.Toast(toastElement);
        toast.show();
    });
</script>
