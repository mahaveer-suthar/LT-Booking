@extends('layouts.app')
@section('content')
    <style>
        @prim: #53e3a6;

        .bg-bubbles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;

            z-index: 1;

            li {
                position: absolute;
                list-style: none;
                display: block;
                width: 40px;
                height: 40px;
                background-color: fade(white, 15%);
                bottom: -160px;

                -webkit-animation: square 25s infinite;
                animation: square 25s infinite;

                -webkit-transition-timing-function: linear;
                transition-timing-function: linear;

                &:nth-child(1) {
                    left: 10%;
                }

                &:nth-child(2) {
                    left: 20%;

                    width: 80px;
                    height: 80px;

                    animation-delay: 2s;
                    animation-duration: 17s;
                }

                &:nth-child(3) {
                    left: 25%;
                    animation-delay: 4s;
                }

                &:nth-child(4) {
                    left: 40%;
                    width: 60px;
                    height: 60px;

                    animation-duration: 22s;

                    background-color: fade(white, 25%);
                }

                &:nth-child(5) {
                    left: 70%;
                }

                &:nth-child(6) {
                    left: 80%;
                    width: 120px;
                    height: 120px;

                    animation-delay: 3s;
                    background-color: fade(white, 20%);
                }

                &:nth-child(7) {
                    left: 32%;
                    width: 160px;
                    height: 160px;

                    animation-delay: 7s;
                }

                &:nth-child(8) {
                    left: 55%;
                    width: 20px;
                    height: 20px;

                    animation-delay: 15s;
                    animation-duration: 40s;
                }

                &:nth-child(9) {
                    left: 25%;
                    width: 10px;
                    height: 10px;

                    animation-delay: 2s;
                    animation-duration: 40s;
                    background-color: fade(white, 30%);
                }

                &:nth-child(10) {
                    left: 90%;
                    width: 160px;
                    height: 160px;

                    animation-delay: 11s;
                }
            }
        }

        @-webkit-keyframes square {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-700px) rotate(600deg);
            }
        }

        @keyframes square {
            0% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(-700px) rotate(600deg);
            }
        }

        p {
            background: linear-gradient(to left, #141E30, #243B55);
            font-size: 21px;
            padding: 15px;
            border-radius: 5px;
            margin: 10px;
        }
    </style>
    <div class="wrapper">
        <div class="container">
            <div>
                <h1>Hello {{Auth::user()->name}} 👋</h1>
                <h2>Welocome in LT Booking </h2>
            </div>
        </div>
    @endsection
