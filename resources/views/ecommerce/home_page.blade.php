@extends('ecommerce.navbar')

@section('content')

<div class="overflow-x-hidden overflow-y-hidden">
  
  <div class="wrapper flex justify-start items-start">
    
    <span class="flex flex-col flex-col-reverse justify-center items-center lg:flex-row w-full lg:gap-6">

      <section class="animate__animated animate__backInUp flex flex-col items-center justify-center bg-blue-300/10 backdrop-blur-sm drop-shadow-lg shadow-md p-6 m-4 rounded-lg md:w-3/4 lg:w-2/5 lg:ml-24">
        <h2 class="text-sm lg:text-2xl text-center font-bold mb-4 text-amber-500 front-text">
          DISCOVER THE POWER OF PROFESSIONAL-GRADE CLEANING AT YOUR HOME
        </h2>
        <h4 class="text-center text-sm lg:text-lg mb-6 text-gray-500 font-bold">
          Elevate your cleaning game with our industry-leading products that
          deliver unmatched performance. Don't wait, take action and elevate
          your cleaning standards today.
        </h4>
        <a
          href="https://www.facebook.com/profile.php?id=100094725815233"
          class="flex items-center justify-center bg-violet-700 hover:bg-blue-600 text-white font-semibold py-2 px-2 rounded-md w-full md:w-3/4 lg:w-1/2 transition-all duration-200 text-center text-xs lg:text-sm"
          data-aos="fade-up"
          data-aos-easing="ease-out-cubic"
          data-aos-duration="4000"
        >
          CHAT WITH OUR CLEANING EXPERTS
        </a>
      </section>

      <section class="w-full md:w-2/3 lg:w-3/4">
        <img src="{{asset('images/hero_image.png')}}" alt="">
      </section>

  </span>

    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
    <div class="bubble">
      <span class="dot"></span>
    </div>
  </div>

    <div class="px-2 bg-violet-700 p-8">
      <h2 class=" flex justify-center text-center text-md md:text-2xl font-bold text-amber-500 md:mt-8  wow animate__animated animate__fadeInUp "data-wow-duration="1s" data-wow-delay="1s">
        Introducing Our Dishwashing Liquid
      </h2>
      <p class="text-amber-600 flex justify-center text-center mb-8 font-bold wow animate__animated animate__fadeInUp "data-wow-duration="1s" data-wow-delay="1s">
        Experience the cleaning power like never before!
      </p>

      <video src="../images/faveVideo.mp4"
      class="video rounded-sm shadow-md colorlay"
      autoplay
      muted
      controls
      ></video>
    </div>

    {{-- <div class="h-56 min-h-full md:min-h-screen flex justify-center items-center bg-instakit_parallax">
        
    </div> --}}

  <div
    class="flex justify-center items-center mx-4 md:mx-44 lg:mx-96 mt-4"
    data-aos="fade-down"
    data-aos-easing="ease-out-cubic"
    data-aos-duration="4000">


    <div class="flex-col bg-violet-700 p-4 md:p-8 rounded-md mt-10 md:mt-36 shadow-md animate__animated animate__bounceInUp wow animate__animated animate__fadeInUp "data-wow-duration="1s">
      <h2 class="text-gray-200 text-2xl font-bold text-center">
        Why Choose Us?
      </h2>
      <p class="text-gray-200 font-bold text-center mt-2">
        Our journey is driven by a passion for excellence, an unwavering
        commitment to quality, and a deep understanding of our clients'
        needs.
      </p>
    </div>
  </div>

  <div class="flex flex-col mt-16 w-full mb-8">
    <div class="flex flex-col md:flex-row justify-center w-full mb-4">
      <div
        class="p-8 w-full md:w-1/3"
        data-aos="fade-right"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="4000"
      >
        <div class="bg-violet-700 p-4 rounded-md shadow-md my-4 animate__animated animate__bounceInLeft wow animate__animated animate__zoomInLeft "data-wow-duration="1s" >
          <span class="flex flex-row items-center">
            <span>
              <i class="fa-solid fa-user-shield text-gray-200 mr-1 text-2xl"></i>
            </span>
            <span class=" text-lg text-gray-200 font-bold">Safety</span>
          </span>
          <span>
            <p class="text-gray-200 ">
              Safety is paramount, especially when it comes to household
              cleaning products. We offer a good cleaning products that are
              safe to use around people, pets, and the environment. It has a
              clear usage instructions and precautions.
            </p>
          </span>
        </div>
      </div>


      <div
        class="p-8 w-full md:w-1/3"
        data-aos="zoom-in"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="4000"
      >
        <div class="bg-violet-700 p-4 rounded-md shadow-md my-4 animate__animated animate__bounceInUp wow animate__animated animate__zoomInUp "data-wow-duration="1s" >
          <span class="flex flex-row items-center">
            <span>
              <i class="fa-solid fa-hands text-gray-200 mr-1 text-2xl"></i>
            </span>
            <span class=" text-lg text-gray-200 font-bold">
              Versatility
            </span>
          </span>
          <span>
            <p class="text-gray-200 ">
              Our cleaning products can handle multiple cleaning tasks,
              reducing the need for numerous specialized products. It is
              easy and can be used on various surfaces or materials provide
              convenience and cost-effectiveness.
            </p>
          </span>
        </div>
      </div>

      <div
        class="p-8 w-full md:w-1/3"
        data-aos="fade-left"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="4000"
      >
        <div class="bg-violet-700 p-4 rounded-md shadow-md my-4 animate__animated animate__bounceInRight wow animate__animated animate__zoomInRight "data-wow-duration="1s" >
          <span class="flex flex-row items-center">
            <span>
              <i class="fa-solid fa-thumbs-up text-gray-200 mr-1 text-2xl"></i>
            </span>
            <span class=" text-lg text-gray-200 font-bold">
              Effectiveness
            </span>
          </span>
          <span>
            <p class="text-gray-200 ">
              Our cleaning products are effective at removing dirt, grime,
              stains, and other contaminants from various surfaces. It can
              be use to clean efficiently and leave the area or item looking
              and feeling clean.
            </p>
          </span>
        </div>
      </div>
    </div>

    <div class="flex flex-col md:flex-row justify-center w-full mb-4">
      <div
        class="p-8 w-full md:w-1/3"
        data-aos="fade-right"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="4000"
      >
        <div class="bg-violet-700 p-4 rounded-md shadow-md my-4 animate__animated animate__bounceInLeft wow animate__animated animate__zoomInLeft "data-wow-duration="1s" >
          <span class="flex flex-row items-center">
            <span>
              <i class="fa-solid fa-hand-holding-hand text-gray-200 mr-1 text-2xl"></i>
            </span>
            <span class=" text-lg text-gray-200 font-bold">
              Ease Of Use
            </span>
          </span>
          <span>
            <p class="text-gray-200 ">
              Fave cleaning products are designed with user-friendliness in
              mind, ensuring that whether they come in spray, liquid or
              powder, the cleaning process demand minimal effort from the
              user.
            </p>
          </span>
        </div>
      </div>

      <div
        class="p-8 w-full md:w-1/3"
        data-aos="zoom-in"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="4000"
      >
        <div class="bg-violet-700 p-4 rounded-md shadow-md my-4 animate__animated animate__bounceInUp wow animate__animated animate__zoomInUp "data-wow-duration="1s" >
          <span class="flex flex-row items-center">
            <span>
              <i class="fa-solid fa-spray-can-sparkles text-gray-200 mr-1 text-2xl"></i>
            </span>
            <span class=" text-lg text-gray-200 font-bold">
              Fragrance And Residue
            </span>
          </span>
          <span>
            <p class="text-gray-200 ">
              Our good cleaning products leaves a pleasant fragrance after
              cleaning. Additionally, it doesnt leave behind any harmful
              residues that might attract dirt or cause long-term damage to
              the surface.
            </p>
          </span>
        </div>
      </div>

      <div
        class="p-8 w-full md:w-1/3"
        data-aos="fade-left"
        data-aos-easing="ease-out-cubic"
        data-aos-duration="4000"
      >
        <div class="bg-violet-700 p-4 flex flex-col rounded-md shadow-md my-4 animate__animated animate__bounceInRight wow animate__animated animate__zoomInRight "data-wow-duration="1s">
          <span class="flex flex-row items-center">
            <span>
              <i class="fa-brands fa-pagelines text-gray-200 mr-1 text-2xl"></i>
            </span>
            <span class=" text-lg text-gray-200 font-bold">
              Environment Friendly
            </span>
          </span>
          <span>
            <p class="text-gray-200 ">
              With increasing environmental concerns, choosing our cleaning
              products that are eco-friendly and biodegradable is essential.
              These products have a lower impact on the environment during
              manufacturing.
            </p>
          </span>
        </div>
      </div>
    </div>
  </div>


  <div class="h-56 min-h-full md:min-h-screen flex justify-center items-center bg-developer1">
        
  </div>

  <div class= "h-full my-32"> 
    <h2 class="text-3xl font-bold text-center">Testimonials</h2>
    <p class="text-center mt-6">Customer satisfaction is one of our mission. Take a look at our customer reviews to us for your references.</p>
  
      <div class="flex justify-center h-96 mt-12">
            <swiper-container class="mySwiper" pagination="true" pagination-clickable="true" navigation="true" space-between="30"
              centered-slides="true" autoplay-delay="4500" autoplay-disable-on-interaction="false">
              <swiper-slide class="flex flex-col space-y-3  bg-blue-300/10 backdrop-blur-sm drop-shadow-lg shadow-md">
                <img src="../images/review2.jpg" alt="" class="rounded-full h-24">
                <p>Joy P.</p>
                <p class="px-8 text-sm">"Late review kc nagtry muna aq kung ok. And yes suoer ok ang product di aq nadismaya. Kc legit na mabilis makatanggal ng oil sa mga hinuhugasan. Safe and secure din ang pagkakabalot nila sa product. Salamat kay seller at kay kuya rider na nagdeliver ng product. .! "</p>
                 <ul class="mb-8 flex items-center justify-center">
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
            </ul>
              </swiper-slide>
            
               <swiper-slide class="flex flex-col space-y-3  bg-blue-300/10 backdrop-blur-sm drop-shadow-lg shadow-md">
                <img src="../images/review1.jpg" alt="" class="rounded-full h-24">
                <p>jadeanroe</p>
                <p class="px-8 text-sm">"Sobrang bango nang diswashing at mabula kaya nakakatipid ka. Safe na safe yung product kasi nakabubble wrap talaga. Napakaapproachable nang seller. I recommend it to other buyers. "</p>
                 <ul class="mb-8 flex items-center justify-center">
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                 
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
            </ul>
              </swiper-slide>

               <swiper-slide class="flex flex-col space-y-3  bg-blue-300/10 backdrop-blur-sm drop-shadow-lg shadow-md">
                <img src="../images/review3.jpg" alt="" class="rounded-full h-24">
                <p>carolyntrugillotivodocdor</p>
                <p class="px-8 text-sm">Late review kc nagtry muna aq kung ok. And yes super ok ang product di aq nadismaya. Kc legit na mabilis makatanggal ng oil sa mga hinuhugasan. Safe and secure din ang pagkakabalot nila sa product. Salamat kay seller at kay kuya rider na nagdeliver ng product.</p>
                 <ul class="mb-8 flex items-center justify-center">
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
              <li>
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="currentColor"
                  class="h-5 w-5 text-yellow-500"
                >
                  <path
                    fill-rule="evenodd"
                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                    clip-rule="evenodd"
                  />
                </svg>
              </li>
            </ul>
              </swiper-slide>

            </swiper-container>
      </div>
</div>
  
<br>
  <div
    data-aos="fade-right"
    data-aos-easing="ease-out-cubic"
    data-aos-duration="4000">
    <h2 class="md:mx-8 mx-8 mt-14 underline text-xl cursor-pointer animate-bounce">
      <i class="fa-solid fa-phone-volume text-2xl mr-1"></i>Want a Business? Lets talk!
    </h2>
  </div>

  <div
    class="flex flex-col md:flex-row my-24 md:my-8 md:mx-8 mx-4 animate__animated animate__bounceInRight"
    data-aos="fade-left"
    data-aos-easing="ease-out-cubic"
    data-aos-duration="4000"
  >
    <div class="w-full md:w-1/4 p-4">
      <span class="flex flex-row md:flex-row">
        <FaRegArrowAltCircleRight class="text-2xl text-violet-700 cursor-pointer" />
        <h3 class="text-lg ml-2">Setup a Schedule</h3>
      </span>
      <p class="mt-2 md:mt-4">
        Fill up the form below and wait for our cleaning experts to call or
        contact you
      </p>
      <br />
      <hr />
      <br />
    </div>
    <div class="w-full md:w-1/4 p-4">
      <span class="flex flex-row md:flex-row">
        <FaRegArrowAltCircleRight class="text-2xl text-violet-700 cursor-pointer" />
        <h3 class="text-lg ml-2">Talk with us</h3>
      </span>
      <p class="mt-2 md:mt-4">
        Our cleaning experts or agents will talk to you about you starting a business with us
      </p>
      <br />
      <hr />
      <br />
    </div>
    <div class="w-full md:w-1/4 p-4">
      <span class="flex flex-row md:flex-row">
        <FaRegArrowAltCircleRight class="text-2xl text-violet-700 cursor-pointer" />
        <h3 class="text-lg ml-2">Visit our office</h3>
      </span>
      <p class="mt-2 md:mt-4">
        Visit our office for more information about the business opportunity
      </p>
      <br />
      <hr />
      <br />
    </div>
    <div class="w-full md:w-1/4 p-4">
      <span class="flex flex-row md:flex-row">
        <FaRegArrowAltCircleRight class="text-2xl text-violet-700 cursor-pointer" />
        <h3 class="text-lg ml-2">Run your business</h3>
      </span>
      <p class="mt-2 md:mt-4">
        Congrats on your business. Run wild and make money
      </p>
      <br />
      <hr />
      <br />
    </div>
  </div>

  <div class="image-container w-full lg:mx-0">
    <div class="image-color-overlay w-full">
    </div>
  </div>

  
      <div class="h-screen items-center grid grid-cols-1 md:grid-cols-1 lg:grid-cols-2 lg:px-32">
        <div class="wow animate__animated animate__fadeInLeft">
          <div class="mx-10 mt-8">
            <p class="text-sm md:text-lg">
              After setting your appointment, please wait for our cleaning
              expert to contact you. The maximum days of waiting is probably
              3 days.
            </p>
            <p class="font-bold text-2xl text-pink-600 mt-8 text-sm md:text-md">0998-887-3878</p>
            <p class="text-lg not-italic mt-2 text-sm md:text-md">Fave Ecommerce Inc</p>
          </div>
        </div>
        
        
        <div class="rounded-md bg-white md:w-full mt-2 lg:h-4/6 md:mx-10 border-2 mx-4 mt-2 wow animate__animated animate__fadeInRight">
          {{-- <form method="POST" action="{{route('setappointment')}}">
            @csrf --}}
            <div class="px-4 md:px-10 py-10 md:py-20">
              <input class="p-3 w-full rounded-lg border border-gray-200 text-sm" type="text" name="name" placeholder="Name">
              <div class="mt-2 flex flex-row gap-2">
                <input class="p-3 w-3/6 rounded-lg border border-gray-200 text-sm" type="text" name="email" placeholder="Email Address">
                <input class="p-3 w-3/6 rounded-lg border border-gray-200 text-sm" type="text" name="phone" placeholder="Phone Number">
              </div>
              <div class="mt-2">
                <textarea class="w-full rounded-lg pl-2 border border-gray-200 text-sm" name="message"  rows="8" placeholder="Message"></textarea>
              </div>
              <div class="mt-4">
                <div class="font-bold text-red-500 font-xs">
                  @if (session('success'))
                  {{ session('success') }}
                  @endif
              </div>
                <button type="submit" class="text-sm transition ease-in-out over:-translate-y-1 hover:scale-110 inline-block font-medium rounded-lg bg-violet-700 hover:bg-yellow-500 px-5 py-3 text-white sm:w-auto duration-500">
                  Set Appointment
                </button>
              </div>
            </div>
          {{-- </form> --}}
        </div>
      </div>
    
</div>

@endsection