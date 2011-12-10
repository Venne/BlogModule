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
 * @Table(name="blog")
 * 
 * @property $title
 * @property $text
 * @property $created
 * @property $updated
 * @property $url
 */
class BlogEntity extends \App\PagesModule\BaseEntity {


	const LINK = "Blog:Default:default";

	/**
	 * @ManyToMany(targetEntity="CategoryEntity", cascade={"all"})
	 * @JoinTable(name="blogCategoriesLink",
	 *      joinColumns={@JoinColumn(name="`from`", referencedColumnName="id", onDelete="CASCADE")},
	 *      inverseJoinColumns={@JoinColumn(name="`to`", referencedColumnName="id", onDelete="CASCADE")}
	 *      )
	 */
	protected $categories;

	/** @Column (type="text") */
	protected $notation;



	public function getCategories()
	{
		return $this->categories;
	}



	public function setCategories($categories)
	{
		$this->categories = $categories;
	}



	public function getNotation()
	{
		return $this->notation;
	}



	public function setNotation($notation)
	{
		$this->notation = $notation;
	}



	public function __toString()
	{
		return $this->title;
	}

}
