<?PHP

namespace BlogBundle\Twig;

class blogExtension extends \Twig_Extension
{
	private $listcategories;

	public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getCategories', array($this, 'getCategories')),
        );
    }

    public function getCategories()
    {
    	return $this->listcategories->getCategories();
    }

	public function __construct($listcategories)
	{
		$this->listcategories = $listcategories;
	}

	public function getName()
	{
		return 'social_extension';
	}
}

?>