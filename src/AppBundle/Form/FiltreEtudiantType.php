<?php

namespace AppBundle\Form;

use AppBundle\Entity\Faculte;
use AppBundle\Form\Listener\AddClasse;
use AppBundle\Form\Listener\AddFiliere;
use AppBundle\Model\FiltreEdudiantModel;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FiltreEtudiantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("annee", ChoiceType::class, [
                "label"=>"Année",
                "choices"=>range(2010, 2015),
                "choice_label"=>function($value, $key, $index){
                    return $value;
                }
            ])
            ->add("faculte", EntityType::class, [
                "class"=>Faculte::class,
                "placeholder"=>"",
                "query_builder"=>function(EntityRepository $repo){
                    return $repo->createQueryBuilder("faculte")->orderBy("faculte.nom", "ASC");
                }
            ])
            ->add("submit", SubmitType::class, ["label"=>"Chercher"])
        ;

        $builder->addEventSubscriber(new AddFiliere());
        $builder->addEventSubscriber(new AddClasse());
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class'=>FiltreEdudiantModel::class
        ]);
    }
}
