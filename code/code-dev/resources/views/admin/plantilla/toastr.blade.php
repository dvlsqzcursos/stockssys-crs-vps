@if(Session::has('messages'))   
    
    <div aria-live="polite" aria-atomic="true" class="position-relative">
        <!-- Position it: -->
        <!-- - `.toast-container` for spacing between toasts -->
        <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
        <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
        <div class="toast-container top-0 end-0 p-3 ">
            <div class="toast alert bg-{{ Session::get('typealert') }} text-white fade show top-0 end-0 p-3">
                <div class="toast-header bg-{{ Session::get('typealert') }} text-white">
                    <strong class="me-auto"><i class="fa-solid fa-message"></i> Mensaje del Sistema</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body">
                    <strong class="me-auto">{{ Session::get('messages') }}</strong>
                    <br>
                    @if( $errors->any() )
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                </div>

                <script>
                    $('.alert').slideDown();
                    setTimeout(function(){ $('.alert').slideUp(); },5000);
                </script>
            </div>            
        </div>
    </div>



@endif
