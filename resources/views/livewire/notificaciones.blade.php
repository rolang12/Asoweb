{{-- {{dd($notificaciones)}} --}}
{{-- <div class="my-auto" >

    @if (count($notificaciones) > 0)
        <span id="btnPeticion" style="right: 12.5rem " class="absolute text-xs text-white font-medium inline-flex rounded-full justify-center h-4 w-4 bg-red-500">{{count($notificaciones)}}</span>

    @endif

    <div x-data="{ open: false }">
     
        <i id="resultados" x-on:click="open=!open" class="fa-solid fa-earth-americas text-white hover:text-gray-200 text-lg  "></i>

        <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 absolute">


           

            <div class="">

                <ul class="bg-gray-50 " >
                @forelse ($notificaciones as $notificacion)
                    <li class=" py-2 bg-gray-50 shadow-lg w-44 right-36 hover:bg-gray-100 text-left ">

                        Esto es una notificacion
                        
                        {{-- <div class="text-xs font-bold text-blue-800" >{{$notificacion->user->name}}</div><div class="text-xs"> Te ha enviado un mensaje</div>  --}}
                        
                        {{-- <a href="{{ route('perfil', ['id' => $detalle->users->name]) }}"
                            class="text-right text-sm text-blue-800">{{ $detalle->users->name }}</a>
                    </li>
                    <hr>

                @empty
                    <li class="text-sm mb-3 text-gray-500">No tienes mensajes nuevos</li>
                @endforelse
                </ul>
                
            </div>
        </div>
    </div>

 --}}
</div>
<div class="my-auto" >

    @if (count($notificaciones) > 0)
        <span id="btnPeticion" style="right: 12.5rem " class="absolute text-xs text-white font-medium inline-flex rounded-full justify-center h-4 w-4 bg-red-500">{{count($notificaciones)}}</span>

    @endif

    <div x-data="{ open: false }">
     
        <i id="resultados" x-on:click="open=!open" class="fa-solid fa-earth-americas text-white hover:text-gray-200 text-lg  "></i>

        <div x-show="open" x-on:click.away="open = false" class="bg-gray-50 my-3 absolute">

            <div class="">

                <ul class="bg-gray-50 " >
                @forelse ($notificaciones as $notificacion)
                <li class="dropdown dropdown-notifications">
                    <a href="#notifications-panel" class="dropdown-toggle" data-toggle="dropdown">
                      <i data-count="0" class="glyphicon glyphicon-bell notification-icon"></i>
                    </a>
      
                    <div class="dropdown-container">
                      <div class="dropdown-toolbar">
                        <div class="dropdown-toolbar-actions">
                          <a href="#">Mark all as read</a>
                        </div>
                        <h3 class="dropdown-toolbar-title">Notifications (<span class="notif-count">0</span>)</h3>
                      </div>
                      <ul class="dropdown-menu">
                      </ul>
                      <div class="dropdown-footer text-center">
                        <a href="#">View All</a>
                      </div>
                    </div>
                  </li>
                    <hr>

                @empty
                    <li class="text-sm mb-3 text-gray-500">No tienes mensajes nuevos</li>
                @endforelse
                </ul>
                
            </div>
        </div>
    </div>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script type="text/javascript">
      var notificationsWrapper   = $('.dropdown-notifications');
      var notificationsToggle    = notificationsWrapper.find('a[data-toggle]');
      var notificationsCountElem = notificationsToggle.find('i[data-count]');
      var notificationsCount     = parseInt(notificationsCountElem.data('count'));
      var notifications          = notificationsWrapper.find('ul.dropdown-menu');

      if (notificationsCount <= 0) {
        notificationsWrapper.hide();
      }

      // Enable pusher logging - don't include this in production
      // Pusher.logToConsole = true;

      var pusher = new Pusher('397635d727f4de53cfbe', {
      cluster: 'us2',
      encrypted: true
    });

      // Subscribe to the channel we specified in our Laravel Event
      var channel = pusher.subscribe('status-liked');

      // Bind a function to a Event (the full Laravel class)
      channel.bind('App\\Events\\StatusLiked', function(data) {
        var existingNotifications = notifications.html();
        var avatar = Math.floor(Math.random() * (71 - 20 + 1)) + 20;
        var newNotificationHtml = `
          <li class="notification active">
              <div class="media">
                <div class="media-left">
                  <div class="media-object">
                    <img src="https://api.adorable.io/avatars/71/`+avatar+`.png" class="img-circle" alt="50x50" style="width: 50px; height: 50px;">
                  </div>
                </div>
                <div class="media-body">
                  <strong class="notification-title">`+data.message+`</strong>
                  <!--p class="notification-desc">Extra description can go here</p-->
                  <div class="notification-meta">
                    <small class="timestamp">about a minute ago</small>
                  </div>
                </div>
              </div>
          </li>
        `;
        notifications.html(newNotificationHtml + existingNotifications);

        notificationsCount += 1;
        notificationsCountElem.attr('data-count', notificationsCount);
        notificationsWrapper.find('.notif-count').text(notificationsCount);
        notificationsWrapper.show();
      });
    </script>

</div>
