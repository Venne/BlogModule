<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace BlogModule;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class ModuleForm extends \CoreModule\Forms\ModuleForm
{


	public function startup()
	{
		parent::startup();

		$this->addGroup("Blog items");
		$this->addSelect("notationInHtml", "Notation in HTML", array(false => "no", true => "yes"));
		$this->addSelect("showNotationOnPage", "Show notation on page", array(false => "no", true => "yes"));
	}

}
