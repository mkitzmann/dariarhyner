<?php
namespace App\Form;

use App\Entity\Artwork;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ArtworkType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array('label' => 'Title'))
            ->add('series', TextType::class, array('label' => 'Series'))
            ->add('year', IntegerType::class, array('label' => 'Year', 'required' => false))
            ->add('description', TextType::class, array('label' => 'Description', 'required' => false))
             ->add('gridsize', ChoiceType::class, array('label' => 'Grid Size', 'required' => true,  'choices'  => array(
                'Medium' => 'medium',
                'Small' => 'small',
                'Large' => 'large',
            ),))
            ->add('image', FileType::class, array('label' => 'Artwork (Image file)', 'required' => false))
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Artwork::class,
        ));
    }

}