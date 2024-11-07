<!-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Animated Login/Signup Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    /* Custom animations */
    .fade-in {
      opacity: 0;
      animation: fadeIn 1s forwards;
    }

    @keyframes fadeIn {
      to {
        opacity: 1;
      }
    }
    .slide-in {
      transform: translateX(-100%);
      animation: slideIn 0.8s forwards;
    }

    @keyframes slideIn {
      to {
        transform: translateX(0);
      }
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gradient-to-r from-blue-500 to-purple-600">

  <! Container -->
  <!-- <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg">
    <h2 class="mb-6 text-3xl font-bold text-center text-gray-800">Welcome</h2> -->
    
    <!-- Toggle Buttons -->
    <!-- <div class="flex justify-center mb-6 space-x-4">
      <button id="loginBtn" class="px-4 py-2 font-semibold text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Login</button>
      <button id="signupBtn" class="px-4 py-2 font-semibold text-blue-500 border border-blue-500 rounded hover:bg-blue-500 hover:text-white focus:outline-none focus:ring focus:ring-blue-300">Signup</button>
    </div> -->

    <!-- Login Form -->
    <!-- <form id="loginForm" class="fade-in">
      <input type="email" placeholder="Email" class="w-full px-4 py-2 mb-4 border rounded border-gray-300 focus:outline-none focus:ring focus:ring-blue-200">
      <input type="password" placeholder="Password" class="w-full px-4 py-2 mb-4 border rounded border-gray-300 focus:outline-none focus:ring focus:ring-blue-200">
      <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Log In</button>
    </form> -->

    <!-- Signup Form -->
    <!-- <form id="signupForm" class="hidden fade-in">
      <input type="text" placeholder="Full Name" class="w-full px-4 py-2 mb-4 border rounded border-gray-300 focus:outline-none focus:ring focus:ring-blue-200">
      <input type="email" placeholder="Email" class="w-full px-4 py-2 mb-4 border rounded border-gray-300 focus:outline-none focus:ring focus:ring-blue-200">
      <input type="password" placeholder="Password" class="w-full px-4 py-2 mb-4 border rounded border-gray-300 focus:outline-none focus:ring focus:ring-blue-200">
      <input type="password" placeholder="Confirm Password" class="w-full px-4 py-2 mb-4 border rounded border-gray-300 focus:outline-none focus:ring focus:ring-blue-200">
      <button type="submit" class="w-full px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300">Sign Up</button>
    </form>
  </div> -->

  <!-- JavaScript for Toggle -->
  <!-- <script>
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");
    const loginBtn = document.getElementById("loginBtn");
    const signupBtn = document.getElementById("signupBtn");

    loginBtn.addEventListener("click", () => {
      signupForm.classList.add("hidden");
      loginForm.classList.remove("hidden");
      loginForm.classList.add("fade-in");
    });

    signupBtn.addEventListener("click", () => {
      loginForm.classList.add("hidden");
      signupForm.classList.remove("hidden");
      signupForm.classList.add("fade-in");
    });
  </script>
</body>
</html> --> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <style>
    *{
    margin: 0;
padding: 0;
box-sizing: border-box;
font-family: "poppins";
color: #fff;
}
body{
display: flex;
justify-content: center;
align-items: center;
min-height: 100vh;
background: #25252b;
}
.container{
position: relative;
width: 750px;
height: 450px;
border: 2px solid #ff2770;
box-shadow: 0 0 25px #ff2770;
overflow: hidden;
}
.container .form-box{
position: absolute;
top: 0;
width: 50%;
height: 100%;
display: flex;
justify-content: center;
flex-direction: column;}

.form-box.Login{
  left: 0;
  padding: 0 40px;
}

.form-box.Login .animation{
  transform: translateX(0%);
transition: .7s;
opacity: 1;
transition-delay: calc(.1s * var(--S)) ;
}
.container.active .form-box.Login .animation{
transform: translateX(-120%);
opacity: 0;
}

.form-box.Register{
  
  right: 0;
  padding: 0 60px;
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

.form-box h2{
font-size: 32px;
text-align: center;}
.form-box .input-box{
position: relative;
width: 100%;
height: 50px;
margin-top: 25px;}
.input-box input{
width: 100%;
height: 100%;
background: transparent;
border: none;
outline: none;
font-size: 16px;
color: #fff;
font-weight: 600;
border-bottom: 2px solid #fff;
padding-right: 23px;
transition: .5s;
}
.input-box label{
position: absolute;
top: 50%;
left: 0;
transform: translateY(-50%);
font-size: 16px;
color: #fff;
transition: .5s;
}
.input-box input:focus,
.input-box input:valid{

  border-bottom: 2px solid #ff2770;}

.input-box input:focus ~ label,
.input-box input:valid ~ label{
  top: -5px;
  color: #ff2770;}
.input-box i{
position: absolute;
top: 50%;
right: 0;
font-size: 18px;
transform: translateY(-50%);
transition: .5s;
}
.input-box input:focus ~ i,
.input-box input:valid ~ i{
color: #ff2778;
}
.btn{
position: relative;
width: 100%;
height: 45px;
background: transparent;
border-radius: 40px;
cursor: pointer;
font-size: 16px;
font-weight: 600;
border: 2px solid #ff2770;
overflow: hidden;
z-index: 1;
}
.btn::before{
content: "";
position: absolute;
height: 300%;
width: 100%;
background: linear-gradient(#25252b, #ff2770,#25252b, #ff2770);
top: -100%;
left: 0;
z-index: -1;
transition: .5s;
}
.btn:hover:before{
top: 0;
}
.regi-link{
font-size: 14px;
text-align: center;
margin: 20px 0 10px;
}
.regi-link a{
text-decoration: none;
color: #ff2770;
font-weight: 600;
}
.regi-link a:hover{
text-decoration: underline;}

.info-content{
position: absolute;
top: 0;
height: 100%;
width: 50%;
display: flex;
justify-content: center;
flex-direction: column;}
.info-content.Login{
right: 0;
text-align: right;
padding: 0 40px 60px 150px;
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
left: 0;
text-align: left;
padding: 0 150px 60px 40px;
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

.info-content h2{
text-transform: uppercase;
font-size: 36px;
line-height: 1.3}
.info-content p{
font-size: 16px;
}
.container .curved-shape{
position: absolute;
right: 0;
top: -5px;
height: 600px;
width: 850px;
background: linear-gradient(#25252b, #ff2770);
transform: rotate(10deg) skewY(40deg);
transform-origin: bottom right;
transition: 1.5s ease;
transition-delay: 1.6s;
}
.container.active .curved-shape{
  
transform: rotate(0deg) skewY(0deg);
transition-delay: .5s;
}


.container .curved-shape2{
position: absolute;
left: 250px;
top: 100%;
height: 700px;
width: 850px;
background: #25252b;
border-top: 3px solid #ff2770;
transform: rotate(0deg) skewY(0deg);
transform-origin: bottom left;
transition: 1.5s ease;
transition-delay: .5s;
}
.container.active .curved-shape2{
  
  transform: rotate(-11deg) skewY(-41deg);
  transition-delay: 1.2s;
  }

  </style>
</head>
<body>
  <div class="container">
    <div class="curved-shape"></div>
    <div class="curved-shape2"></div>
    <div class="form-box Login">
      <h2 class="animation" style="--D:0; --S:21">Login</h2>
      <form action="#">
        <div class="input-box animation" style="--D:1; --S:22">
          <input type="text" required>
          <label for="">Username</label>
          <i class='bx bx-user'></i>

        </div>
        <div class="input-box animation" style="--D:2; --S:23">
          <input type="password" required>
          <label for="">Password</label>
          <i class='bx bx-lock-alt' ></i>

        </div>
        <div class="input-box animation" style="--D:3; --S:24">
          <button class="btn" type="submit">Login</button>
        </div>
        <div class="regi-link animation" style="--D:4; --S:25">
          <p>Don't have an account? <a href="#" class="SignUpLink">Sign Up</a></p>
        </div>
      </form>
    </div>
    <div class="info-content Login">
      <h2 class="animation" style="--D:0; --S:20">Welcome Back</h2>
      <p class="animation" style="--D:1; --S:21">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet accusantium distinctio error corrupti hic, obcaecati aperiam autem molestiae eius voluptatem, delectus animi earum maxime consectetur ad vel asperiores quaerat minus?</p>
    </div>
    <div class="form-box Register">
      <h2 class="animation" style="--li:17; --S:0;">Sign Up</h2>
      <form action="#">
        <div class="input-box animation" style="--li:18; --S:1;">
          <input type="text" required>
          <label for="">Username</label>
          <i class='bx bx-user'></i>
        </div>
        <div class="input-box animation" style="--li:18; --S:1;">
          <input type="Email" required>
          <label for="">Email</label>
          <i class='bx bx-envelope'></i>
        </div>
        <div class="input-box animation" style="--li:19; --S:2;">
          <input type="password" required>
          <label for="">Password</label>
          <i class='bx bx-lock-alt' ></i>

        </div>
        <div class="input-box animation" style="--li:20; --S:3;">
          <button class="btn" type="submit">Register</button>
        </div>
        <div class="regi-link animation" style="--li:21; --S:4;">
          <p>Don't have an account? <a href="#" class="SignInLink">Sign In</a></p>
        </div>
      </form>
    </div>
    <div class="info-content Register">
      <h2 class="animation" style="--li:17; --S:0;">Welcome Back</h2>
      <p class="animation" style="--li:18; --S:1;">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eveniet accusantium distinctio error corrupti hic, obcaecati aperiam autem molestiae eius voluptatem, delectus animi earum maxime consectetur ad vel asperiores quaerat minus?</p>
    </div>
  </div>
  <script>
   const container = document.querySelector('.container');
const LoginLink=document.querySelector('.SignInLink');
const RegisterLink=document.querySelector('.SignUpLink');
RegisterLink.addEventListener('click', ()=>{
container.classList.add('active');
})
LoginLink.addEventListener('click', ()=>{
container.classList.remove('active');
})
  </script>
</body>
</html>