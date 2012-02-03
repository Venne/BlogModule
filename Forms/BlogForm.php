<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\BlogModule\Forms;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class BlogForm extends \App\PagesModule\Forms\PagesForm {


	public function startup()
	{
		$this->addGroup();
		$this->addManyToMany("categories", "Categories");

		if($this->presenter->context->parameters["modules"]["blog"]["notationInHtml"]){
			$this->addEditor("notation", "Notation");
		}else{
			$this->addTextArea("notation", "Notation");
		}

		$this->setCurrentGroup();

		parent::startup();

		unset($this["mainPage"]);
		$this["localUrl"]->setRequired("Enter url");
	}



	protected function getParams()
	{
		$arr = parent::getParams();
		$arr["module"] = "Blog";
		return $arr;
	}

}
