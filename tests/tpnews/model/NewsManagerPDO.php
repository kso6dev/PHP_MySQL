<?php


class NewsManagerPDO extends NewsManager
{
    protected $_db;

    public function __construct(PDO $db)
    {
        $this->_db = $db;
    }

    public function get($id)
    {
        $news = null;
        try
        {
            $query = $this->_db->prepare('SELECT id, title, content, creation_date, modification_date, author FROM article WHERE id=:id');
            $query->execute(array(
                'id' => $id
            ));

            if ($rec = $query->fetch(PDO::FETCH_ASSOC))
            {
                $news = new News($rec);
            }
            $query->closeCursor();
        }
        catch (Exception $e)
        {
            $errorMessage = $e->getMessage();
            require('view/errorView.php');
        }
        return $news;
    }

    public function getList($start = -1, $limit = -1)
    {
        $newsList = [];
        $sqlquery = 'SELECT id, title, content, creation_date, modification_date, author FROM article';
        if ($start != -1 || $limit != -1)
        {
            $sqlquery .= ' LIMIT ' .(int)$limit . ' OFFSET ' .(int)$start;
        }
        $query = $this->_db->query($sqlquery);
        while ($rec = $query->fetch())
        {
            $news = new News($rec);
            $newsList[] = $news;
        }
        $query->closeCursor();
        return $newsList;
    }

    public function count()
    {
        $query = $this->_db->query('SELECT COUNT(*) as countnews FROM article');
        $rec = $query->fetch();
        return $rec['countnews'];
    }

    protected function add(News $news)
    {
        $query = $this->_db->prepare('INSERT INTO article(title, content, creation_date, modification_date, author) 
                                            VALUES(:title, :content, :creation_date, :modification_date, :author)');
        $query->execute(array(
            'title' => $news->title(),
            'content' => $news->content(),
            'creation_date' => $news->creation_date(),
            'modification_date' => $news->modification_date(),
            'author' => $news->author()
        ));
        $query->closeCursor();
    }

    public function delete($id)
    {
        $query = $this->_db->prepare('DELETE FROM article WHERE id=:id');
        $query->execute(array(
            'id' => $id
        ));
    }

    protected function update(News $news)
    {
        $query = $this->_db->prepare('UPDATE article SET title=:title, content=:content, author=:author, modification_date=NOW() WHERE id=:id');
        $query->execute(array(
            'title' => $news->title(),
            'content' => $news->content(),
            'author' => $news->author(),
            'id' => $news->id()
        ));
        $query->closeCursor();
    }
}