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

use CoreModule\NavigationEntity;
use Nette\DI\ContainerBuilder;
use Nette\DI\Container;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class Module extends \Venne\Module\BaseModule
{


	/** @var string */
	protected $description = "Make basic blog";

	/** @var string */
	protected $version = "2.0";

	/** @var array */
	protected $dependencies = array("pages>=2.0");



	public function configure(\Nette\DI\Container $container)
	{
		parent::configure($container);

		$manager = $container->core->cmsManager;

		$manager->addContentType(Entities\BlogEntity::LINK, "blog entry", array("url"), $container->blog->blogRepository, function() use($container)
		{
			return $container->blog->createBlogForm();
		});

		$manager->addContentType(Entities\ListEntity::LINK, "blog list", array("url"), $container->blog->listRepository, function() use($container)
		{
			return $container->blog->createListForm();
		});
	}



	public function getForm(Container $container)
	{
		return new \BlogModule\ModuleForm($container->configFormMapper, $this->getName());
	}

}
