<?php

namespace Rjbijl\Renderer;

use Rjbijl\Model\StubModel;

/**
 * Rjbijl\Renderer\StubRenderer
 *
 * @author Robert-Jan Bijl <robert-jan@prezent.nl>
 */
class StubRenderer
{
    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * StubRenderer constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(dirname(__DIR__) . '/Resources/views');
        $this->twig = new \Twig_Environment($loader);
    }

    /**
     * Generate the contents of the stub
     *
     * @param StubModel $stub
     * @return string
     */
    public function renderStub(StubModel $stub)
    {
        return $this->twig->render('stub.php.twig', ['stub' => $stub]);
    }
}