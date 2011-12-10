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

/**
 * @author Josef Kříž
 */
class Module extends \App\PagesModule\Module {



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



	public function configure(\Venne\DI\Container $container, \App\CoreModule\CmsManager $manager)
	{
		parent::configure($container, $manager);

		$manager->addRepository("blog", function() use ($container) {
					return $container->doctrineContainer->getRepository("\\App\\BlogModule\\BlogEntity");
				});
		$manager->addRepository("blogCategory", function() use ($container) {
					return $container->doctrineContainer->getRepository("\\App\\BlogModule\\CategoryEntity");
				});
		$manager->addRepository("blogList", function() use ($container) {
					return $container->doctrineContainer->getRepository("\\App\\BlogModule\\ListEntity");
				});


		$manager->addContentType(BlogEntity::LINK, "blog entry", array("url"), function($entity) use($container) {
					return new BlogForm($entity, $container->doctrineContainer->entityFormMapper, $container->doctrineContainer->entityManager);
				}, function() use ($container) {
					return $container->blogRepository->createNew();
				});
				
		$manager->addContentType(ListEntity::LINK, "blog list", array("url"), function($entity) use($container) {
					return new ListForm($entity, $container->doctrineContainer->entityFormMapper, $container->doctrineContainer->entityManager);
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
