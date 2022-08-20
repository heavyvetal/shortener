<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL Shortener</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <style>
        #urlbox {
            margin: 0 auto 20px auto;
            max-width: 758px;
            box-shadow: 0 1px 4px #ccc;
            border-radius: 2px;
            padding: 10px 30px 5px;
            background: #fff;
            text-align: center;
        }
        #result, #copy {
            display: none;
        }
    </style>
</head>
<body>
    <section id="urlbox">
        <form id="shortener-form">
            <div class="form-group">
                <label for="incoming-url">Paste your URL to be shortened</label>
                <input id="incoming-url" type="text" class="form-control" placeholder="Enter the link here">
            </div>
            <div id="result" class="form-group">
                <label for="shorten-url">Your shortened URL</label>
                <input id="shorten-url" type="text" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <button id="copy" type="button" class="btn btn-primary">Copy</button>
        </form>
    </section>

    <script>
        $(document).ready(function () {
            $('#shortener-form').on('submit', function(event) {
                event.preventDefault();

                let url = $('#incoming-url').val();

                $.ajax({
                    url: "/shortener",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        url: url
                    },
                    success: function(response){
                        let parsed_response = JSON.parse(response);

                        if (parsed_response.success) {
                            $('#shorten-url').val(parsed_response.short_url);
                            $('#result').show();
                            $('#copy').show();
                        } else {
                            console.log(parsed_response.message)
                            obj = parsed_response.fails

                            for (let prop in obj) {
                                console.log(prop + ": " + obj[prop]);
                            }
                        }
                    },
                });
            });

            $('#copy').on('click', function() {
                if (!navigator.clipboard) {
                    try {
                        let successful = document.execCommand('copy');
                        let msg = successful ? 'successful' : 'unsuccessful';
                        console.log('Copying to clipboard  was ' + msg);
                    } catch (err) {
                        console.error('Unable to copy', err);
                    }
                    return;
                }

                navigator.clipboard.writeText(text).then(function() {
                    console.log('Copying to clipboard was successful!');
                }, function(err) {
                    console.error('Could not copy text: ', err);
                });
            });
        })
    </script>
</body>
</html>
