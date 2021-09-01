<?php
get_header();
?>

<style>
    .maincontainer {
        width: 360px;
        padding: 8% 0 0;
        margin: auto;
    }
    .fcontainer input {
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        font-size: 14px;
    }
    .fcontainer {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        border: 1px solid grey;
    }
    .fcontainer button {
        background: #6E4242;
        width: 100%;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
    }
    .fcontainer .signup-form {
        display: none;
    }
</style>

<div class="maincontainer">
    <div class="fcontainer">
        <form class="signup-form">
            <input type="text" placeholder="name" />
            <input type="password" placeholder="password" />
            <input type="text" placeholder="email address" />
            <input type="text" placeholder="Country" />
            <button>Sign-up</button>
            <p class="message">Already registered? <a href="#" class="sign-in"> Sign In</a></p>
        </form>
        <form class="login-form">
            <input type="text" placeholder="username" />
            <input type="password" placeholder="password" />
            <button>Sign-in</button>
            <p class="message">Not registered? <a href="#" class="create_account">Create an account</a></p>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
    $('.create_account').click(function(){
        $('.login-form').hide();
        $('.signup-form').show();
    });
    $('.sign-in').click(function(){
        $('.login-form').show();
        $('.signup-form').hide();
    });
</script>

<?php
get_footer();
?>