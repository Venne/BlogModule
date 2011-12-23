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
class ListForm extends \Venne\Forms\PageForm {



	public function startup()
	{
		$this->addGroup();
		$this->addManyToMany("categories", "Categories");
		$this->addText("itemsPerPage", "Items per page")
				->addRule(self::NUMERIC, "Value must be integer");
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
