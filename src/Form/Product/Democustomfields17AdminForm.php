<?php


namespace PrestaShop\Module\Democustomfields17\Form\Product;

use PrestaShopBundle\Form\Admin\Type\CommonAbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Module;
use Symfony\Component\OptionsResolver\OptionsResolver;
use PrestaShop\Module\Democustomfields17\Form\Product\Hooks\HookFieldsBuilderInterface;

class Democustomfields17AdminForm extends CommonAbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $this->addFieldsByHook($options['hookFieldsBuilder'], $builder, $options['module']);
    }
    
    private function addFieldsByHook(
        HookFieldsBuilderInterface $hookFieldsBuilder,
        FormBuilderInterface $builder,
        Module $module
    ) {
        $hookFieldsBuilder
            ->addCustomFields($builder, $module)
            ->add(
                $module->getModuleFormDatasID(), // used to check if datas come from Admin Product form
                'Symfony\Component\Form\Extension\Core\Type\HiddenType',
                ['data' => '1']
            );
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'hookFieldsBuilder' => null,
            'module' => null,
            'allow_extra_fields' => true
        ));
    }
}
