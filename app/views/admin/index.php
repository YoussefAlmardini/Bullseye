<style>
    @font-face {
        font-family: 'Open Sans';
        font-style: normal;
        font-weight: 300;
        src: local('Open Sans Light'), local('OpenSans-Light'), url(https://fonts.gstatic.com/s/opensans/v17/mem5YaGs126MiZpBA-UN_r8OUuhs.ttf) format('truetype');
    }
    body,
    html {
        height: 100%;
    }
    body {
        font-family: 'Open Sans';
        font-weight: 100;
        display: flex;
        overflow: hidden;
    }
    .login-form {
        min-height: 10rem;
        margin: auto;
        max-width: 50%;
        padding: 0.5rem;
    }
    .login-text {
        color: white;
        font-size: 1.5rem;
        margin: 0 auto;
        max-width: 50%;
        text-align: center;
    }
    .login-username,
    .login-password {
        background: transparent;
        border: 0 solid;
        border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        color: white;
        display: block;
        margin: 1rem;
        padding: 0.5rem;
        transition: 250ms background ease-in;
        width: calc(100% - 3rem);
    }
    .login-username:focus,
    .login-password:focus {
        background: white;
        color: black;
        transition: 250ms background ease-in;
    }
    .login-submit {
        border: 1px solid white;
        background: transparent;
        color: white;
        display: block;
        margin: 1rem auto;
        min-width: 1px;
        padding: 0.25rem;
        transition: 250ms background ease-in;
    }
    .login-submit:hover,
    .login-submit:focus {
        background: white;
        color: black;
        transition: 250ms background ease-in;
    }
    [class*=underlay] {
        left: 0;
        min-height: 100%;
        min-width: 100%;
        position: fixed;
        top: 0;
    }
    .underlay-black {
        background: black;
        z-index: -1;
    }
</style>
<body>
    <form action="/login/authorizeAdmin" method="POST" class="login-form">
        <p class="login-text">Login</p>
        <div class="underlay-black"></div>
        <input required type="email" placeholder="E-mailadres" name="email" class="login-username">
        <input required type="password" placeholder="Wachtwoord" name="password" class="login-password">
        <input type="submit" value="Login" name="submit" class="login-submit"></button>
    </form>
</body>
<?php
//include "mapload.php";
?>


</html>
