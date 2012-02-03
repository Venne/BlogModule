<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 * @gmail.com)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\BlogModule\Subscribers;

use Doctrine\Common\EventSubscriber;
use App\CoreModule\Events\AdminEvents;
use App\CoreModule\Events\AdminEventArgs;
use App\CoreModule\Entities\NavigationEntity;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 */
class AdminSubscriber implements EventSubscriber {


	/**
	 * Array of events.
	 *
	 * @return array
	 */
	public function getSubscribedEvents()
	{
		return array(AdminEvents::onAdminMenu,);
	}



	/**
	 * onAdminMenu event.
	 *
	 * @param AdminEventArgs $args
	 */
	public function onAdminMenu(AdminEventArgs $args)
	{
		$nav = new NavigationEntity("Blog module");
		$nav->setLink(":Blog:Admin:Default:");
		$nav->setMask(":Blog:Admin:*:*");
		$args->addNavigation($nav);
	}

}
