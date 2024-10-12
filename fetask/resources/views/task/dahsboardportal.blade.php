@extends('layout.main')

@section('content')
    @if (session('isLoggedIn'))
        <div class="main-panel">
        @else
            <div class="main-panel col-lg-12">
    @endif
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h2 class="text-center">Dashboard Aplikasi
                            {{-- {{ Session::get('isLoggedIn') }} --}}
                        </h2>
                    </div>
                    <div class="card-body  ">
                        <div class="slider owl-carousel">
                            <div class="row justify-content-center">
                                @foreach ($list as $item)
                                    @php
                                        // Panggil helper function api_url_getimage
                                        $endpoint = api_url_getimage('aplikasi/');
                                    @endphp
                                    <a href={{ $item->link }} target="_blank">
                                        <div class="card  mt-2">
                                            <div class="img">
                                                <img src="{{ $endpoint }}{{ $item->gambar }}" alt="{{ $item->nama }}">
                                            </div>
                                            <div class="content">
                                                <div class="title">
                                                    {{ $item->nama }}
                                                </div>
                                                <p class="sub-title">
                                                    {{ $item->keterangan }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <style>
        :root {
            --bg: #121212;
            --card-bg: #ffffff;
            --border: 1px solid #3c3c3a;
            --shadow: 0px 10px 15px 0.3px rgba(0, 0, 0, 0.411);
            --text: #0a0a0a;
            --sub-text: #909090;

        }

        .slider .card {
            display: flex;
            justify-content: center;
            /* Memastikan gambar berada di tengah secara horizontal */
            align-items: center;
            border: var(--border);
            margin: 3px;
            /* Memastikan gambar berada di tengah secara vertikal */
        }

        .slider .card .img {
            height: 100px;
            margin: 40px;
            width: calc(100% - 32px);
            min-width: 100px;
            max-width: 100px;
            /* Tidak perlu menetapkan lebar atau maksimum lebar jika Anda ingin gambar menyesuaikan konten. */
            /* Add your desired max-width value */
            border-radius: 10px;
            transition: all 0.2s ease;
            overflow: hidden;
        }

        /* .slider .card {
                                                                                                                        flex: 1;
                                                                                                                        margin: 0 10px 10px 8px;
                                                                                                                        background: var(--card-bg);
                                                                                                                        border: var(--border);
                                                                                                                        border-radius: 16px;
                                                                                                                        overflow: hidden;
                                                                                                                    } */

        /* .slider .card .img {
                                                                                                                    height: 80px;
                                                                                                                    margin: 40px;
                                                                                                                    width: calc(100% - 32px);
                                                                                                                    min-width: 100px;
                                                                                                                    max-width: 100px;
                                                                                                                    border-radius: 10px;
                                                                                                                    transition: all 0.2s ease;
                                                                                                                    overflow: hidden;
                                                                                                                    }
                                                                                                                */
        .slider .card .img:hover {
            filter: brightness(75%);
        }

        .slider .card .img img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transition: all 0.2s ease-in-out;
        }

        .slider .card .img img:hover {
            transform: scale(1.1);
            /* Scale up by 10% on hover */
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        }

        .slider .card {
            padding: 10px 20px;
        }

        .card .title {
            text-align: center;
            font-size: 20px;
            font-weight: 500;
            color: var(--text);
        }

        .card .sub-title {
            font-size: 16px;
            font-weight: 400;
            color: var(--sub-text);
            line-height: 20px;
            text-align: center;
            word-wrap: break-word;
            width: 20ch;
        }

        .card p {
            text-align: justify;
            margin: 10px 0;
            color: var(--sub-text);
            line-height: 1.5;
            /* Adjust the line height as needed */
            max-height: 6em;
            /* 4 lines multiplied by the line height (adjust as needed) */
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: normal;
        }

        .card .content button {
            position: absolute;
            width: 50px;
            height: 50px;
            bottom: 10px;
            right: 24px;
            font-size: 20px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            opacity: 0;
            transition: bottom 0.2s ease-out, opacity 0.2s ease-out;
        }
    </style>
@endsection
