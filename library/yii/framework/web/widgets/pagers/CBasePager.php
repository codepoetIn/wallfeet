<?php
/**
 * CBasePager class file.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @link http://www.yiiframework.com/
 * @copyright Copyright &copy; 2008-2011 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

/**
 * CBasePager is the base class for all pagers.
 *
 * It provides the calculation of page count and maintains the current page.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @version $Id: CBasePager.php,v 1.1.1.1 2012-01-04 21:08:27 karthick Exp $
 * @package system.web.widgets.pagers
 * @since 1.0
 */
abstract class CBasePager extends CWidget
{
	private $_pages;

	/**
	 * Returns the pagination information used by this pager.
	 * @return CPagination the pagination information
	 */
	public function getPages()
	{
		if($this->_pages===null)
			$this->_pages=$this->createPages();
		return $this->_pages;
	}

	/**
	 * Sets the pagination information used by this pager.
	 * @param CPagination $pages the pagination information
	 */
	public function setPages($pages)
	{
		$this->_pages=$pages;
	}

	/**
	 * Creates the default pagination.
	 * This is called by {@link getPages} when the pagination is not set before.
	 * @return CPagination the default pagination instance.
	 */
	protected function createPages()
	{
		return new CPagination;
	}

	/**
	 * @return integer number of items in each page.
	 * @see CPagination::getPageSize
	 */
	public function getPageSize()
	{
		return $this->getPages()->getPageSize();
	}

	/**
	 * @param integer $value number of items in each page
	 * @see CPagination::setPageSize
	 */
	public function setPageSize($value)
	{
		$this->getPages()->setPageSize($value);
	}

	/**
	 * @return integer total number of items.
	 * @see CPagination::getItemCount
	 */
	public function getItemCount()
	{
		return $this->getPages()->getItemCount();
	}

	/**
	 * @param integer $value total number of items.
	 * @see CPagination::setItemCount
	 */
	public function setItemCount($value)
	{
		$this->getPages()->setItemCount($value);
	}

	/**
	 * @return integer number of pages
	 * @see CPagination::getPageCount
	 */
	public function getPageCount()
	{
		return $this->getPages()->getPageCount();
	}

	/**
	 * @param boolean $recalculate whether to recalculate the current page based on the page size and item count.
	 * @return integer the zero-based index of the current page. Defaults to 0.
	 * @see CPagination::getCurrentPage
	 */
	public function getCurrentPage($recalculate=true)
	{
		return $this->getPages()->getCurrentPage($recalculate);
	}

	/**
	 * @param integer $value the zero-based index of the current page.
	 * @see CPagination::setCurrentPage
	 */
	public function setCurrentPage($value)
	{
		$this->getPages()->setCurrentPage($value);
	}

	/**
	 * Creates the URL suitable for pagination.
	 * @param integer $page the page that the URL should point to.
	 * @return string the created URL
	 * @see CPagination::createPageUrl
	 */
	protected function createPageUrl($page)
	{
		return $this->getPages()->createPageUrl($this->getController(),$page);
	}
}
