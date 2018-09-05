<?php

abstract class NewsManager
{

    abstract public function get($id);

    abstract public function getList($start = -1, $limit = -1);

    abstract public function count();

    abstract protected function add(News $news);

    abstract protected function update(News $news);

    public function save(News $news)
    {
        if($news->isValid())
        {
            $news->isNew() ? $this->add($news) : $this->update($news);
        }
        else
        {
            throw new RuntimeException('La news doit etre valide pour etre enregistrée');
        }
    }

    abstract public function delete($id);
}