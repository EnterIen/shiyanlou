<?php

namespace core;

use dispatcher\Box;

class Orm extends Box
{
    public $_where;
    public $_select;
    public $_limit;
    public $_sql;
    public $_table;
    public $_params = [];

    public function init()
    {
        $this->_table = $this->table ?? strtolower(end(explode('\\',get_called_class()))).'s';
    }

	protected function find()
	{
        $this->_sql = 'SELECT * FROM '.$this->_table;
	    return $this;    
	}

	public function select($select)
	{
        if (is_array($select)) {
            $select = implode(',',$select);
        }
		$this->_sql = str_replace('*',trim($select),$this->_sql);
	    return $this;
	}

	public function one() 
	{
		$this->_limit = ' LIMIT 1';
	    return current($this->fetch());
	}

	public function all() 
	{
		return $this->fetch();
    }

    public function fetch()
    {
        return  Model::prepare($this->_sql.($this->_where ?? ''))
            ->bind($this->_params)
            ->get();
    }
}
