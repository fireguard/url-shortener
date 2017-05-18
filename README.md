# URL Shortener


## Usage

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
