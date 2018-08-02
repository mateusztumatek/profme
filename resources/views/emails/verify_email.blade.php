

<style>
    body{
        background-image: url({{url('img/login-background.jpg')}});
        background-size: cover;

    }
    h2{
        text-align: center;
    }

    a:hover{
        transform: scale(1.1);
        opacity: 0.5;
    }
    #btn{
        transition: all 500ms;
        text-decoration: none;
        padding: 10px;
        color: rgba(8,18,31,0.99);
        border: 1px solid rgba(8,18,31,0.5);
        text-align: center;
    }
    .col-auto{
        text-align: center;
        padding: 30px;
        padding-left: 60px;
        padding-right: 60px;

        margin: auto;
    }
</style>
<body>
<div class="col-auto">
    <h2 >Witaj {{$user->name}}</h2><br>

    <p>Zweryfikuj swoje konto klikając w ponizszy link</p>
    <a id="btn"  href="{{route('verify', ["tok" => $user->verify])}}"> Zweryfikuj </a>
    <p>Dziękujemy że jesteś z nami {{config('app.name')}}.pl</p>
    <p style="font-size: 8px; opacity: 0.5; margin-top: 20px;" class="text-center">nie odpowiadaj na tą wiadomość</p>
</div>


</body>
