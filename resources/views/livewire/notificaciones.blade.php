<div>

    <div class="items-center inline-flex" x-data="{ open: false }">

        <i id="resultados" x-on:click="open=!open"
            class="fa-solid  fa-earth-americas text-white hover:text-gray-200 text-lg"></i>

            <li style="list-style: none" class="dropdown dropdown-notifications">
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
    </div>

 
    <hr>


    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
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
