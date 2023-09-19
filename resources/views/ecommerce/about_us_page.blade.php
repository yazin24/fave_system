@extends('ecommerce.navbar')

@section('content')

<div class="">
    <div class="bg-gradient-to-l from-violet-900 via-violet-400 to-blue-100 pt-24">
      <h2 class="text-center font-bold text-3xl text-gray-200">
        About Us
      </h2>
      <div class="flex flex-col md:flex-row md:mx-44">
        <div class="p-8 md:p-12">
          <h2 class="text-2xl text-violet-700 font-bold mb-2">Mission</h2>
          <p class="font-bold text-gray-800">
            TO PROVIDE HIGH QUALITY PRODUCTS AND UNCONDITIONAL CUSTOMER
            SATISFACTION THAT PROMOTES A HEALTHIER, SAFER, CLEANER ENVIRONMENT
            AND MEETING CUSTOMER DEMANDS AND EXPECTATIONS DRIVEN BY CONTINOUS
            RESEARCH AND PRODUCT INNOVATIONS. WE ARE COMMITED TO DELIVERING
            ECO-FRIENDLY AND EFFECTIVE SOLUTIONS WHILE MINIMIZING THE IMPACT
            ON THE PLANET DEVELOPMENT.
          </p>
        </div>
        <div class="p-2 md:p-12 flex justify-center">
          <i class="fa-solid fa-comment-dots text-8xl text-gray-200 md:mt-8"></i>
        </div>
      </div>
      <div class="flex flex-col md:flex-row md:mx-44 ">
        <div class="p-8 md:p-12 ">
          <h2 class="text-2xl text-violet-700 font-bold mb-2">Vision</h2>
          <p class="font-bold text-gray-800">
            DRIVEN BY OUR PASSION FOR CLEANLINESS AND ENVIRONMENTAL
            STEWARDSHIP, WE ARE AIMING TO BECOME THE MOST TRUSTED AND ADMIRED
            BRAND FOR HOMECARE PRODUCTS WORLDWIDE. WE ENVISION A FUTURE WHERE
            OUR INNOVATIVE AND ECO-FRIENDLY SOLUTIONS ARE SYNONYMOUS WITH
            CLEANLINESS AND HYGIENE, SETTING THE BENCHMARK FOR THE INDUSTRY.
            BY FOSTERING A CULTURE OF EXCELLENCE, SUSTAINABILITY, AND
            CONTINUOUS IMPROVEMENT, WE AIM TO INSPIRE AND EMPOWER INDIVIDUALS
            AND BUSINESSES TO EMBRACE A CLEANER AND HEALTHIER LIFESTYLE,
            MAKING A POSITIVE IMPACT ON THE WELL-BEING OF PEOPLE AND THE
            PLANET.
          </p>
        </div>
        <div class="p-8 md:p-12 flex justify-center">
          <FaRegEye class="text-8xl text-gray-200 md:mt-8" />
        </div>
      </div>
      <br></br>
      <hr></hr>
      <br></br>
      <div class="flex flex-col md:flex-row justify-center">
        <div class="p-12 mt-8">
          <h2 class="text-violet-700 font-bold text-2xl">
            Fave E-commerce
          </h2>
          <h2 class="font-bold text-sm">
            8 Calle Industria Bagumbayan Quezon City
          </h2>
          <h2 class="font-bold text-sm">09182687414</h2>
          <h2 class="font-bold text-sm">+298-8343-5</h2>
          <h2 class="font-bold text-sm">faveecommerce@gmail.com</h2>
        </div>
        <div class="p-4 md:p-12 flex justify-center items-center align-center">
          <img src="../images/newlogo.png" class="h-44" />
        </div>
      </div>
    </div>
  </div> 

@endsection