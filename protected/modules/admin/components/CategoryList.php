<?php

//Yii::import('zii.widgets.CPortlet');

class CategoryList extends CWidget
{
    public $condition = array();
	public $selected = 0;
	public $model;
    
	public function init()
	{
		$this->getTypeList();
	}
    
	public function run()
	{
		
	}
    
	public function getTypeList()
	{
		$asktypes = $this->model->findAll($this->condition);
		$asktype_arr = array();
		foreach ($asktypes as $key => $asktype)
		{
			$asktype_arr[$key]['id'] = $asktype->id;
			$asktype_arr[$key]['pid'] = $asktype->pid;
			$asktype_arr[$key]['typename'] = $asktype->typename;
		}
		$tree_arr = $this->_nestedTree($asktype_arr);
		echo $this->_makeSelectOption($tree_arr);
	}
	
	private function _makeSelectOption($tree_arr)
	{
		$tree_html = '';
		static $indent_str = '';
		foreach ($tree_arr as $arr)
		{
			$selected_attr = '';
			if ($this->selected == $arr['id'])
			{
				$selected_attr = ' selected="selected"';
			}
            if ($arr['pid'] != 0)
            {
                $indent_str .= "&nbsp;&nbsp;";
            }
            $tree_html .= "<option value='{$arr['id']}'$selected_attr>{$indent_str}{$arr['typename']}</option>";
			if (!empty($arr['subtree'])) //如果有子类
			{
				$tree_html .= $this->_makeSelectOption($arr['subtree']);
			}
            $indent_str = '';
		}
		return $tree_html;
	}
	private function _nestedTree($tree_arr, $pid = 0)
	{
		$new_arr = array();
		foreach ($tree_arr as $arr)
		{
			if ($arr['pid'] == $pid)
			{
				$arr['subtree'] = $this->_nestedTree($tree_arr, $arr['id']);
				$new_arr[] = $arr;
			}
		}
		return $new_arr;
	}
	
	protected function renderContent()
	{
		//$this->render('categoryList');
	}
}