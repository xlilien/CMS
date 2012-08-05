<?php
/**
 * TagPresenter.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame
 *
 * @date    28.07.12
 */

namespace FrontModule;

class TagPresenter extends FrontPresenter
{

	/**
	 * @var array
	 */
	private $posts;

	/**
	 * @var \Flame\CMS\Models\Tags\TagFacade
	 */
	private $tagFacade;

	/**
	 * @param \Flame\CMS\Models\Tags\TagFacade $tagFacade
	 */
	public function injectTagFacade(\Flame\CMS\Models\Tags\TagFacade $tagFacade)
	{
		$this->tagFacade = $tagFacade;
	}

	public function actionPosts($id)
	{
		if($tag = $this->tagFacade->getOne($id)){
			$this->template->tag = $tag;

			$this->posts = $tag->getPosts()->toArray();

			if(!count($this->posts)){
				$this->setView('none');
			}
		}else{
			$this->setView('notFound');
		}
	}

	public function createComponentPostsControl()
	{
		$postControl = new \Flame\CMS\Components\Posts\Post($this, 'postsControl');
		$postControl->setPosts($this->posts);
		return $postControl;
	}

}
