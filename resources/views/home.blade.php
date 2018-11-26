<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./assets/css/app.css">
    <script src="./assets/js/app.js"></script>
    <script src="./assets/js/axios.min.js"></script>
    <title>W&S Backend Task</title>
</head>
<body>
<div class="code-generation">
    <div class="full-width">
        <h1>Generate Code</h1>

        <p>Click the button below to generate a One-time password to continue.</p>

        <button onclick="generateCode()">Generate Code</button>
        <p><small><em>In case you forgot the secret key, here it is: MKBSWN3DPEHPK2PXZ</em></small></p>

        <!-- Generated code goes here-->
        <h1 class="generated-code">
            &nbsp;
        </h1>
        <!-- /Generated code ends here-->
    </div>
</div>
<div class="code-validation">
    <div class="full-width">
        <h1>Validate Code</h1>
        <form method="post">
            <label for="token">Token to validate</label>
            <input type="text" name="token" class="token-input">
            <button type="submit" onclick="validateCode(event)">Validate Code</button>
        </form>
        <div></div>

        <!-- Code Validation status goes here -->
        <p class="validated-code-status">&nbsp;</p>
        <!-- /Code Validation status goes here-->
    </div>
</div>
</body>
</html>