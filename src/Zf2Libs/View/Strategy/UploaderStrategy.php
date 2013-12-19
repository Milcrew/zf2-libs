<?php
namespace Zf2Libs\View\Strategy;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Request as HttpRequest;
use Zf2Libs\View\Model\Uploader\UploaderModelInterface;
use Zf2Libs\View\Renderer\TextAreaRenderer;
use Zend\View\ViewEvent;

class UploaderStrategy extends AbstractListenerAggregate
{
    /**
     * Character set for associated content-type
     *
     * @var string
     */
    protected $charset = 'utf-8';

    /**
     * Multibyte character sets that will trigger a binary content-transfer-encoding
     *
     * @var array
     */
    protected $multibyteCharsets = array(
        'UTF-16',
        'UTF-32',
    );

    /**
     * @var TextAreaRenderer
     */
    protected $renderer;

    /**
     * Constructor
     *
     * @param  TextAreaRenderer $renderer
     */
    public function __construct(TextAreaRenderer $renderer)
    {
        $this->renderer = $renderer;
    }

    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = -1)
    {
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RENDERER, array($this, 'selectRenderer'), $priority);
        $this->listeners[] = $events->attach(ViewEvent::EVENT_RESPONSE, array($this, 'injectResponse'), $priority);
    }

    /**
     * Set the content-type character set
     *
     * @param  string $charset
     * @return UploaderStrategy
     */
    public function setCharset($charset)
    {
        $this->charset = (string) $charset;
        return $this;
    }

    /**
     * Retrieve the current character set
     *
     * @return string
     */
    public function getCharset()
    {
        return $this->charset;
    }

    /**
     * Detect if we should use the UploaderRenderer based on model type and/or
     * Accept header
     *
     * @param  ViewEvent $e
     * @return null | TextAreaRenderer
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if (!$model instanceof UploaderModelInterface) {
            return null;
        }
        // JsonModel found
        return $this->renderer;
    }

    /**
     * Inject the response with the "Uploader" behavior and appropriate Content-Type header
     *
     * @param  ViewEvent $e
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();

        if ($renderer !== $this->renderer) {
            return;
        }

        $result   = $e->getResult();
        if (!is_string($result)) {
            return;
        }
        
        // Populate response
        $response = $e->getResponse();

        $result = "<html><head></head><body>".$result."</body></html>";
        $response->setContent($result);


        $headers = $response->getHeaders();

        $headers->addHeaderLine('content-type', 'text/html; charset=' . $this->charset);
        if (in_array(strtoupper($this->charset), $this->multibyteCharsets)) {
            $headers->addHeaderLine('content-transfer-encoding', 'BINARY');
        }
    }
}
