<?php

namespace ShopBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;


class ArtikelType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('prijs')
            ->add('omschrijving')
            ->add('staffelGroupsId', null, array('label' => 'Staffel Groep'))
            ->add('btwId', null, array('label' => 'Btw percentage'))
            ->add('categoryId', null, array('label' => 'Product Category'))
            ->add('img', FileType::class, [
                'data_class' => null,
                'empty_data' => $builder->getForm()->getData('Artikel')->getImg(),
                'label' => 'Product afbeelding',
                'required' => false]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ShopBundle\Entity\Artikel'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'shopbundle_artikel';
    }


}
