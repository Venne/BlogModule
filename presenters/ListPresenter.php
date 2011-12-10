<?php

namespace App\BlogModule;

use Nette\Environment;

/**
 * @author Josef Kříž
 * 
 * @secured
 */
class ListPresenter extends \Venne\Application\UI\PagePresenter {


	/** @var ListEntity */
	protected $entity;

	/**
	 * @inject blogListRepository
	 * @var \Venne\Doctrine\ORM\BaseRepository
	 */
	protected $repository;

	/**
	 * @inject blogRepository
	 * @var \Venne\Doctrine\ORM\BaseRepository
	 */
	protected $blogRepository;



	public function setRepository($repository)
	{
		$this->repository = $repository;
	}



	public function setBlogRepository($repository)
	{
		$this->blogRepository = $repository;
	}



	/**
	 * @privilege read
	 */
	public function startup()
	{
		parent::startup();

		$this->entity = $this->repository->findOneBy(array("page" => $this->page->id));
	}



	public function actionDefault()
	{
		$query = $this->blogRepository->createQueryBuilder("a")
				->leftJoin("a.categories", "p")
				->setMaxResults($this->entity->itemsPerPage)
				->orderBy("a.created", "DESC");
		$i = false;
		foreach ($this->entity->categories as $category) {
			if(!$i){
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



	public function beforeRender()
	{
		parent::beforeRender();

		$this->setRobots(self::ROBOTS_INDEX | self::ROBOTS_FOLLOW);
	}

}