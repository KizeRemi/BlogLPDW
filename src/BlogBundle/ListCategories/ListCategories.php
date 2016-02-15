<?PHP

namespace BlogBundle\ListCategories;

use BlogBundle\Entity\Category;

class ListCategories
{
	private $doctrine;

	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function getCategories()
	{
		$categ = $this->doctrine->getRepository('BlogBundle:Category')->findAll();
        return $categ;
	}
}

?>