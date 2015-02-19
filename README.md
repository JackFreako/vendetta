# vendetta
Freedom of Transportation :)

This repo is a PHP Server side code for Google Cloud Messaging (GCM) Service.

1) function.php

    This file implements the main functionalities of the Server Side code. The server has two main functions:
    a) Store into a MYSQL DB the Registeration ID of a User/Device
    b) Send Push Notificaiton Requests to a GCM Service

2) loader.php

This is reponsible for connecting with the DB.

3) register.php

This is reponsible to storing the credentials of a user/device into the DB.

4) config.php

This is a configuration file for setting up the DB and the GoogleCloudMesssaging(GCM) API key.

5) send_push_notification.php

This file is employed with the Java Script call when a Message Needs to be sent to a particular register device. 
The server makes a request by providing the registration ID and the Message to be sent.
