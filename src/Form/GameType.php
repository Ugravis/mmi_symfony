<?php

namespace App\Form;

use App\Entity\Editor;
use App\Entity\Game;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom'
            ])
            ->add('duration', IntegerType::class, [
                'label' => 'Durée d\'une partie en minutes'
            ])
            ->add('mini', IntegerType::class, [
                'label' => 'Nombre de joueurs minimum'
            ])
            ->add('max', IntegerType::class, [
                'label' => 'Nombre maximum de joueurs'
            ])
            ->add('photo1', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo 1'
            ])
            ->add('photo2', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo 2'
            ])
            ->add('photo3', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo 3'
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix'
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Nombre d\'exemplaires en stock'
            ])
            ->add('editor', EntityType::class, [
                'label' => 'Editeur',
                'class' => Editor::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
