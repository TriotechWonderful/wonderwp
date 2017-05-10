<?php

namespace WonderWp\Framework\Form\Field;

use WonderWp\Framework\Form\Field\AbstractCategoryField;

class TranslatedCategoryField extends AbstractCategoryField implements OptionsFieldInterface
{

    /**
     * @inheritDoc
     */
    protected function doSetOptions()
    {
        foreach ($this->categories as $category) {
            /** @var \WP_Term $category */
            $this->selectOptions[$category->term_id] = __('term_' . $category->slug, $this->getTextDomain());
        }

        $this->setOptions($this->selectOptions);

        return $this;
    }

}
