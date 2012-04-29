<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace BlogModule\Entities;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\Venne\Doctrine\ORM\BaseRepository")
 * @Table(name="blogList")
 *
 * @property $title
 * @property $text
 * @property $created
 * @property $updated
 * @property $url
 */
class ListEntity extends \CoreModule\Entities\BasePageEntity {


	const LINK = "Blog:List:default";

	/**
	 * @ManyToMany(targetEntity="CategoryEntity", cascade={"all"})
	 * @JoinTable(name="blogListLink",
	 *	  joinColumns={@JoinColumn(name="list_id", referencedColumnName="id", onDelete="CASCADE")},
	 *	  inverseJoinColumns={@JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")}
	 *	  )
	 */
	protected $categories;

	/** @Column (type="integer") */
	protected $itemsPerPage;



	public function __construct()
	{
		parent::__construct();
		$this->itemsPerPage = 10;
	}



	public function getCategories()
	{
		return $this->categories;
	}



	public function setCategories($categories)
	{
		$this->categories = $categories;
	}



	public function getItemsPerPage()
	{
		return $this->itemsPerPage;
	}



	public function setItemsPerPage($itemsPerPage)
	{
		$this->itemsPerPage = $itemsPerPage;
	}

}
