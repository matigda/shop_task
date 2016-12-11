<?php
declare(strict_types = 1);

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function listAction(Request $request)
    {
        $page = (int) $request->get('page', 1);

        $pagination = $this->get('provider.product')->getPaginatedProducts($page);

        return $this->render('@App/Product/list.html.twig', compact('pagination'));
    }
}
