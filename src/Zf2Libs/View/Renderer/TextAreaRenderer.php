<?php
namespace Zf2Libs\View\Renderer;

use Zend\Form\Element\Textarea;
use Zend\Form\View\Helper\FormTextarea;
use Zend\Json\Json;
use Zend\View\Exception;
use Zend\View\Renderer\TreeRendererInterface;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;
use Zf2Libs\View\Model\Uploader\UploaderModelInterface;
use Zf2Libs\View\Renderer\Exception\InvalidArgumentException;

/**
 * Zf2Libs renderer
 */
class TextAreaRenderer implements Renderer, TreeRendererInterface
{
    /**
     * @var Resolver
     */
    protected $resolver;

    /**
     * @return $this
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * @param Resolver $resolver
     * @return $this
     */
    public function setResolver(Resolver $resolver)
    {
        return $this;
    }

    /**
     * @param UploaderModelInterface $model
     * @param null $values
     * @return string
     * @throws InvalidArgumentException
     */
    public function render($model, $values = null)
    {
        if (!$model instanceof UploaderModelInterface) {
            throw new InvalidArgumentException("Unsupportable type of model, required type UploaderModelInterface");
        }

        $textArea = new Textarea();
        $textArea->setName('response');

        $textAreaViewHelper = new FormTextarea();

        $jsonEncoder = new Json();
        $value = $jsonEncoder->encode($model->getVariables());

        $textArea->setValue($value);

        return $textAreaViewHelper->render($textArea);
    }

    /**
     * Can this renderer render trees of view models?
     *
     * No.
     *
     * @return boolean
     */
    public function canRenderTrees()
    {
        return false;
    }
}
