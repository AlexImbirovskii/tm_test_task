<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $question = $options['data'];

        $choices = [];
        foreach ($question->getOptions() as $option) {
            $choices[$option->getText()] = $option->getId();
        }

        $builder->add('selectedOptions', ChoiceType::class, [
            'choices' => $choices,
            'expanded' => true,
            'multiple' => true,
            'label' => $question->getText(),
            'mapped' => false,
        ]);

        $builder->add('forceSubmit', HiddenType::class, [
            'data' => '1',
            'mapped' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
