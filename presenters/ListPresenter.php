<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\BlogModule;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 *
 * @secured
 */
class ListPresenter extends \App\CoreModule\Presenters\PagePresenter {



	public function actionDefault()
	{
		$query = $this->context->blog->blogRepository->createQueryBuilder("a")->leftJoin("a.categories", "p")->setMaxResults($this->page->itemsPerPage)->orderBy("a.created", "DESC");
		$i = false;
		foreach ($this->page->categories as $category) {
			if (!$i) {
				$i = true;
				$query = $query->where("p.id = :cat" . $category->id)->setParameter("cat" . $category->id, $category->id);
			}
			$query = $query->orWhere("p.id = :cat" . $category->id)->setParameter("cat" . $category->id, $category->id);
		}
		$this->template->items = $query->getQuery()->getResult();
		if (!$this->template->items) {
			$this->template->items = array();
		}
	}


}