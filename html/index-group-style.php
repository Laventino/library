<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .container {
            width: 200px;
        }
        .group-item {
            overflow: scroll;
            display: flex;
            scrollbar-width: none;
        }
        .group-item::-webkit-scrollbar {
            display: none;
        }
        .image-item {
            background-color: #424242;
        }
        .image-item .img-container {
            width: 100%;
            height: 100%;
        }
        .image-item img {
            width: 150px;
            height: 200px;
            object-fit: contain;
        }

    </style>
    <div class="container">
        <div class="group-title">Random Movie</div>
        <div class="group-item">
            <div class="image-item">
                <div class="img-container">
                    <img src="https://img.freepik.com/free-vector/gradient-minimalist-space-movie-poster_742173-6466.jpg?semt=ais_country_boost&w=740" alt="">
                </div>
            </div>
            <div class="image-item">
                <div class="img-container">
                    <img src="https://d1csarkz8obe9u.cloudfront.net/posterpreviews/action-movie-poster-template-design-0f5fff6262fdefb855e3a9a3f0fdd361_screen.jpg?ts=1700270983" alt="">
                </div>
            </div>
        </div>
        <div class="group-title">Harry Potter</div>
        <div class="group-item">
            <div class="image-item">
                <div class="img-container">
                    <img src="https://rukminim2.flixcart.com/image/850/1000/jmkwya80/poster/d/m/e/large-wb-official-licensed-harry-potter-chamber-of-secrets-movie-original-imaf9ggnqwsvayuz.jpeg?q=20&crop=false" alt="">
                </div>
            </div>
            <div class="image-item">
                <div class="img-container">
                    <img src="https://files.ekmcdn.com/allwallpapers/images/harry-potter-poster-61x91.5cm-20-years-of-movie-magic-38326-1-p.jpg" alt="">
                </div>
            </div>
            <div class="image-item">
                <div class="img-container">
                    <img src="https://imgc.allpostersimages.com/img/posters/trends-international-harry-potter-and-the-order-of-the-phoenix-one-sheet_u-L-Q1RFZ180.jpg" alt="">
                </div>
            </div>
        </div>
    </div>
</body>
</html>