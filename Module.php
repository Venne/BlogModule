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

use \App\CoreModule\NavigationEntity;
use Nette\DI\ContainerBuilder;

/**
 * @author Josef Kříž
 */
class Module extends \Venne\Module\AutoModule {



	public function getName()
	{
		return "blog";
	}



	public function getDescription()
	{
		return "Make basic blog";
	}



	public function getVersion()
	{
		return "2.0";
	}



	public function getDependencies()
	{
		return array(
			"pages>=2.0"
		);
	}

	
	public function loadConfiguration(ContainerBuilder $container, array $config)
	{
		$container->addDefinition("blogRepository")
				->setClass("Venne\Doctrine\ORM\BaseRepository")
				->setFactory("@entityManager::getRepository", array("\\App\\BlogModule\\BlogEntity"))
				->addTag("repository")
				->setAutowired(false);
		
		$container->addDefinition("blogCategoryRepository")
				->setClass("Venne\Doctrine\ORM\BaseRepository")
				->setFactory("@entityManager::getRepository", array("\\App\\BlogModule\\CategoryEntity"))
				->addTag("repository")
				->setAutowired(false);
		
		$container->addDefinition("blogListRepository")
				->setClass("Venne\Doctrine\ORM\BaseRepository")
				->setFactory("@entityManager::getRepository", array("\\App\\BlogModule\\ListEntity"))
				->addTag("repository")
				->setAutowired(false);
	}


	public function configure(\Nette\DI\Container $container, \App\CoreModule\CmsManager $manager)
	{
		parent::configure($container, $manager);

		$manager->addContentType(BlogEntity::LINK, "blog entry", array("url"), function($entity) use($container) {
					return new BlogForm($container->entityFormMapper, $container->entityManager, $entity);
				}, function() use ($container) {
					return $container->blogRepository->createNew();
				});
				
		$manager->addContentType(ListEntity::LINK, "blog list", array("url"), function($entity) use($container) {
					return new ListForm($container->entityFormMapper, $container->entityManager, $entity);
				}, function() use ($container) {
					return $container->blogListRepository->createNew();
				});

		$manager->addEventListener(\App\CoreModule\Events::onAdminMenu, $this);
	}



	public function onAdminMenu($menu)
	{
		$nav = new NavigationEntity("Blog module");
		$nav->setLink(":Blog:Admin:Default:");
		$nav->setMask(":Blog:Admin:*:*");
		$menu->addNavigation($nav);
	}

}
