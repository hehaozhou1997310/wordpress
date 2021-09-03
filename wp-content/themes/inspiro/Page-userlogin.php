<?php
get_header();
?>

<style>
    .maincontainer {
        width: 100%;
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
        max-width: 450px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;
        border: 1px solid grey;
        width: 100%;
    }
    .fcontainer button {
        background: #4CAF50;
        width: 100%;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
    }
    .fcontainer .signup-form {
        display: none;
    }   
    .flex {
      display: flex;
    }
    .pinp input:first-child {
        margin-right: 10px;
    }
    .pinp input:last-child {
        margin-left: 10px;
    }
</style>

</head>

<body>


<div class="maincontainer">
    <div class="fcontainer">
        <form class="signup-form">
            <div class="flex pinp">
                <input type="text" placeholder="First Name" />
                <input type="text" placeholder="Last Name" />
            </div>
            <div class="flex pinp">
                <input type="email" placeholder="Email Address" />
                <input type="email" placeholder="Confirm Email Address" />
            </div>
            <div class="flex pinp">
                <input type="text" placeholder="Country" />
                <input type="number" placeholder="Phone Number" />
            </div>
            <div class="flex pinp">
                <input type="password" placeholder="Password" />
                <input type="password" placeholder="Confirm Password" />
            </div>
            <button>Sign-up</button>
            <p class="message">Already registered? <a href="#" class="sign-in">Sign In</a></p>
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