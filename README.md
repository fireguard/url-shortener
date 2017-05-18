# URL Shortener

## Installation
This Package can be installed through the composer.

In order for the package to be automatically added to your composer.json file, run the following command:

```php
  composer require fireguard/url-shortener
```
Or if you prefer, add the following snippet manually:
```php
{
  "require": {
    ...
    "fireguard/url-shortener": "^0.1"
  }
}
```

## Usage

Basic instructions for usage.

### Google URL Shortener

Generate Google API Key 
> https://developers.google.com/console/help/generating-dev-keys


```php
$google = new GoogleUrlShortener('YOUR_GOOGLE_KEY');
$url = $google->shorten('https://google.com.br/');
```


### ToLy URL Shortener

```php
$toLy = new Fireguard\UrlShortener\ToLyUrlShortener();
$url = $toLy->shorten('https://google.com.br/');
```
