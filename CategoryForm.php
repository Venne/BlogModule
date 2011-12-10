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

/**
 * @author Josef Kříž
 */
class CategoryForm extends \Venne\Forms\EntityForm {



	public function startup()
	{
		parent::startup();

		$this->addManyToOne("parent", "Parent");
		$this->addText("name", "Category name");
	}

}
