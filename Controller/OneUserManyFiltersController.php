<?php

namespace Mesd\FilterBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesd\FilterBundle\Form\Type\OneUserManyFiltersType;

/**
 * One User Many Filters controller.
 *
 */
class OneUserManyFiltersController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $userClass = $this->container->getParameter('mesd_filter.user_class');
        $userRepository = $entityManager->getRepository($userClass);
        $users = $userRepository->findAll();

        return $this->render('MesdFilterBundle:OneUserManyFilters:index.html.twig', array(
            'entities' => $users,
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function showAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $userClass = $this->container->getParameter('mesd_filter.user_class');
        $userRepository = $entityManager->getRepository($userClass);
        $entity = $userRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        return $this->render('MesdFilterBundle:OneUserManyFilters:show.html.twig', array(
            'entity'      => $entity,
        ));
    }

    /**
     * Displays a form to edit an existing User entity.
     *
     */
    public function editAction($id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $userClass = $this->container->getParameter('mesd_filter.user_class');
        $userRepository = $entityManager->getRepository($userClass);
        $entity = $userRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity, $userClass);

        return $this->render('MesdFilterBundle:OneUserManyFilters:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a User entity.
    *
    * @param User $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm($entity, $userClass)
    {
        $form = $this->createForm(new OneUserManyFiltersType($userClass), $entity, array(
            'action' => $this->generateUrl(
                'MesdFilterBundle_oneusermanyfilters_update',
                array(
                    'id' => $entity->getId(),
                )
            ),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing User entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $userClass = $this->container->getParameter('mesd_filter.user_class');
        $userRepository = $entityManager->getRepository($userClass);
        $entity = $userRepository->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find User entity.');
        }

        $editForm = $this->createEditForm($entity, $userClass);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $entityManager->flush();

            return $this->redirect($this->generateUrl('MesdFilterBundle_oneusermanyfilters_show', array('id' => $id)));
        }

        return $this->render('MesdFilterBundle:OneUserManyFilters:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        ));
    }
}
