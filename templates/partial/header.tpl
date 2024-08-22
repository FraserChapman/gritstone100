<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ @APP_NAME }}</title>
    <meta name="author" content="{{ @APP_EMAIL }}">
    <link rel="icon" href="{{ @IMG . 'icon/apple-touch-icon.png' }}">
    <link
        href="https://fonts.googleapis.com/css?family=Lato%3A300%2C300italic%2C400%2C400italic%2C700%2C700italic&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ @CSS . 'styles.min.css' }}">
    <include if="{{ @@head }}" href="{{ @head }}" />
</head>

<body id='{{ @id }}-page'>
    <header>
        <a href="/">
            <img src="{{ @IMG . 'icon/logo-bar-trans.png' }}" title="{{ @APP_NAME }}">
        </a>
        <nav>
            <ul>
                <li><a data-active="{{ @id === 'route' }}" href="/route">Route</a></li>
                <li><a data-active="{{ @id === 'map' }}" href="/map">Map</a></li>
                <li><a data-active="{{ @id === 'contact' }}" href="/contact">Contact</a></li>
            </ul>
        </nav>
    </header>