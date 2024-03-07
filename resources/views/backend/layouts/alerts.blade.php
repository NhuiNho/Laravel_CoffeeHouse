@section('alerts')
    <div class="container bootstrap snippets bootdey pt-5">
        @if (session('info'))
            <div class="alert alert-info alert-dismissible" role="alert">
                <div class="icon"><span class="mdi mdi-info-outline"></span></div>
                <div class="message">
                    <strong>Info!</strong>
                    {{ session('info') }}
                </div>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <div class="icon"><span class="mdi mdi-alert-triangle"></span></div>
                <div class="message">
                    <strong>Warning!</strong>
                    {{ session('warning') }}
                </div>
            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="icon"> <span class="mdi mdi-close-circle-o"></span></div>
                <div class="message">
                    <strong>Error!</strong>
                    {{ session('error') }}
                </div>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <div class="icon"> <span class="mdi mdi-close-circle-o"></span></div>
                <div class="message">
                    <strong>Error!</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <div class="icon"><span class="mdi mdi-check"></span></div>
                <div class="message">
                    <strong>Success!</strong>
                    {{ session('success') }}
                </div>
            </div>
        @endif

        @if (session('primary'))
            <div class="alert alert-primary alert-dismissible" role="alert">
                <div class="icon"><span class="mdi mdi-notifications"></span></div>
                <div class="message">
                    <strong>Primary!</strong>
                    {{ session('primary') }}
                </div>
            </div>
        @endif

        @if (session('dark'))
            <div class="alert alert-dark alert-dismissible" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close"
                        aria-hidden="true"></span></button>
                <div class="icon"><span class="mdi mdi-notifications"></span></div>
                <div class="message">
                    <strong>Dark!</strong>
                    {{ session('dark') }}
                </div>
            </div>
        @endif

        @if (session('light'))
            <div class="alert alert-light alert-dismissible" role="alert">
                <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span class="mdi mdi-close"
                        aria-hidden="true"></span></button>
                <div class="icon"><span class="mdi mdi-notifications"></span></div>
                <div class="message">
                    <strong>Light!</strong>
                    {{ session('light') }}
                </div>
            </div>
        @endif

    </div>

    <script>
        $(document).ready(function() {
            window.setTimeout(() => {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function() {
                    $(this).remove();
                })
            }, 5000);
        });
    </script>
@show
