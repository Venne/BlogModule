<?php

/**
 * This file is part of the Venne:CMS (https://github.com/Venne)
 *
 * Copyright (c) 2011, 2012 Josef Kříž (http://www.josef-kriz.cz)
 *
 * For the full copyright and license information, please view
 * the file license.txt that was distributed with this source code.
 */

namespace App\BlogModule\Entities;

use Venne;

/**
 * @author Josef Kříž <pepakriz@gmail.com>
 * @Entity(repositoryClass="\Venne\Doctrine\ORM\BaseRepository")
 * @Table(name="blog")
 *
 * @property $title
 * @property $text
 * @property $created
 * @property $updated
 * @property $url
 */
class BlogEntity extends \App\PagesModule\Entities\BaseEntity {


	const LINK = "Blog:Default:default";

	/**
	 * @ManyToMany(targetEntity="CategoryEntity", cascade={"all"})
	 * @JoinTable(name="blogCategoriesLink",
	 *	  joinColumns={@JoinColumn(name="blog_id", referencedColumnName="id", onDelete="CASCADE")},
	 *	  inverseJoinColumns={@JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")}
	 *	  )
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
