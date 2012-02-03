<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\BlogModule\AdminModule;

use Nette\Forms\Form;
use Nette\Web\Html;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 *
 * @secured
 */
class DefaultPresenter extends \Venne\Application\UI\AdminPresenter {


	/** @persistent */
	public $id;



	public function startup()
	{
		parent::startup();
		$this->addPath("Blog", $this->link(":Blog:Admin:Default:"));
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
		$repository = $this->context->blog->categoryRepository;
		$entity = $repository->createNew();
		$em = $this->context->entityManager;

		$form = $this->context->blog->createCategoryForm();
		$form->setEntity($entity);
		$form->addSubmit("_submit", "Save");
		$form->onSuccess[] = function($form) use ($repository)
		{
			$repository->save($form->entity);
			$form->presenter->flashMessage("Category has been created");
			$form->presenter->redirect("default");
		};
		return $form;
	}



	public function createComponentFormEdit($name)
	{
		$repository = $this->context->blog->categoryRepository;
		$entity = $repository->find($this->id);
		$em = $this->context->entityManager;

		$form = $this->context->blog->createCategoryForm();
		$form->setEntity($entity);
		$form->addSubmit("_submit", "Save");
		$form->onSuccess[] = function($form) use ($repository)
		{
			$repository->save($form->entity);
			$form->presenter->flashMessage("Category has been updated");
			$form->presenter->redirect("this");
		};
		return $form;
	}



	public function handleDelete($id)
	{
		$this->context->blog->categoryRepository->delete($this->context->blogCategoryRepository->find($this->id));
		$this->flashMessage("Page has been deleted", "success");
		$this->redirect("this", array("id" => NULL));
	}



	public function renderDefault()
	{
		$this->template->table = $this->context->blog->categoryRepository->findAll();
	}

}