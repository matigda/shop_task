<?php
declare(strict_types = 1);

namespace AppBundle\Controller;

use AppBundle\Form\Model\Product as FormModel;
use AppBundle\Event\ProductAddedEvent;
use AppBundle\Events;
use AppBundle\Form\ProductType;
use Domain\Command\CreateProductCommand;
use Domain\Entity\Product;
use Domain\Responder\CreateProductResponder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller implements CreateProductResponder
{
    /**
     * @Route("/admin/new-product", name="new-product")
     */
    public function newProductAction(Request $request)
    {
        $formModel = new FormModel();
        $form = $this->createForm(ProductType::class, $formModel);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commandHandler = $this->get('command_handler.create_product');
            $commandHandler->execute(
                new CreateProductCommand($formModel->getName(), $formModel->getDescription(), $formModel->getPrice()),
                $this
            );

            $this->addFlash('success', 'Produkt dodano.');

            return $this->redirect($this->generateUrl('new-product'));
        }

        return $this->render('@App/Admin/new_product.html.twig', ['form' => $form->createView()]);
    }

    public function productCreated(Product $product)
    {
        $event = new ProductAddedEvent($product);
        $this->get('event_dispatcher')->dispatch(Events::PRODUCT_ADDED, $event);
    }
}
