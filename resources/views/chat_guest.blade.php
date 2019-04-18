<html>
<head>
    <title> OpenTok Getting Started </title>
    <script src="https://static.opentok.com/v2/js/opentok.js"></script>
</head>
<body>

    <div id="videos">
        <div id="subscriber"></div>
        <div id="publisher"></div>
    </div>

    <script src="https://static.opentok.com/v2/js/opentok.min.js"></script>
    <script type="text/javascript">

    var token = '{{ $opentok_token }}';
    var session_key = '{{ $session_token }}';
    var api_key = '{{ env('OPENTOK_API_KEY') }}';

    // Handling all of our errors here by alerting them
    function handleError(error) {
      if (error) {
        alert(error.message);
      }
    }

    // connect to open tok api using client side library
    var session = OT.initSession(api_key, session_key);

    // when other user is connected we want to show them
    // in subscriber div element
    /*session.on('streamCreated', function(event) {
        session.subscribe(event.stream, 'subscriber', {
            insertMode: 'append',
            width: '100%',
            height: '100%'
        }, handleError);
    });*/

    session.on("streamCreated", function(event) {
      console.log("New stream in the session: " + event.stream.streamId);
      var options = {insertMode: 'append'}

      session.subscribe(event.stream, 'subscriber', options, function(error){
        if (error) {
          console.log(error);
        } else {
          console.log('Subscriber added.');
        }
      });
    });

    // when first user loads this page we want him to
    // be shown in publisher div element

    var pros = {
      audioFallbackEnabled:true,
      classNames: "OT_root OT_publisher",
      constraints:{
        audio:true,
        video:true
      },
      fitMode: "cover",
      height: '100%',
      insertDefaultUI: true,
      insertMode: 'append',
      maxResolution: '',
      mirror: true,
      name: 'Guest',
      publishAudio: true,
      publishVideo: true,
      showControls: true,
      style: {
        buttonDisplayMode: 'auto'
      },
      width: '100%'
    };

    var publisher = OT.initPublisher('publisher', pros /*{
        insertMode: 'append',
        fitMode: "cover",
        width: '100%',
        height: '250px',
        publishAudio: true,
        publishVideo: true,
        showControls: true,
    }*/, handleError);

    // if we have any connection error let's put an alert box
    /*session.connect(token, function(error) {
        if (error) {
            //alert(error.message);
             handleError(error);
        } else {
            session.publish(publisher, handleError);
        }
    });*/

     session.connect(token, function (error) {
        if (error) {
            console.log("Failed to connect: ", error.message);
            if (error.name === "OT_NOT_CONNECTED") {
              alert("You are not connected to the internet. Check your network connection.");
            }
        } else {
            session.publish(publisher, handleError);
            console.log("Connected");
        }
    });

    </script>
</body>
</html>