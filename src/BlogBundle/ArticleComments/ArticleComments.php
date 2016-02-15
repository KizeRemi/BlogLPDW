<?PHP

namespace BlogBundle\ArticleComments;

use BlogBundle\Entity\Comment;

class ArticleComments
{
	private $doctrine;

	public function __construct($doctrine)
	{
		$this->doctrine = $doctrine;
	}

	public function getComments($id)
	{
		$comments = $this->doctrine->getRepository('BlogBundle:Comment')->getByIdArticle($id);
        return $comments;
	}
}

?>