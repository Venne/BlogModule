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

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class CategoryForm extends \Venne\Forms\EntityForm {


	public function startup()
	{
		parent::startup();

		$this->addGroup();
		$this->addManyToOne("parent", "Parent");
		$this->addText("name", "Category name");
	}

}
