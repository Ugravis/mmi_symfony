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

{% block stylesheets %}
{% endblock %}
```
### Imports
```twig
  {{ asset('/public_file') }}
  {{ path('route_name', {'param_1': var1, 'param_2:' var2 }) }}
```
### Heritage
```twig
{% extends 'example.html.twig' %}
```
### PHP logic
```twig
{% for jeu in jeux %}
  <p>{{ $var.id }}</p>      
{% endfor %}

{% if var1 == var2 %}
{% endif %}
```

## Debug
`dd($var)` : show variable content and stop code execution (abrv: dump, die - from VarDumper - var_dump() en mieux)

## Launch project
Symfony server : `symfony server:start`, `http://127.0.0.1:8000/home`  
XAMPP (depreciated) : `http://localhost/mmi_symfony/public/index.php/home` 
## Ressources
🔗 [Course material](https://docs.mmi-troyes.fr/books/wr319d-wra319d)