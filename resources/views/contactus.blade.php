@extends('layout')

@section('title', 'Contact Us')

@section('content')
<section class="flex flex-col md:flex-row items-center gap-6 mb-8 mx-auto p-8 md:p-12 bg-white text-gray-800 md:justify-between">
    <div class="flex flex-col space-y-4 w-full md:w-1/2">
        @if (session('success'))
        <div class="flash-message bg-green-500 text-white p-3 rounded-lg">
            {{ session('success') }}
        </div>
        @endif
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Get in Touch</h1>
        <p class="text-md md:text-lg text-gray-600 mb-4">Have a question or want to work together? Drop us a message!</p>
        <form action="{{ route('contacts.store') }}" method="POST" class="space-y-3">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <div class="col-span-1">
                    @error('full_name')
                    <div class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                    <input type="text" name="full_name" placeholder="Full name" value="{{ old('full_name', Auth::check() ? Auth::user()->First_Name . ' ' . Auth::user()->Last_Name : '') }}" class="w-full p-3 rounded-full border border-gray-300 bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition duration-300 focus:outline-none">
                </div>
                <div class="col-span-1">
                    @error('email')
                    <div class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </div>
                    @enderror
                    <input type="email" name="email" placeholder="Email" value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}" class="w-full p-3 rounded-full border border-gray-300 bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition duration-300 focus:outline-none">
                </div>
            </div>
            <div>
                @error('message')
                <div class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </div>
                @enderror
                <textarea name="message" placeholder="Message" class="w-full p-3 rounded-xl border border-gray-300 bg-white text-gray-800 placeholder-gray-500 focus:ring-2 focus:ring-blue-500 transition duration-300 focus:outline-none" rows="4">{{ old('message') }}</textarea>
            </div>
            <button type="submit" class="py-2 px-6 w-full md:w-auto bg-gradient-to-r from-blue-600 to-blue-800 rounded-full font-semibold text-md text-white shadow-md transform transition-transform hover:scale-105 hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Submit</button>
        </form>
    </div>
    <div class="flex justify-center items-center w-full md:w-1/2 max-w-xs md:max-w-md mx-auto animate-bounce-custom">
        <img src="storage/img/CommonImg/Contact.png" alt="Contact" class="w-full rounded-lg">
    </div>
</section>

<div class="flex flex-col md:flex-row items-center gap-6 px-6 md:px-12 py-10 bg-white text-gray-800 rounded-lg shadow-lg">
    <div class="w-full md:w-1/2 rounded-lg overflow-hidden shadow-md transform transition-transform duration-300 hover:scale-105">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d212361.61152701065!2d35.3415633!3d33.7309325!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151f1798849fcae3%3A0xcb7cf8d31d35ce1!2sCity%20Centre%20Beirut!5e0!3m2!1sen!2slb!4v1730239123142!5m2!1sen!2slb"
            width="100%"
            height="350"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"
            referrerpolicy="no-referrer-when-downgrade">
        </iframe>
    </div>

    <div class="w-full md:w-1/2 text-center md:text-left space-y-5">
    <!-- Section Title -->
    <h2 class="text-3xl font-bold text-gray-900">Our Location</h2>
    <p class="text-md text-gray-600">Visit us at our office or contact us through the details below.</p>
    
    <div class="bg-white p-6 rounded-lg shadow-lg">
  <!-- Office Location -->
  <div class="mb-4">
    <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-x-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
        <path fill-rule="evenodd" d="m9.69 18.933.003.001C9.89 19.02 10 19 10 19s.11.02.308-.066l.002-.001.006-.003.018-.008a5.741 5.741 0 0 0 .281-.14c.186-.096.446-.24.757-.433.62-.384 1.445-.966 2.274-1.765C15.302 14.988 17 12.493 17 9A7 7 0 1 0 3 9c0 3.492 1.698 5.988 3.355 7.584a13.731 13.731 0 0 0 2.273 1.765 11.842 11.842 0 0 0 .976.544l.062.029.018.008.006.003ZM10 11.25a2.25 2.25 0 1 0 0-4.5 2.25 2.25 0 0 0 0 4.5Z" clip-rule="evenodd" />
      </svg>
      Office Location
    </h3>
    <p class="text-gray-700 ml-7"><strong>Address:</strong> Hazmieh, Beirut, Lebanon</p>
  </div>

  <!-- Phone -->
  <div class="mb-4">
    <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-x-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
        <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 0 1 3.5 2h1.148a1.5 1.5 0 0 1 1.465 1.175l.716 3.223a1.5 1.5 0 0 1-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 0 0 6.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 0 1 1.767-1.052l3.223.716A1.5 1.5 0 0 1 18 15.352V16.5a1.5 1.5 0 0 1-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 0 1 2.43 8.326 13.019 13.019 0 0 1 2 5V3.5Z" clip-rule="evenodd" />
      </svg>
      Contact Details
    </h3>
    <p class="text-gray-700 ml-7"><strong>Phone:</strong> +961 70771122</p>
  </div>

  <!-- Email -->
  <div>
    <h3 class="text-xl font-semibold text-gray-800 flex items-center gap-x-2">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
        <path fill-rule="evenodd" d="M1 11.27c0-.246.033-.492.099-.73l1.523-5.521A2.75 2.75 0 0 1 5.273 3h9.454a2.75 2.75 0 0 1 2.651 2.019l1.523 5.52c.066.239.099.485.099.732V15a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3.73Zm3.068-5.852A1.25 1.25 0 0 1 5.273 4.5h9.454a1.25 1.25 0 0 1 1.205.918l1.523 5.52c.006.02.01.041.015.062H14a1 1 0 0 0-.86.49l-.606 1.02a1 1 0 0 1-.86.49H8.236a1 1 0 0 1-.894-.553l-.448-.894A1 1 0 0 0 6 11H2.53l.015-.062 1.523-5.52Z" clip-rule="evenodd" />
      </svg>
      Email Us
    </h3>
    <p class="text-gray-700 ml-7"><strong>Email:</strong> <a href="mailto:support@nexis.com" class="text-blue-600 underline hover:text-blue-800 transition duration-200">support@nexis.com</a></p>
  </div>
</div>

</div>

</div>
<style>
    .animate-bounce-custom {
        animation: bounce-custom 2s infinite;
    }

    @keyframes bounce-custom {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-20px);
        }
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    if ($('.flash-message').length) {
        $('.flash-message').delay(3000).fadeOut(500, function() {
            $(this).remove();
        });
    }
</script>
@endsection