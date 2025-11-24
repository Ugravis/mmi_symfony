# Symfony
[![Technos](https://skillicons.dev/icons?i=php,symfony,mysql)](https://skillicons.dev)

## Setup

### Create new project
`symfony new app-name —webapp`

### CLI
```bash
symfony console make:controller  
symfony console make:entity  
symfony console make:migration  
symfony console make:crud

symfony console doctrine:database:create    
symfony console doctrine:migrations:migrate  
symfony console doctrine:migrations:list  
```

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

## Doctrine ORM
Entity, EntityManager, Repository, migrations, relations (many-to-one, one-to-many, many-to-many - unidirectionnelle, bidirectionnelle). 
Collections methodes : add, remove, contains, isEmpty, toArray. 

## Debug
`dd($var)` : show variable content and stop code execution (abrv: dump, die - from VarDumper - var_dump() en mieux)

## Launch project
### Local
Symfony server : `symfony server:start`, `http://127.0.0.1:8000/home`  
XAMPP (depreciated) : `http://localhost/mmi_symfony/public/index.php/home` 
### MMI VM
http://mmiple.mmi-troyes.fr:8319  
[Phpmyadmin](http://localhost:8080)

## Ressources
🔗 [Course material](https://docs.mmi-troyes.fr/books/wr319d-wra319d)