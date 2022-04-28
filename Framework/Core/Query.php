<?php

namespace Jet\Framework\Core;

use Jet\Framework\Query\QueryBuilder;

class Query
{
    private $query;
    private $connection;

    /**
     * @var Connection
     */

    public function __construct($sql = "")
    {
        $this->connection = new Connection();
        $this->setQuery($sql);
    }

    use QueryBuilder;

    /**
     * @return string
     */
    public function getQuery(): string
    {
        return $this->query;
    }

    /**
     * @param string $query
     */
    public function setQuery(string $query): Query
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param $new: the new body of the query to concatenate to the current query.
     * @return Query
     */
    public function add($new): Query
    {
        $this->query.=" ".$new;
        return $this;
    }

    public function __toString(){
        return (string) $this->query;
    }

    public function __destruct()
    {
        return $this->__toString();
    }


}
