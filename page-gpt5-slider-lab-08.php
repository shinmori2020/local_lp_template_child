<?php
/**
 * Template Name: GPT-5 Slider Lab 08（Swiper.js）
 * Description: Swiper.jsライブラリを使用したモダンスライダー実装。CDN読み込み・レスポンシブ対応・バニラJS。
 * Template Post Type: page
 */

if (!defined('ABSPATH')) { exit; }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GPT5 Slider Lab 08 - Swiper.js Implementation</title>
    
    <!-- Swiper.js CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: #f5f7fa;
            line-height: 1.6;
        }

        .gpt5sw-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px;
        }

        .gpt5sw-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .gpt5sw-title {
            font-size: 3rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 15px 0;
            letter-spacing: 0.05em;
        }

        .gpt5sw-subtitle {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin: 0;
            font-weight: 300;
        }

        .gpt5sw-description {
            background: white;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 60px;
        }

        .gpt5sw-description h3 {
            color: #34495e;
            font-size: 1.5rem;
            margin: 0 0 20px 0;
        }

        .gpt5sw-description p {
            color: #7f8c8d;
            margin: 0 0 15px 0;
            line-height: 1.7;
        }

        .gpt5sw-description ul {
            color: #7f8c8d;
            padding-left: 20px;
        }

        .gpt5sw-description li {
            margin-bottom: 8px;
        }

        /* スライダーエリア（準備済み） */
        .gpt5sw-slider-section {
            background: white;
            padding: 60px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .gpt5sw-slider-title {
            text-align: center;
            font-size: 2rem;
            color: #2c3e50;
            margin: 0 0 40px 0;
            font-weight: 600;
        }

        /* レスポンシブ対応 */
        @media (max-width: 768px) {
            .gpt5sw-container {
                padding: 40px 15px;
            }

            .gpt5sw-title {
                font-size: 2.2rem;
            }

            .gpt5sw-subtitle {
                font-size: 1rem;
            }

            .gpt5sw-description {
                padding: 25px;
            }

            .gpt5sw-slider-section {
                padding: 40px 20px;
            }

            .gpt5sw-slider-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 480px) {
            .gpt5sw-title {
                font-size: 1.8rem;
            }

            .gpt5sw-description {
                padding: 20px;
            }

            .gpt5sw-slider-section {
                padding: 30px 15px;
            }
        }

        /* ===== Swiper Slider 01 Styles ===== */
        .gpt5sw-slider-01 {
            margin-top: 30px;
        }

        .gpt5sw-slider-01 .swiper {
            width: 100%;
            height: 500px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
        }

        .gpt5sw-slider-01 .swiper-slide {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            font-size: 1.5rem;
            font-weight: 600;
            text-align: center;
        }

        .gpt5sw-slider-01 .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .gpt5sw-slider-01 .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            padding: 60px 30px 30px;
            color: white;
        }

        .gpt5sw-slider-01 .slide-title {
            font-size: 2rem;
            font-weight: 700;
            margin: 0 0 10px 0;
            line-height: 1.3;
        }

        .gpt5sw-slider-01 .slide-description {
            font-size: 1rem;
            margin: 0;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* Custom Navigation Buttons */
        .gpt5sw-slider-01 .gpt5sw-01-next,
        .gpt5sw-slider-01 .gpt5sw-01-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 50%;
            color: #667eea;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-size: 20px;
            font-weight: 700;
        }

        .gpt5sw-slider-01 .gpt5sw-01-next {
            right: 15px;
        }

        .gpt5sw-slider-01 .gpt5sw-01-next::after {
            content: '›';
        }

        .gpt5sw-slider-01 .gpt5sw-01-prev {
            left: 15px;
        }

        .gpt5sw-slider-01 .gpt5sw-01-prev::after {
            content: '‹';
        }

        .gpt5sw-slider-01 .gpt5sw-01-next:hover,
        .gpt5sw-slider-01 .gpt5sw-01-prev:hover {
            background: rgba(255, 255, 255, 1);
            transform: translateY(-50%) scale(1.1);
        }

        /* External Controls Container */
        .gpt5sw-01-external-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding: 0;
        }

        /* Custom Pagination */
        .gpt5sw-slider-01 .gpt5sw-01-pagination {
            display: flex;
            gap: 8px;
        }

        .gpt5sw-slider-01 .gpt5sw-01-pagination .gpt5sw-bullet {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: #9ca3af;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 600;
            border: 2px solid transparent;
        }

        .gpt5sw-slider-01 .gpt5sw-01-pagination .gpt5sw-bullet:hover {
            background: #6b7280;
            transform: scale(1.1);
        }

        .gpt5sw-slider-01 .gpt5sw-01-pagination .gpt5sw-bullet.active {
            background: #374151;
            border-color: #6b7280;
            transform: scale(1.2);
        }


        /* Custom Controls */
        .gpt5sw-01-controls {
            /* No positioning needed - handled by external-controls flex */
        }

        .gpt5sw-01-info {
            background: #f8f9fa;
            color: #495057;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .gpt5sw-slider-01 .swiper {
                height: 400px;
            }

            .gpt5sw-slider-01 .slide-title {
                font-size: 1.5rem;
            }

            .gpt5sw-slider-01 .slide-content {
                padding: 40px 20px 20px;
            }

            .gpt5sw-slider-01 .gpt5sw-01-next,
            .gpt5sw-slider-01 .gpt5sw-01-prev {
                width: 40px;
                height: 40px;
            }

            .gpt5sw-01-external-controls {
                padding: 0;
            }
        }

        @media (max-width: 480px) {
            .gpt5sw-slider-01 .swiper {
                height: 320px;
            }

            .gpt5sw-slider-01 .slide-title {
                font-size: 1.2rem;
            }

            .gpt5sw-slider-01 .slide-description {
                font-size: 0.9rem;
            }

            .gpt5sw-slider-01 .slide-content {
                padding: 30px 15px 15px;
            }
            
            .gpt5sw-01-external-controls {
                padding: 0;
                flex-direction: column;
                gap: 10px;
                align-items: center;
            }
        }

        /* ===== Swiper Slider 02 Styles (Advanced 3D Parallax) ===== */
        .gpt5sw-slider-02 {
            margin-top: 60px;
        }

        .gpt5sw-slider-02 .swiper {
            width: 100%;
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .gpt5sw-slider-02 .swiper-slide {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(45deg, #667eea 0%, #764ba2 100%);
            overflow: hidden;
        }

        .gpt5sw-slider-02 .swiper-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, rgba(0,0,0,0.6) 100%);
            z-index: 2;
        }

        .gpt5sw-slider-02 .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform: scale(1.1);
            transition: transform 8s ease-out;
        }

        .gpt5sw-slider-02 .swiper-slide-active img {
            transform: scale(1);
        }

        .gpt5sw-slider-02 .slide-content {
            position: absolute;
            top: 40px;
            left: 40px;
            right: 40px;
            bottom: 40px;
            color: white;
            z-index: 3;
            opacity: 0;
            transform: translateY(-30px);
            transition: all 1s ease-out 0.5s;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            gap: 15px;
        }

        .gpt5sw-slider-02 .swiper-slide-active .slide-content {
            opacity: 1;
            transform: translateY(0);
        }

        .gpt5sw-slider-02 .slide-category {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            padding: 4px 12px;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 8px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .gpt5sw-slider-02 .slide-text {
            flex: 1;
            text-align: left;
        }

        .gpt5sw-slider-02 .slide-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin: 0 0 10px 0;
            line-height: 1.1;
            text-shadow: 2px 2px 20px rgba(0, 0, 0, 0.5);
            background: linear-gradient(135deg, #fff 0%, #e0e7ff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .gpt5sw-slider-02 .slide-description {
            font-size: 1.3rem;
            margin: 0;
            line-height: 1.5;
            opacity: 0.95;
            text-shadow: 1px 1px 10px rgba(0, 0, 0, 0.3);
        }

        .gpt5sw-slider-02 .slide-button {
            align-self: flex-start;
        }

        .gpt5sw-slider-02 .slide-cta {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 30px;
            border-radius: 40px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.2);
            white-space: nowrap;
        }

        .gpt5sw-slider-02 .slide-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .gpt5sw-slider-02 .slide-cta::after {
            content: '→';
            transition: transform 0.3s ease;
        }

        .gpt5sw-slider-02 .slide-cta:hover::after {
            transform: translateX(5px);
        }

        /* Advanced Custom Navigation */
        .gpt5sw-slider-02 .gpt5sw-02-next,
        .gpt5sw-slider-02 .gpt5sw-02-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            color: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.4s ease;
            backdrop-filter: blur(20px);
            font-size: 24px;
            font-weight: 700;
        }

        .gpt5sw-slider-02 .gpt5sw-02-next {
            right: 20px;
        }

        .gpt5sw-slider-02 .gpt5sw-02-next::after {
            content: '→';
        }

        .gpt5sw-slider-02 .gpt5sw-02-prev {
            left: 20px;
        }

        .gpt5sw-slider-02 .gpt5sw-02-prev::after {
            content: '←';
        }

        .gpt5sw-slider-02 .gpt5sw-02-next:hover,
        .gpt5sw-slider-02 .gpt5sw-02-prev:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-50%) scale(1.1);
        }


        /* Advanced Thumbnails */
        .gpt5sw-02-thumbnails {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            justify-content: center;
            padding: 0 20px;
        }

        .gpt5sw-02-thumb {
            width: 80px;
            height: 60px;
            border-radius: 10px;
            overflow: hidden;
            cursor: pointer;
            opacity: 0.6;
            transform: scale(0.9);
            transition: all 0.3s ease;
            border: 3px solid transparent;
            position: relative;
        }

        .gpt5sw-02-thumb::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            transition: opacity 0.3s ease;
        }

        .gpt5sw-02-thumb.active {
            opacity: 1;
            transform: scale(1);
            border-color: #667eea;
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.3);
        }

        .gpt5sw-02-thumb.active::after {
            opacity: 0;
        }

        .gpt5sw-02-thumb:hover {
            opacity: 0.8;
            transform: scale(0.95);
        }

        .gpt5sw-02-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Control Panel */
        .gpt5sw-02-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .gpt5sw-02-play-pause {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .gpt5sw-02-play-pause:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .gpt5sw-02-info {
            background: #f8f9fa;
            color: #495057;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.95rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .gpt5sw-02-speed-control {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #f8f9fa;
            padding: 8px 16px;
            border-radius: 20px;
        }

        .gpt5sw-02-speed-btn {
            background: none;
            border: 2px solid #dee2e6;
            color: #495057;
            padding: 6px 12px;
            border-radius: 15px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .gpt5sw-02-speed-btn.active {
            background: #667eea;
            color: white;
            border-color: #667eea;
        }

        .gpt5sw-02-speed-btn:hover:not(.active) {
            border-color: #667eea;
            color: #667eea;
        }

        /* Responsive Design for Slider 02 */
        @media (max-width: 768px) {
            .gpt5sw-slider-02 .swiper {
                height: 500px;
            }

            .gpt5sw-slider-02 .slide-content {
                gap: 15px;
                text-align: center;
                align-items: center;
            }

            .gpt5sw-slider-02 .slide-text {
                text-align: center;
            }

            .gpt5sw-slider-02 .slide-button {
                align-self: center;
            }

            .gpt5sw-slider-02 .slide-title {
                font-size: 2.5rem;
            }

            .gpt5sw-slider-02 .slide-description {
                font-size: 1.1rem;
            }

            .gpt5sw-slider-02 .slide-cta {
                padding: 15px 30px;
                font-size: 1.1rem;
            }

            .gpt5sw-slider-02 .gpt5sw-02-next,
            .gpt5sw-slider-02 .gpt5sw-02-prev {
                width: 50px;
                height: 50px;
                font-size: 20px;
            }

            .gpt5sw-02-thumbnails {
                gap: 10px;
                padding: 0 15px;
            }

            .gpt5sw-02-thumb {
                width: 60px;
                height: 45px;
            }

            .gpt5sw-02-controls {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .gpt5sw-slider-02 .swiper {
                height: 400px;
                border-radius: 15px;
            }

            .gpt5sw-slider-02 .slide-content {
                gap: 12px;
                top: 20px;
                left: 20px;
                right: 20px;
                bottom: 20px;
            }

            .gpt5sw-slider-02 .slide-title {
                font-size: 2rem;
            }

            .gpt5sw-slider-02 .slide-description {
                font-size: 1rem;
            }

            .gpt5sw-slider-02 .slide-cta {
                padding: 12px 24px;
                font-size: 1rem;
            }

            .gpt5sw-02-thumbnails {
                gap: 8px;
            }

            .gpt5sw-02-thumb {
                width: 50px;
                height: 38px;
            }

            .gpt5sw-02-speed-control {
                flex-direction: column;
                gap: 8px;
            }
        }

        /* ===== Swiper Slider 03 Styles (3D Card Coverflow) ===== */
        .gpt5sw-slider-03 {
            margin-top: 60px;
            padding: 40px 0;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            border-radius: 20px;
        }

        .gpt5sw-slider-03 .swiper {
            width: 100%;
            height: 500px;
            padding: 50px 0;
        }

        .gpt5sw-slider-03 .swiper-slide {
            width: 350px;
            height: 400px;
            position: relative;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gpt5sw-slider-03 .swiper-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.1) 100%);
            z-index: 1;
        }

        .gpt5sw-slider-03 .swiper-slide:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }

        .gpt5sw-slider-03 .swiper-slide-active {
            transform: scale(1.05);
            z-index: 2;
        }

        .gpt5sw-slider-03 .slide-image {
            width: 100%;
            height: 60%;
            object-fit: cover;
            border-radius: 20px 20px 0 0;
        }

        .gpt5sw-slider-03 .slide-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: white;
            padding: 20px;
            z-index: 2;
            height: 40%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: 0 0 20px 20px;
        }

        .gpt5sw-slider-03 .slide-category {
            display: inline-block;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-bottom: 8px;
            align-self: flex-start;
        }

        .gpt5sw-slider-03 .slide-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 8px 0;
            line-height: 1.3;
        }

        .gpt5sw-slider-03 .slide-description {
            font-size: 0.9rem;
            color: #7f8c8d;
            line-height: 1.5;
            margin: 0;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
        }

        .gpt5sw-slider-03 .slide-price {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(255, 255, 255, 0.95);
            color: #e74c3c;
            padding: 8px 12px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 1.1rem;
            z-index: 3;
            backdrop-filter: blur(10px);
        }

        /* Custom Navigation for Slider 03 */
        .gpt5sw-slider-03 .gpt5sw-03-next,
        .gpt5sw-slider-03 .gpt5sw-03-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 50px;
            height: 50px;
            background: white;
            border: 2px solid #667eea;
            border-radius: 50%;
            color: #667eea;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.3s ease;
            font-size: 18px;
            font-weight: 700;
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
        }

        .gpt5sw-slider-03 .gpt5sw-03-next {
            right: 20px;
        }

        .gpt5sw-slider-03 .gpt5sw-03-next::after {
            content: '→';
        }

        .gpt5sw-slider-03 .gpt5sw-03-prev {
            left: 20px;
        }

        .gpt5sw-slider-03 .gpt5sw-03-prev::after {
            content: '←';
        }

        .gpt5sw-slider-03 .gpt5sw-03-next:hover,
        .gpt5sw-slider-03 .gpt5sw-03-prev:hover {
            background: #667eea;
            color: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        /* Pagination Dots for Slider 03 */
        .gpt5sw-03-pagination {
            display: flex;
            justify-content: center;
            gap: 10px;
            margin-top: 30px;
        }

        .gpt5sw-03-pagination .gpt5sw-03-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(102, 126, 234, 0.3);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gpt5sw-03-pagination .gpt5sw-03-dot.active {
            background: #667eea;
            transform: scale(1.3);
        }

        .gpt5sw-03-pagination .gpt5sw-03-dot:hover {
            background: #667eea;
            transform: scale(1.1);
        }

        /* Info Panel for Slider 03 */
        .gpt5sw-03-info {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-top: 25px;
            flex-wrap: wrap;
        }

        .gpt5sw-03-counter {
            background: white;
            color: #2c3e50;
            padding: 10px 20px;
            border-radius: 25px;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .gpt5sw-03-auto-toggle {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .gpt5sw-03-auto-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        /* Responsive Design for Slider 03 */
        @media (max-width: 768px) {
            .gpt5sw-slider-03 .swiper {
                height: 450px;
                padding: 30px 0;
            }

            .gpt5sw-slider-03 .swiper-slide {
                width: 280px;
                height: 350px;
            }

            .gpt5sw-slider-03 .slide-title {
                font-size: 1.2rem;
            }

            .gpt5sw-slider-03 .slide-description {
                font-size: 0.85rem;
            }

            .gpt5sw-slider-03 .gpt5sw-03-next,
            .gpt5sw-slider-03 .gpt5sw-03-prev {
                width: 40px;
                height: 40px;
                font-size: 16px;
            }

            .gpt5sw-03-info {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .gpt5sw-slider-03 {
                margin-top: 40px;
                padding: 30px 10px;
            }

            .gpt5sw-slider-03 .swiper {
                height: 400px;
                padding: 20px 0;
            }

            .gpt5sw-slider-03 .swiper-slide {
                width: 250px;
                height: 320px;
            }

            .gpt5sw-slider-03 .slide-content {
                padding: 15px;
            }

            .gpt5sw-slider-03 .slide-title {
                font-size: 1.1rem;
            }

            .gpt5sw-slider-03 .slide-price {
                font-size: 1rem;
                padding: 6px 10px;
            }
        }

        /* ===== Swiper Slider 04 Styles (Vertical Timeline) ===== */
        .gpt5sw-slider-04 {
            margin-top: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 20px;
            padding: 60px 40px;
            position: relative;
        }

        .gpt5sw-slider-04::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="25" r="1" fill="rgba(255,255,255,0.05)"/><circle cx="50" cy="50" r="1" fill="rgba(255,255,255,0.08)"/><circle cx="25" cy="75" r="1" fill="rgba(255,255,255,0.03)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.06)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            border-radius: 20px;
            z-index: 1;
        }

        .gpt5sw-slider-04 .swiper {
            width: 100%;
            height: 700px;
            position: relative;
            z-index: 2;
        }

        .gpt5sw-slider-04 .swiper-slide {
            height: auto;
            padding: 50px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gpt5sw-slider-04 .timeline-item {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 800px;
            position: relative;
        }

        .gpt5sw-slider-04 .timeline-year {
            flex-shrink: 0;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.15);
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            font-weight: 800;
            color: white;
            backdrop-filter: blur(20px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            position: relative;
            z-index: 3;
        }

        .gpt5sw-slider-04 .timeline-content {
            flex: 1;
            margin-left: 40px;
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 20px;
            backdrop-filter: blur(20px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
            position: relative;
        }

        .gpt5sw-slider-04 .timeline-content::before {
            content: '';
            position: absolute;
            left: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-top: 15px solid transparent;
            border-bottom: 15px solid transparent;
            border-right: 15px solid rgba(255, 255, 255, 0.95);
        }

        .gpt5sw-slider-04 .timeline-title {
            font-size: 1.8rem;
            font-weight: 700;
            color: #2c3e50;
            margin: 0 0 15px 0;
            line-height: 1.3;
        }

        .gpt5sw-slider-04 .timeline-subtitle {
            font-size: 1.1rem;
            font-weight: 500;
            color: #667eea;
            margin: 0 0 20px 0;
        }

        .gpt5sw-slider-04 .timeline-description {
            font-size: 1rem;
            color: #5a6c7d;
            line-height: 1.7;
            margin: 0 0 20px 0;
        }

        .gpt5sw-slider-04 .timeline-highlights {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .gpt5sw-slider-04 .timeline-highlight {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* Timeline Line */
        .gpt5sw-slider-04::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 80px;
            bottom: 80px;
            width: 3px;
            background: linear-gradient(to bottom, transparent 0%, rgba(255,255,255,0.5) 20%, rgba(255,255,255,0.8) 50%, rgba(255,255,255,0.5) 80%, transparent 100%);
            transform: translateX(-50%);
            z-index: 1;
        }

        /* Navigation for Slider 04 */
        .gpt5sw-slider-04 .gpt5sw-04-next,
        .gpt5sw-slider-04 .gpt5sw-04-prev {
            position: absolute;
            right: -70px;
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.9);
            border: 2px solid rgba(102, 126, 234, 0.3);
            border-radius: 50%;
            color: #667eea;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.3s ease;
            font-size: 18px;
            font-weight: 700;
            backdrop-filter: blur(20px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .gpt5sw-slider-04 .gpt5sw-04-next {
            top: 50%;
            transform: translateY(5px);
        }

        .gpt5sw-slider-04 .gpt5sw-04-next::after {
            content: '↓';
        }

        .gpt5sw-slider-04 .gpt5sw-04-prev {
            top: 50%;
            transform: translateY(-65px);
        }

        .gpt5sw-slider-04 .gpt5sw-04-prev::after {
            content: '↑';
        }

        .gpt5sw-slider-04 .gpt5sw-04-next:hover,
        .gpt5sw-slider-04 .gpt5sw-04-prev:hover {
            background: rgba(255, 255, 255, 1);
            border-color: rgba(102, 126, 234, 0.5);
            transform: translateY(5px) scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .gpt5sw-slider-04 .gpt5sw-04-prev:hover {
            transform: translateY(-65px) scale(1.1);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        /* Timeline Progress */
        .gpt5sw-04-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 30px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .gpt5sw-04-progress {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 12px 25px;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: 600;
            backdrop-filter: blur(20px);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .gpt5sw-04-auto-control {
            background: rgba(255, 255, 255, 0.95);
            color: #667eea;
            border: none;
            padding: 12px 25px;
            border-radius: 25px;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .gpt5sw-04-auto-control:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255, 255, 255, 0.3);
        }

        /* Alternative Layout for Even Slides */
        .gpt5sw-slider-04 .swiper-slide:nth-child(even) .timeline-item {
            flex-direction: row-reverse;
        }

        .gpt5sw-slider-04 .swiper-slide:nth-child(even) .timeline-content {
            margin-left: 0;
            margin-right: 40px;
        }

        .gpt5sw-slider-04 .swiper-slide:nth-child(even) .timeline-content::before {
            left: auto;
            right: -15px;
            border-right: none;
            border-left: 15px solid rgba(255, 255, 255, 0.95);
        }

        /* Responsive Design for Slider 04 */
        @media (max-width: 768px) {
            .gpt5sw-slider-04 {
                padding: 40px 20px;
            }

            .gpt5sw-slider-04 .swiper {
                height: 600px;
            }

            .gpt5sw-slider-04 .timeline-year {
                width: 80px;
                height: 80px;
                font-size: 1.4rem;
            }

            .gpt5sw-slider-04 .timeline-content {
                margin-left: 25px;
                padding: 20px;
            }

            .gpt5sw-slider-04 .timeline-title {
                font-size: 1.5rem;
            }

            .gpt5sw-slider-04 .timeline-subtitle {
                font-size: 1rem;
            }

            .gpt5sw-slider-04 .timeline-description {
                font-size: 0.9rem;
            }

            .gpt5sw-slider-04 .swiper-slide:nth-child(even) .timeline-content {
                margin-right: 25px;
            }

            .gpt5sw-04-controls {
                flex-direction: column;
                gap: 15px;
            }

            .gpt5sw-slider-04 .gpt5sw-04-next,
            .gpt5sw-slider-04 .gpt5sw-04-prev {
                right: 15px;
                width: 45px;
                height: 45px;
                font-size: 16px;
            }
        }

        @media (max-width: 480px) {
            .gpt5sw-slider-04 {
                padding: 30px 15px;
            }

            .gpt5sw-slider-04 .swiper {
                height: 500px;
            }

            .gpt5sw-slider-04 .swiper-slide:nth-child(even) .timeline-item,
            .gpt5sw-slider-04 .timeline-item {
                flex-direction: column;
                text-align: center;
            }

            .gpt5sw-slider-04 .timeline-content,
            .gpt5sw-slider-04 .swiper-slide:nth-child(even) .timeline-content {
                margin: 20px 0 0 0;
            }

            .gpt5sw-slider-04 .timeline-content::before,
            .gpt5sw-slider-04 .swiper-slide:nth-child(even) .timeline-content::before {
                display: none;
            }

            .gpt5sw-slider-04 .timeline-year {
                width: 70px;
                height: 70px;
                font-size: 1.2rem;
            }

            .gpt5sw-slider-04 .gpt5sw-04-next,
            .gpt5sw-slider-04 .gpt5sw-04-prev {
                right: 10px;
                width: 40px;
                height: 40px;
                font-size: 14px;
            }
        }

        /* ===== Swiper Slider 05 Styles (Interactive 3D Cube Slider) ===== */
        .gpt5sw-slider-05 {
            margin-top: 60px;
            background: linear-gradient(45deg, #1e3c72 0%, #2a5298 50%, #1e3c72 100%);
            border-radius: 25px;
            padding: 60px 40px;
            position: relative;
            overflow: hidden;
        }

        .gpt5sw-slider-05::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at center, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 20s linear infinite;
            z-index: 1;
        }

        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .gpt5sw-slider-05 .swiper {
            width: 100%;
            height: 500px;
            position: relative;
            z-index: 2;
            overflow: visible;
        }

        .gpt5sw-slider-05 .swiper-slide {
            text-align: center;
            background: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            transition: all 0.6s ease;
            width: 350px;
        }

        .gpt5sw-slider-05 .cube-card {
            width: 300px;
            height: 400px;
            position: relative;
            transform-style: preserve-3d;
            transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
        }

        .gpt5sw-slider-05 .cube-card:hover {
            transform: rotateY(180deg) scale(1.05);
        }

        .gpt5sw-slider-05 .cube-face {
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            backface-visibility: hidden;
        }

        .gpt5sw-slider-05 .cube-front {
            background: linear-gradient(135deg, rgba(255,255,255,0.95) 0%, rgba(255,255,255,0.85) 100%);
            color: #2c3e50;
        }

        .gpt5sw-slider-05 .cube-back {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            transform: rotateY(180deg);
        }

        .gpt5sw-slider-05 .cube-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            margin-bottom: 20px;
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .gpt5sw-slider-05 .cube-back .cube-icon {
            background: linear-gradient(135deg, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0.1) 100%);
            color: white;
        }

        .gpt5sw-slider-05 .cube-title {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0 0 15px 0;
            line-height: 1.3;
        }

        .gpt5sw-slider-05 .cube-description {
            font-size: 1rem;
            line-height: 1.6;
            margin: 0 0 25px 0;
            opacity: 0.9;
        }

        .gpt5sw-slider-05 .cube-stats {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
            width: 100%;
        }

        .gpt5sw-slider-05 .cube-stat {
            text-align: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            backdrop-filter: blur(10px);
        }

        .gpt5sw-slider-05 .stat-number {
            font-size: 1.5rem;
            font-weight: 700;
            display: block;
        }

        .gpt5sw-slider-05 .stat-label {
            font-size: 0.85rem;
            opacity: 0.8;
            margin-top: 5px;
        }

        /* Floating particles effect */
        .gpt5sw-slider-05 .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .gpt5sw-slider-05 .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        .gpt5sw-slider-05 .particle:nth-child(1) { left: 10%; top: 20%; animation-delay: 0s; }
        .gpt5sw-slider-05 .particle:nth-child(2) { left: 20%; top: 80%; animation-delay: 1s; }
        .gpt5sw-slider-05 .particle:nth-child(3) { left: 60%; top: 40%; animation-delay: 2s; }
        .gpt5sw-slider-05 .particle:nth-child(4) { left: 80%; top: 70%; animation-delay: 3s; }
        .gpt5sw-slider-05 .particle:nth-child(5) { left: 70%; top: 10%; animation-delay: 4s; }
        .gpt5sw-slider-05 .particle:nth-child(6) { left: 30%; top: 60%; animation-delay: 5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0px) scale(1); opacity: 0.6; }
            50% { transform: translateY(-20px) scale(1.1); opacity: 1; }
        }

        /* Navigation for Slider 05 */
        .gpt5sw-slider-05 .gpt5sw-05-next,
        .gpt5sw-slider-05 .gpt5sw-05-prev {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50%;
            color: #667eea;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10;
            transition: all 0.4s ease;
            font-size: 20px;
            font-weight: 700;
            backdrop-filter: blur(20px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        }

        .gpt5sw-slider-05 .gpt5sw-05-prev {
            left: 20px;
        }

        .gpt5sw-slider-05 .gpt5sw-05-next {
            right: 20px;
        }

        .gpt5sw-slider-05 .gpt5sw-05-prev::after {
            content: '←';
        }

        .gpt5sw-slider-05 .gpt5sw-05-next::after {
            content: '→';
        }

        .gpt5sw-slider-05 .gpt5sw-05-next:hover,
        .gpt5sw-slider-05 .gpt5sw-05-prev:hover {
            background: #667eea;
            color: white;
            transform: translateY(-50%) scale(1.1);
            box-shadow: 0 12px 40px rgba(102, 126, 234, 0.3);
        }

        /* Pagination */
        .gpt5sw-slider-05 .swiper-pagination {
            bottom: -50px;
        }

        .gpt5sw-slider-05 .swiper-pagination-bullet {
            width: 16px;
            height: 16px;
            background: rgba(255, 255, 255, 0.5);
            opacity: 1;
            margin: 0 10px;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .gpt5sw-slider-05 .swiper-pagination-bullet:hover {
            background: rgba(255, 255, 255, 0.8);
            transform: scale(1.1);
        }

        .gpt5sw-slider-05 .swiper-pagination-bullet-active {
            background: white;
            transform: scale(1.4);
        }

        /* Controls */
        .gpt5sw-05-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 40px;
            padding: 20px 0;
            color: white;
        }

        .gpt5sw-05-counter {
            font-size: 1.2rem;
            font-weight: 600;
        }

        .gpt5sw-05-autoplay {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 12px 24px;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .gpt5sw-05-autoplay:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        /* Responsive Design for Slider 05 */
        @media (max-width: 768px) {
            .gpt5sw-slider-05 {
                padding: 40px 20px;
            }

            .gpt5sw-slider-05 .swiper {
                height: 450px;
            }

            .gpt5sw-slider-05 .cube-card {
                width: 280px;
                height: 370px;
            }

            .gpt5sw-slider-05 .cube-title {
                font-size: 1.5rem;
            }

            .gpt5sw-slider-05 .cube-description {
                font-size: 0.9rem;
            }

            .gpt5sw-slider-05 .gpt5sw-05-next,
            .gpt5sw-slider-05 .gpt5sw-05-prev {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }

            .gpt5sw-slider-05 .gpt5sw-05-prev {
                left: 15px;
            }

            .gpt5sw-slider-05 .gpt5sw-05-next {
                right: 15px;
            }

            .gpt5sw-05-info {
                flex-direction: column;
                gap: 15px;
            }
        }

        @media (max-width: 480px) {
            .gpt5sw-slider-05 {
                padding: 30px 15px;
            }

            .gpt5sw-slider-05 .swiper {
                height: 400px;
            }

            .gpt5sw-slider-05 .cube-card {
                width: 260px;
                height: 340px;
            }

            .gpt5sw-slider-05 .cube-face {
                padding: 25px;
            }

            .gpt5sw-slider-05 .cube-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }

            .gpt5sw-slider-05 .cube-title {
                font-size: 1.3rem;
            }

            .gpt5sw-slider-05 .cube-description {
                font-size: 0.85rem;
            }

            .gpt5sw-slider-05 .gpt5sw-05-next,
            .gpt5sw-slider-05 .gpt5sw-05-prev {
                width: 45px;
                height: 45px;
                font-size: 16px;
            }

            .gpt5sw-slider-05 .gpt5sw-05-prev {
                left: 10px;
            }

            .gpt5sw-slider-05 .gpt5sw-05-next {
                right: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="gpt5sw-container">
        <header class="gpt5sw-header">
            <h1 class="gpt5sw-title">GPT5 Slider Lab 08</h1>
            <p class="gpt5sw-subtitle">Swiper.js Implementation</p>
        </header>

        <section class="gpt5sw-description">
            <h3>Swiper.jsについて</h3>
            <p>
                Swiper.jsは最もモダンなモバイル向けタッチスライダーライブラリです。
                ハードウェアアクセラレーションによる滑らかなアニメーションと、
                優れたタッチジェスチャーサポートが特徴です。
            </p>
            
            <h3>主な特徴</h3>
            <ul>
                <li><strong>軽量・高速</strong> - jQueryなど他ライブラリ不要</li>
                <li><strong>タッチ対応</strong> - モバイル・タブレット完全対応</li>
                <li><strong>豊富な機能</strong> - 自動再生、無限ループ、パララックス等</li>
                <li><strong>カスタマイズ性</strong> - 柔軟な設定とスタイリング</li>
                <li><strong>フレームワーク対応</strong> - React、Vue、Angularなど</li>
            </ul>

            <p>
                このページでは、Swiper.jsを使用した様々なスライダーパターンを実装・検証します。
            </p>
        </section>

        <section class="gpt5sw-slider-section">
            <h2 class="gpt5sw-slider-title">Basic Feature-Rich Slider</h2>
            
            <!-- Swiper Slider 01 -->
            <div class="gpt5sw-slider-01">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <!-- Slides will be dynamically generated by JavaScript -->
                    </div>
                    
                    <!-- Navigation arrows -->
                    <div class="gpt5sw-01-next"></div>
                    <div class="gpt5sw-01-prev"></div>
                    
                </div>
                
                <!-- Controls outside slider -->
                <div class="gpt5sw-01-external-controls">
                    <!-- Pagination -->
                    <div class="gpt5sw-01-pagination"></div>
                    
                    <!-- Custom controls -->
                    <div class="gpt5sw-01-controls">
                        <div class="gpt5sw-01-info">
                            <span id="gpt5sw-01-current">1</span> / <span id="gpt5sw-01-total">6</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="gpt5sw-slider-section">
            <h2 class="gpt5sw-slider-title">Advanced Parallax 3D Slider</h2>
            
            <!-- Swiper Slider 02 -->
            <div class="gpt5sw-slider-02">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <!-- Slides will be dynamically generated by JavaScript -->
                    </div>
                    
                    <!-- Navigation arrows -->
                    <div class="gpt5sw-02-next"></div>
                    <div class="gpt5sw-02-prev"></div>
                </div>
                
                
                <!-- Thumbnails -->
                <div class="gpt5sw-02-thumbnails"></div>
                
                <!-- Control Panel -->
                <div class="gpt5sw-02-controls">
                    <button class="gpt5sw-02-play-pause" id="gpt5sw-02-play-pause">
                        <span id="gpt5sw-02-play-icon">⏸</span>
                        <span>一時停止</span>
                    </button>
                    
                    <div class="gpt5sw-02-info">
                        <span>スライド:</span>
                        <span id="gpt5sw-02-current">1</span> / <span id="gpt5sw-02-total">5</span>
                    </div>
                    
                    <div class="gpt5sw-02-speed-control">
                        <span style="font-size: 0.9rem; color: #6c757d;">速度:</span>
                        <button class="gpt5sw-02-speed-btn" data-speed="2000">遅い</button>
                        <button class="gpt5sw-02-speed-btn active" data-speed="4000">標準</button>
                        <button class="gpt5sw-02-speed-btn" data-speed="1000">高速</button>
                    </div>
                </div>
            </div>
        </section>

        <section class="gpt5sw-slider-section">
            <h2 class="gpt5sw-slider-title">3D Card Coverflow Slider</h2>
            
            <!-- Swiper Slider 03 -->
            <div class="gpt5sw-slider-03">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <!-- Slides will be dynamically generated by JavaScript -->
                    </div>
                    
                    <!-- Navigation arrows -->
                    <div class="gpt5sw-03-next"></div>
                    <div class="gpt5sw-03-prev"></div>
                </div>
                
                <!-- Pagination Dots -->
                <div class="gpt5sw-03-pagination"></div>
                
                <!-- Info Panel -->
                <div class="gpt5sw-03-info">
                    <div class="gpt5sw-03-counter">
                        <span id="gpt5sw-03-current">1</span> / <span id="gpt5sw-03-total">6</span>
                    </div>
                    
                    <button class="gpt5sw-03-auto-toggle" id="gpt5sw-03-auto-toggle">
                        <span id="gpt5sw-03-auto-icon">⏸</span>
                        <span id="gpt5sw-03-auto-text">自動再生停止</span>
                    </button>
                </div>
            </div>
        </section>

        <section class="gpt5sw-slider-section">
            <h2 class="gpt5sw-slider-title">Vertical Timeline Slider</h2>
            
            <!-- Swiper Slider 04 -->
            <div class="gpt5sw-slider-04">
                <div class="swiper">
                    <div class="swiper-wrapper">
                        <!-- Slides will be dynamically generated by JavaScript -->
                    </div>
                    
                    <!-- Navigation arrows -->
                    <div class="gpt5sw-04-prev"></div>
                    <div class="gpt5sw-04-next"></div>
                </div>
                
                <!-- Control Panel -->
                <div class="gpt5sw-04-controls">
                    <div class="gpt5sw-04-progress">
                        <span id="gpt5sw-04-current">2020</span> / <span id="gpt5sw-04-total">2024</span>
                    </div>
                    
                    <button class="gpt5sw-04-auto-control" id="gpt5sw-04-auto-control">
                        <span id="gpt5sw-04-auto-icon">⏸</span>
                        <span id="gpt5sw-04-auto-text">自動進行停止</span>
                    </button>
                </div>
            </div>
        </section>
            
        <!-- Swiper Slider 05 -->
        <section class="gpt5sw-slider-section">
            <h2 class="gpt5sw-slider-title">05. インタラクティブ3Dキューブスライダー</h2>
                <div class="gpt5sw-slider-05">
                    <!-- Floating particles -->
                    <div class="particles">
                        <div class="particle"></div>
                        <div class="particle"></div>
                        <div class="particle"></div>
                        <div class="particle"></div>
                        <div class="particle"></div>
                        <div class="particle"></div>
                    </div>
                    
                    <div class="swiper">
                        <div class="swiper-wrapper">
                            <!-- Slides will be dynamically generated by JavaScript -->
                        </div>
                        
                        <!-- Navigation arrows -->
                        <div class="gpt5sw-05-prev"></div>
                        <div class="gpt5sw-05-next"></div>
                        
                        <!-- Pagination -->
                        <div class="swiper-pagination"></div>
                    </div>
                    
                    <!-- Control Panel -->
                    <div class="gpt5sw-05-info">
                        <div class="gpt5sw-05-counter">
                            <span id="gpt5sw-05-current">1</span> / <span id="gpt5sw-05-total">6</span>
                        </div>
                        
                        <button class="gpt5sw-05-autoplay" id="gpt5sw-05-autoplay">
                            <span id="gpt5sw-05-auto-icon">⏸</span>
                            <span id="gpt5sw-05-auto-text">自動進行停止</span>
                        </button>
                    </div>
                </div>
            </section>
        </section>
    </div>

    <!-- Swiper.js JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        (function() {
            'use strict';

            // Sample data for slider 01
            const slider01Data = [
                {
                    image: 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800&h=500&fit=crop',
                    title: '革新的なビジネスソリューション',
                    description: '最新のテクノロジーを活用して、あなたのビジネスを次のレベルへ導きます。'
                },
                {
                    image: 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=800&h=500&fit=crop',
                    title: 'デジタルマーケティング戦略',
                    description: 'データドリブンなアプローチで、ROIを最大化する効果的なマーケティング戦略を提案します。'
                },
                {
                    image: 'https://images.unsplash.com/photo-1553028826-f4804151e2a0?w=800&h=500&fit=crop',
                    title: 'クリエイティブデザイン',
                    description: 'ユーザー体験を重視したクリエイティブなデザインで、ブランド価値を向上させます。'
                },
                {
                    image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=500&fit=crop',
                    title: 'データ分析・可視化',
                    description: '複雑なデータを分かりやすく可視化し、意思決定をサポートします。'
                },
                {
                    image: 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=800&h=500&fit=crop',
                    title: 'チーム開発・協業',
                    description: '効率的なチーム開発プロセスで、高品質なプロダクトを迅速に提供します。'
                },
                {
                    image: 'https://images.unsplash.com/photo-1559136555-9303baea8ebd?w=800&h=500&fit=crop',
                    title: 'カスタマーサポート',
                    description: '24/7体制の充実したサポートで、お客様の成功を全面的にバックアップします。'
                }
            ];

            // Sample data for slider 02 (Advanced Parallax)
            const slider02Data = [
                {
                    image: 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=1200&h=600&fit=crop',
                    category: 'Technology',
                    title: 'Future Innovation',
                    description: '最先端テクノロジーで未来を創造する革新的なソリューションを提供します。',
                    cta: 'Learn More'
                },
                {
                    image: 'https://images.unsplash.com/photo-1573164713712-03790a178651?w=1200&h=600&fit=crop',
                    category: 'Creative',
                    title: 'Design Excellence',
                    description: 'ユーザー体験を重視したクリエイティブデザインで、ブランド価値を向上させます。',
                    cta: 'View Portfolio'
                },
                {
                    image: 'https://images.unsplash.com/photo-1551434678-e076c223a692?w=1200&h=600&fit=crop',
                    category: 'Business',
                    title: 'Strategic Growth',
                    description: 'データドリブンなビジネス戦略で、持続可能な成長を実現します。',
                    cta: 'Get Started'
                },
                {
                    image: 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=1200&h=600&fit=crop',
                    category: 'Development',
                    title: 'Digital Solutions',
                    description: '高品質なデジタルソリューションで、ビジネスの課題を解決します。',
                    cta: 'Contact Us'
                },
                {
                    image: 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=1200&h=600&fit=crop',
                    category: 'Collaboration',
                    title: 'Team Excellence',
                    description: 'エキスパートチームによる協業で、最高の成果を実現します。',
                    cta: 'Join Team'
                }
            ];

            // Sample data for slider 03 (3D Card Coverflow)
            const slider03Data = [
                {
                    image: 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop',
                    category: 'Electronics',
                    title: 'Wireless Headphones',
                    description: '高品質なワイヤレスヘッドフォン。クリアな音質と快適な装着感を実現。',
                    price: '¥19,800'
                },
                {
                    image: 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=300&fit=crop',
                    category: 'Fashion',
                    title: 'Premium Sneakers',
                    description: 'スタイリッシュで履き心地抜群のプレミアムスニーカー。',
                    price: '¥24,000'
                },
                {
                    image: 'https://images.unsplash.com/photo-1546868871-7041f2a55e12?w=400&h=300&fit=crop',
                    category: 'Watches',
                    title: 'Smart Watch Pro',
                    description: '多機能スマートウォッチ。健康管理から通知まで全てをサポート。',
                    price: '¥45,000'
                },
                {
                    image: 'https://images.unsplash.com/photo-1588508065123-287b28e013da?w=400&h=300&fit=crop',
                    category: 'Bags',
                    title: 'Leather Backpack',
                    description: '本革製の高級バックパック。ビジネスからカジュアルまで対応。',
                    price: '¥32,500'
                },
                {
                    image: 'https://images.unsplash.com/photo-1572635196237-14b3f281503f?w=400&h=300&fit=crop',
                    category: 'Sunglasses',
                    title: 'Designer Sunglasses',
                    description: 'UV保護機能付きデザイナーサングラス。洗練されたスタイル。',
                    price: '¥18,900'
                },
                {
                    image: 'https://images.unsplash.com/photo-1484704849700-f032a568e944?w=400&h=300&fit=crop',
                    category: 'Home',
                    title: 'Premium Coffee Maker',
                    description: 'プロ仕様のコーヒーメーカー。本格的なコーヒーを自宅で楽しめます。',
                    price: '¥89,000'
                }
            ];

            // Sample data for slider 04 (Vertical Timeline)
            const slider04Data = [
                {
                    year: '2020',
                    title: '会社設立',
                    subtitle: '新たなスタートライン',
                    description: '革新的なテクノロジーで社会に貢献することを目指し、小さなオフィスからスタートしました。創業メンバー3名で挑戦を始めました。',
                    highlights: ['スタートアップ', '創業3名', '革新技術']
                },
                {
                    year: '2021',
                    title: '初期プロダクト開発',
                    subtitle: 'MVP完成とユーザーテスト',
                    description: '1年間の開発期間を経て、初期プロダクトが完成。ベータユーザー50名による集中的なテストを実施し、貴重なフィードバックを収集しました。',
                    highlights: ['MVP完成', 'ベータテスト', 'ユーザー50名']
                },
                {
                    year: '2022',
                    title: '正式サービス開始',
                    subtitle: '市場参入とユーザー獲得',
                    description: '正式サービスをローンチし、初月から1000名のユーザー登録を達成。メディアにも取り上げられ、認知度が大幅に向上しました。',
                    highlights: ['正式ローンチ', 'ユーザー1000名', 'メディア掲載']
                },
                {
                    year: '2023',
                    title: '事業拡大とチーム強化',
                    subtitle: '組織成長と新機能追加',
                    description: 'チームメンバーを15名に拡大し、新機能を次々とリリース。ユーザー数は10,000名を突破し、安定したサービス運営を実現しました。',
                    highlights: ['チーム15名', 'ユーザー10000名', '新機能多数']
                },
                {
                    year: '2024',
                    title: '次のステージへ',
                    subtitle: 'グローバル展開の準備',
                    description: '国内市場での地位を確立し、海外展開に向けた準備を開始。新たな投資を受け入れ、さらなる成長に向けて歩みを進めています。',
                    highlights: ['海外展開', '新規投資', '持続成長']
                }
            ];

            // Global variables
            let swiper01 = null;
            let swiper01IsPlaying = true;
            let swiper02 = null;
            let swiper02IsPlaying = true;
            let swiper03 = null;
            let swiper03IsPlaying = true;
            let swiper04 = null;
            let swiper04IsPlaying = true;
            let swiper05 = null;
            let swiper05IsPlaying = true;

            // Sample data for slider 05 (Interactive 3D Cube)
            const slider05Data = [
                {
                    icon: '🚀',
                    title: 'イノベーション',
                    description: '革新的なアイデアと最新技術で、未来を創造します',
                    stat1: { number: '50+', label: 'プロジェクト' },
                    stat2: { number: '95%', label: '成功率' }
                },
                {
                    icon: '🎨',
                    title: 'クリエイティブ',
                    description: '美しいデザインと優れたユーザー体験を提供します',
                    stat1: { number: '200+', label: 'デザイン' },
                    stat2: { number: '4.9★', label: '評価' }
                },
                {
                    icon: '⚡',
                    title: 'パフォーマンス',
                    description: '高速で効率的なソリューションを構築します',
                    stat1: { number: '99.9%', label: '稼働率' },
                    stat2: { number: '<1s', label: '応答速度' }
                },
                {
                    icon: '🛡️',
                    title: 'セキュリティ',
                    description: 'エンタープライズ級のセキュリティで保護します',
                    stat1: { number: '0件', label: '侵害' },
                    stat2: { number: 'ISO27001', label: '認証' }
                },
                {
                    icon: '📈',
                    title: '成長',
                    description: 'ビジネスの継続的な成長をサポートします',
                    stat1: { number: '300%', label: 'ROI' },
                    stat2: { number: '24/7', label: 'サポート' }
                },
                {
                    icon: '🌍',
                    title: 'グローバル',
                    description: '世界中のお客様にサービスを提供しています',
                    stat1: { number: '50+', label: '国' },
                    stat2: { number: '100k+', label: 'ユーザー' }
                }
            ];

            // Swiper.js初期化
            function initSwiperSliders() {
                console.log('Swiper.js が読み込まれました');
                console.log('Swiper version:', typeof Swiper !== 'undefined' ? 'loaded' : 'not loaded');
                
                if (typeof Swiper === 'undefined') {
                    console.error('Swiper.js が読み込まれていません');
                    return;
                }

                console.log('=== Starting Swiper 01 initialization ===');
                
                // Generate slides for slider 01
                console.log('Step 1: Generating slider content');
                generateSlider01Content();
                
                // Initialize Swiper 01
                console.log('Step 2: Initializing Swiper 01 instance');
                initSwiper01();
                
                // Setup custom controls for Swiper 01 (delay to ensure proper initialization)
                setTimeout(() => {
                    console.log('Step 3: Setting up Swiper 01 custom controls');
                    setupSlider01Controls();
                    console.log('=== Swiper 01 initialization complete ===');
                }, 150);

                console.log('=== Starting Swiper 02 initialization ===');
                
                // Generate slides for slider 02
                console.log('Step 1: Generating slider 02 content');
                generateSlider02Content();
                
                // Initialize Swiper 02
                console.log('Step 2: Initializing Swiper 02 instance');
                initSwiper02();
                
                // Setup custom controls for Swiper 02 (delay to ensure proper initialization)
                setTimeout(() => {
                    console.log('Step 3: Setting up Swiper 02 custom controls');
                    setupSlider02Controls();
                    console.log('=== Swiper 02 initialization complete ===');
                }, 200);

                console.log('=== Starting Swiper 03 initialization ===');
                
                // Generate slides for slider 03
                console.log('Step 1: Generating slider 03 content');
                generateSlider03Content();
                
                // Initialize Swiper 03
                console.log('Step 2: Initializing Swiper 03 instance');
                initSwiper03();
                
                // Setup custom controls for Swiper 03 (delay to ensure proper initialization)
                setTimeout(() => {
                    console.log('Step 3: Setting up Swiper 03 custom controls');
                    setupSlider03Controls();
                    console.log('=== Swiper 03 initialization complete ===');
                }, 250);

                console.log('=== Starting Swiper 04 initialization ===');
                
                // Generate slides for slider 04
                console.log('Step 1: Generating slider 04 content');
                generateSlider04Content();
                
                // Initialize Swiper 04
                console.log('Step 2: Initializing Swiper 04 instance');
                initSwiper04();
                
                // Setup custom controls for Swiper 04 (delay to ensure proper initialization)
                setTimeout(() => {
                    console.log('Step 3: Setting up Swiper 04 custom controls');
                    setupSlider04Controls();
                    console.log('=== Swiper 04 initialization complete ===');
                }, 300);

                // Initialize Swiper 05 with delay
                setTimeout(() => {
                    console.log('=== Starting Swiper 05 initialization ===');
                    initSwiper05();
                    console.log('=== Swiper 05 initialization complete ===');
                }, 500);
            }

            // Generate slider 01 content
            function generateSlider01Content() {
                const swiperWrapper = document.querySelector('.gpt5sw-slider-01 .swiper-wrapper');
                if (!swiperWrapper) return;

                swiperWrapper.innerHTML = '';
                
                slider01Data.forEach((slide, index) => {
                    const slideElement = document.createElement('div');
                    slideElement.className = 'swiper-slide';
                    slideElement.innerHTML = `
                        <img src="${slide.image}" alt="${slide.title}" loading="${index === 0 ? 'eager' : 'lazy'}">
                        <div class="slide-content">
                            <h3 class="slide-title">${slide.title}</h3>
                            <p class="slide-description">${slide.description}</p>
                        </div>
                    `;
                    swiperWrapper.appendChild(slideElement);
                });

                // Update total count
                const totalElement = document.getElementById('gpt5sw-01-total');
                if (totalElement) {
                    totalElement.textContent = slider01Data.length;
                }
            }

            // Initialize Swiper 01 with full features
            function initSwiper01() {
                const swiperElement = document.querySelector('.gpt5sw-slider-01 .swiper');
                if (!swiperElement) return;

                swiper01 = new Swiper(swiperElement, {
                    // Basic settings
                    direction: 'horizontal',
                    loop: true,
                    speed: 600,
                    effect: 'slide',
                    
                    // Autoplay
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },

                    // Slides per view
                    slidesPerView: 1,
                    spaceBetween: 0,
                    centeredSlides: true,

                    // Touch settings
                    touchRatio: 1,
                    touchAngle: 45,
                    simulateTouch: true,
                    shortSwipes: true,
                    longSwipes: true,

                    // Keyboard control
                    keyboard: {
                        enabled: true,
                        onlyInViewport: true,
                    },

                    // Mouse wheel
                    mousewheel: {
                        enabled: true,
                        sensitivity: 1,
                    },

                    // Accessibility
                    a11y: {
                        enabled: true,
                        prevSlideMessage: '前のスライド',
                        nextSlideMessage: '次のスライド',
                        firstSlideMessage: '最初のスライド',
                        lastSlideMessage: '最後のスライド',
                    },

                    // Lazy loading
                    lazy: {
                        loadPrevNext: true,
                        loadPrevNextAmount: 2,
                    },

                    // Preloader
                    preloadImages: false,

                    // Watch for changes
                    observer: true,
                    observeParents: true,

                    // Callbacks
                    on: {
                        slideChange: function () {
                            updateSlider01Counter();
                            updateCustomPagination();
                        },
                        init: function () {
                            console.log('Swiper 01 initialized successfully');
                        }
                    }
                });

                // Initialize custom components AFTER Swiper instance is created
                // Use setTimeout to ensure swiper01 variable is properly assigned
                setTimeout(() => {
                    console.log('Initializing custom components...');
                    if (swiper01) {
                        console.log('Swiper instance available, creating custom components');
                        createCustomPagination();
                        updateSlider01Counter();
                        updateCustomPagination();
                    } else {
                        console.error('Swiper instance still not available after timeout');
                    }
                }, 100);
            }

            // Setup custom controls for slider 01
            function setupSlider01Controls() {
                // Navigation buttons
                const nextBtn = document.querySelector('.gpt5sw-01-next');
                const prevBtn = document.querySelector('.gpt5sw-01-prev');
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        if (swiper01) swiper01.slideNext();
                        console.log('Next button clicked');
                    });
                }
                
                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        if (swiper01) swiper01.slidePrev();
                        console.log('Previous button clicked');
                    });
                }
            }

            // Create custom pagination bullets
            function createCustomPagination() {
                const paginationContainer = document.querySelector('.gpt5sw-01-pagination');
                if (!paginationContainer) {
                    console.error('Pagination container not found');
                    return;
                }
                if (!swiper01) {
                    console.error('Swiper instance not available');
                    return;
                }

                paginationContainer.innerHTML = '';
                console.log('Creating pagination for', slider01Data.length, 'slides');
                
                for (let i = 0; i < slider01Data.length; i++) {
                    const bullet = document.createElement('div');
                    bullet.className = 'gpt5sw-bullet';
                    bullet.textContent = i + 1;
                    bullet.addEventListener('click', function() {
                        console.log('Clicked pagination bullet', i + 1);
                        if (swiper01) swiper01.slideToLoop(i);
                    });
                    paginationContainer.appendChild(bullet);
                }
                console.log('Pagination bullets created successfully');
            }

            // Update pagination active state
            function updateCustomPagination() {
                const bullets = document.querySelectorAll('.gpt5sw-01-pagination .gpt5sw-bullet');
                if (!bullets.length) {
                    console.log('No pagination bullets found');
                    return;
                }
                if (!swiper01) {
                    console.log('Swiper instance not available for pagination update');
                    return;
                }

                const currentIndex = swiper01.realIndex;
                console.log('Updating pagination, current slide:', currentIndex + 1);

                bullets.forEach((bullet, index) => {
                    bullet.classList.remove('active');
                    if (index === currentIndex) {
                        bullet.classList.add('active');
                        console.log('Activated pagination bullet:', index + 1);
                    }
                });
            }


            // Update slide counter
            function updateSlider01Counter() {
                const currentElement = document.getElementById('gpt5sw-01-current');
                if (!currentElement) {
                    console.log('Current slide counter element not found');
                    return;
                }
                if (!swiper01) {
                    console.log('Swiper instance not available for counter update');
                    return;
                }
                
                const realIndex = swiper01.realIndex + 1;
                currentElement.textContent = realIndex;
                console.log('Updated slide counter to:', realIndex);
            }

            // ===== SWIPER 02 FUNCTIONS =====

            // Generate slider 02 content
            function generateSlider02Content() {
                const swiperWrapper = document.querySelector('.gpt5sw-slider-02 .swiper-wrapper');
                if (!swiperWrapper) return;

                swiperWrapper.innerHTML = '';
                
                slider02Data.forEach((slide, index) => {
                    const slideElement = document.createElement('div');
                    slideElement.className = 'swiper-slide';
                    slideElement.innerHTML = `
                        <img src="${slide.image}" alt="${slide.title}" loading="${index === 0 ? 'eager' : 'lazy'}">
                        <div class="slide-content" data-swiper-parallax="-300">
                            <div class="slide-text">
                                <div class="slide-category" data-swiper-parallax="-100">${slide.category}</div>
                                <h3 class="slide-title" data-swiper-parallax="-200">${slide.title}</h3>
                                <p class="slide-description" data-swiper-parallax="-150">${slide.description}</p>
                            </div>
                            <div class="slide-button">
                                <a href="#" class="slide-cta" data-swiper-parallax="-50">${slide.cta}</a>
                            </div>
                        </div>
                    `;
                    swiperWrapper.appendChild(slideElement);
                });

                // Update total count
                const totalElement = document.getElementById('gpt5sw-02-total');
                if (totalElement) {
                    totalElement.textContent = slider02Data.length;
                }

                // Generate thumbnails
                generateSlider02Thumbnails();
            }

            // Generate thumbnails for slider 02
            function generateSlider02Thumbnails() {
                const thumbnailContainer = document.querySelector('.gpt5sw-02-thumbnails');
                if (!thumbnailContainer) return;

                thumbnailContainer.innerHTML = '';
                
                slider02Data.forEach((slide, index) => {
                    const thumb = document.createElement('div');
                    thumb.className = 'gpt5sw-02-thumb' + (index === 0 ? ' active' : '');
                    thumb.innerHTML = `<img src="${slide.image}" alt="${slide.title}">`;
                    thumb.addEventListener('click', function() {
                        if (swiper02) swiper02.slideToLoop(index);
                    });
                    thumbnailContainer.appendChild(thumb);
                });
            }

            // Initialize advanced Swiper 02 with parallax and 3D effects
            function initSwiper02() {
                const swiperElement = document.querySelector('.gpt5sw-slider-02 .swiper');
                if (!swiperElement) return;

                swiper02 = new Swiper(swiperElement, {
                    // Basic settings
                    direction: 'horizontal',
                    loop: true,
                    speed: 1000,
                    effect: 'fade',
                    
                    // Fade effect settings
                    fadeEffect: {
                        crossFade: true
                    },

                    // Parallax effect
                    parallax: true,
                    
                    // Autoplay with advanced settings
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                        reverseDirection: false,
                    },

                    // Slides settings
                    slidesPerView: 1,
                    spaceBetween: 0,
                    centeredSlides: true,

                    // Touch settings
                    touchRatio: 1,
                    touchAngle: 45,
                    simulateTouch: true,
                    shortSwipes: true,
                    longSwipes: true,
                    touchStartPreventDefault: false,

                    // Keyboard control
                    keyboard: {
                        enabled: true,
                        onlyInViewport: true,
                    },

                    // Mouse wheel
                    mousewheel: {
                        enabled: true,
                        sensitivity: 1,
                        releaseOnEdges: true,
                    },

                    // Accessibility
                    a11y: {
                        enabled: true,
                        prevSlideMessage: '前のスライド',
                        nextSlideMessage: '次のスライド',
                        firstSlideMessage: '最初のスライド',
                        lastSlideMessage: '最後のスライド',
                    },

                    // Lazy loading
                    lazy: {
                        loadPrevNext: true,
                        loadPrevNextAmount: 2,
                    },

                    // Preloader
                    preloadImages: false,

                    // Watch for changes
                    observer: true,
                    observeParents: true,

                    // Callbacks
                    on: {
                        slideChange: function () {
                            updateSlider02Counter();
                            updateSlider02Thumbnails();
                        },
                        init: function () {
                            console.log('Swiper 02 initialized successfully');
                        }
                    }
                });
            }

            // Setup custom controls for slider 02
            function setupSlider02Controls() {
                // Navigation buttons
                const nextBtn = document.querySelector('.gpt5sw-02-next');
                const prevBtn = document.querySelector('.gpt5sw-02-prev');
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        if (swiper02) swiper02.slideNext();
                    });
                }
                
                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        if (swiper02) swiper02.slidePrev();
                    });
                }

                // Play/Pause button
                const playPauseBtn = document.getElementById('gpt5sw-02-play-pause');
                const playIcon = document.getElementById('gpt5sw-02-play-icon');
                
                if (playPauseBtn) {
                    playPauseBtn.addEventListener('click', function() {
                        if (swiper02IsPlaying) {
                            swiper02.autoplay.stop();
                            playIcon.textContent = '▶';
                            playPauseBtn.querySelector('span:last-child').textContent = '再生';
                            swiper02IsPlaying = false;
                        } else {
                            swiper02.autoplay.start();
                            playIcon.textContent = '⏸';
                            playPauseBtn.querySelector('span:last-child').textContent = '一時停止';
                            swiper02IsPlaying = true;
                        }
                    });
                }

                // Speed control buttons
                const speedButtons = document.querySelectorAll('.gpt5sw-02-speed-btn');
                speedButtons.forEach(button => {
                    button.addEventListener('click', function() {
                        const speed = parseInt(this.getAttribute('data-speed'));
                        
                        // Update active state
                        speedButtons.forEach(btn => btn.classList.remove('active'));
                        this.classList.add('active');
                        
                        // Update autoplay delay
                        if (swiper02 && swiper02.autoplay) {
                            swiper02.autoplay.stop();
                            swiper02.params.autoplay.delay = speed;
                            if (swiper02IsPlaying) {
                                swiper02.autoplay.start();
                            }
                        }
                    });
                });
            }

            // Update slide counter for slider 02
            function updateSlider02Counter() {
                const currentElement = document.getElementById('gpt5sw-02-current');
                if (!currentElement || !swiper02) return;
                
                const realIndex = swiper02.realIndex + 1;
                currentElement.textContent = realIndex;
            }

            // Update thumbnails active state for slider 02
            function updateSlider02Thumbnails() {
                const thumbs = document.querySelectorAll('.gpt5sw-02-thumb');
                if (!thumbs.length || !swiper02) return;

                const currentIndex = swiper02.realIndex;

                thumbs.forEach((thumb, index) => {
                    thumb.classList.remove('active');
                    if (index === currentIndex) {
                        thumb.classList.add('active');
                    }
                });
            }

            // ===== SWIPER 03 FUNCTIONS =====

            // Generate slider 03 content
            function generateSlider03Content() {
                const swiperWrapper = document.querySelector('.gpt5sw-slider-03 .swiper-wrapper');
                if (!swiperWrapper) return;

                swiperWrapper.innerHTML = '';
                
                slider03Data.forEach((slide, index) => {
                    const slideElement = document.createElement('div');
                    slideElement.className = 'swiper-slide';
                    slideElement.innerHTML = `
                        <img src="${slide.image}" alt="${slide.title}" class="slide-image" loading="${index === 0 ? 'eager' : 'lazy'}">
                        <div class="slide-price">${slide.price}</div>
                        <div class="slide-content">
                            <div class="slide-category">${slide.category}</div>
                            <h3 class="slide-title">${slide.title}</h3>
                            <p class="slide-description">${slide.description}</p>
                        </div>
                    `;
                    swiperWrapper.appendChild(slideElement);
                });

                // Update total count
                const totalElement = document.getElementById('gpt5sw-03-total');
                if (totalElement) {
                    totalElement.textContent = slider03Data.length;
                }

                // Generate pagination dots
                generateSlider03Pagination();
            }

            // Generate pagination dots for slider 03
            function generateSlider03Pagination() {
                const paginationContainer = document.querySelector('.gpt5sw-03-pagination');
                if (!paginationContainer) return;

                paginationContainer.innerHTML = '';
                
                slider03Data.forEach((slide, index) => {
                    const dot = document.createElement('div');
                    dot.className = 'gpt5sw-03-dot' + (index === 0 ? ' active' : '');
                    dot.addEventListener('click', function() {
                        if (swiper03) swiper03.slideToLoop(index);
                    });
                    paginationContainer.appendChild(dot);
                });
            }

            // Initialize Swiper 03 with coverflow effect
            function initSwiper03() {
                const swiperElement = document.querySelector('.gpt5sw-slider-03 .swiper');
                if (!swiperElement) return;

                swiper03 = new Swiper(swiperElement, {
                    // Coverflow effect
                    effect: 'coverflow',
                    coverflowEffect: {
                        rotate: 30,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: true,
                    },

                    // Basic settings
                    direction: 'horizontal',
                    loop: true,
                    speed: 600,
                    
                    // Autoplay
                    autoplay: {
                        delay: 3500,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },

                    // Slides settings
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    centeredSlides: true,

                    // Touch settings
                    touchRatio: 1,
                    touchAngle: 45,
                    simulateTouch: true,
                    shortSwipes: true,
                    longSwipes: true,

                    // Keyboard control
                    keyboard: {
                        enabled: true,
                        onlyInViewport: true,
                    },

                    // Mouse wheel
                    mousewheel: {
                        enabled: true,
                        sensitivity: 1,
                    },

                    // Accessibility
                    a11y: {
                        enabled: true,
                        prevSlideMessage: '前のカード',
                        nextSlideMessage: '次のカード',
                        firstSlideMessage: '最初のカード',
                        lastSlideMessage: '最後のカード',
                    },

                    // Lazy loading
                    lazy: {
                        loadPrevNext: true,
                        loadPrevNextAmount: 2,
                    },

                    // Watch for changes
                    observer: true,
                    observeParents: true,

                    // Callbacks
                    on: {
                        slideChange: function () {
                            updateSlider03Counter();
                            updateSlider03Pagination();
                        },
                        init: function () {
                            console.log('Swiper 03 initialized successfully');
                        }
                    }
                });
            }

            // Setup custom controls for slider 03
            function setupSlider03Controls() {
                // Navigation buttons
                const nextBtn = document.querySelector('.gpt5sw-03-next');
                const prevBtn = document.querySelector('.gpt5sw-03-prev');
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        if (swiper03) swiper03.slideNext();
                    });
                }
                
                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        if (swiper03) swiper03.slidePrev();
                    });
                }

                // Auto toggle button
                const autoToggleBtn = document.getElementById('gpt5sw-03-auto-toggle');
                const autoIcon = document.getElementById('gpt5sw-03-auto-icon');
                const autoText = document.getElementById('gpt5sw-03-auto-text');
                
                if (autoToggleBtn) {
                    autoToggleBtn.addEventListener('click', function() {
                        if (swiper03IsPlaying) {
                            swiper03.autoplay.stop();
                            autoIcon.textContent = '▶';
                            autoText.textContent = '自動再生開始';
                            swiper03IsPlaying = false;
                        } else {
                            swiper03.autoplay.start();
                            autoIcon.textContent = '⏸';
                            autoText.textContent = '自動再生停止';
                            swiper03IsPlaying = true;
                        }
                    });
                }
            }

            // Update slide counter for slider 03
            function updateSlider03Counter() {
                const currentElement = document.getElementById('gpt5sw-03-current');
                if (!currentElement || !swiper03) return;
                
                const realIndex = swiper03.realIndex + 1;
                currentElement.textContent = realIndex;
            }

            // Update pagination active state for slider 03
            function updateSlider03Pagination() {
                const dots = document.querySelectorAll('.gpt5sw-03-dot');
                if (!dots.length || !swiper03) return;

                const currentIndex = swiper03.realIndex;

                dots.forEach((dot, index) => {
                    dot.classList.remove('active');
                    if (index === currentIndex) {
                        dot.classList.add('active');
                    }
                });
            }

            // ===== SWIPER 04 FUNCTIONS =====

            // Generate slider 04 content
            function generateSlider04Content() {
                const swiperWrapper = document.querySelector('.gpt5sw-slider-04 .swiper-wrapper');
                if (!swiperWrapper) return;

                swiperWrapper.innerHTML = '';
                
                slider04Data.forEach((slide, index) => {
                    const slideElement = document.createElement('div');
                    slideElement.className = 'swiper-slide';
                    slideElement.innerHTML = `
                        <div class="timeline-item">
                            <div class="timeline-year">${slide.year}</div>
                            <div class="timeline-content">
                                <h3 class="timeline-title">${slide.title}</h3>
                                <p class="timeline-subtitle">${slide.subtitle}</p>
                                <p class="timeline-description">${slide.description}</p>
                                <div class="timeline-highlights">
                                    ${slide.highlights.map(highlight => `<span class="timeline-highlight">${highlight}</span>`).join('')}
                                </div>
                            </div>
                        </div>
                    `;
                    swiperWrapper.appendChild(slideElement);
                });

                // Update total count (show last year)
                const totalElement = document.getElementById('gpt5sw-04-total');
                if (totalElement) {
                    totalElement.textContent = slider04Data[slider04Data.length - 1].year;
                }

                // Update current year (show first year)
                const currentElement = document.getElementById('gpt5sw-04-current');
                if (currentElement) {
                    currentElement.textContent = slider04Data[0].year;
                }
            }

            // Initialize Swiper 04 with vertical direction
            function initSwiper04() {
                const swiperElement = document.querySelector('.gpt5sw-slider-04 .swiper');
                if (!swiperElement) return;

                swiper04 = new Swiper(swiperElement, {
                    // Vertical direction
                    direction: 'vertical',
                    loop: false,
                    speed: 800,
                    
                    // Autoplay
                    autoplay: {
                        delay: 5000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },

                    // Slides settings
                    slidesPerView: 1,
                    spaceBetween: 0,

                    // Touch settings
                    touchRatio: 1,
                    touchAngle: 45,
                    simulateTouch: true,

                    // Keyboard control
                    keyboard: {
                        enabled: true,
                        onlyInViewport: true,
                    },

                    // Mouse wheel
                    mousewheel: {
                        enabled: true,
                        sensitivity: 1,
                    },

                    // Accessibility
                    a11y: {
                        enabled: true,
                        prevSlideMessage: '前の年代',
                        nextSlideMessage: '次の年代',
                        firstSlideMessage: '最初の年代',
                        lastSlideMessage: '最後の年代',
                    },

                    // Watch for changes
                    observer: true,
                    observeParents: true,

                    // Callbacks
                    on: {
                        slideChange: function () {
                            updateSlider04Counter();
                        },
                        init: function () {
                            console.log('Swiper 04 initialized successfully');
                        }
                    }
                });
            }

            // Setup custom controls for slider 04
            function setupSlider04Controls() {
                // Navigation buttons
                const nextBtn = document.querySelector('.gpt5sw-04-next');
                const prevBtn = document.querySelector('.gpt5sw-04-prev');
                
                if (nextBtn) {
                    nextBtn.addEventListener('click', function() {
                        if (swiper04) swiper04.slideNext();
                    });
                }
                
                if (prevBtn) {
                    prevBtn.addEventListener('click', function() {
                        if (swiper04) swiper04.slidePrev();
                    });
                }

                // Auto control button
                const autoControlBtn = document.getElementById('gpt5sw-04-auto-control');
                const autoIcon = document.getElementById('gpt5sw-04-auto-icon');
                const autoText = document.getElementById('gpt5sw-04-auto-text');
                
                if (autoControlBtn) {
                    autoControlBtn.addEventListener('click', function() {
                        if (swiper04IsPlaying) {
                            swiper04.autoplay.stop();
                            autoIcon.textContent = '▶';
                            autoText.textContent = '自動進行開始';
                            swiper04IsPlaying = false;
                        } else {
                            swiper04.autoplay.start();
                            autoIcon.textContent = '⏸';
                            autoText.textContent = '自動進行停止';
                            swiper04IsPlaying = true;
                        }
                    });
                }
            }

            // Update year counter for slider 04
            function updateSlider04Counter() {
                const currentElement = document.getElementById('gpt5sw-04-current');
                if (!currentElement || !swiper04) return;
                
                const currentIndex = swiper04.activeIndex;
                const currentYear = slider04Data[currentIndex]?.year || '2020';
                currentElement.textContent = currentYear;
            }

            // Slider 05: Interactive 3D Cube Slider
            function initSwiper05() {
                const container = document.querySelector('.gpt5sw-slider-05');
                if (!container) return;

                const swiperElement = container.querySelector('.swiper');
                const swiperWrapper = swiperElement.querySelector('.swiper-wrapper');
                const nextBtn = container.querySelector('.gpt5sw-05-next');
                const prevBtn = container.querySelector('.gpt5sw-05-prev');
                const autoplayBtn = container.querySelector('#gpt5sw-05-autoplay');

                // Generate slides from data
                slider05Data.forEach((item, index) => {
                    const slideDiv = document.createElement('div');
                    slideDiv.className = 'swiper-slide';
                    slideDiv.innerHTML = `
                        <div class="cube-card">
                            <div class="cube-face cube-front">
                                <div class="cube-icon">${item.icon}</div>
                                <h3 class="cube-title">${item.title}</h3>
                                <p class="cube-description">${item.description}</p>
                            </div>
                            <div class="cube-face cube-back">
                                <div class="cube-icon">${item.icon}</div>
                                <h3 class="cube-title">詳細情報</h3>
                                <div class="cube-stats">
                                    <div class="cube-stat">
                                        <span class="stat-number">${item.stat1.number}</span>
                                        <div class="stat-label">${item.stat1.label}</div>
                                    </div>
                                    <div class="cube-stat">
                                        <span class="stat-number">${item.stat2.number}</span>
                                        <div class="stat-label">${item.stat2.label}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    swiperWrapper.appendChild(slideDiv);
                });

                // Initialize Swiper
                swiper05 = new Swiper(swiperElement, {
                    slidesPerView: 'auto',
                    spaceBetween: 30,
                    centeredSlides: true,
                    effect: 'coverflow',
                    coverflowEffect: {
                        rotate: 30,
                        stretch: 0,
                        depth: 100,
                        modifier: 2,
                        slideShadows: false,
                    },
                    loop: true,
                    autoplay: {
                        delay: 4000,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: true,
                    },
                    speed: 800,
                    grabCursor: true,
                    pagination: {
                        el: container.querySelector('.swiper-pagination'),
                        clickable: true,
                        dynamicBullets: true,
                    },
                    navigation: {
                        nextEl: nextBtn,
                        prevEl: prevBtn,
                    },
                    on: {
                        slideChange: function() {
                            updateSwiper05Counter();
                        },
                        init: function() {
                            updateSwiper05Counter();
                        },
                    },
                });

                // Autoplay control
                if (autoplayBtn) {
                    autoplayBtn.addEventListener('click', function() {
                        const autoIcon = document.getElementById('gpt5sw-05-auto-icon');
                        const autoText = document.getElementById('gpt5sw-05-auto-text');
                        
                        if (swiper05IsPlaying) {
                            swiper05.autoplay.stop();
                            swiper05IsPlaying = false;
                            autoIcon.textContent = '▶';
                            autoText.textContent = '自動進行開始';
                        } else {
                            swiper05.autoplay.start();
                            swiper05IsPlaying = true;
                            autoIcon.textContent = '⏸';
                            autoText.textContent = '自動進行停止';
                        }
                    });
                }

                console.log('Swiper 05 (Interactive 3D Cube) initialized');
            }

            // Update counter for slider 05
            function updateSwiper05Counter() {
                if (!swiper05) return;
                
                const currentElement = document.getElementById('gpt5sw-05-current');
                const totalElement = document.getElementById('gpt5sw-05-total');
                
                if (currentElement && totalElement) {
                    const realIndex = swiper05.realIndex + 1;
                    const total = slider05Data.length;
                    currentElement.textContent = realIndex;
                    totalElement.textContent = total;
                }
            }


            // DOM読み込み完了後に実行
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initSwiperSliders);
            } else {
                initSwiperSliders();
            }
        })();
    </script>
</body>

<?php get_footer(); ?>