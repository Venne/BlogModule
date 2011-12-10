<?php

/**
 * Venne:CMS (version 2.0-dev released on $WCDATE$)
 *
 * Copyright (c) 2011 Josef Kříž pepakriz@gmail.com
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\BlogModule;

use Venne\ORM\Column;
use Nette\Utils\Html;
use Venne\Forms\Form;

/**
 * @author Josef Kříž
 */
class BlogForm extends \App\PagesModule\PagesForm {



	public function startup()
	{
		$this->addGroup();
		$this->addManyToMany("categories", "Categories");
		$this->addTextArea("notation", "Notation");
		$this->setCurrentGroup();

		parent::startup();

		unset($this["mainPage"]);
		$this["url"]->setRequired("Enter url");
	}



	protected function getParams()
	{
		$arr = parent::getParams();
		$arr["module"] = "Blog";
		return $arr;
	}

}
