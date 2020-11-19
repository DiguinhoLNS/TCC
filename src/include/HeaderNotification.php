<div id = "HeaderNotification" class = "BS">

    <nav>

        <ul id = "NotificationsGroup">
        <?php 

        function Notificar($mensagem){
        
            if(isset($_COOKIE["MessageNotification"])){

                echo '

                    <li class = "NotificationBox">
                        <i class = "material-icons"> &#xe645; </i>
                        <span> '.$mensagem.' </span>
                    </li>
                
                ';

            }else{

                echo '<li id = "NoneNotifications"> Sem Notificações </li>';

            }
        }
        
        ?>
            <li id = "NoneNotifications"> Sem Notificações </li>
        </ul>

        <ul id = "NotificationsConfig">

            <li id = "ClearNotifications" title = "Limpar Notificações"> Limpar </li>

        </ul>

    </nav>

</div>