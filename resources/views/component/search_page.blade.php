<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="web_template/css/antd.min.css">
    <link rel="shortcut icon" href="web_template/images/vexere-ico9e92.ico?v=0.0.3">
    <link rel="stylesheet" href="web_template/css/styles.37e156ef.chunk.css">
    <link rel="stylesheet" href="web_template/css/custome.css">
    <script src="web_template/js/_app.js"></script>
    <script src="web_template/js/index.js"></script>
    <script src="web_template/js/limousineLandingPage.js"></script>
    <script src="web_template/js/route.js"></script>
    <script src="web_template/js/fbevents.js"></script>
</head>
<body>
    <div id="__next">
        <div id="loadingContainer" class="loading__LoadingContainer-sc-1dclnqz-0 iEKYSP">
            <div id="loadingWrapper" class="loading__LoadingWrapper-sc-1dclnqz-2 bqdDYP">
            </div>
            {{-- <div class="header-container Navbar__Container-sc-19tf8g-0 hMKwnH"> --}}
                {{-- header --}}
                @include('component.header')
            {{-- </div> --}}
            <div class="route__BodyWrapper-sc-3icvq2-2 Jgmnn">
                @include('component.breadcum')
                @include('component.main_filter')
                <div class="ant-row" style="margin-left: -8px; margin-right: -8px; margin-top: 18px;">
                @include('component.filter')
                @include('component.result')
                </div>
                {{-- filter_main --}}

            </div>
            <div class="footer-container route__FooterContainer-sc-3icvq2-1 knTnTC">
            </div>
        </div>
    </div>
</body>
</html>
