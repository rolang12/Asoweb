<div x-data="{ open: false }">

    <button x-on:click="open=!open">
        <i class="fa-solid fa-earth-americas text-white hover:text-gray-200 text-lg"> </i>
        @if ($count > 0)
            <span 
                class="w-4 h-4 text-xs absolute rounded-full bg-red-600 text-white">{{ $count }}</span>
        @endif
    </button>

    <div class="shadow-lg" x-show="open" x-transition x-on:click.away="open = false">
        <ul class="absolute text-sm h-80 rounded-md right-40  w-80 top-11 bg-white overflow-auto">
            <li class="bg-gray-50 text-gray-500 relative text-left">
                <div class="p-1">Notificaciones</div>
            </li>
            <hr>
            @forelse ($notificaciones as $notificacion)
                <li wire:click="ver_notificacion({{$notificacion}})" class="text-left px-5 py-2 shadow-md hover:bg-cyan-200 text-gray-800 {{ $notificacion->status == 1 ? 'bg-cyan-100' : 'bg-white' }}">

                    <div class="flex cursor-pointer justify-evenly">
                        <div> <img class="w-10 h-10 rounded-full object-cover"
                                src="{{ asset('storage/' . $notificacion->users->profile_photo_path) }}" alt="img">
                        </div>
                        <div class="inline-flex ml-2 items-center font-semibold ">{{ $notificacion->tipo_mensaje }}
                        </div>
                        <span class="text-right"><small>{{ \Carbon\Carbon::parse($notificacion->created_at)->diffForHumans() }}</small></span>
                    </div>

                </li>

            @empty

                <li class="bg-white text-left px-5 py-2 shadow-md  text-gray-800">
                    <small class="">No hay notificaciones</small>
                </li>
            @endforelse
        </ul>

    </div>

</div>

{{-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <script type="text/javascript">
        var notificationsWrapper = $('.dropdown-notifications');
        var notificationsToggle = notificationsWrapper.find('a[data-toggle]');
        var notificationsCountElem = notificationsToggle.find('i[data-count]');
        var notificationsCount = parseInt(notificationsCountElem.data('count'));
        var notifications = notificationsWrapper.find('ul.dropdown-menu');

        if (notificationsCount <= 0) {
            notificationsWrapper.hide();
        }

        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        // var pusher = new Pusher('397635d727f4de53cfbe', {
        //     cluster: 'us2',
        //     encrypted: true
        // });

        // Subscribe to the channel we specified in our Laravel Event
        // var channel = pusher.subscribe('status-liked');

        // Bind a function to a Event (the full Laravel class)
        // channel.bind('App\\Events\\StatusLiked', function(data) {
        //     var existingNotifications = notifications.html();
        //     var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        //     var newNotificationHtml = `
        //     <li class="notification active">
        //         <div class="media">
        //             <div class="media-body">
        //             <strong class="notification-title">` + data.message + `</strong>
        //             <!--p class="notification-desc">Extra description can go here</p-->
        //             <div class="notification-meta">
        //                 <small class="timestamp">about a minute ago</small>
        //             </div>
        //             </div>
        //         </div>
        //     </li>
        //     `;
        //     notifications.html(newNotificationHtml + existingNotifications);


        //     notificationsCount += 1;
        //     notificationsCountElem.attr('data-count', notificationsCount);
        //     notificationsWrapper.find('.notif-count').text(notificationsCount);
        //     notificationsWrapper.show();
        // });
    </script>

</div>
            notificationsCount += 1;
            notificationsCountElem.attr('data-count', notificationsCount);
            notificationsWrapper.find('.notif-count').text(notificationsCount);
            notificationsWrapper.show();
        });
    </script> --}}
