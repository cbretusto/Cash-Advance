@php
    session_start();
    $isLogin = false;
    if(isset($_SESSION['rapidx_user_id'])){
        $isLogin = true;
    }

    $isAuthorized = false;
    $user_level = 0;
@endphp

@if($isLogin)
    @if($_SESSION['rapidx_user_level_id'] == 5)
        @if(count($_SESSION['rapidx_user_accesses']) > 0)
            @for($index = 0; $index < count($_SESSION['rapidx_user_accesses']); $index++)
                @if($_SESSION['rapidx_user_accesses'][$index]['module_id'] == 12)
                    @php 
                        $isAuthorized = true; 
                        $user_level = $_SESSION['rapidx_user_accesses'][$index]['user_level_id'];
                    @endphp
                    @break
                @endif
            @endfor

            @if(!$isAuthorized)
                <script type="text/javascript">
                    window.location = '../RapidX/';
                </script>
            @endif
        @else
            <script type="text/javascript">
                window.location = '../RapidX/';
            </script>
        @endif
    @endif

    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Rapidx | @yield('title')</title>
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="shortcut icon" type="image/png" href="{{ asset('public/images/favicon.ico') }}">
            @include('shared.css_links.css_links')
        </head>

        <body class="hold-transition sidebar-mini">
            <input type="hidden" id="loginUserId" value="<?php echo $_SESSION['rapidx_user_id']; ?>">
            <div class="wrapper">
                @include('shared.pages.header')
                @include('shared.pages.super_user_nav')
                @yield('content_page')
                @include('shared.pages.footer')
            </div>
            
            @include('shared.js_links.js_links')
            @yield('js_content')
            <script type="text/javascript">
                $(document).ready(function(){
                    verifyUser();
                    function verifyUser(){
                        let loginUserId = $('#loginUserId').val();
                        console.log('Session(Admin/User):', loginUserId);
                        $.ajax({
                            url: "get_user_log",
                            method: "get",
                            data: {
                                loginUserId : loginUserId
                            },
                            dataType: "json",

                            success: function(response){
                                let result = response['result']
                                let access = 0;
                                for (let index = 0; index < result.rapidx_user_access_details.length; index++) {
                                    if(result.rapidx_user_access_details[index].module_id == 12){ // 12 = Cash Advance Module
                                        access = 1
                                    }
                                }
                                if(access == 0){
                                    window.location.href = 'error';
                                }
                            }
                        });
                    }
                });
            </script>
        </body>
    </html>
@else
    <script type="text/javascript">
        window.location = "../RapidX/";
    </script>
@endif