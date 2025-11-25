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
symfony console make:form

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
  {{ path('route_name', {'param_1': var1, 'param_2': var2 }) }}
```

### Heritage
```twig
{% extends 'example.html.twig' %}
```

### PHP logic
```twig
{% for jeu in jeux %}
  <p>{{ var.id }}</p>      
{% endfor %}

{% if var1 == var2 %}
{% endif %}
```

## Doctrine ORM
Vocab: **Entity**, **EntityManager**, **Repository**, **migrations**, and **relations** (*many-to-one*, *one-to-many*, *many-to-many* - *unidirectionnelle*, *bidirectionnelle*). 

Collections: les data provenant de relations (ex: game.editor) sont accessibles via Collection, avec les méthodes : `add()`, `remove()`, `contains()`, `isEmpty()`, `toArray()`.  
  
```php
  $entityManager->remove(object: $editor)
```

Après un `persist()`, `remove()`, etc : `flush()` pour commit les modifications dans la bdd. 

```php
  $entityManager->persist($game);
  $entityManager->flush();
```

## Forms

### FormType

```php
  public function buildForm(FormBuilderInterface $builder, array $options): void {
      $builder
        ->add('name', TextType::class, [
          'label' => 'Nom'
        ])
      ;
    }
  }
```

### Affichage Twig
*Ecrire le bouton en html standart n'est pas recommandé, Mais la 'manière Symfony' n'a pas été vue dans ce cours*.
```twig
  {{ form_start(game_form) }}

    {{ form_row(game_form.name) }}
    {{ form_row(game_form.price) }}

    <button type="submit">Send</button>

  {{ form_end(form) }}
```

### Récupération controller

Via `Request` (classe représentant un objet req classique). Egalement méthodes propres à form : `isSubmitted()`, `isValid()`, `getData()`. 

```php
  // Init le form pour l'afficher dans le twig
  $form = $this->createForm(GameType::class, $game);

  // Lier form et requête http
  $form->handleRequest($request);

  if ($form->isSubmitted() && $form->isValid()) {
    $game = $form->getData();
    $entityManager->persist($game);

    // Puis suite des opérations classiques...
    $entityManager->flush();
    return $this->redirectToRoute('app_games_list');
  }
```

## Debug
`dd($var)` : show variable content and stop code execution (abrv: dump, die - from VarDumper - var_dump() en mieux)

## Launch project
### Local
Symfony server : `symfony server:start`, `http://127.0.0.1:8000/home`  
XAMPP (depreciated) : `http://localhost/mmi_symfony/public/index.php/home` 
### MMI VM
http://mmiple.mmi-troyes.fr:8319  
[Phpmyadmin](http://localhost:8080)  
Container : symfony-web

## Ressources
🔗 [Course material](https://docs.mmi-troyes.fr/books/wr319d-wra319d)