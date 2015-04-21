<?php
namespace MyApp\BlogBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use MyApp\BlogBundle\Entity\Article;
use MyApp\BlogBundle\Entity\Comments;
use MyApp\BlogBundle\Form\ArticleType;
use MyApp\BlogBundle\Form\CommentsType;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use \MyApp\BlogBundle\Entity\Hrefs;

class BlogController extends Controller
{
    public function ajouterAction()
    {
        $article = new Article();
        $article->setCreationDate(new \DateTime());
        $form =$this->createForm(new ArticleType(),$article);
        $request=$this->get('request');
        
        if($request->getMethod()=='POST')
        {
            $form->bindRequest($request);
            if($form->isValid())
            {
                $article =$form->getData();
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($article);
                $em->flush();
                return ($this->redirect('MyAppBlogBundle_homepage'));
            }
        }
        return $this->render('MyAppBlogBundle:Blog:ajouter.html.twig',array(
           'form'=>$form->createview(), 
        ));
    }
    public function indexAction($page)
    {
        if( $page < 0 )
        {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // la page d'erreur 404 (on pourra personnaliser cette page plus tard, d'ailleurs).
            throw new NotFoundHttpException('Page inexistante (page = '.$page.')');
        }
        elseif( $page == 0  )
        {
            $page =1;        
        }
        
        

        $em =$this->getDoctrine()->getEntityManager();
        $articles=$em->getRepository('MyAppBlogBundle:Article')
                ->findBy(array(), array('id'=>'DESC'));

        $i=0;
        $debut=($page-1)*5;
        $items =new \Doctrine\Common\Collections\ArrayCollection();
        foreach($articles as $article )
        {
            $article->setContent(substr($article->getContent(),0,700));
            if( strlen($article->getContent()) ==700) {
                $article->setContent($article->getContent().'...');
                
                };
            $i++;
            if($i>$debut && $i<=$debut+5)
            {
                $items[]=$article ;
            }
        }
        $nbre_page=ceil($i/5);
        $n =array();
        for($i=1;$i<=$nbre_page;$i++)
        {
            $n[] =$i;
        }
        return $this->render('MyAppBlogBundle:Blog:index.html.twig',array(
            "articles"=>$items,
            "nbre_page"=>$n,
            "page_now"=>$page,
            
           
            
        ));
    }
    public function viewAction($title)
    {
        $title = str_replace("-", " ",$title);
        $em = $this->getDoctrine()->getEntityManager();
        $article =$em->getRepository('MyAppBlogBundle:Article')
                     ->findOneBy(array('title'=>$title));
        $comments = new Comments();
        $comments->setArticle($article);
        $form= $this->createForm(new CommentsType(),$comments);
        $comms =$article->getComments(); 
        $request= $this->getRequest();
        
             if($request->getMethod()=='POST')
            {
                 $form->bindRequest($request);
                     if($form->isValid())
                     {
                
                        $comments =$form->getData();
                        $em->persist($comments);
                        $em->flush();
                                return $this->render('MyAppBlogBundle:Blog:voir.html.twig',array(
            "article"=>$article,
            "form"=>$form->createView(),
            "comments"=> $comms, 
            ));
                
                       }
            }
            
        
                
        return $this->render('MyAppBlogBundle:Blog:voir.html.twig',array(
            "article"=>$article,
            "form"=>$form->createView(),
            "comments"=> $comms,         
            ));
    }
    public function categAction($cat ,$page)
    {
       if( $page < 0 )
        {
            // On déclenche une exception NotFoundHttpException, cela va afficher
            // la page d'erreur 404 (on pourra personnaliser cette page plus tard, d'ailleurs).
            throw new NotFoundHttpException('Page inexistante (page = '.$page.')');
        }
        elseif( $page == 0  )
        {
            $page =1;        
        }
        
        $cat = str_replace("-", " ",$cat);
		$em = $this->getDoctrine()->getEntityManager();
		if($cat!="all")
		{
				
				$articles = $em->getRepository('MyAppBlogBundle:Article')
					->createQueryBuilder('a')
					->where('a.categorie=:cat')
					->setParameter('cat', $cat)
					->orderBy('a.creation_date','DESC')
					->getQuery()
					->getResult();        
        }
		else
		{
			    $articles = $em->getRepository('MyAppBlogBundle:Article')
					->createQueryBuilder('a')
					->orderBy('a.creation_date','DESC')
					->getQuery()
					->getResult();
		}
        
        $i=0;
        $debut=($page-1)*5;
        $items =new \Doctrine\Common\Collections\ArrayCollection();
        foreach($articles as $article )
        {
            $article->setContent(substr($article->getContent(),0,700));
            if( strlen($article->getContent()) ==700) {
                $article->setContent($article->getContent().'...');
                
                };
            $i++;
            if($i>$debut && $i<=$debut+5)
            {
                $items[]=$article ;
            }
        }
        $nbre_page=ceil($i/5);
        $n =array();
        for($i=1;$i<=$nbre_page;$i++)
        {
            $n[] =$i;
        }        
        
        return $this->render('MyAppBlogBundle:Blog:index.html.twig',array(
            "articles"=>$items,
            "nbre_page"=>$n,
            "page_now"=>$page,));
        
    }
    public function resumeAction()
    {
        return $this->render('MyAppBlogBundle:Blog:cv.html.twig');
    }


    
}

