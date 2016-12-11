<?php
declare(strict_types = 1);

namespace AppBundle\Provider;

use FOS\ElasticaBundle\Finder\TransformedFinder;
use Knp\Component\Pager\Paginator;

class ProductProvider
{
    /**
     * @var TransformedFinder
     */
    private $finder;

    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * @var int
     */
    private $resultsOnPage;

    public function __construct(TransformedFinder $finder, Paginator $paginator, int $resultsOnPage)
    {
        $this->finder = $finder;
        $this->paginator = $paginator;
        $this->resultsOnPage = $resultsOnPage;
    }

    public function getPaginatedProducts(int $page)
    {
        $results = $this->finder->createPaginatorAdapter('');

        return $this->paginator->paginate($results, $page, $this->resultsOnPage);
    }
}
