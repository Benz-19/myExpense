<?php

//Error Message Handler   
if (isset($_SESSION['success_message'])) {
    echo '<script>const msg = true;</script>';
    echo '<div class ="success">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['success_message']);
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        var success_msgs = document.querySelectorAll('.success');
    
        if (success_msgs.length > 0) {
            success_msgs.forEach(function(msgElement) {
                msgElement.style.color = 'green';
            });
    
            setTimeout(() => {
                window.history.back(); //redirect to the previous page
            }, 9000);
        }
    });
    </script>
    <?php
}

//Success Message Handler 
if (isset($_SESSION['error_message'])) {
    echo '<div class ="error">' . $_SESSION['success_message'] . '</div>';
    unset($_SESSION['error_message']);
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var error_msg = document.querySelectorAll('.error');
            if (error_msg.length > 0) {
                error_msg.forEach(function(msgElm){
                    msgElm.style.color = 'red';
                });
                
                setTimeout(() => {
                    window.history.back(); //redirect to the previous page
                }, 9000);
            }
        });
    </script>
    <?php
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .transLeft:hover {
            transition: all 0.9s ease-in-out;
            transform: translateX(10%);
        }
    </style>
    <title>Login</title>
</head>

<body>
    <section class="relative py-20 2xl:py-40 bg-gray-800 overflow-hidden">
        <img class="hidden lg:block absolute inset-0 mt-32" src="zospace-assets/lines/line-mountain.svg" alt="">
        <img class="hidden lg:block absolute inset-y-0 right-0 -mr-40 -mt-32" src="zospace-assets/lines/line-right-long.svg" alt="">
        <div class="relative container px-4 mx-auto">
            <div class="max-w-5xl mx-auto">
                <div class="flex flex-wrap items-center -mx-4">
                    <div class="w-full lg:w-1/2 px-4">
                        <div class="px-6 lg:px-20 py-12 lg:py-24 bg-gray-600 rounded-lg">
                            <form action="/myExpense/processAuth" method="POST">
                                <h3 class="mb-10 text-2xl text-white font-bold font-heading">Login into your Account</h3>
                                <div class="flex items-center pl-6 mb-3 bg-white rounded-full">
                                    <span class="inline-block pr-3 py-2 border-r border-gray-50">
                                        <svg class="w-5 h-5" width="20" height="21" viewbox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.29593 0.492188C4.81333 0.492188 2.80078 2.50474 2.80078 4.98734C2.80078 7.46993 4.81333 9.48248 7.29593 9.48248C9.77851 9.48248 11.7911 7.46993 11.7911 4.98734C11.7911 2.50474 9.77851 0.492188 7.29593 0.492188ZM3.69981 4.98734C3.69981 3.00125 5.30985 1.39122 7.29593 1.39122C9.28198 1.39122 10.892 3.00125 10.892 4.98734C10.892 6.97342 9.28198 8.58346 7.29593 8.58346C5.30985 8.58346 3.69981 6.97342 3.69981 4.98734Z" fill="black"></path>
                                            <path d="M5.3126 10.3816C2.38448 10.3816 0.103516 13.0524 0.103516 16.2253V19.8214C0.103516 20.0696 0.304772 20.2709 0.55303 20.2709H14.0385C14.2867 20.2709 14.488 20.0696 14.488 19.8214C14.488 19.5732 14.2867 19.3719 14.0385 19.3719H1.00255V16.2253C1.00255 13.4399 2.98344 11.2806 5.3126 11.2806H9.27892C10.5443 11.2806 11.6956 11.9083 12.4939 12.9335C12.6465 13.1293 12.9289 13.1644 13.1248 13.0119C13.3207 12.8594 13.3558 12.5769 13.2033 12.381C12.2573 11.1664 10.8566 10.3816 9.27892 10.3816H5.3126Z" fill="black"></path>
                                            <rect x="15" y="15" width="5" height="1" rx="0.5" fill="black"></rect>
                                            <rect x="17" y="18" width="5" height="1" rx="0.5" transform="rotate(-90 17 18)" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <input class="w-full pl-4 pr-6 py-4 font-bold placeholder-gray-900 rounded-r-full focus:outline-none" type="email" placeholder="example@user.com" name="email">
                                </div>
                                <div class="flex items-center pl-6 mb-3 bg-white rounded-full">
                                    <span class="inline-block pr-3 py-2 border-r border-gray-50">
                                        <svg class="w-5 h-5" width="17" height="21" viewbox="0 0 17 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.184 8.48899H15.2011V6.25596C15.2011 2.6897 12.3193 0 8.49924 0C4.67919 0 1.7974 2.6897 1.7974 6.25596V8.48899H1.81568C0.958023 9.76774 0.457031 11.3049 0.457031 12.9569C0.457031 17.3921 4.06482 21 8.49924 21C12.9341 21 16.5424 17.3922 16.5428 12.9569C16.5428 11.3049 16.0417 9.76774 15.184 8.48899ZM2.69098 6.25596C2.69098 3.14895 5.13312 0.893578 8.49924 0.893578C11.8654 0.893578 14.3075 3.14895 14.3075 6.25596V7.39905C12.8423 5.86897 10.7804 4.91468 8.49966 4.91468C6.21837 4.91468 4.15607 5.86946 2.69098 7.40017V6.25596ZM8.49966 20.1064C4.55762 20.1064 1.35061 16.8989 1.35061 12.9569C1.35061 9.01534 4.5572 5.80826 8.49924 5.80826C12.4422 5.80826 15.6488 9.01534 15.6492 12.9569C15.6492 16.8989 12.4426 20.1064 8.49966 20.1064Z" fill="black"></path>
                                            <path d="M8.49957 8.93567C7.26775 8.93567 6.26562 9.93779 6.26562 11.1696C6.26562 11.8679 6.60247 12.5283 7.1592 12.9474V14.7439C7.1592 15.4829 7.76062 16.0843 8.49957 16.0843C9.2381 16.0843 9.83994 15.4829 9.83994 14.7439V12.9474C10.3966 12.5278 10.7335 11.8679 10.7335 11.1696C10.7335 9.93779 9.7309 8.93567 8.49957 8.93567ZM9.16793 12.3228C9.03032 12.4023 8.94636 12.5502 8.94636 12.7088V14.7439C8.94636 14.9906 8.74572 15.1907 8.49957 15.1907C8.25342 15.1907 8.05278 14.9906 8.05278 14.7439V12.7088C8.05278 12.5502 7.96833 12.4032 7.83072 12.3228C7.41026 12.078 7.1592 11.6468 7.1592 11.1696C7.1592 10.4307 7.76062 9.82925 8.49957 9.82925C9.2381 9.82925 9.83994 10.4307 9.83994 11.1696C9.83994 11.6468 9.58881 12.078 9.16793 12.3228Z" fill="black"></path>
                                        </svg>
                                    </span>
                                    <input class="w-full pl-4 pr-6 py-4 font-bold placeholder-gray-900 rounded-r-full focus:outline-none" type="password" placeholder="Password" name="password">
                                </div>

                                <button class="py-4 w-full bg-blue-500 hover:bg-blue-600 text-white font-bold rounded-full transition duration-200 transLeft">Get started</button>
                            </form>
                            <div class="flex flex-col mt-8">
                                <i class="text-white">Don't have an account?</i>
                                <a href="/myExpense/sign-up">
                                    <button class="mt-2 py-4 w-20 bg-green-500 hover:bg-blue-600 text-black font-bold transition duration-200 transLeft" name="submitLogin">sign-up</button>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 px-4 mb-16 lg:mb-0">
                        <div class="max-w-md">
                            <h2 class="mt-8 mb-12 text-5xl font-bold font-heading text-white">continue your journey by signing into your account.</h2>
                            <p class="text-lg text-gray-200">
                                <span>Your wallet</span>
                                <span class="text-white">will be alive.</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
