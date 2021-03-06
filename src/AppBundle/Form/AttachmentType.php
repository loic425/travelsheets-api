<?php
/**
 * Created by PhpStorm.
 * User: quentinmachard
 * Date: 10/08/2017
 * Time: 14:22
 */

namespace AppBundle\Form;


use AppBundle\Entity\Attachment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AttachmentType extends AbstractType
{
    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
           'label' => 'form.name',
        ));

        $builder->add('file', FileType::class, array(
            'label' => 'form.file',
            'property_path' => 'uploadedFile',
            'required' => in_array('Upload', $options['validation_groups']),
        ));

        $builder->add('save', SubmitType::class, array(
            'label' => 'actions.save',
        ));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Attachment::class,
            'validation_groups' => array('Upload', 'Default'),
        ));
    }
}