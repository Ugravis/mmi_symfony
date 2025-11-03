# Symfony
[![Technos](https://skillicons.dev/icons?i=php,symfony)](https://skillicons.dev)
## Setup
### Create new project
`symfony new app-name —webapp`
### CLI
`symfony console make:controller`  
## Helper
`export PATH="/Applications/XAMPP/xamppfiles/bin:$PATH"`  
`source ~/.zshrc`

`php bin/console debug:router`

## Twig
### Basic syntax
```twig
{{ variable }}
{% logic() %}
{# comment #}
```
### Defined blocks
```twig
{% block main %}
{% endblock %}
```
### Heritage
```twig
{% extends 'example.html.twig' %}
```

## Launch project
Symfony server : `symfony server:start`, `http://127.0.0.1:8000/home`  
XAMPP (depreciated) : `http://localhost/mmi_symfony/public/index.php/home` 
## Ressources
🔗 [Course material](https://docs.mmi-troyes.fr/books/wr319d-wra319d)