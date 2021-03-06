<?php namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use BlogBundle\Entity\Category;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array(
                                    'label' => 'Titre',
                                    'attr' => array('placeholder' => 'Choisir un titre...')))
            ->add('content', TextareaType::class, array('label' => 'Contenu de l\'article'))
            ->add('category', EntityType::class, array(
    								'class' => 'BlogBundle:Category',
                                    'label' => ' ',
    								'choice_label' => 'name',
                                    'placeholder' => 'Choisir une catégorie...',
                                    'required' => true))
            ->add('tags', EntityType::class, array(
                                    'class' => 'BlogBundle:Tag',
                                    'multiple' => true,
                                    'choice_label' => 'name',
                                    'expanded' => false))
            ->add('Ajouter', SubmitType::class);
    }
}