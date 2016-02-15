<?php namespace BlogBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Doctrine\ORM\EntityRepository;
use BlogBundle\Entity\Comment;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author', TextType::class, array(
                                    'label' => 'Pseudo',
                                    'attr' => array('placeholder' => 'Entrer un pseudo...')))
            ->add('content', TextareaType::class, array('label' => 'Contenu de votre message...'))
            ->add('Ajouter', SubmitType::class);
    }
}