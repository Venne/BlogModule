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

/**
 * @author Josef Kříž
 * @Entity(repositoryClass="\Venne\Doctrine\ORM\BaseRepository")
 * @Table(name="blogList")
 * 
 * @property $title
 * @property $text
 * @property $created
 * @property $updated
 * @property $url
 */
class ListEntity extends \App\CoreModule\BasePageEntity {


	const LINK = "Blog:List:default";

	/**
	 * @ManyToMany(targetEntity="CategoryEntity", cascade={"all"})
	 * @JoinTable(name="blogListLink",
	 *      joinColumns={@JoinColumn(name="`from`", referencedColumnName="id", onDelete="CASCADE")},
	 *      inverseJoinColumns={@JoinColumn(name="`to`", referencedColumnName="id", onDelete="CASCADE")}
	 *      )
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
