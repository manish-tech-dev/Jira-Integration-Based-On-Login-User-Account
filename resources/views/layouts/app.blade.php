<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Jira Task Management</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- jQuery (load only once) -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables -->
        <link rel="stylesheet" href="https://cdn.datatables.net/2.3.1/css/dataTables.dataTables.css" />      
        <script src="https://cdn.datatables.net/2.3.1/js/dataTables.js"></script>

        <!-- Toastr CSS and JS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <script>
            // Wait for document ready to configure Toastr
            $(document).ready(function() {
                // Configure Toastr
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "3000"
                };
            });

            // Setup AJAX CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>
    </head>
    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to   { opacity: 1; }
        }

        /* Toastr custom styling if needed */
        .toast-success {
            background-color: #51A351;
        }
        .toast-error {
            background-color: #BD362F;
        }

    </style>
      <style>
        .new_loader {
            position: fixed;
            width: 100vw;
            height: 100vh;
            top: 0;
            right: 0;
            left: 0;
            bottom: 0;
            z-index: 999999999;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(0, 0, 0, 0.4);
            color: #fff;
            flex-direction: column;
        }

        .new_loader .spinner-loader {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            position: relative;
            animation: rotate 1s linear infinite
        }

        .new_loader .spinner-loader::before,
        .new_loader .spinner-loader::after {
            content: "";
            box-sizing: border-box;
            position: absolute;
            inset: 0px;
            border-radius: 50%;
            border: 5px solid #FFF;
            animation: prixClipFix 2s linear infinite;
        }

        .new_loader .spinner-loader::after {
            transform: rotate3d(90, 90, 0, 180deg);
            border-color: #2139C2;
        }

        @keyframes talantSpin {
            0% {
                transform: translate(-50%, -50%) rotate(0deg) scale(1);
            }

            90% {
                transform: translate(-50%, -50%) rotate(1080deg) scale(1);
            }

            100% {
                transform: scale(0);
            }
        }

        @-webkit-keyframes talantSpin {
            0% {
                -webkit-transform: translate(-50%, -50%) rotate(0deg) scale(1);
            }

            98% {
                -webkit-transform: translate(-50%, -50%) rotate(1080deg) scale(1);
            }

            100% {
                -webkit-transform: translate(-50%, -50%) rotate(1080deg) scale(0);
            }
        }

        @keyframes talantSuccess {
            from {
                transform: translate(-50%, -50%) rotate(0) scale(0);
            }

            to {
                transform: translate(-50%, -50%) rotate(-45deg) scale(1);
            }
        }

        @-webkit-keyframes talantSuccess {
            from {
                -webkit-transform: translate(-50%, -50%) rotate(0) scale(0);
            }

            to {
                -webkit-transform: translate(-50%, -50%) rotate(-45deg) scale(1);
            }
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg)
            }

            100% {
                transform: rotate(360deg)
            }
        }

        @keyframes prixClipFix {
            0% {
                clip-path: polygon(50% 50%, 0 0, 0 0, 0 0, 0 0, 0 0)
            }

            50% {
                clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 0, 100% 0, 100% 0)
            }

            75%,
            100% {
                clip-path: polygon(50% 50%, 0 0, 100% 0, 100% 100%, 100% 100%, 100% 100%)
            }
        }
        .dt-search label{
            margin-right: 10px;
        }
        .dt-search input{
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
            /* width: 100%; */
        }
    </style>

    <body class="font-sans antialiased">

    <!-- loader -->
        <div class="new_loader" id="new_spinner_loader_main" style="display: none;">
            <span class="spinner-loader"></span>
        </div>

        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main style="padding-top: 0px;">
                {{ $slot }}
            </main>
            
            <div id="edit_ticket_detail_modal" class="fixed inset-0 z-50 hidden">
                <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 p-4"  id="edit_ticket_detail_modal_content">
                </div>
            </div>

            <input type="hidden" id="orignal_task_status" value="">
            <input type="hidden" id="orignal_task_summary" value="">
        </div>
    </body>
    
</html>

<script>

    // function openEditTicketDetailModal(taskKey) {
    //     $.ajax({
    //       url: "{{ route('open_edit_ticket_detail_modal') }}",
    //       type: "GET",
    //       data: { taskKey: taskKey },
    //       success: function(response) {
    //         $('#edit_ticket_detail_modal_content').html(response);
    //         $('#edit_ticket_detail_modal').modal('show');
    //       }
    //     });
    // }

    // function closeModal() {
    //     $('#edit_ticket_detail_modal').addClass('hidden').removeClass('flex');
    // }
    

</script>
