<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  @vite('resources/css/app.css')
  @vite('resources/css/login.css')
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body class="flex justify-center items-center min-h-screen" style="background-image: url('/storage/login/background3.png'); background-size: cover; background-position: center;">'
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
          <button class="btn relative text-white w-full h-16 bg-transparent rounded-full cursor-pointer text-lg font-semibold border-2 border-blue-600 overflow-hidden z-10" type="submit">Login</button>
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
          <input type="Email" class="w-full h-full bg-transparent border-0 outline-none text-[#1E4189]font-semibold border-b-2 border-blue pr-6 transition-all duration-500" required>
          <label for="">Email</label>
          <i class='bx bx-envelope'></i>
        </div>
        <div class="input-box animation relative w-full h-12 mt-6" style="--li:20; --S:3;">
          <input type="password" class="w-full h-full bg-transparent border-0 outline-none text-blue-600 font-semibold border-b-2 border-blue pr-6 transition-all duration-500" required>
          <label for="">Password</label>
          <i class='bx bx-lock-alt' ></i>

        </div>
        <div class="input-box animation relative w-full h-12 mt-6" style="--li:21; --S:4;">
          <button class="btn relative w-full text-white h-16 bg-transparent rounded-full cursor-pointer text-lg font-semibold border-2 border-blue-600 overflow-hidden z-10" type="submit">Register</button>
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

