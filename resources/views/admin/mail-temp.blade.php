<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
    <!-- Noto sans serif  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!-- Noto sans -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;700;800;900&display=swap"
        rel="stylesheet">
    <!-- opeb sabs serif -->
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,500&display=swap"
        rel="stylesheet">
    <!-- poppins google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="./asset/css/email.css">
    <style>
        * {
            margin: 0;
            padding: 0;
        }

        .banner-heading {
            font-size: 50px;
            font-weight: 800;
            color: #0a5d8d;
            line-height: 1;
        }

        html {
            font-size: 62.5%;
        }

        body {
            font-family: 'Poppins', 'Noto Sans''Open Sans';
            font-size: 16px;
            line-height: 1.6;
            box-sizing: border-box;
        }

        .poppins {
            font-family: 'Poppins' !important;
        }

        .noto-sans {
            font-family: 'Noto Sans' !important;
        }

        .open-sans {
            font-family: 'Open Sans' !important;
        }

        .font-italic {
            font-style: italic;
        }

        .emg-banner {
            width: 100% !important;
            height: 550px;
        }

        .profile-photo {
            width: 180px;
            height: 180px;
        }

        .profile-card {
            background-color: #d9f2ea;
            border-top: 2px solid #3e766c;
            border-bottom: 2px solid #3e766c;
            border-left: 0;
            border-right: 0;
        }

        .banner-logo {
            left: 100px;
            top: 30px;
            height: 80px;
        }

        .banner-text {
            position: absolute;
            left: 100px;
            top: 40%;
        }

        .border-left-banner {
            border-left: 5px solid #025387;

        }

        .border-left {
            border-left: 7px solid #7dc3b5;
        }

        .text-color {
            color: #296197;
        }

        @media only screen and (max-width: 768px) and (min-width: 767px) {
            .profile-photo {
                width: 100%;
                height: 140px !important;
            }
        }

        @media only screen and (max-width: 766px) and (min-width: 320px) {}

        @media only screen and (max-width: 480px) and (min-width: 300px) {
            .emg-banner {
                width: 100% !important;
                height: 250px;
            }

            .banner-text {
                left: 20px;
                top: 35%;
            }

            .banner-logo {
                left: 20px;
                top: 15px;
                height: 80px;
            }

            .banner-logo {
                height: 50px !important;
            }

            .banner-heading {
                font-size: 16px !important;
            }

            .profile-card-content {
                display: block !important;
            }
        }

        @media only screen and (max-width: 768px) and (min-width: 481px) {
            .emg-banner {
                width: 100% !important;
                height: 320px;
            }

            .banner-logo {
                height: 60px !important;
            }

            .banner-heading {
                font-size: 30px !important;
            }

            .profile-photo {
                width: 200px;
                height: 200px !important;
            }
        }


        .profile-card-content {
            display: flex;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="position-relative">
            <img src="{{ asset('asset/img/R_768.png') }}" class="emg-banner mb-5" alt="email front photo">
            <div>
                <img src="{{ asset('asset/img/logo_150.png') }}" class="position-absolute banner-logo">
            </div>
            <div class="banner-text position-absolute">
                <h1 class="mb-0 pb-0 banner-heading">GRID STABILITY:
                    <h1 class="mb-0 pb-0 banner-heading">BEST PRACTICES</h1>
                    <h1 class="mb-0 pb-0 banner-heading">AROUND THE GLOBE</h1>
                    <div class="border-left-banner ps-3 mt-3">
                        <p class="mb-0">A Round Table Conference Invitation</p>
                        <p>14<sup>th</sup> March, 2023</p>
                    </div>
            </div>
        </div>



        <p class="fw-bold">Dear Sir/ Ma’am,</p>
        <p class="mb-2">Greetings from Wattpower!!</p>
        <p class="mb-2">
            It is our pleasure to invite you to a round table meeting on<span class="fw-bold open-sans font-italic">
                14th March,2023
                at The Quorum, Gurugram,</span> which will focus on <span class="fw-bold open-sans font-italic">“Grid
                Stability: Solar
                Project Design Optimization”.</span></p>
        <p class="mb-2">
            With the increasing number of power electronic controller- based
            systems getting connected to the grid, the stability of voltage, transient
            & frequency gets utmost priority.The local grid condition along with a
            proper grid code arrangement will always play a major role in plant
            generation and consumption.</p>
        <p class="">
            The main objective of the LVRT is to maintain the grid voltage stability.
            During faults generating units like solar PV plant need to contribute to
            voltage stability and shall support voltage.</p>
    </div>
    <div class="container mb-5">
        <div class="card  profile-card">
            <div class="card-body py-5">
                <div class="profile-card-content">
                    <div>
                        <img src="{{ asset('asset/img/profile.png') }}" class="profile-photo" alt="profile photo">
                    </div>
                    <div>
                        <div class="pt-4 ps-5">
                            <h3 class="text-color mb-3 poppins">Mr. Hariram Subramanian,</h3>
                            <h3 class="text-color poppins font-italic">CTO smart PV & Head of German Competence Centre,
                                Huawei</h3>
                            <p>will be available to have an engaging discussion on probable
                                recommendations and best practices around the world on
                                the above mentioned subject. Mr Hariram is also an active
                                member in various VDE/DKE grid code working groups &
                                chairman in ENTSO-E Grid Forming Converters.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <p>This meeting is designed for a small group of technical leaders from the solar developer fraternity and your
            presence is keenly solicited.</p>
        <p class="text-color mb-1  fw-bold open-sans">We look forward to seeing you!</p>
        <p>(Kindly share a line of confirmation)</p>
        <div class="mb-5 mt-5">
            <h2 class="fw-bold font-italic">Sincerely,</h2>
            <h2 class="fw-bold font-italic">Team Wattpower</h2>
        </div>

        <div class="mb-5 border-left ps-4">
            <h3 class="fw-bold mb-0 font-italic">Venue: The Quorum, Gurugram</h3>
            <p class="mb-0">Time: 3:00 pm to 7:00 pm</p>
            <p class="mb-0">Followed by Networking Dinner</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
