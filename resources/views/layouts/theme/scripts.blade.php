 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('assets/js/app.js') }}"></script>
 <script src="{{ asset('assets/js/custom.js') }}"></script>
 <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
 <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
 <script src="{{ asset('plugins/nicescroll/nicescroll.min.js') }}"></script>
 <script src="{{ asset('plugins/currency/currency.min.js') }}"></script>

 <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
 <!-- END GLOBAL MANDATORY SCRIPTS -->

 <script>
     function noty(msg, option = 1) {
         Snackbar.show({
             text: msg.toUpperCase(),
             actionText: 'CERRAR',
             actionTextColor: '#fff',
             backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
             pos: 'top-right'
         });
     }
 </script>

 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
 {{-- <script src="{{ asset('plugins/apex/apexcharts.min.js')}}"></script>
<script src="{{ asset('assets/js/dashboard/dash_1.js')}}"></script> --}}
 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
 <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>

 @livewireScripts
