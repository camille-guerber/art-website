<?php

namespace App\Controller;

use App\Entity\About;
use App\Entity\Hashtag;
use App\Entity\Produit;
use App\Form\ContactType;
use App\Service\MessageGenerator;
use Knp\Component\Pager\PaginatorInterface;
use Sonata\SeoBundle\Seo\SeoPageInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class HomeController
 * @package App\Controller
 * @Route(
 *     path="/",
 * )
 */
class HomeController extends AbstractController
{

    public $seo;

    public function __construct(SeoPageInterface $seo)
    {
        $this->seo = $seo;
    }

    /**
     * @Route(
     *     path="/home",
     *     name="home",
     * )
     */
    public function home(Request $request, PaginatorInterface $paginator, MessageGenerator $messageGenerator)
    {
        $this->seo->setLinkCanonical($request->getUri());

        $query = $this->getDoctrine()->getRepository(Produit::class)->findAllByDate();
        $hashtags = $this->getDoctrine()->getRepository(Hashtag::class)->findAll();

        $pagination = $paginator->paginate(
            $query,
            $request->query->getInt('page', 1),
            10
        );

        return $this->render('home/index.html.twig', [
            'products' => $pagination,
            'hashtags' => $hashtags,
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/contact",
     *     name="home_contact"
     * )
     */
    public function contact(Request $request)
    {
        $this->seo->setLinkCanonical($request->getUri());

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($data);

            $em->flush();

            $this->addFlash('notice', 'Merci, votre message a bien été envoyé, je vous répondrai dès que possible.');

            return $this->redirectToRoute('home');
        }

        return $this->render('home/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/about",
     *     name="home_about"
     * )
     */
    public function about(Request $request, $id = 1)
    {
        $about = $this->getDoctrine()->getRepository(About::class)->find($id);

        $keywords = $this->seo->getMetas();
        $keywords = $keywords['name']['keywords'][0].' about, a propos, arts appliques, beaux arts paris';

        $this->seo->addMeta('name', 'keywords', $keywords);
        $this->seo->addMeta('name', 'description', substr($about->getDescription(), 0, 199));
        $this->seo->setLinkCanonical($request->getUri());

        return $this->render('home/about.html.twig', [
            'about' => $about,
        ]);
    }
}