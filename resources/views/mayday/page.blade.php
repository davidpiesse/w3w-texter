<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send Location</title>
</head>
<body style="text-align: center; font-family: system-ui, BlinkMacSystemFont, -apple-system, Segoe UI, Roboto, Oxygen, Ubuntu, Cantarell, Fira Sans, Droid Sans, Helvetica Neue, sans-serif;">
    <h2 style="color:green;">KEEP THIS PAGE OPEN</h2>

    <div style="border: 3px solid green;">
        <h1>Your Location</h1>

        <p>GPS Location</p>
        <h2 id="gps">Waiting...</h2>

        <p>what3words Address</p>
        <h2 id="w3w">Waiting...</h2>

        <p>Last Update Sent</p>
        <h2 id="last_update">Waiting...</h2>
    </div>

    <script>
        let options = {
            enableHighAccuracy: true,
            timeout: 1000,
            maximumAge: 0
        }

        let last_update = null

        let secondRunner = null
            
        function success(pos) {
            let crd = pos.coords
            sendPosition(crd)
            updateLocation(crd)
            getWhat3WordsAddress(crd)
            updateLastUpdated()
        }
            
        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`)
        }



        function updateTimeSince(){
            secondRunner = setInterval(updateLastUpdated, 1000)
        }

        updateTimeSince()

        function updateLocation(position){
            document.getElementById("gps").innerText = parseFloat(position.latitude).toFixed(5) + ", " + parseFloat(position.longitude).toFixed(5)
        }

        function setLastUpdated(){
            last_update = new Date()
        }

        function updateLastUpdated(){
            if(last_update == null){
                last_update = new Date()
            }
            previous_date = last_update
            now = new Date()
            let seconds = Math.round((now.getTime() - previous_date.getTime()) / 1000)
            if(seconds == 0){
                document.getElementById("last_update").innerText = "Just now"
            }else{
                document.getElementById("last_update").innerText = seconds + " seconds ago"
            }
        }

        function getWhat3WordsAddress(position){
            let url= "https://api.what3words.com/v2/reverse?coords="+ position.latitude +","+ position.longitude +"&display=minimal&format=json&key=U9YA2P3F"

            const Http = new XMLHttpRequest()
            Http.responseType = 'json'
            Http.open("GET", url)
            Http.send()
            Http.onreadystatechange=(e)=>{
                if(Http.response != null){
                    document.getElementById("w3w").innerText = Http.response.words;
                }
            }
        }

        function sendPosition(position){
            postAjax('{{ route("mayday.update.location", $mayday) }}', { 
                latitude: position.latitude,
                longitude: position.longitude,
                altitude: position.altitude,
                altitude_accuracy: position.altitudeAccuracy,
                accuracy: position.accuracy,
                heading: position.heading,
                speed: position.speed,
                timestamp: position.timestamp,
            }, function(data){ 
                setLastUpdated()
             });
        }

        function postAjax(url, data, success) {
            let params = typeof data == 'string' ? data : Object.keys(data).map(
                    function(k){ return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]) }
                ).join('&');
        
            let xhr = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
            xhr.open('POST', url);
            xhr.onreadystatechange = function() {
                if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText); }
            };
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send(params);
            return xhr;
        }
            
        navigator.geolocation.watchPosition(success, error, options);

        let connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
        
        let type = connection.effectiveType;

        function updateConnectionStatus() {
            console.log("Connection type changed from " + type + " to " + connection.type);
            sendConnection(connection)
            updateLastUpdated()
        }

        function sendConnection(connection){
            postAjax('{{ route("mayday.update.connection", $mayday) }}', { 
                downlink: connection.downlink,
                effectiveType: connection.effectiveType,
                rtt: connection.rtt,
            }, function(data){ 
                setLastUpdated()
            });
        }

        connection.addEventListener('change', updateConnectionStatus);

        sendConnection(connection)
    </script>
</body>
</html>