<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace BlogModule\Forms;

use Nette\Utils\Html;
use Venne\Forms\Form;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ListForm extends \Venne\Forms\PageForm {


	public function startup()
	{
		$this->addGroup();
		$this->addManyToMany("categories", "Categories");
		$this->addText("itemsPerPage", "Items per page")->addRule(self::NUMERIC, "Value must be integer");
		$this->setCurrentGroup();

		parent::startup();
	}



	protected function getParams()
	{
		$arr = parent::getParams();
		$arr["module"] = "Blog";
		$arr["presenter"] = "List";
		$arr["url"] = isset($this->entity->localUrl) ? $this->entity->localUrl : NULL;
		return $arr;
	}

}
