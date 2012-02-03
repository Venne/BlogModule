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
 * @Entity(repositoryClass="Venne\Doctrine\ORM\BaseRepository")
 * @Table(name="blogCategory")
 */
class CategoryEntity extends \Venne\Doctrine\ORM\NamedEntity {


	/**
	 * @OneToMany(targetEntity="categoryEntity", mappedBy="parent", cascade={"persist", "remove"}, orphanRemoval=true)
	 */
	protected $childrens;

	/**
	 * @ManyToOne(targetEntity="categoryEntity", inversedBy="id", cascade={"persist", "remove"})
	 * @JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
	 */
	protected $parent;



	public function __construct()
	{
		parent::__construct();
		$this->childrens = new \Doctrine\Common\Collections\ArrayCollection;
	}



	public function getChildrens()
	{
		return $this->childrens;
	}



	public function setChildrens($childrens)
	{
		$this->childrens = $childrens;
	}



	public function getParent()
	{
		return $this->parent;
	}



	public function setParent($parent)
	{
		$this->parent = $parent;
	}


}
