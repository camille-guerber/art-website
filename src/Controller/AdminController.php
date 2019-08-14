<?php


namespace App\Controller;


use App\Entity\About;
use App\Entity\Contact;
use App\Entity\Hashtag;
use App\Entity\Produit;
use App\Form\AboutType;
use App\Form\HashtagEditType;
use App\Form\HashtagType;
use App\Form\ProduitEditType;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class AdminController
 * @package App\Controller
 * @Route(
 *     path="/admin",
 * )
 */
class AdminController extends AbstractController
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/index",
     *     name="admin_index",
     * )
     */
    public function index()
    {
        return $this->render('admin/index.html.twig');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/product/create",
     *     name="admin_product_create",
     * )
     */
    public function productCreate(Request $request)
    {
        $form = $this->createForm(ProduitType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $product = $form->getData();

            $product->setCreatedAt(new \DateTime());
            $product->setUpdatedAt(new \DateTime());

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            $this->addFlash('notice', $product->getTitre().' a bien été ajouté.');

            return $this->redirectToRoute('admin_product_list');
        }

        return $this->render('product/create.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/product/list",
     *     name="admin_product_list"
     * )
     */
    public function productList(Request $request)
    {
        $products = $this->getDoctrine()->getRepository(Produit::class)->findAllByDate()->getResult();

        return $this->render('product/list.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route(
     *     path="/product/edit/{id}",
     *     name="admin_product_edit",
     *     requirements={"id"="\d+"}
     * )
     */
    public function productEdit(Request $request, $id)
    {
        $product = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        $form = $this->createForm(ProduitEditType::class, $product);

        $form->add('edit', SubmitType::class, [
            'label' => 'Editer',
        ]);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $productEdited = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();

            $this->addFlash('notice',$product->getTitre().' a bien été édité.');

            return $this->redirectToRoute('admin_product_list');
        }

        return $this->render('product/edit.twig', [
            'form' => $form->createView(),
            'product' => $product,
        ]);

    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @Route(
     *     path="/product/remove/{id}",
     *     name="admin_product_remove",
     *     requirements={"id"="\d+"}
     * )
     */
    public function removeProduct(Request $request, $id)
    {
        $product = $this->getDoctrine()->getRepository(Produit::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($product);

        $em->flush();

        $this->addFlash('notice', 'Le produit '.$product->getTitre().' a bien été supprimé.');

        return $this->redirectToRoute('admin_product_list');
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/hashtag/create",
     *     name="admin_hashtag_create",
     * )
     */
    public function hashtagCreate(Request $request)
    {
        $form = $this->createForm(HashtagType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $hashtag = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($hashtag);
            $em->flush();
            $this->addFlash('notice', "Le hashtag ".$hashtag->getNom()." a bien été ajouté !");

            return $this->redirectToRoute('admin_hashtag_list');
        }

        return $this->render('hashtag/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/hashtag/list",
     *     name="admin_hashtag_list"
     * )
     */
    public function hashtagList(Request $request)
    {
        $hashtags = $this->getDoctrine()->getRepository(Hashtag::class)->findAll();

        return $this->render('hashtag/list.html.twig', [
            'hashtags' => $hashtags,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route(
     *     path="/hashtag/remove/{id}",
     *     name="admin_hashtag_remove",
     *     requirements={"id"="\d+"}
     * )
     */
    public function hashtagRemove(Request $request, $id)
    {
        $hashtag = $this->getDoctrine()->getRepository(Hashtag::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($hashtag);

        $em->flush();

        $this->addFlash('notice', 'Le hashtag '.$hashtag->getNom().' a bien été supprimé.');

        return $this->redirectToRoute('admin_hashtag_list');
    }

    /**
     * @param Request $request
     * @param $id
     * @Route(
     *     path="/hashtag/edit/{id}",
     *     name="admin_hashtag_edit",
     *     requirements={"id"="\d+"}
     * )
     */
    public function hashtagEdit(Request $request, $id)
    {
        $hashtag = $this->getDoctrine()->getRepository(Hashtag::class)->find($id);

        $form = $this->createForm(HashtagEditType::class, $hashtag);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('notice', 'Le hahstag '.$hashtag->getNom().' a bien été modifié.');

            return $this->redirectToRoute('admin_hashtag_list');
        }

        return $this->render('hashtag/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param Request $request
     * @Route(
     *     path="/message/list",
     *     name="admin_message_list"
     * )
     */
    public function messageList(Request $request)
    {
        $messages = $this->getDoctrine()->getRepository(Contact::class)->findAllByDate();

        return $this->render('message/list.html.twig', [
            'messages' => $messages,
        ]);
    }

    /**
     * @param Request $request
     * @param $id
     * @Route(
     *     path="/message/remove/{id}",
     *     name="admin_message_remove",
     *     requirements={"id"="\d+"}
     * )
     */
    public function messageRemove(Request $request, $id)
    {
        $message = $this->getDoctrine()->getRepository(Contact::class)->find($id);

        $em = $this->getDoctrine()->getManager();

        $em->remove($message);

        $em->flush();

        $this->addFlash('notice', 'Message bien supprimé.');

        return $this->redirectToRoute('admin_message_list');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route(
     *     path="/message/view/{id}",
     *     name="admin_message_view",
     *     requirements={"id"="\d+"}
     * )
     */
    public function messageView(Request $request, $id)
    {
        $message = $this->getDoctrine()->getRepository(Contact::class)->find($id);

        $message->setIsRead(true);

        $em = $this->getDoctrine()->getManager();

        $em->flush();

        return $this->render('message/view.twig', [
            'message' => $message,
        ]);
    }

    /**
     * @param Request $request
     * @param int $id
     * @Route(
     *     path="/about/edit",
     *     name="admin_about_edit",
     * )
     */
    public function aboutEdit(Request $request, $id = 1)
    {
        $about = $this->getDoctrine()->getRepository(About::class)->find($id);

        $form = $this->createForm(AboutType::class, $about);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $this->addFlash('notice', 'La page à propos à bien été éditée');

            return $this->redirectToRoute('admin_index');
        }

        return $this->render('about/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}