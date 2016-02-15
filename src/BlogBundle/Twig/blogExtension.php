<?PHP

namespace BlogBundle\Twig;

class blogExtension extends \Twig_Extension
{
	private $listcategories;
	private $articlecomments;

	public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('getCategories', array($this, 'getCategories')),
            new \Twig_SimpleFunction('getComments', array($this, 'getComments')),
        );
    }

    public function getCategories()
    {
    	return $this->listcategories->getCategories();
    }
    public function getComments($id)
    {
    	return $this->articlecomments->getComments($id);
    }
	public function __construct($listcategories, $articlecomments)
	{
		$this->listcategories = $listcategories;
		$this->articlecomments = $articlecomments;
	}

	public function getName()
	{
		return 'social_extension';
	}
}

?>