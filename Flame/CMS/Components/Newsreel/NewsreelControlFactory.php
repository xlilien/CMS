<?php
/**
 * NewsreelControlFactory.php
 *
 * @author  Jiří Šifalda <sifalda.jiri@gmail.com>
 * @package Flame\CMS
 *
 * @date    21.10.12
 */

namespace Flame\CMS\Components\Newsreel;

class NewsreelControlFactory extends \Flame\Application\ControlFactory
{

	/**
	 * @var int
	 */
	private $itemsInNewsreelMenuList = 3;

	/**
	 * @var \Flame\CMS\Models\Options\OptionFacade $optionFacade
	 */
	private $optionFacade;

	/**
	 * @var \Flame\CMS\Models\Newsreel\NewsreelFacade $newsreelFacade
	 */
	private $newsreelFacade;

	/**
	 * @param \Flame\CMS\Models\Newsreel\NewsreelFacade $newsreelFacade
	 */
	public function injectNewsreelFacade(\Flame\CMS\Models\Newsreel\NewsreelFacade $newsreelFacade)
	{
		$this->newsreelFacade = $newsreelFacade;
	}

	/**
	 * @param \Flame\CMS\Models\Options\OptionFacade $optionFacade
	 */
	public function injectOptionFacade(\Flame\CMS\Models\Options\OptionFacade $optionFacade)
	{
		$this->optionFacade = $optionFacade;
	}

	/**
	 * @param null $data
	 * @return NewsreelControl
	 */
	public function create($data = null)
	{
		$control = new NewsreelControl();
		$control->setItems($this->newsreelFacade->getLastPassedNewsreel($this->itemsInNewsreelMenuList));
		return $control;
	}

	/**
	 * @param $limit
	 */
	public function setLimit($limit)
	{
		if((int) $limit > 0) $this->itemsInNewsreelMenuList = (int) $limit;
	}

}
