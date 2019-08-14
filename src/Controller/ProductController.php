<?php


namespace App\Controller;


use App\Entity\Produit;
use Sonata\SeoBundle\Seo\SeoPageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    public $seo;

    public function __construct(SeoPageInterface $seo)
    {
        $this->seo = $seo;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/product/view/{id}/{slug}",
     *     name="product_view",
     *     requirements={"id"="\d+"}
     * )
     */
    public function productView(Request $request, $id, $slug)
    {
        $product = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        $metas = $this->seo->getMetas();
        $title = $this->seo->getTitle().' - '.$product->getTitre();
        $keywords = $metas['name']['keywords'][0];

        foreach($product->getHashtags() as $h) {
            $keywords = $keywords.' ,'.$h->getNom();
        }

        $this->seo->setTitle($title);
        $this->seo->addMeta('name', 'keywords', $keywords);
        $this->seo->addMeta('name', 'description', substr($product->getDescription(), 0, 199));
        $this->seo->setLinkCanonical($request->getUri());

        return $this->render('product/view.twig', [
            'product' => $product,
        ]);
    }
}