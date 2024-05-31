@if (session()->has('success'))
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it: -->
        <!-- - `.toast-container` for spacing between toasts -->
        <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
        <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
        <div class="toast-container top-0 end-0 p-3">
            <!-- Then put toasts within -->
            <div class="toast fade show text-white bg-success" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-body">
                    {{ session('success') }}
                    <button type="button" class="btn-close float-end" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        </div>
    </div>
@endif
