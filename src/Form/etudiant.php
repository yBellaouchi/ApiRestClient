<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
// use Symfony\Component\Form\FormBuilderInterface as FormFormBuilderInterface;
use Symfony\Component\Form\FormBuilderInterface;
class etudiant  extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('nom',TextType::class)
          ->add('prenom',TextType::class)
          ->add('cin',TextType::class)
          ->add('age',TextType::class)
          ->add('filiere',TextType::class);
        
    }

}

?>