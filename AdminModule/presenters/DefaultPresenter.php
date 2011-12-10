<?php

namespace App\BlogModule\AdminModule;

use Nette\Forms\Form;
use Nette\Web\Html;

/**
 * @author Josef Kříž
 * 
 * @secured
 */
class DefaultPresenter extends \Venne\Application\UI\AdminPresenter {

	/** @persistent */
	public $id;
	
	/**
	 * @privilege read
	 */
	public function startup()
	{
		parent::startup();
		$this->addPath("Blog", $this->link(":Blog:Admin:Default:"));
		\Nette\Config\NeonAdapter::save(array("key" => array("a" => "b", "c" => "d"), "key2" => array(), "key4" => "ppp", "key3" => array("a" => "b", "c" => "d")), $this->context->params["tempDir"] . "/test.neon");
	}



	public function actionCreate()
	{
		$this->addPath("new item", $this->link(":Blog:Admin:Default:create"));
	}



	public function actionEdit()
	{
		$this->addPath("Edit ({$this->id})", $this->link(":Blog:Admin:Default:edit"));
	}



	public function createComponentForm($name)
	{
		$repository = $this->context->blogCategoryRepository;
		$entity = $this->context->blogCategoryRepository->createNew();
		$em = $this->context->doctrineContainer->entityManager;
		
		$form = new \App\BlogModule\CategoryForm($entity, $this->context->doctrineContainer->entityFormMapper, $em);
		$form->setSuccessLink("default");
		$form->setFlashMessage("Page has been created");
		$form->setSubmitLabel("Create");
		$form->onSave[] = function($form) use ($repository){
			$repository->save($form->entity);
		};
		return $form;
	}



	public function createComponentFormEdit($name)
	{
		$repository = $this->context->blogCategoryRepository;
		$entity = $this->context->blogCategoryRepository->find($this->id);
		$em = $this->context->doctrineContainer->entityManager;
		
		$form = new \App\BlogModule\CategoryForm($entity, $this->context->doctrineContainer->entityFormMapper, $em);
		$form->setSuccessLink("this");
		$form->setFlashMessage("Page has been updated");
		//$form->setSubmitLabel("Update");
		$form->onSave[] = function($form) use ($repository){
			$repository->save($form->entity);
		};
		return $form;
	}



	public function beforeRender()
	{
		parent::beforeRender();
		$this->setTitle("Venne:CMS | Blog administration");
		$this->setKeywords("blog administration");
		$this->setDescription("blog administration");
		$this->setRobots(self::ROBOTS_NOINDEX | self::ROBOTS_NOFOLLOW);
	}



	public function handleDelete($id)
	{
		$this->context->blogCategoryRepository->delete($this->context->blogCategoryRepository->find($this->id));
		$this->flashMessage("Page has been deleted", "success");
		$this->redirect("this", array("id" => NULL));
	}



	public function renderDefault()
	{
		$this->template->table = $this->context->blogCategoryRepository->findAll();
	}

}