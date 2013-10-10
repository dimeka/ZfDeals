<?php
namespace ZfDeals\Controller;

use Zend\Form\Form;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    private $form;
    private $mapper;

    public function indexAction()
    {
        return new ViewModel();
    }

    public function addProductAction()
    {
        $form = $this->getProductAddForm();

        if ($this->getRequest()->isPost()) {
            $form->setData($this->getRequest()->getPost());

            if ($form->isValid()) {
                $newEntity = $form->getData();

                $this->productMapper->insert($newEntity);

                return new ViewModel(
                    array(
                        'form' => $form,
                        'success' => true
                    )
                );
            } else {
                return new ViewModel(
                    array(
                        'form' =>$form
                    )
                );
            }
        } else {
            return new ViewModel(
                array(
                    'form' =>$form
                )
            );
        }
    }

    public function setProductAddForm($productAddForm)
    {
        $this->productAddForm = $productAddForm;
    }

    public function getProductAddForm()
    {
        return $this->productAddForm;
    }

    public function setProductMapper($productMapper)
    {
        $this->productMapper = $productMapper;
    }

    public function getProductMapper()
    {
        return $this->productMapper;
    }
}