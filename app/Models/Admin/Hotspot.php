<?php

namespace App\Models\Admin;

/**
 * 热点模型
 *
 */
class Hotspot extends Base
{
    /**
     * 表名
     *
     * @var string
     */
    protected $table = 'hotspot';

    /**
     * 可以被集体附值的表的字段
     *
     * @var string
     */
    protected $fillable = array('id', 'name', 'agency_id', 'status');

    /**
     * 状态
     */
    const ON = 1;
    const OFF = 0;


    /**
     * 与agency表关联
     */
    public function agency()
    {
        return $this->belongsTo('App\Models\Admin\Agency');
    }
    
    /**
     * 取得所有
     *
     * @return array
     */
    public function getAllByPage()
    {
        $currentQuery = $this->orderBy('id', 'desc')->paginate(self::PAGE_NUMS);
        return $currentQuery;
    }

    /**
     * 取得所有
     *
     * @return array
     */
    public function getAll()
    {
        return $this->all();
    }

    /**
     * 取得指定ID
     * 
     * @param intval $id
     * @return array
     */
    public function getById($id)
    {
        return $this->where('id', '=', intval($id))->first();
    }

    /**
     * 增加
     * 
     * @param array $data 所需要插入的信息
     * @return static
     */
    public function add(array $data)
    {
        return $this->create($data);
    }
    
    /**
     * 修改
     * 
     * @param array $data 所需要插入的信息
     */
    public function edit(array $data, $id)
    {
        return $this->where('id', '=', intval($id))->update($data);
    }
    
    /**
     * 删除
     * 
     * @param array $ids
     * @return int
     */
    public function del(array $ids)
    {
        return $this->destroy($ids);
    }

    /**
     * 取得指定ID组
     * 
     * @param int $ids
     * @return array
     */
    public function getInIds($ids)
    {
        if( ! is_array($ids)) return false;
        return $this->whereIn('id', $ids)->get()->toArray();
    }

}
