<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite('resources/css/app.css')
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    *{
    margin: 0;
padding: 0;
box-sizing: border-box;

}

.form-box.Login .animation{
  transform: translateX(0%);
transition: .7s ease;
opacity: 1;
transition-delay: calc(.1s * var(--S)) ;
}
.container.active .form-box.Login .animation{
transform: translateX(-120%);
opacity: 0;
transition-delay: calc(.1s * var(--li));
}

.form-box.Register .animation{
transform: translateX(120%);
transition: .7s ease;
opacity: 0;
filter: blur(10px);
transition-delay: calc(.1s * var(--S));
}

.container.active .form-box.Register .animation{
transform: translateX(0%);
opacity: 1;
filter: blur(0);
transition-delay: calc(.1s * var(--li));
}


.input-box label{
position: absolute;
top: 50%;
left: 0;
transform: translateY(-50%);
font-size: 16px;
color: black;
transition: .5s;
}
.input-box input:focus,
.input-box input:valid{

  border-bottom: 2px solid blue;}

.input-box input:focus ~ label,
.input-box input:valid ~ label{
  top: -8px;
  color: #5384f5;}
.input-box i{
position: absolute;
top: 50%;
right: 0;
font-size: 18px;
transform: translateY(-50%);
transition: .5s;
}


.btn::before{
content: "";
position: absolute;
height: 300%;
width: 100%;
background: linear-gradient(#5384f5, #0738ab, #5384f5, #0738ab);
top: -100%;
left: 0;
z-index: -1;
transition: .5s;
}
.btn:hover:before{
top: 0;
}

.info-content.Login .animation{
transform: translateX(0);
transition: .7s ease;
transition-delay: calc(.1s * var(--S)) ;
opacity: 1;
filter: blur(0px);

}
.container.active .info-content.Login .animation{
transform: translateX(120%);
opacity: 0;
filter: blur(10px);
transition-delay: calc(.1s * var(--D));
}

.info-content.Register{

pointer-events: none;
}

.info-content.Register .animation{
transform: translateX(-120%);
transition: .7s ease;
opacity: 0;
filter: blur(10px);
transition-delay: calc(.1s * var(--S)) ;

}

.container.active .info-content.Register .animation{
transform: translateX(0%);
opacity: 1;
filter: blur(0);
transition-delay: calc(.1s * var(--li));
}

.curved-shape{
position: absolute;
right: 0;
top: -5px;
height: 600px;
width: 850px;
background: linear-gradient(#5384f5, #0738ab);
transform: rotate(10deg) skewY(40deg);
transform-origin: bottom right;
transition: 1.5s ease;
transition-delay: 1.6s;
}
.container.active .curved-shape{
  
transform: rotate(0deg) skewY(0deg);
transition-delay: .5s;
}


.curved-shape2{
position: absolute;
left: 250px;
top: 100%;
height: 700px;
width: 850px;
background: white;
transform: rotate(0deg) skewY(0deg);
transform-origin: bottom left;
transition: 1.5s ease;
transition-delay: .5s;
}
.container.active .curved-shape2{
  
  transform: rotate(-11deg) skewY(-41deg);
  transition-delay: 1.2s;
  }
.container{
  width: 750px;
height: 450px;
box-shadow: 0 0 40px #5384f5;
}
.input-box input{
background: transparent;
border-bottom: 2px solid blue;
}
.form-box{

width: 50%;
}

.info-content.Login{
right: 0;
text-align: right;
padding: 0 40px 60px 150px;
}
.info-content.Register{
left: 0;
text-align: left;
padding: 0 10px 60px 20px;
pointer-events: none;
}

@media (max-width: 800px) {
  .container {
    display: flex;
    justify-content: center;
    width: 90%; /* Full width minus padding */
    
  }
  .form-box{
    
    display: flex;
    justify-content: flex-end;
    padding-bottom: 45px;
    width: max-content;
  }
  
  .form-box.Register{
    width: 100%;
    align-items: center;
  }

  .curved-shape{
  left: 0;
  width: 100%; 
  height: 120px;
  transform: rotate(0deg) skewY(0deg);
  transition: 1.5s ease;
  }
  .curved-shape2 {
    display: none;
  }

  /* Full-width adjustments for input boxes */
  .input-box input,
  .btn {
    width: 100%;
  }

  /* Center the info content on mobile */
  .info-content.Login, .info-content.Register {
    padding: 20px;
    text-align: center;
    justify-content: flex-start;
    margin-top: 20px;
    left: 0;
    width: 100%;
    text-align: center;
    padding: 0 10px 60px 20px;
    pointer-events: none;
  }

}
.Register {
  padding: 40px 40px 10px 10px;
  opacity: 0;
  visibility: hidden;
  transition: opacity 0.7s ease, visibility 0.7s ease;
}
.Login {
  opacity: 1;
  visibility: visible;
  transition: opacity 0.7s ease, visibility 0.7s ease;
}
.container.active .Register {
  opacity: 1;
  visibility: visible;
}
.container.active .Login {
  opacity: 0;
  visibility: hidden;
}


</style>
</head>
<body class="flex justify-center items-center min-h-screen" style="background-image: url('{{ asset('background3.png') }}'); background-size: cover; background-position: center;">
  <div class="container relative bg-white border-solid border-2 border-blue-600 overflow-hidden">
    <div class="curved-shape"></div>
    <div class="curved-shape2"></div>
    <div class="form-box Login absolute left-0 p-0 px-10 top-0 w-1/2 h-full flex justify-center flex-col">
      <h2 class="animation text-2xl text-center" style="--D:0; --S:21">Login</h2>
      <form action="#">
        <div class="input-box animation relative w-full h-12 mt-6" style="--D:1; --S:22">
          <input type="text" class="w-full h-full bg-transparent border-0 outline-none text-blue-600 font-semibold border-b-2 border-blue pr-6 transition-all duration-500" required>
          <label for="">Username</label>
          <i class='bx bx-user'></i>

        </div>
        <div class="input-box animation relative w-full h-12 mt-6" style="--D:2; --S:23">
          <input class="w-full h-full bg-transparent border-0 outline-none text-blue-600 font-semibold border-b-2 border-blue pr-6 transition-all duration-500" type="password" required>
          <label for="">Password</label>
          <i class='bx bx-lock-alt' ></i>

        </div>
        <div class="input-box animation relative w-full h-12 mt-6" style="--D:3; --S:24">
          <button class="btn relative w-full h-16 bg-transparent rounded-full cursor-pointer text-lg font-semibold border-2 border-blue-600 overflow-hidden z-10" type="submit">Login</button>
        </div>
        <div class="regi-link animation text-center my-5 mx-10" style="--D:4; --S:25">
          <p class="text-sm">Don't have an account? <a href="#" class="SignUpLink font-semibold hover:underline text-blue-600">Sign Up</a></p>
        </div>
      </form>
    </div>
    <div class="info-content Login pr-32 pl-36 pb-16 pt-0 absolute h-full flex justify-center flex-col right-0 text-right text-white">
      <h2 class="animation uppercase text-3xl leading-snug" style="--D:0; --S:20">Welcome Back</h2>
      <p class="animation text-base" style="--D:1; --S:21">Enjoy your shopping spree</p>
    </div>
    <div class="form-box Register absolute right-0 px-15 w-10 h-full flex justify-center flex-col">
      <h2 class="animation text-2xl text-center" style="--li:17; --S:0;">Sign Up</h2>
      <form action="#">
        <div class="input-box animation relative w-full h-12 mt-6" style="--li:18; --S:1;">
          <input type="text" class="w-full h-full bg-transparent border-0 outline-none text-blue-600 font-semibold border-b-2 border-blue pr-6 transition-all duration-500" required>
          <label for="">Username</label>
          <i class='bx bx-user'></i>
        </div>
        <div class="input-box animation relative w-full h-12 mt-6" style="--li:19; --S:2;">
          <input type="Email" class="w-full h-full bg-transparent border-0 outline-none text-blue-600 font-semibold border-b-2 border-blue pr-6 transition-all duration-500" required>
          <label for="">Email</label>
          <i class='bx bx-envelope'></i>
        </div>
        <div class="input-box animation relative w-full h-12 mt-6" style="--li:20; --S:3;">
          <input type="password" class="w-full h-full bg-transparent border-0 outline-none text-blue-600 font-semibold border-b-2 border-blue pr-6 transition-all duration-500" required>
          <label for="">Password</label>
          <i class='bx bx-lock-alt' ></i>

        </div>
        <div class="input-box animation relative w-full h-12 mt-6" style="--li:21; --S:4;">
          <button class="btn relative w-full h-16 bg-transparent rounded-full cursor-pointer text-lg font-semibold border-2 border-blue-600 overflow-hidden z-10" type="submit">Register</button>
        </div>
        <div class="regi-link animation text-center my-5 mx-10" style="--li:22; --S:5;">
          <p class="text-sm">Already have an account? <a href="#" class="SignInLink text-blue-600 font-semibold hover:underline">Log In</a></p>
        </div>
      </form>
    </div>
    <div class="info-content Register left-0 text-left pl-10 pr-36 pb-16 pt-0 absolute top-0 h-full w-1/2 flex justify-center flex-col text-white">
      <h2 class="animation uppercase text-3xl leading-snug" style="--li:17; --S:0;">Welcome</h2>
      <p class="animation text-base" style="--li:18; --S:1;">Indulge in a one of a kind experience</p>
    </div>
  </div>
  <script>
const container = document.querySelector('.container');
    const LoginLink = document.querySelector('.SignInLink');
    const RegisterLink = document.querySelector('.SignUpLink');

    RegisterLink.addEventListener('click', () => {
      container.classList.add('active');
    });

    LoginLink.addEventListener('click', () => {
      container.classList.remove('active');
    });

  </script>
</body>
</html>

